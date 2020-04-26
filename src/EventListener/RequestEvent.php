<?php

namespace App\EventListener;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RequestEvent
{

    public $securityContext;

    public function __construct(TokenStorageInterface $token_storage)
    {
        $this->securityContext = $token_storage;
    }

    public function onKernelRequest()
    {
        $token = $this->securityContext->getToken();
        if ($token) {
            $user = $token->getUser();
            if (is_object($user)) {
                if ($user->getBlock()) {
                    $this->securityContext->setToken(null);
                }
            }
        }
    }
}

?>