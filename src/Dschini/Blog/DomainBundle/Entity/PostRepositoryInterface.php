<?php
namespace Dschini\Blog\DomainBundle\Entity;

use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Interface PostRepositoryInterface
 * @package Dschini\Blog\DomainBundle\Entity
 */
interface PostRepositoryInterface extends ObjectRepository
{
    public function fetchLatest();
}
