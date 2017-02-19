<?php

namespace Ndrm\ConceptBundle\Security;

use \Ndrm\ConceptBundle\Entity\Instance;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

/**
 * 
 */
class InstanceVoter extends Voter {

    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    /**
     * Contains a list of constants
     */
    private $attributes;
    
    /**
     *
     * @var AccessDecisionManagerInterface
     */
    private $decisionManager;

    /**
     * 
     */
    public function __construct(AccessDecisionManagerInterface $decisionManager) {
        $this->attributes = [self::VIEW, self::EDIT, self::DELETE];
        $this->decisionManager = $decisionManager;
    }

    /**
     * 
     * @param type $attribute
     * @param Instance $subject
     * @return boolean
     */
    protected function supports($attribute, $subject) {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, $this->attributes)) {
            return false;
        }

        // only vote on Instance objects inside this voter
        if (!$subject instanceof Instance) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token) {
        // ROLE_ADMIN can do anything! The power!
        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }

        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a Instance object, thanks to supports
        /** @var Post $post */
        $instance = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($instance, $user);
            case self::EDIT:
                return $this->canEdit($instance, $user);
            case self::DELETE:
                return $this->canDelete($instance, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Instance $instance, User $user) {
        // if they can edit, they can view
        if ($this->canEdit($instance, $user)) {
            return true;
        }
    }

    private function canEdit(Instance $instance, User $user) {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return $user === $instance->getOwner();
    }

    private function canDelete(Instance $instance, User $user) {
        // this assumes that the data object has a getOwner() method
        // to get the entity of the user who owns this data object
        return $user === $instance->getOwner();
    }

}
