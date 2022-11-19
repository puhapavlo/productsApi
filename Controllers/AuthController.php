<?php

namespace Pablo\ApiProduct\Controllers;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Pablo\ApiProduct\Entity\User;

class AuthController extends AbstractController
{
    public function signin()
    {
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('dsjfhj34jr4eksdn3r3fjhjkehdfn4rhflusdrhf48eir')
        );

        $user = new User();
        if ($user->passwordVerify($this->request->username, $this->request->password)) {
            $now = new \DateTimeImmutable();
            $token = $config->builder()
                // Configures the issuer (iss claim)
                ->issuedBy('http://example.com')
                // Configures the audience (aud claim)
                ->permittedFor('http://example.org')
                // Configures the id (jti claim)
                ->identifiedBy('4f1g23a12aa')
                // Configures the time that the token was issue (iat claim)
                ->issuedAt($now)
                // Configures the expiration time of the token (exp claim)
                ->expiresAt($now->modify('+2 minutes'))
                // Configures a new claim, called "uid"
                ->withClaim('uid', $user->id)
                // Configures a new header, called "foo"
                ->withHeader('foo', 'bar')
                // Builds a new token
                ->getToken($config->signer(), $config->signingKey());

            return $this->response->json([
                'accessToken' => $token->toString()
            ]);
        }

        return $this->response->json([
            "message" => "Login failed."
        ]);
    }

    public function createUser()
    {
        $username = $this->request->username;
        $password = $this->request->password;
        $user = new User();
        $user->username = $username;
        $user->password = $password;
        return $user->create();
    }
}

