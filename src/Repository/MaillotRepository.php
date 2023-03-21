<?php

namespace App\Repository;

use App\Entity\Maillot;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use LDAP\Result;

/**
 * @extends ServiceEntityRepository<Maillot>
 *
 * @method Maillot|null find($id, $lockMode = null, $lockVersion = null)
 * @method Maillot|null findOneBy(array $criteria, array $orderBy = null)
 * @method Maillot[]    findAll()
 * @method Maillot[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaillotRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Maillot::class);
    }

    public function add(Maillot $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Maillot $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
     * @return Maillot[] Returns an array of Maillot objects
    */
    public function reposito($description = null): array
   {
       $result =  $this->createQueryBuilder('m')
           ->orderBy('m.id', 'ASC')
           ->getQuery()
           ->getResult();
           if($description!=null){
                $result->andWhere('m.description like :nomcherche')
                ->setParameter('nomcherche', "%{$description}%");
           }
           ;
          return $result;
   }

   public function findByNom($description): array
   {   
       return $this->createQueryBuilder('e')
           ->andWhere('e.description like :description')
           ->setParameter(':description',"%$description%")
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Maillot
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
