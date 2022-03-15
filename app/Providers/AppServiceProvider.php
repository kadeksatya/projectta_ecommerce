<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('currency', function ( $expression ) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
          });

        //   Permission

        Blade::directive('permission', function($expression) {
            return "<?php if (auth::user()->role_id == {$expression}) : ?>";
        });
        
        Blade::directive('endpermission', function($expression) {
            return "<?php endif; ?>";
        });

    }
}
