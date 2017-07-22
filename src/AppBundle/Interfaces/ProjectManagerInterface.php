<?php

namespace AppBundle\Interfaces;

use AppBundle\Entity\Project;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

interface ProjectManagerInterface
{
    /**
     * @param int $projectId
     * @return Project
     */
    public function findProject(int $projectId): Project;

    /**
     * @return array
     */
    public function fetchProjects(): array;

    /**
     * @param Project $project
     * @return Project
     */
    public function updateProject(Project $project): Project;

    /**
     * @param int $projectId
     * @return Project
     */
    public function deleteProject(int $projectId): Project;

    /**
     * @return Project
     */
    public function createProject(): Project;
}
