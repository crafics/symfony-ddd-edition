<?php

namespace Acme\Demo\DomainBundle\Service;

use Acme\Demo\DomainBundle\Entity\Note;
use Acme\Demo\DomainBundle\Entity\NoteRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class NoteService
 * @package Acme\Demo\DomainBundle\Service
 */
class NoteService
{
    protected $noteRepository;
    protected $em;
    protected $validator;

    /**
     * @param NoteRepositoryInterface $noteRepository
     * @param EntityManagerInterface $em
     * @param ValidatorInterface $validator
     */
    public function __construct(NoteRepositoryInterface $noteRepository, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $this->noteRepository = $noteRepository;
        $this->em = $em;
        $this->validator = $validator;
    }

    /**
     * @param $id
     * @return object
     */
    public function getNoteById($id)
    {
        return $this->noteRepository->find($id);
    }

    /**
     * @param $message
     * @return Note
     */
    public function createNote($message)
    {
        $note = new Note();
        $note->setMessage($message);
        $errors = $this->validator->validate($note);
        if (count($errors) > 0) {
            throw new InvalidArgumentException((string) $errors);
        }
        $this->em->persist($note);
        $this->em->flush($note);
        return $note;
    }
}
