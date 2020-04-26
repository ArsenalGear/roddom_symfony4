<?php

namespace App\Repository;

use App\Entity\Organisation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Organisation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Organisation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Organisation[]    findAll()
 * @method Organisation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganisationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Organisation::class);
    }

    // /**
    //  * @return Organisation[] Returns an array of Organisation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


//    public function findOneBySomeField($value): ?Organisation
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function organisationSort()
    {
        $qb = $this->createQueryBuilder('o')
            ->select('o')
            ->where('o.show_org = 1')
            ->orderBy("o.rating", 'DESC')
            ->addOrderBy('o.countReview', 'DESC')
            ->addOrderBy('o.id', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function filtre($filtrearr)
    {
        $rating = $filtrearr['rating'];
        $category = $filtrearr['category'];
        $city = $filtrearr['city'];

        $qb = $this->createQueryBuilder('o')
            ->select('o');

        if ($rating) {
            $qb->where("o.rating = '$rating'");
        }

        if ($category) {
            $qb->andWhere("o.category = '$category'");
        }

        if ($filtrearr['count_review']) {
            $count_review = explode("-", $filtrearr['count_review']);
            $qb->andWhere($qb->expr()->between('o.countReview', $count_review[0], $count_review[1]));
        }

        if ($city) {
            $qb->leftJoin('o.city', 'c')
                ->andWhere('c.name = :city')
                ->setParameter('city', $city);
        }
        $qb->andWhere('o.show_org = 1');
        $qb->orderBy("o.rating", 'DESC')
            ->addOrderBy('o.countReview', 'DESC')
            ->addOrderBy('o.id', 'DESC');
        return $qb->getQuery()->getResult();
    }


    public function search($word)
    {
        $qb = $this->createQueryBuilder('o')
            ->select('o')
            ->where('o.address LIKE :word')
            ->orWhere('o.name LIKE :word')
            ->andWhere('o.show_org = 1')
            ->setParameter('word', '%' . $word . '%')
            ->orderBy("o.rating", 'DESC')
            ->addOrderBy('o.countReview', 'DESC')
            ->addOrderBy('o.id', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function findByCity($city)
    {
        $qb = $this->createQueryBuilder('o')
            ->select('o')
            ->leftJoin('o.city', 'c')
            ->where('c.name = :city')
            ->setParameter('city', $city)
            ->andWhere('o.show_org = 1')
            ->orderBy("o.rating", 'DESC')
            ->addOrderBy('o.countReview', 'DESC')
            ->addOrderBy('o.id', 'DESC');
        return $qb->getQuery()->getResult();
    }

    public function findByCitySlug($city)
    {
        $qb = $this->createQueryBuilder('o')
            ->select('o')
            ->leftJoin('o.city', 'c')
            ->where('c.slug = :city')
            ->andWhere('o.show_org = 1')
            ->setParameter('city', $city)
            ->orderBy("o.rating", 'DESC')
            ->addOrderBy('o.countReview', 'DESC')
            ->addOrderBy('o.id', 'DESC');
        return $qb->getQuery()->getResult();
    }
}
