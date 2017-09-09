<?php


namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Project;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use TagBundle\Entity\Tag;

class LoadProjectsData extends AbstractFixture implements FixtureInterface
{

    public function getProjects()
    {
        return [
            ['Projet1', 'Je suis un beau projet.', ['PHP']],
            ['Projet2', 'Je suis un autre beau projet', ['React']]
        ];
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getProjects() as $key => $projectData) {
            $project = (new Project())
                ->setTitle($projectData[0])
                ->setDescription($projectData[1]);
            foreach ($projectData[2] as $tagName) {
                $tag = new Tag();
                $tag->setName($tagName);
                $manager->persist($tag);
                $project->addTag($tag);
            }
            $this->addReference('project'.$key, $project);
            $manager->persist($project);
        }
        $manager->flush();
    }

}
