<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Manager\CommentManager;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CommentController extends Controller
{
    /**
     * @Rest\Post("/comments/new", name="app_post_comment")
     * @Method("POST")
     * @param Request $request
     * @return Comment|JsonResponse
   */
    public function postCommentAction(Request $request)
    {
        /** @var Comment $comment */
        $comment = $this->getCommentManager()->newComment();
        $form = $this->createForm(CommentType::class, $comment);
        $commentManager = $this->getCommentManager();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commentManager->createComment($comment, true);
        }

        return $comment;
    }

    /**
     * Return the Comment manager.
     * @return CommentManager
     */
    private function getCommentManager()
    {
        return $this->get('api.manager.comment');
    }
}
