<?php

namespace App\Security;

use App\Entity\User;
use App\Repository\UserRepository;
use League\OAuth2\Client\Provider\GoogleUser;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;

final readonly class OAuthRegistrationService
{
    public function __construct(
        private readonly UserRepository $repository
    ) {
    }


    /**
     * @params GoogleUser $resourceOwner
     */
    public function persist(ResourceOwnerInterface $resourceOwner): User
    {
        $user = (new User())
            ->setEmail($resourceOwner->getEmail())
            ->setGoogleId($resourceOwner->getId());

        $this->repository->add($user, true);
        return $user;
    }
}
