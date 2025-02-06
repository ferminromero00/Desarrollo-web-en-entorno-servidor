<?php

namespace App\Repository;

use App\Entity\Instrumento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Usuario;

/**
 * @extends ServiceEntityRepository<Instrumento>
 */
class InstrumentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Instrumento::class);
    }

    public function findNoImpartidosPorProfesor(int $profesorId): array
    {
        return $this->createQueryBuilder('i')
            ->select('i', 'p')
            ->leftJoin('i.profesor', 'p')
            ->leftJoin('App\Entity\Matricula', 'm', 'WITH', 'm.instrumento = i')
            ->where('p.id IS NULL OR p.id != :profesorId')
            ->setParameter('profesorId', $profesorId)
            ->getQuery()
            ->getResult();
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

    public function findNoMatriculadoPorAlumno(Usuario $usuario): array
    {
        return $this->createQueryBuilder('i')
            ->leftJoin('i.matriculas', 'm')
            ->leftJoin('m.alumno', 'a')
            ->where('a.id != :usuarioId OR a.id is NULL')
            ->setParameter('usuarioId', $usuario->getId())
            ->getQuery()
            ->getResult();
    }
}
