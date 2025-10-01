<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
Class HomeController extends AbstractController{
#[Route('/home', name: 'app_home')]
public function index (){
return new Response('bonjourno');
}
}