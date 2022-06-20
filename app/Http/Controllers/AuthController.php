<?php

namespace App\Http\Controllers;

use App\Constants\HttpRequest;
use App\Constants\Messages;
use App\Http\Requests\AuthRequest;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\ClientRepository;

/**
 *
 */
class AuthController extends Controller
{
    /**
     *
     */
    const GRANT_CLIENT = 2;

    /**
     *
     */
    const GRANT_TYPE = 'password';

    /**
     * @param ClientRepository $clients
     */
    public function __construct(
        private ClientRepository $clients,
    ) {}

    /**
     * Generate access token or error if credentials are incorrect.
     *
     * @param AuthRequest $request
     * @return array|mixed
     */
    public function login(AuthRequest $request)
    {
        $username = $request->username;
        $password = $request->password;

        $tokenResponse = $this->getToken($username, $password);

        if ($tokenResponse->failed()) {
            return response()->json(
                ['message' => Messages::WRONG_CREDENTIALS],
                HttpRequest::UNAUTHORIZED_CODE
            );
        }

        return $tokenResponse->json();
    }

    /**
     * Determine if the user's credentials are correct to return an access token or an error if applicable.
     *
     * @param $username
     * @param $password
     * @return PromiseInterface|Response|array
     */
    public function getToken($username, $password)
    {
        $passportClient = $this->clients->find(self::GRANT_CLIENT);

        if (! isset($passportClient->id)) {
            return ['message' => Messages::PASSPORT_CLIENT_NOT_EXIST,];
        }

        return Http::asForm()->post(url('/oauth/token'), [
            'grant_type' => self::GRANT_TYPE,
            'client_id' => $passportClient->id,
            'client_secret' => $passportClient->secret,
            'username' => $username,
            'password' => $password,
            'scope' => '',
        ]);
    }
}
