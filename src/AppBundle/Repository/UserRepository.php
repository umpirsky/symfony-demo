<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use AppBundle\Entity\UserRepository as AppUserRepository;
use Doctrine\ORM\EntityRepository;

/**
 * This custom Doctrine repository is empty because so far we don't need any custom
 * method to query for application user information. But it's always a good practice
 * to define a custom repository that will be used when the application grows.
 * See http://symfony.com/doc/current/book/doctrine.html#custom-repository-classes
 *
 * @author Ryan Weaver <weaverryan@gmail.com>
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class UserRepository extends EntityRepository implements AppUserRepository
{
    /**
     * @param string $username
     *
     * @return null|User
     */
    public function findOneByUsername($username)
    {
        return $this->findOneBy(['username' => $username]);
    }

    /**
     * @param int $maxResults
     *
     * @return User[]
     */
    public function findSorted($maxResults)
    {
        return $this->findBy([], ['id' => 'DESC'], $maxResults);
    }

    /**
     * @param User $user
     */
    public function register(User $user)
    {
        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush($user);
    }
}
