<?php

namespace App\Doctrine\Listener;

use App\Entity\Comment;
use Symfony\Component\Security\Core\Security;

class AuthorCommentListener
{

    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function prePersist(Comment $entity)
    {
        if(empty($entity->getUser()))
        {
            $user = $this->security->getUser();
            $entity->setUser($user);
        }
    }
}