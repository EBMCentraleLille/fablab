<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/6/16
 * Time: 12:39 PM
 */

namespace CentraleLille\CustomFosUserBundle\Security;

use CentraleLille\CustomFosUserBundle\Entity\Project;
use CentraleLille\CustomFosUserBundle\Entity\ProjectRole;
use CentraleLille\CustomFosUserBundle\Entity\User;
use CentraleLille\CustomFosUserBundle\Entity\ProjectUser;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ProjectLeaderVoter extends Voter
{
    private $decisionManager;
    const LEADER = ProjectRole::project_role_leader;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    /**
     * Determines if the attribute and subject are supported by this voter.
     *
     * @param string $attribute An attribute
     * @param mixed  $subject   The subject to secure, e.g. an object the user wants to access or any other PHP type
     *
     * @return bool True if the attribute and subject are supported, false otherwise
     */
    protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::LEADER))) {
            return false;
        }
        // only vote on Project objects inside this voter
        if (!$subject instanceof Project) {
            return false;
        }
        return true;
    }

    /**
     * Perform a single access check operation on a given attribute, subject and token.
     *
     * @param string         $attribute
     * @param mixed          $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }
        $project = $subject;

        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }

        foreach ($user->getProjectUsers() as $projectUser) {
            if ($projectUser->getProject() === $project && $projectUser->hasRole(self::LEADER)) {
                return true;
            }
        }
    }
}
