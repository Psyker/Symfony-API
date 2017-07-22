<?php

namespace AppBundle\Entity\Manager;

use AppBundle\Entity\Project;
use AppBundle\Interfaces\ProjectManagerInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ProjectManager extends AbstractManager implements ProjectManagerInterface
{

    /**
     * @param int $projectId
     * @return Project
     */
    public function findProject(int $projectId): Project
    {
        /** @var Project $project */
        $project = $this->getRepository()->find($projectId);

        if (null == $project) {
            throw new ResourceNotFoundException('Project doesn\'t exist.');
        }

        return $project;
    }

    /**
     * @return array
     */
    public function fetchProjects(): array
    {
        $projects = $this->getRepository()->findAll();

        return $projects;
    }

    /**
     * @param Project $project
     * @return Project
     */
    public function updateProject(Project $project): Project
    {
        $this->persistObject($project);

        return $project;
    }

    /**
     * @param int $projectId
     * @return Project
     */
    public function deleteProject(int $projectId): Project
    {
        /** @var Project $project */
        $project = $this->findProject($projectId);
        $this->removeObject($project);

        return $project;
    }

    /**
     * Create a new Project
     *
     * @return Project
     */
    public function createProject(): Project
    {
        $class = $this->getClass();

        return new $class;
    }
}
