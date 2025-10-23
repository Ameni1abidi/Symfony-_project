<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/add_book', name: 'app_add_book')]
    public function addBook(): Response
    {
        return $this->render('book/add.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }
    #[Route('/add_book',name:'app_add_book')]
    public function addBookRequest (Request $request, EntityManagerInterface $entitymanager): Response {
           $books = new Book();
           $form = $this->createForm(BookType::class, $books);
           //$form -> add('save',SubmitType);

           $form->handleRequest($request);
           if ($form->isSubmitted() && $form->isValid()) {
               $entitymanager->persist($books);
               $entitymanager->flush();

               return $this->redirectToRoute('app_affiche_book');
           }

           return $this->render('book/add.html.twig', [
               'form' => $form->createView(),
           ]);
       }
#[Route('/affiche_book', name: 'app_affiche_book')]
public function affichebook(BookRepository $bookRepo): Response
{
    $publishedbook = $bookRepo->findBy(['published' => true]);
    $numpublishedbook = count($publishedbook);
    $numunpublishedbook = count($bookRepo->findBy(['published' => false]));

    return $this->render('book/add.html.twig', [
        'numpublishedbook' => $numpublishedbook,
        'numunpublishedbook' => $numunpublishedbook,
    ]);
}
public function affiche (BookRepository $bookRepo):Response{
    $books =$bookRepo->findCategory();
    return $this ->render('book/affiche.html.twig');
}

}
