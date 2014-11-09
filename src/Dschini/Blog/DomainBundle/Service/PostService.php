<?php

namespace Dschini\Blog\DomainBundle\Service;

use Dschini\Blog\DomainBundle\Entity\PostRepositoryInterface;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function query()
    {
        $results = $this->postRepository->fetchLatest();
        return $results;
    }
}
