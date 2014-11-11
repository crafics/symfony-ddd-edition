<?php

namespace Acme\Demo\RestBundle\Controller;

use Acme\Demo\DomainBundle\Entity\Note;
use Acme\Demo\RestBundle\Form\NoteType;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Util\Codes;

class NoteController extends FOSRestController
{
    /**
     * @return \Acme\Demo\DomainBundle\Handler\NoteHandlerInterface
     */
    public function NoteHandler()
    {
        return $this->get('acme.demo.note');
    }

    /**
     * Get single note,
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a note for a given id",
     *   output = "Acme\Demo\DomainBundle\Entity\Note",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the note is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="note")
     *
     * @param Request $request the request object
     * @param int     $id      the note id
     *
     * @return array
     *
     * @throws NotFoundHttpException when note not exist
     */
    public function getNoteAction(Request $request, $id)
    {
        $note = $this->NoteHandler()->get($id);
        if (null === $note) {
            throw $this->createNotFoundException("note does not exist.");
        }
        $view = new View($note);
        $group = $this->container->get('security.context')->isGranted('ROLE_API') ? 'restapi' : 'standard';
        $view->getSerializationContext()->setGroups(array('Default', $group));
        return $view;
    }


    /**
     * Creates a new note from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\Demo\DomainBundle\Form\NoteType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *   template = "Acme:Demo:RestBundle:Note:newNote.html.twig",
     *   statusCode = Codes::HTTP_BAD_REQUEST
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|RouteRedirectView
     */
    public function postNoteAction(Request $request)
    {
        $noteType = new NoteType();
        $newNote = $this->NoteHandler()->post( $request->request->get($noteType->getName()) );
        if(null !== $newNote){

        }
        return $this->routeRedirectView('get_note', array('id' => $newNote->getId()));
    }
}
