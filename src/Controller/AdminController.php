<?php

namespace App\Controller;

use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(ArticleService $articleService): Response
    {
        $homePage = $this->generateUrl('home_index', referenceType: UrlGeneratorInterface::ABSOLUTE_URL);

        $firstArticlePage = $this->generateUrl('articles_show', [
            'id' => 1
        ]);

        $secondArticlePage = $articleService->getArticleUrl(2);

        try {
            $routeNotFound = $this->generateUrl('articles_add');
        } catch (RouteNotFoundException $e) {
            $routeNotFound = 'RouteNotFound';
        }

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'home_page' => $homePage,
            'first_article_page' => $firstArticlePage,
            'second_article_page' => $secondArticlePage,
            'route_not_found' => $routeNotFound
        ]);
    }
}
