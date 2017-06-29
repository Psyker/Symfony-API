<?php

namespace ApiBundle\Controller;

use AppBundle\Entity\Project;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;

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

    }
}
