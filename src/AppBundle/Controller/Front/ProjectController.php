<?php

namespace AppBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProjectController extends Controller
{

    /**
     * @Rest\Get("/projects", name="app_get_projects")
     * @Method("GET")
     * @return array|JsonResponse
     */
    public function getProjectsAction()
    {
        $projects = $this->getProjectManager()->fetchProjects();

        return $projects;
    }

    /**
     * @Rest\Get("/projects/{id}", name="app_get_project", requirements={"id"="\d+"})
     * @Method("GET")
     * @param int $id
     * @return array|JsonResponse
     */
    public function getProjectAction(int $id)
    {
        $project = $this->getProjectManager()->findProject($id);

        return $project;
    }

    /**
     * Get ProjectManager
     *
     * @return \AppBundle\Entity\Manager\ProjectManager|object
     */
    public function getProjectManager()
    {
        return $this->get('api.manager.project');
    }
}
