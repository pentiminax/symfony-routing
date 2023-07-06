<?php

namespace App\Controller;

use App\Entity\Article;
use App\Enum\ArticleStatusEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/articles', name: 'articles_')]
class ArticleController extends AbstractController
{
    #[Route('/list/{status}', name: 'list', methods: ['GET', 'POST'])]
    public function list(ArticleStatusEnum $status = ArticleStatusEnum::PUBLISHED): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => "ArticleController::list",
            'status' => $status
        ]);
    }

    #[Route('/{id}', name: 'show', requirements: ['id' => '\d+'], methods: ['GET'], condition: 'params["id"] >= 1', priority: 1)]
    public function show(?Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'controller_name' => "ArticleController::show",
        ]);
    }

    #[Route('/{slug}', name: 'show_slug', methods: ['GET'])]
    public function showWithSlug(?Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'controller_name' => "ArticleController::show",
        ]);
    }

    #[Route(
        '/{id<\d+>}',
        name: 'delete',
        methods: ['DELETE'],
        condition: 'request.headers.get("X-Requested-With") == "XMLHttpRequest" and params["id"] >= 1',
    )]
    public function delete(): Response
    {
        return $this->json([
            'message' => 'Delete successful.'
        ]);
    }
}
