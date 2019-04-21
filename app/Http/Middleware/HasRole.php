<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class HasRole
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
        $roles = $this->getRequiredRoleForRoute($request->route());
        //Si la peticion es a traves de JSON, significa que es una ruta de la API
        
        $uri_role = $request->segment(2); //http://api.domain(0)/v1(1)/role(2)
        $usuario = \JWTAuth::parseToken()->authenticate();
        if ($usuario->hasRole($roles)) {
            if ($usuario->recordarme) {
                $usuario->rol_activo = $uri_role;
                $usuario->save();
            }
            return $next($request);
        } else {
            return response()->json(['errors' => trans('generals.insufficient_role')], 404);
        }
        /*if ($request->segment(1) == 'api') {
            $uri_role = $request->segment(2); //http://domain(0)/api(1)/v1(2)/perfil(3)
            $usuario = \JWTAuth::parseToken()->authenticate();
            if ($usuario->hasRole($roles)) {
                if ($usuario->recordarme) {
                    $usuario->rol_activo = $uri_role;
                    $usuario->save();
                }
                return $next($request);
            } else {
                return response()->json(['errors' => trans('generals.insufficient_role')], 404);
            }
        } else {
            if ($request->user() !== null && $request->user()->hasRole($roles)) {
                $uri_role = $request->segment(1);
                if ($request->user()->recordarme) {
                    $request->session()->put('rol_activo', $uri_role);
                }
                return $next($request);
            } else {
                \Utility::setMessage(['message' => trans('generals.insufficient_role')]);
                return \Redirect::to('/'); 
            }
        }*/
    }

    /**
     * gets the route role
     * @param  string/array $route route information
     * @return bool
     */
    private function getRequiredRoleForRoute($route)
    {
        $actions = $route->getAction();
        return isset($actions['roles']) ? $actions['roles'] : null;
    }
}
