<?php
/**
 * Created by PhpStorm.
 * User: esprit
 * Date: 02/12/2018
 * Time: 20:13
 */

namespace OnsBundle\Repository;


use Doctrine\ORM\EntityRepository;

class FoyerRepository extends EntityRepository
{

    public function findFoyers($id)
    {

        return $this->getEntityManager()
            ->createQuery("SELECT f1 FROM OnsBundle:Foyer f1 WHERE NOT EXISTS
            (SELECT f FROM OnsBundle:Foyer f
              INNER JOIN OnsBundle:Demande d 
              WITH f.idFoyer = d.idFoyer
              WHERE
                (f.idFoyer=f1.idFoyer AND d.idetudiant = :idu))")
            ->setParameter('idu', $id)
            ->getResult();
    }
}