<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        global $token;
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.
        function getHeaders()
        {
        $headers = array();
        foreach ($_SERVER as $k => $v)
        {
        if (substr($k, 0, 5) == "HTTP_")
        {
        $k = str_replace('_', ' ', substr($k, 5));
        $k = str_replace(' ', '-', ucwords(strtolower($k)));
        $headers[$k] = $v;
        }
        }
        return $headers;    
        }
        $cai = getHeaders();
   
        $token = false;
       foreach($cai as $x => $x_value) {
            if ( $x == "Api-Token"){
                $token = $x_value;
            }
        };

        $this->app['auth']->viaRequest('api', function ($request) {
            global $token;
         if ($token != false) {
             return User::where('api_token', $token)->first();
            }
          });
       

       /* dd($request);

        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->header('api_token')) {
                return User::where('api_token', $request->header('api_token'))->first();
            }
        });*/
    }
}
