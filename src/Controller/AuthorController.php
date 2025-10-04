<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AuthorRepository;
use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;

final class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/list_author', name: 'app_list_author')]
    public function listAuthors(): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com ', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william.jpg','username' => ' William Shakespeare', 'email' =>
            ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
            array('id' => 3, 'picture' => '/images/Taha-Hussein.jpg','username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
            );
           



        return $this->render('author/list.html.twig', [
            'a' => $authors
        ]);
    }
    #[Route('/details_author/{id}', name: 'app_details_author')]
    public function detailsAuthor(int $id): Response
    {
        $authors = array(
            array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg', 'username' => 'Victor Hugo', 'email' =>
            'victor.hugo@gmail.com', 'nb_books' => 100),
            array('id' => 2, 'picture' => '/images/william.jpg', 'username' => 'William Shakespeare', 'email' =>
            'william.shakespeare@gmail.com', 'nb_books' => 200),
            array('id' => 3, 'picture' => '/images/Taha-Hussein.jpg', 'username' => 'Taha Hussein', 'email' =>
            'taha.hussein@gmail.com', 'nb_books' => 300),
        );

        $author = null;
        foreach ($authors as $a) {
            if ($a['id'] === $id) {
                $author = $a;
                break;
            }
        }

        return $this->render('author/showAuthor.html.twig', [
            'a' => $author,
        ]);
    }
    #[Route('/affiche_author', name: 'app_affiche_author')]
    public function show(AuthorRepository $repoAuthor): Response {
        
        $list= $repoAuthor->findAll();
        return $this->render('author/affiche.html.twig',[
            'a'=>$list
        ]);}

    #[Route('/add_author', name: 'app_add_author')]
       public function addStatique( EntityManagerInterface $entitymanager): Response {
        $author1 = new Author();
        $author1->setUsername('Albert Camus');
        $author1->setEmail('albertCamus@gmail.com');
        $entitymanager->persist($author1);
        $entitymanager->flush();
        return $this->redirectToRoute('app_affiche_author')
         ;
       }
}
