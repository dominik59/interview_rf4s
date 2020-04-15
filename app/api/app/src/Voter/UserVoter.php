<?php

namespace App\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    protected function supports(string $attribute, $subject)
    {
        return $attribute === 'VIEW' && $subject instanceof User;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        $isPermissionGranted = false;
        if ($user instanceof UserInterface) {
            switch ($attribute) {
                case 'VIEW':
                    if ($subject === $user) {
                        $isPermissionGranted = true;
                    } else {
                        $isPermissionGranted = false;
                    }
                    break;
            }
        }

        return $isPermissionGranted;
    }
}