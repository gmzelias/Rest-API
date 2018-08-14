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
   

        foreach($cai as $x => $x_value) {
            echo "Key=" . $x . ", Value=" . $x_value;
            echo "<br>";
        }

        $cuid = $cai['Api-Token'];
        echo($cuid);
        echo('siguio');

        if ($cuid) {
            return User::where('api_token', $cuid)->first();
        }

       /* dd($request);

        $this->app['auth']->viaRequest('api', function ($request) {
            if ($request->header('api_token')) {
                return User::where('api_token', $request->header('api_token'))->first();
            }
        });*/
    }
}
