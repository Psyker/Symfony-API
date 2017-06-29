<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Rest\Get("/users")
     */
    public function getUsersAction()
    {
        $users = $this->getDoctrine()->getManager()->getRepository('ApiBundle:User')->findAll();
        return ['users' => $users];
    }
}
