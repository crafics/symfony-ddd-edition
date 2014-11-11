<?php

namespace Acme\Demo\DomainBundle\Handler;

use Acme\Demo\DomainBundle\Model\NoteInterface;

Interface NoteHandlerInterface
{
    /**
     * Get a note given the identifier
     *
     * @api
     *
     * @param mixed $id
     *
     * @return NoteInterface
     */
    public function get($id);

    /**
     * Get a list of notes.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return NoteInterface[]
     */
    public function all($limit = 5, $offset = 0);

    /**
     * Post note, creates a new note.
     *
     * @api
     *
     * @param array $parameters
     *
     * @return NoteInterface
     */
    public function post(array $parameters);

    /**
     * Edit a note.
     *
     * @api
     *
     * @param Note      $note
     * @param array     $parameters
     *
     * @return Note
     */
    public function put(NoteInterface $note, array $parameters);

    /**
     * Partially update a note.
     *
     * @api
     *
     * @param Note      $note
     * @param array     $parameters
     *
     * @return Note
     */
    public function patch(NoteInterface $page, array $parameters);
}