<?php

namespace Acme\Demo\DomainBundle\Model;

Interface NoteInterface
{
    public function getId();

    public function setId($id);

    public function getMessage();

    public function setMessage($message);
}