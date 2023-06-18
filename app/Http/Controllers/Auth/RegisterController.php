<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\Api\v1\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RedirectsUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;


    /**
     * @var \App\Services\Api\v1\UserService
     */
    private UserService $service;

    /**
     * @param \App\Services\Api\v1\UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->middleware('guest');
        $this->service = $service;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(): \Illuminate\View\View
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \App\Http\Requests\User\CreateUserRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(CreateUserRequest $request): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $user = $this->service->create($request->validated(), true);

        return $request->wantsJson()
            ? $user->response()
            : redirect($this->redirectPath());
    }
}
