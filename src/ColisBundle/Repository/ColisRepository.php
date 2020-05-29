<?php


namespace ColisBundle\Repository;


class ColisRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByDepart($depart)
    {
        $query=$this->createQueryBuilder('s')
        ->where('s.depart LIKE :key')->orWhere('s.destination LIKE :key')
            ->setParameter('key','%'.$depart.'%');

        return $query->getQuery()->getResult();
    }
    public function findAllOrderedByDepart($id)
    {   $qb=$this->createQueryBuilder('s');
        $qb->where('s.idKarhba=:id');
        $qb->orderBy('s.depart','ASC');
        $qb->setParameter('id',$id);
        return $qb->getQuery()->getResult();
    }
}