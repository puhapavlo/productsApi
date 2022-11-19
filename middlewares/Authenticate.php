<?php

namespace Pablo\ApiProduct\middlewares;

use DateTimeImmutable;
use Lcobucci\Clock\FrozenClock;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Validation\Constraint\LooseValidAt;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Constraint\ValidAt;
use Pablo\ApiProduct\exceptions\NotAuthorizedHttpException;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class Authenticate implements IMiddleware {

    /**
     * @inheritDoc
     * @throws NotAuthorizedHttpException
     */
    public function handle(Request $request): void
    {
        $headers = getallheaders();
        $tokenString = $headers['Authorization'];

        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::plainText('dsjfhj34jr4eksdn3r3fjhjkehdfn4rhflusdrhf48eir')
        );

        $token = $config->parser()->parse($tokenString);

        if (
            !$config->validator()->validate(
                $token,
                new SignedWith(
                    new Sha256(),
                    InMemory::plainText('dsjfhj34jr4eksdn3r3fjhjkehdfn4rhflusdrhf48eir')
                ),
                new LooseValidAt(new FrozenClock(new DateTimeImmutable()))
            )
        ) {
            throw new NotAuthorizedHttpException('Token is not valid.');
        }
        $userId = $token->claims()->get('uid');
        $request->uid = $userId;
    }
}
