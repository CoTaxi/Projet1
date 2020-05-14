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
    public function findAllOrderedByDepart()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM ColisBundle:Colis p ORDER BY p.depart ASC'
            )
            ->getResult();
    }
}