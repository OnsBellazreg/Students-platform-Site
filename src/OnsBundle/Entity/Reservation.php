<?php
/**
 * Created by PhpStorm.
 * User: esprit
 * Date: 27/11/2018
 * Time: 20:34
 */

namespace OnsBundle\Entity;
use UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
/**
 * Reservation
 *
 * @ORM\Table(name="Reservation")
 * @ORM\Entity
 */

class Reservation
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $idReservation;
    /**
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idetudiant",referencedColumnName="id")
     */
    private $idetudiant;
    /**
     * @ORM\ManyToOne(targetEntity="Covoiturage")
     * @ORM\JoinColumn(name="idCovoiturage",referencedColumnName="idcovoiturage")
     */
    private $idCovoiturage;

    /**
     * @return mixed
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @param mixed $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
    }

    /**
     * @return mixed
     */
    public function getIdetudiant()
    {
        return $this->idetudiant;
    }

    /**
     * @param mixed $idetudiant
     */
    public function setIdetudiant($idetudiant)
    {
        $this->idetudiant = $idetudiant;
    }

    /**
     * @return mixed
     */
    public function getIdCovoiturage()
    {
        return $this->idCovoiturage;
    }

    /**
     * @param mixed $idCovoiturage
     */
    public function setIdCovoiturage($idCovoiturage)
    {
        $this->idCovoiturage = $idCovoiturage;
    }




}