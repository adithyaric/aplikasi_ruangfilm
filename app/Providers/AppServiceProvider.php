<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::directive('currency', function ( $expression ) { return "Rp. <?php echo number_format($expression,0,',','.'); ?>"; });

        $setting = \App\Models\SubmissionSetting::current();
        view()->share('setting', $setting);
        view()->share('submissionOpen', \App\Models\SubmissionSetting::isOpen());
        view()->share('isBeforeOpen', $setting && now()->lessThan($setting->open_at));
        view()->share('jumlahPeserta', \App\Models\User::where('role', 'peserta')->count() * 2);
    }
}
