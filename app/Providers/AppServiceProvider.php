<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
        });
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });
        
        // Share visitor count with all views
        if (\Illuminate\Support\Facades\Schema::hasTable('visitors')) {
            $visitorCount = \App\Visitor::count();
            view()->share('visitorCount', $visitorCount);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
