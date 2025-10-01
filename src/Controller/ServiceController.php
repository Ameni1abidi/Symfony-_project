<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ServiceController extends AbstractController
{
    #[Route('/service', name: 'app_service')]
    public function index(): Response
    {
        return $this->render('service/index.html.twig', [
            'controller_name' => 'ServiceController',
        ]);
    }

    #[Route('/test/{name}/{age}', name: 'app_test')]
    public function ShowService( $name ,$age): Response
    {
        return new Response('Hello ' . $name . ' age: ' . $age);
        
    }

    #[Route('/service1', name: 'app_service1')]
    public function goToIndex(): Response
    {
        return $this->redirectToRoute('app_home');
    }
}
