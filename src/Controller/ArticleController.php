<?php

namespace App\Controller;

use App\Entity\Article;
use App\Enum\ArticleStatusEnum;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{
    public function list(ArticleStatusEnum $status = ArticleStatusEnum::PUBLISHED): Response
    {
        return $this->render('article/index.html.twig', [
            'controller_name' => "ArticleController::list",
            'status' => $status
        ]);
    }

    public function show(?Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'controller_name' => "ArticleController::show",
        ]);
    }

    public function showWithSlug(?Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
            'controller_name' => "ArticleController::show",
        ]);
    }

    public function delete(): Response
    {
        return $this->json([
            'message' => 'Delete successful.'
        ]);
    }
}
