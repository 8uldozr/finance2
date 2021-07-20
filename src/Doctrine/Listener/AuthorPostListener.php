<?php

namespace App\Doctrine\Listener;

use App\Entity\Post;
use Symfony\Component\Security\Core\Security;

class AuthorPostListener
{

    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Post $entity)
    {
        if(empty($entity->getUser()))
        {
            $user = $this->security->getUser();

            $entity->setUser($user);
        }
    }
}