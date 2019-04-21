<?php
/*
*  Middleware para verificar que exista un usuario autenticado
*  Desarrollado por Julio Hernandez
*/
namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\PayloadException;
use Tymon\JWTAuth\Exceptions\InvalidClaimException;
use Tymon\JWTAuth\Exceptions\JWTException;

class VerifyJWTToken
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
        try {
    		if (! $token = JWTAuth::getToken()) {
                return response()->json(['errors' => 'token_not_provided'], 400);
            }
            if (! $user = JWTAuth::parseToken()->authenticate()) {
               return response()->json(['errors' => 'user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            if ($request->ajax()) {
                return response()->json(['errors' => 'token_expired'], $e->getStatusCode()); //$statusCode = 401
            }
        } catch (TokenInvalidException $e) {
            if ($request->ajax()) {
                return response()->json(['errors' => 'token_invalid'], $e->getStatusCode()); //$statusCode = 400
            }
        } catch (TokenBlacklistedException $e) {
            if ($request->ajax()) {
                return response()->json(['errors' => 'token_blacklisted'], $e->getStatusCode()); //$statusCode = 401
            }
        } catch (PayloadException $e) {
            if ($request->ajax()) {
                return response()->json(['errors' => 'token_expired'], $e->getStatusCode()); //$statusCode = 500
            }
        } catch (InvalidClaimException $e) {
            if ($request->ajax()) {
                return response()->json(['errors' => 'token_invalid'], $e->getStatusCode()); //$statusCode = 400
            }
        } catch (JWTException $e) {
            if ($request->ajax()) {
                return response()->json(['errors' => 'token_absent'], $e->getStatusCode()); //$statusCode = 500
            }
        }
		
        return $next($request);
    }
}
