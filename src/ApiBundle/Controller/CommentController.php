<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentController extends Controller
{
    /**
     * @Rest\Post("/comments/new", name="app_post_comment")
     * @Method("POST")
     * @param Request $request
     * @return Comment
     */
    public function postCommentAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if (!empty($request->get('author'))
            && !empty($request->get('message'))
            && !empty($request->get('project'))
        ) {
            $project = $em->getRepository('AppBundle:Project')->find($request->get('project'));
            $comment = new Comment();
            $comment->setAuthor($request->get('author'))
                ->setMessage($request->get('message'))
                ->setProject($project);
            $em->persist($comment);
            $em->flush();

            return $comment;
        }
    }
}
