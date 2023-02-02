<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/beer', name: 'beer')]
class BeerController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {

        return $this->render('beer/index.html.twig', [
            'controller_name' => 'BeerController',
        ]);
    }
}
