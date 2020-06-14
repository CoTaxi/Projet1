<?php


namespace EvenementBundle\Repository;


class EvenementRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllOrderedByDepart()
    {   $qb=$this->createQueryBuilder('s');
        $qb->orderBy('s.dureeEvent','ASC');
        return $qb->getQuery()->getResult();
    }
}