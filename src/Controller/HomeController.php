<?php

namespace App\Controller;

use App\Repository\BlogpostRepository;
use App\Repository\PaintRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PaintRepository $paintRepository,BlogpostRepository $blogpostRepository): Response
    {
        $paints=$paintRepository->lastTree();
        $blogposts=$blogpostRepository->lastTree();
        return $this->render('home/index.html.twig',compact('paints','blogposts'));
    }
}
