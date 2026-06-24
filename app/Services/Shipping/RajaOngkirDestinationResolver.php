<?php

namespace App\Services\Shipping;

use App\Exceptions\ShippingException;
use Illuminate\Support\Str;

class RajaOngkirDestinationResolver
{
    protected $costService;

    public function __construct(RajaOngkirCostService $costService)
    {
        $this->costService = $costService;
    }

    public function resolve(array $location)
    {
        $candidates = collect();

        foreach ($this->buildSearchKeywords($location) as $keyword) {
            foreach ($this->costService->searchDomesticDestinations($keyword, 20, 0) as $destination) {
                $candidates->put($destination['id'], $destination);
            }
        }

        $scored = $candidates
            ->map(function ($destination) use ($location) {
                return [
                    'score' => $this->scoreCandidate($destination, $location),
                    'destination' => $destination,
                ];
            })
            ->filter(function ($item) {
                return $item['score'] >= 100;
            })
            ->sortByDesc('score')
            ->values();

        if ($scored->isEmpty()) {
            throw new ShippingException(
                'Unable to resolve RajaOngkir destination.',
                'Alamat pengiriman belum bisa dipetakan ke tujuan RajaOngkir. Cek kembali kecamatan dan kabupaten.'
            );
        }

        if ($scored->count() > 1 && $scored[0]['score'] === $scored[1]['score']) {
            throw new ShippingException(
                'Ambiguous RajaOngkir destination match.',
                'Alamat pengiriman menghasilkan lebih dari satu tujuan RajaOngkir. Periksa kembali detail alamat.'
            );
        }

        return $scored[0]['destination'];
    }

    protected function buildSearchKeywords(array $location)
    {
        return collect([
            implode(' ', array_filter([
                $location['desa_name'] ?? null,
                $location['kecamatan_name'] ?? null,
                $location['kabupaten_name'] ?? null,
            ])),
            implode(' ', array_filter([
                $location['kecamatan_name'] ?? null,
                $location['kabupaten_name'] ?? null,
                $location['provinsi_name'] ?? null,
            ])),
            implode(' ', array_filter([
                $location['kabupaten_name'] ?? null,
                $location['provinsi_name'] ?? null,
            ])),
        ])->map(function ($keyword) {
            return trim((string) $keyword);
        })->filter()->unique()->values()->all();
    }

    protected function scoreCandidate(array $destination, array $location)
    {
        $province = $this->normalizeText($location['provinsi_name'] ?? '');
        $city = $this->normalizeText($location['kabupaten_name'] ?? '');
        $district = $this->normalizeText($location['kecamatan_name'] ?? '');
        $village = $this->normalizeText($location['desa_name'] ?? '');
        $postalCode = trim((string) ($location['postal_code'] ?? ''));

        $label = $this->normalizeText($destination['label'] ?? '');
        $destinationProvince = $this->normalizeText($destination['province'] ?? '');
        $destinationCity = $this->normalizeText($destination['city'] ?? '');
        $destinationDistrict = $this->normalizeText($destination['district'] ?? '');
        $destinationSubdistrict = $this->normalizeText($destination['subdistrict'] ?? '');
        $destinationVillage = $this->normalizeText($destination['village'] ?? '');
        $destinationZip = trim((string) ($destination['zip_code'] ?? ''));

        $provinceMatched = $province !== '' && ($province === $destinationProvince || Str::contains($label, $province));
        $cityMatched = $city !== '' && (
            $city === $destinationCity
            || $city === $destinationDistrict
            || Str::contains($label, $city)
        );
        $districtMatched = $district !== '' && (
            $district === $destinationSubdistrict
            || $district === $destinationDistrict
            || Str::contains($label, $district)
        );

        if (!$provinceMatched || !$cityMatched || !$districtMatched) {
            return 0;
        }

        $score = 100;

        if ($village !== '') {
            if ($village === $destinationVillage) {
                $score += 15;
            } elseif (Str::contains($label, $village)) {
                $score += 8;
            }
        }

        if ($postalCode !== '' && $postalCode === $destinationZip) {
            $score += 5;
        }

        return $score;
    }

    protected function normalizeText($value)
    {
        $value = Str::lower((string) $value);
        $value = preg_replace('/\b(provinsi|kabupaten|kota|kecamatan|kelurahan|desa)\b/u', ' ', $value);
        $value = preg_replace('/[^a-z0-9]+/u', ' ', $value);

        return trim(preg_replace('/\s+/u', ' ', $value));
    }
}
