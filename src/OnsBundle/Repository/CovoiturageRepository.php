<?php
/**
 * Created by PhpStorm.
 * User: esprit
 * Date: 02/12/2018
 * Time: 20:13
 */

namespace OnsBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CovoiturageRepository extends EntityRepository
{

    public function findCovoiturage($id)
    {

        return $this->getEntityManager()
            ->createQuery("SELECT f1 FROM OnsBundle:Covoiturage f1 WHERE NOT EXISTS
            (SELECT f FROM OnsBundle:Covoiturage f
              INNER JOIN OnsBundle:Reservation d 
              WITH f.idcovoiturage = d.idCovoiturage
              WHERE
                (f.idcovoiturage=f1.idcovoiturage AND d.idetudiant = :idu))")
            ->setParameter('idu', $id)
            ->getResult();
    }
}