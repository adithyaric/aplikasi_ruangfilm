<?php

namespace App\Providers;

use App\Models\AppSetting;
use App\Models\Cart;
use App\Models\SubmissionSetting;
use App\Models\User;
use Throwable;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });

        $setting = null;
        $submissionOpen = false;
        $isBeforeOpen = false;
        $jumlahPeserta = 0;
        $paymentDueHours = 24;
        $landingCartCount = 0;

        try {
            if (Schema::hasTable('submission_settings')) {
                $setting = SubmissionSetting::current();
                $submissionOpen = SubmissionSetting::isOpen();
                $isBeforeOpen = $setting && now()->lessThan($setting->open_at);
            }

            if (Schema::hasTable('users')) {
                $jumlahPeserta = User::where('role', 'peserta')->count() * 2;
            }

            if (Schema::hasTable('app_settings')) {
                $paymentDueHours = AppSetting::paymentDueHours();
            }

            if (auth()->check() && Schema::hasTable('carts') && Schema::hasTable('cart_items')) {
                $landingCartCount = optional(
                    Cart::with('items')->where('user_id', auth()->id())->first()
                )->totalQuantity() ?: 0;
            }
        } catch (Throwable $exception) {
            // Allow console commands and tests to boot even when the database
            // connection is not available yet.
        }

        view()->share('setting', $setting);
        view()->share('submissionOpen', $submissionOpen);
        view()->share('isBeforeOpen', $isBeforeOpen);
        view()->share('jumlahPeserta', $jumlahPeserta);
        view()->share('paymentDueHours', $paymentDueHours);
        view()->share('landingCartCount', $landingCartCount);
    }
}
