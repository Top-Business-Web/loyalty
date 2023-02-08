<?php

namespace App\Http\Controllers\Api\Provider\Auth;

use App\Http\Controllers\Api\Auth\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\{CompanyResource, UserResources};
use App\Models\Company;
use App\Models\User;
use App\Services\AuthService;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Laravel\Socialite\Facades\Socialite;
use function auth;
use function helperJson;
use function now;
use function response;

//use App\Models\PhoneTokens;

class AuthController extends Controller
{
    private AuthService $authService;

    /**
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('auth_jwt')->only(['update_profile','deleteAccount','me']);
        $this->authService = $authService;
    }


    public function login(Request $request)
    {
       return $this->authService->login($request);
    }//end fun

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        return $this->authService->register($request);
    }//end fun

    public function update_profile(request $request){
        return $this->authService->update_profile($request);
    }//end fun

    public function deleteAccount(Request $request)
    {
        return $this->authService->delete_account($request);
    }//end fun

    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();

    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function handleProviderCallback($provider)
    {

        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
//        dd(Socialite::driver("facebook")->stateless()->user());
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $userCreated = User::firstOrCreate(
            [
                'email' => $user->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'status' => true,
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );
        Auth::login($userCreated);
//        dd(Auth::login($userCreated));
        $token = JWTAuth::fromUser($userCreated);
        $userCreated['token'] =$token;
        return helperJson(new UserResources($userCreated), 'register successfully');
    }

    /**
     * @param $provider
     * @return JsonResponse
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'github', 'google'])) {
            return response()->json(['error' => 'Please login using facebook, github or google'], 422);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return $this->authService->profile($request);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profileWithPhone(Request $request)
    {
        return $this->authService->profileWithPhone($request);

    }
}//end class
