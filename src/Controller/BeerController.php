<?php

namespace App\Controller;

use App\Entity\Beer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BeerController extends AbstractController
{
    #[Route('/show/{id}', name: 'app_beer')]
    public function show(Beer $beer): Response
    {
        $beer;

        return $this->render('beer/show.html.twig', [
            'beer' => $beer,
        ]);
    }
}
