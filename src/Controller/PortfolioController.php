<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\PaintRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio', name: 'app_portfolio')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $category=$categoryRepository->findAll();
        return $this->render('portfolio/index.html.twig',compact("category"));
    }

    #[Route('/portfolio/{slug}', name: 'app_portfolio_category')]
    public function show(Category $category,PaintRepository $paintRepository): Response
    {
        $paints=$paintRepository->findAllPortfolio($category);
        return $this->render('portfolio/category_page.html.twig',compact('paints','category'));
    }
}
