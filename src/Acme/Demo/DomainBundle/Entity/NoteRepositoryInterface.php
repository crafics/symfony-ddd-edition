<?php
namespace Acme\Demo\DomainBundle\Entity;

use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Interface MessageRepositoryInterface
 * @package Acme\Demo\DomainBundle\Entity
 */
Interface NoteRepositoryInterface extends ObjectRepository
{
    public function fetchLatest();
}
