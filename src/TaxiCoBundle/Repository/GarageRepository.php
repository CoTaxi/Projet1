<?php

namespace TaxiCoBundle\Repository;

/**
 * GargeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GarageRepository extends \Doctrine\ORM\EntityRepository
{
    public function findDQL()
    {
        $query= $this->getEntityManager()->createQuery
        ("SELECT f FROM EventBundle:Events f where f.nom='mahdi'");
        return $query->getResult();

    }
//    public function getPricesByTrip($id)
//    {
//
//        $qb=$this->createQueryBuilder('q');
//        $qb->select('p')
//            ->from('TaxiCoBundle:Garage', 'p')
//            ->where('p.idService = :serviceId')
//            ->setParameter('tripId', $id);
//
//        return $qb;
//    }
}