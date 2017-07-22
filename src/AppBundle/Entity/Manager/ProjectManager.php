<?php

namespace AppBundle\Entity\Manager;


use AppBundle\Entity\Project;
use AppBundle\Interfaces\ProjectManagerInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class ProjectManager extends AbstractManager implements ProjectManagerInterface
{

    /**
     * @param int $projectId
     * @return Object
     * @throws ResourceNotFoundException
     */
    public function findProject(int $projectId): Object
    {
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
        // TODO: Implement fetchProjects() method.
    }

    /**
     * @param Project $project
     * @return Project
     */
    public function updateProject(Project $project): Project
    {
        // TODO: Implement updateProject() method.
    }

    /**
     * @param int $projectId
     * @return Project
     */
    public function deleteProject(int $projectId): Project
    {
        // TODO: Implement deleteProject() method.
    }
}