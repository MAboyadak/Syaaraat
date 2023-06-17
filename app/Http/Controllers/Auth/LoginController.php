<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\LoginService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private const SUCCESS_REDIRECT_ROUTE_NAME = "tasks.index"; 

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                return redirect()->route(self::SUCCESS_REDIRECT_ROUTE_NAME);
            }
            return $next($request);
        });
    }

    public function getLoginForm() : View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request, LoginService $loginService)
    {
        $validatedData = $request->validated();

        if($loginService->login($validatedData)){
            return redirect()->route(self::SUCCESS_REDIRECT_ROUTE_NAME);
        }
        else{
            return redirect()->back();
        }
    }
}
