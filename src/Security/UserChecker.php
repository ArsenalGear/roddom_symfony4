<?php
namespace App\Security;

use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!is_a($user, "App\Entity\User")) {
            return;
        }

        if ($user->getBlock()) {
            throw new AccountExpiredException();
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!is_a($user, "App\Entity\User")) {
            return;
        }

        if ($user->getBlock()) {
            throw new AccountExpiredException();
        }
    }
}