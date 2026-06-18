<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use App\Models\MerchandiseCategory;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function home()
    {
        $featuredMerchandises = Merchandise::with('category')
            ->active()
            ->latest()
            ->take(6)
            ->get();

        return view('landing.index', [
            'featuredMerchandises' => $featuredMerchandises,
        ]);
    }

    public function merchandise(Request $request)
    {
        $query = Merchandise::with('category')->active();

        if ($request->filled('q')) {
            $search = trim($request->q);
            $query->where(function ($inner) use ($search) {
                $inner->where('name', 'like', '%' . $search . '%')
                    ->orWhere('summary', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($inner) use ($request) {
                $inner->where('slug', $request->category);
            });
        }

        if ($request->sort === 'price-asc') {
            $query->orderBy('price');
        } elseif ($request->sort === 'price-desc') {
            $query->orderByDesc('price');
        } else {
            $query->latest();
        }

        $merchandises = $query->paginate(12)->withQueryString();

        return view('landing.merchandise', [
            'merchandises' => $merchandises,
            'merchandiseCategories' => MerchandiseCategory::where('is_active', true)->orderBy('name')->get(),
            'filters' => $request->only(['q', 'category', 'sort']),
        ]);
    }
}
