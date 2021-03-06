<?php

namespace TaxiCoBundle\Repository;

use Doctrine\ORM\Query\ResultSetMapping;

/**
 * RdvRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RdvRepository extends \Doctrine\ORM\EntityRepository
{
    public function findDQL($id)
    {
        $rsm = new ResultSetMapping();
        $query = $this->getEntityManager()->createNativeQuery('SELECT name  FROM garage WHERE id_service = ?', $rsm);
        $query->setParameter(1, $id);
//        createQuery
//        ("SELECT name FROM TaxiCoBundle:Garage g where g.idService = '$id'");
        return $query->getResult();
    }

    public function getPricesByTrip()
    {

        return $this->createQueryBuilder('s')
            ->select('s')
            ->from('TaxiCoBundle:Rdv', 's')
            ->where('s.status =?1')
            ->setParameter(1, "nondisponible");

    }
    public function findrdv()
    {
        $query= $this->getEntityManager()->createQuery
        ("SELECT f FROM 'TaxiCoBundle:Rdv' f where f.status='nondisponible'");
        return $query->getResult();

    }
}