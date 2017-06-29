<?php


namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Project;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProjectsData extends AbstractFixture implements FixtureInterface
{

    public function getProjects()
    {
        return [
            ['Projet1', 'Je suis un beau projet.', 'PHP'],
            ['Projet2', 'Je suis un autre beau projet', 'React']
        ];
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getProjects() as $key => $project) {
            $project = (new Project())
                ->setTitle($project[0])
                ->setDescription($project[1])
                ->setType($project[2]);
            $this->addReference('project'.$key, $project);
            $manager->persist($project);
        }
        $manager->flush();
    }
}
