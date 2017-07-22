<?php

namespace AppBundle\Entity\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;

abstract class AbstractManager
{
    /**
     * @var string
     */
    private $class;

    /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct($objectClass, ObjectManager $objectManager)
    {
        $this->class = $objectManager->getClassMetadata($objectClass)->getName();
        $this->objectManager = $objectManager;
    }

    /**
     * return the name of the class
     *
     * @return string
     */
    protected function getClass()
    {
        return $this->class;
    }

    /**
     * Get the repository
     *
    * @return EntityRepository
    */
    protected function getRepository(): EntityRepository
    {
        if (null == $this->repository) {
            $this->repository = $this->objectManager->getRepository($this->getClass());
        }
        return $this->repository;
    }

    protected function persistObject($object, $flush = null)
    {
        $this->objectManager->persist($object);

        if ($flush) {
            $this->objectManager->flush();
        }
    }

    protected function removeObject($object, $flush = null)
    {
        $this->objectManager->remove($object);

        if ($flush) {
            $this->objectManager->flush();
        }
    }
}
