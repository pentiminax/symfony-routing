<?php

namespace App\Service;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ArticleService
{
    public function __construct(
        private readonly UrlGeneratorInterface $router
    )
    {
    }

    public function getArticleUrl(int $id): string
    {
        return $this->router->generate('articles_show', [
            'id' => $id
        ]);
    }
}