<?php

namespace Acme\Demo\DomainBundle\Handler;

use Acme\Demo\DomainBundle\Entity\Note;
use Acme\Demo\DomainBundle\Entity\NoteRepositoryInterface;
use Acme\Demo\DomainBundle\Model\NoteInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Exception\InvalidArgumentException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class NoteHandler
 * @package Acme\Demo\DomainBundle\Service
 */
class NoteHandler
{
    protected $noteRepository;
    protected $em;
    protected $validator;

    /**
     * @param NoteRepositoryInterface $noteRepository
     * @param EntityManagerInterface $em
     * @param ValidatorInterface $validator
     */
    public function __construct(NoteRepositoryInterface $noteRepository,
                                EntityManagerInterface $em,
                                ValidatorInterface $validator)
    {
        $this->noteRepository = $noteRepository;
        $this->em = $em;
        $this->validator = $validator;
    }

    /**
     * @param $id
     * @return NoteInterface
     */
    public function get($id)
    {
        return $this->noteRepository->find($id);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->noteRepository->findBy(array(), null, $limit, $offset);
    }

    /**
     * @param NoteInterface $note
     * @return NoteInterface
     */
    private function validateAndPersistNote(NoteInterface $note){
        $errors = $this->validator->validate($note);
        if (count($errors) > 0) {
            throw new InvalidArgumentException((string) $errors);
        }
        $this->em->persist($note);
        $this->em->flush($note);
        return $note;
    }

    /**
     * @param NoteInterface $note
     * @param array $parameters
     * @return NoteInterface
     */
    public function put(NoteInterface $note, array $parameters)
    {
        $note->setMessage($parameters['message']);
        return $this->validateAndPersistNote($note);
    }

    /**
     * @param NoteInterface $note
     * @param array $parameters
     * @return NoteInterface
     */
    public function patch(NoteInterface $note, array $parameters)
    {
        $note->setMessage($parameters['message']);
        return $this->validateAndPersistNote($note);
    }

    /**
     * @param array $parameters
     * @return NoteInterface
     */
    public function post(array $parameters)
    {
        $note = new Note();
        $note->setMessage($parameters['message']);
        return $this->validateAndPersistNote($note);
    }
}
