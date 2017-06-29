<?php

namespace AppBundle\DataFixtures\ORM;

use ApiBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUsersData extends AbstractFixture implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Create Users to import.
     *
     * @return array
     */
    private function getUsers()
    {
        return [
            [
                $this->getParam('mailer_user'),
                $this->getParam('admin_username'),
                $this->getParam('admin_password'),
                ['ROLE_SUPER_ADMIN'],
                true
            ]
        ];
    }

    /**
     * Load data fixtures with the passed EntityManager.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getUsers() as $key => $user) {
            $user = (new User())
                ->setEmail($user[0])
                ->setUsername($user[1])
                ->setPlainPassword($user[2])
                ->setRoles($user[3])
                ->setEnabled(true);
            $this->addReference('user'.$key, $user);
            $manager->persist($user);
        }
        $manager->flush();
    }

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     * @return ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        return $this->container = $container;
    }

    /**
     * @param string $name
     * @return mixed
     */
    private function getParam(string $name)
    {
        return $this->container->getParameter($name);
    }
}
