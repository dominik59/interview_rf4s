<?php

namespace App\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    protected function supports(string $attribute, $subject)
    {
        return $attribute === 'VIEW' && $subject instanceof User;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        switch ($attribute) {
            case 'VIEW':
                if ($subject === $user) {
                    $isPermissionGranted = true;
                } else {
                    $isPermissionGranted = false;
                }
                break;
            default:
                $isPermissionGranted = false;
                break;
        }

        return $isPermissionGranted;
    }
}