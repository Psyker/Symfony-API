<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @Rest\Get("/users", name="app_get_users")
     */
    public function getUsersAction()
    {
        try {
            $users = $this->getDoctrine()->getManager()->getRepository('ApiBundle:User')->findAll();
            if (empty($users)) {
                throw new NotFoundHttpException("There is nos users");
            }
        } catch (NotFoundHttpException $e) {
            return JsonResponse::create([
                'message' => $e->getMessage(),
                'code' => $e->getStatusCode()
            ])->setStatusCode($e->getStatusCode());
        }

        return ['users' => $users];
    }
}
