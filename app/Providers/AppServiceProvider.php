<?php

namespace App\Providers;

use Illuminate\Routing\Exceptions\InvalidSignatureException;
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
       // JsonResource::withoutWrapping();
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('d-m-Y H:i:s'); ?>";
        });
    }

}
