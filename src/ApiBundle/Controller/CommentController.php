<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentController extends Controller
{
    /**
     * @Rest\Get("/comments/{id}", name="app_get_comments", requirements={"id"="\d+"})
     * @ParamConverter("project", class="AppBundle:Project")
     * @param Project $project
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCommentsAction(Project $project)
    {
        $em = $this->getDoctrine()->getManager();
        try {
            if (isset($project) && !empty($project)) {
                $comments = $em->getRepository('AppBundle:Comment')->findByProject($project);
                if (empty($comments)) {
                    throw new NotFoundHttpException("There are no comments", null, 404);
                }
            } else {
                throw new NotFoundHttpException("Project not found", null, 404);
            }
        } catch (\Exception $e) {
            return JsonResponse::create([
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ])->setStatusCode($e->getCode());
        }

        return $comments;
    }
}
