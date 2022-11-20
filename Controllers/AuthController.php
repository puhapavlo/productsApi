<?php

namespace Pablo\ApiProduct\Controllers;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Pablo\ApiProduct\Entity\User\User;

class AuthController extends AbstractController
{

    /**
     * @var \Pablo\ApiProduct\Entity\User\User
     */
    protected $user;

    public function __construct()
    {
        $this->user = new User();
        parent::__construct();
    }

    public function signin()
    {
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('dsjfhj34jr4eksdn3r3fjhjkehdfn4rhflusdrhf48eir')
        );

        if ($this->user->passwordVerify($this->request->username, $this->request->password)) {
            $now = new \DateTimeImmutable();
            $token = $config->builder()
                ->issuedBy('http://example.com')
                ->permittedFor('http://example.org')
                ->identifiedBy('4f1g23a12aa')
                ->issuedAt($now)
                ->withClaim('uid', $this->user->id)
                ->getToken($config->signer(), $config->signingKey());

            return $this->response->json([
                'accessToken' => $token->toString()
            ]);
        }

        return $this->response->json([
            "message" => "Login failed."
        ]);
    }

    public function register()
    {
        $this->user->username = $this->request->username;
        $this->user->password = $this->request->password;
        $this->user->role = $this->request->role;
        return $this->response->json([
            $this->user->create()
        ]);
    }
}

