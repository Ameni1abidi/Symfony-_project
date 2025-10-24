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

        
    
    #[Route('/add_book',name:'app_add_book')]
  
public function addBook(Request $request, EntityManagerInterface $entityManager): Response
{
    $book = new Book();
    $form = $this->createForm(BookType::class, $book);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('book_list');
    }

    return $this->render('book/add.html.twig', [
        'form' => $form->createView(),
    ]);
}
 public function editbook(Request $request, EntityManagerInterface $entityManager, BookRepository $bookRepository, int $id): Response{
    $book = $bookRepository->find($id);
    if (!$book) {
        throw $this->createNotFoundException('The book does not exist');
    }

    $form = $this->createForm(BookType::class, $book);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->flush();

        return $this->redirectToRoute('book_list');
    }

    return $this->render('book/edit.html.twig', [
        'form' => $form->createView(),
    ]);
 }
/*#[Route('/affiche_book', name: 'app_affiche_book')]
public function affichebook(BookRepository $bookRepo): Response
{
    $publishedbook = $bookRepo->findBy(['published' => true]);
    $numpublishedbook = count($publishedbook);
    $numunpublishedbook = count($bookRepo->findBy(['published' => false]));

    return $this->render('book/add.html.twig', [
        'numpublishedbook' => $numpublishedbook,
        'numunpublishedbook' => $numunpublishedbook,
    ]);
}*/


#[Route('/book/list', name: 'book_list')]
public function list(BookRepository $bookRepository): Response

    {
        $books = $bookRepository->findAll();
        $publishedBooks = $bookRepository->findBy(['published' => true]);
        $unpublishedBooks = $bookRepository->findBy(['published' => false]);

        return $this->render('book/list.html.twig', [
             'books' => $books,
            'publishedBooks' => $publishedBooks,
            'unpublishedCount' => count($unpublishedBooks),
            'publishedCount' => count($publishedBooks),
        ]);
    }

     #[Route('/book/category', name: 'book_category')]
    public function listByCategory(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findCategory();
        

        return $this->render('book/affiche.html.twig', [
            'books' => $books,
        ]);
    }
        #[Route('/book/date', name: 'book_date')]
        public function listByDate(BookRepository $bookRepository): Response {
            $datedebut = new \DateTime('2025-01-01');
            $datefin = new \DateTime('2025-12-31');
            $books = $bookRepository->findbook($datedebut, $datefin);

            return $this->render('book/affiche.html.twig', [
                'books' => $books,
            ]);
        }

}
