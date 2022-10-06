<?php

namespace App\Repository;

use App\Entity\Subcategoria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Subcategoria>
 *
 * @method Subcategoria|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subcategoria|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subcategoria[]    findAll()
 * @method Subcategoria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubcategoriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subcategoria::class);
    }

    public function add(Subcategoria $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Subcategoria $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    //    /**
    //     * @return Subcategoria[] Returns an array of Subcategoria objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Subcategoria
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findAllSubcategoria(int $categoriaId): array
    {
        /*
            subcriterio   
        id	int(11) AI PK
        categoria_id	int(11)
        nombre	varchar(255)
        directorio	varchar(255)             
        */
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'select 
            s.id as id,
            s.nombre as nombre
            FROM App\Entity\subcategoria s 
            where s.categoria=:categoriaId'
        );
        $query->setParameter('categoriaId', $categoriaId);
        return $query->getResult();
    }

    public function indAllbyCategoria(int $categoriaId): array
    {
        /*
            subcriterio   
        id	int(11) AI PK
        categoria_id	int(11)
        nombre	varchar(255)
        directorio	varchar(255)             
        */
        $conn = $this->getEntityManager()->getConnection();
        $sql =  'select  * from 
            subcategoria
            where categoria_id=:idCategoria';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery(['idCategoria' = $categoriaId]);
        return $resultSet->fetchAllAssociative();
    }
}
