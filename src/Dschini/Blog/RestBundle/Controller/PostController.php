<?php

namespace Dschini\Blog\RestBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

class PostController extends FOSRestController
{
    /**
     * @return \Dschini\Blog\DomainBundle\Service\PostService
     */
    public function PostService()
    {
        return $this->get('dschini.blog.post');
    }

    /**
     * Get single Post,
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Post for a given id",
     *   output = "Dschini\Blog\DomainBundle\Entity\Post",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the page is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="post")
     *
     * @param Request $request the request object
     * @param int     $id      the page id
     *
     * @return array
     *
     * @throws NotFoundHttpException when page not exist
     */
    public function getPostAction(Request $request, $id)
    {
        $post = $this->PostService()->query();
        if (false === $post) {
            throw $this->createNotFoundException("Post does not exist.");
        }
        $view = new View($post);
        $group = $this->container->get('security.context')->isGranted('ROLE_API') ? 'restapi' : 'standard';
        $view->getSerializationContext()->setGroups(array('Default', $group));
        return $view;
    }
}
