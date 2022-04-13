<?php

namespace App\Providers;

use App\Extensions\CustomSessionDriver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
       /* Password::defaults(function (){
           $rule= Password::min(8);
           return $this->app->isProduction()?$rule->mixedCase():$rule->symbols();
        });*/
        Model::handleLazyLoadingViolationUsing(function ($model, $relation) {
            $class = get_class($model);

            info("Attempted to lazy load [{$relation}] on model [{$class}].");
        });
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('d-m-Y H:i:s'); ?>";
        });

        Session::extend('custom',function ($app){
            return new CustomSessionDriver;
        });
    }

}
