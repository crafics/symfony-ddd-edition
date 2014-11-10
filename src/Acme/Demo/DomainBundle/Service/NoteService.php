<?php

namespace Acme\Demo\DomainBundle\Service;

use Acme\Demo\DomainBundle\Entity\Note;
use Acme\Demo\DomainBundle\Entity\NoteRepositoryInterface;
use Doctrine\ORM\EntityManager;

class NoteService
{
    protected $noteRepository;
    protected $em;

    public function __construct(NoteRepositoryInterface $noteRepository, EntityManager $em)
    {
        $this->noteRepository = $noteRepository;
        $this->em = $em;
    }

    public function getNoteById($id)
    {
        return $this->noteRepository->find($id);
    }

    public function createNote($message){
        $note = new Note();
        $note->setMessage($message);
        $this->em->persist($note);
        $this->em->flush($note);
        return $note;
    }
}
