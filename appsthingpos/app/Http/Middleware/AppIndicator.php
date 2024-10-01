<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;

use App\Models\AppActivation;

use Closure;

class AppIndicator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $authentic = false;
        $activation_data = AppActivation::select('activation_code')->first();
        if(isset($activation_data->activation_code)){
            $authentic = true;
        }

        View::share('activation', [
            "authentic" => $authentic,
        ]);

        return $next($request);
    }
}
