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
                ->issuedBy('http://example.com')
                ->permittedFor('http://example.org')
                ->identifiedBy('4f1g23a12aa')
                ->issuedAt($now)
                ->withClaim('uid', $user->id)
                ->withHeader('foo', 'bar')
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

