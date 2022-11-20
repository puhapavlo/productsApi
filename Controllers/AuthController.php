<?php

namespace Pablo\ApiProduct\Controllers;

use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Pablo\ApiProduct\Entity\User\User;
use Pablo\ApiProduct\MessageServices\EntityMessageResponseService;
use Pablo\ApiProduct\MessageServices\Enum\EntityEvents;
use Pablo\ApiProduct\MessageServices\MessageResponseService;
use Pecee\SimpleRouter\SimpleRouter as Router;

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

    public function login()
    {
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('dsjfhj34jr4eksdn3r3fjhjkehdfn4rhflusdrhf48eir')
        );

        if ($this->user->passwordVerify($this->request->name, $this->request->password)) {
            $now = new \DateTimeImmutable();
            $token = $config->builder()
                ->issuedBy('http://example.com')
                ->permittedFor('http://example.org')
                ->identifiedBy('4f1g23a12aa')
                ->issuedAt($now)
                ->withClaim('uid', $this->user->id)
                ->getToken($config->signer(), $config->signingKey());

            return MessageResponseService::sendMessage($this->response, ['Access Token:' => $token->toString()]);
        }

        return EntityMessageResponseService::sendMessage(
            $this->response,
            $this->request->name,
            EntityEvents::LOGIN_FAILED
        );
    }
}