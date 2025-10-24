<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    //    /**
    //     * @return Book[] Returns an array of Book objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


   public function findCategory(): array
{
    $entityManager = $this->getEntityManager();

    $query = $entityManager->createQuery(
        'SELECT b FROM App\Entity\Book b WHERE b.category LIKE :category'
    )->setParameter('category', 'science-fiction'); 

    return $query->getResult();
}
public function findbook(\DateTimeInterface $datedebut,\DateTimeInterface $datefin ):array{
    

    $query = $this->createQueryBuilder('b')
        ->where('b.published = 1')
        ->andWhere('b.publicationDate BETWEEN :datedebut AND :datefin')
        ->setParameter('datedebut', $datedebut)
        ->setParameter('datefin', $datefin)
        ->getQuery();
    return  $query->getResult();
}

}
