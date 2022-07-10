<?php

namespace App\Controller;

use App\Repository\PaintRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class AchievementsController extends AbstractController
{
    #[Route('/achievements', name: 'app_achievements')]
    public function index(PaintRepository $paintRepository,PaginatorInterface $paginator,Request $request): Response
    {
        $data=$paintRepository->findAll();

        $paints = $paginator->paginate(
            $data, 
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('achievements/index.html.twig',compact('paints'));
    }
}
