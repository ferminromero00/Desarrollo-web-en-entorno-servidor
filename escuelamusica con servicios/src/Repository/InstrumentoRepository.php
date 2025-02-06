<?php

namespace App\Repository;

use App\Entity\Instrumento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Instrumento>
 */
class InstrumentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Instrumento::class);
    }

    public function findNoMatriculado(int $alumnoId): array
    {

        return $this->createQueryBuilder('i')
            ->select('i.id, i.nombre')
            ->leftJoin('App\Entity\Matricula', 'm', 'WITH', 'm.instrumento = i')
            ->where('m.alumno IS NULL OR m.alumno != :alumnoId')
            ->setParameter('alumnoId', $alumnoId)
            ->getQuery()
            ->getResult();
    }    

    public function findOneBySomeField($value): ?Instrumento
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.profesor = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
