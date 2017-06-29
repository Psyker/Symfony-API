<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProjectController extends Controller
{
    /**
     * @Rest\Get("/projects", name="app_get_projects")
     * @return array|JsonResponse
     */
    public function getProjectsAction()
    {
        $em = $this->getDoctrine()->getManager();
        try {
            $projects = $em->getRepository('AppBundle:Project')->findAll();
            if (empty($projects)) {
                throw new NotFoundHttpException("There is no projects");
            }
        } catch (NotFoundHttpException $e) {
            return JsonResponse::create([
                'message' => $e->getMessage(),
                'code' => $e->getStatusCode()
            ])->setStatusCode($e->getStatusCode());
        }

        return ['projects' => $projects];
    }

    /**
     * @Rest\Get("/projects/{id}", name="app_get_project", requirements={"id"="\d+"})
     * @param int $id
     * @return array|JsonResponse
     */
    public function getProjectAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        try {
            if (isset($id) || !empty($id)) {
                $project = $em->getRepository('AppBundle:Project')->findOneById($id);
                if (empty($project)) {
                    throw new NotFoundHttpException("Project not found.", null, 404);
                }
            } else {
                throw new BadRequestHttpException("Invalid parameters.");
            }
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ])->setStatusCode($e->getCode());
        }

        return ['project' => $project];
    }
}
