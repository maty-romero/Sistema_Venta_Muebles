<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('money', function ($amount) {
            return "<?php echo '$' . number_format($amount, 2); ?>";
        });

        Blade::directive('IDs', function ($id) {
            if($id < 10){
                return "<?php echo '000'.$id; ?>";
            } else if($id < 100){
                return "<?php echo '00'.$id; ?>";
            } else if($id < 1000){
                return "<?php echo '0'.$id; ?>";
            }
            return $id;
        });
    }
}
