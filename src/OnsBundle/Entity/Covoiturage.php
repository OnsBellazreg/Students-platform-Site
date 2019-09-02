<?php
/**
 * Created by PhpStorm.
 * User: esprit
 * Date: 27/11/2018
 * Time: 19:59
 */

namespace OnsBundle\Entity;
use UserBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Covoiturage
 *
 * @ORM\Table(name="Covoiturage")
 * @ORM\Entity(repositoryClass="OnsBundle\Repository\CovoiturageRepository")
 */
class Covoiturage
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $idcovoiturage;
    /**
     * @var string
     *    @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your Arrival cannot be a number"
     * )
     * @ORM\Column(type="string",length=225, nullable=false)
     */
    private $Depart;
    /**
     * @var string
     *    @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your Arrival cannot be a number"
     * )
     * @ORM\Column(type="string",length=225, nullable=false)
     */
    private $Arrive;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="temps", type="string", nullable=false)
     */
    private $temps;
    /**
     * @ORM\Column(type="string",length=225, nullable=false)
     */
    private $Type;
    /**
     * @var integer
     *     @Assert\Type(
     *     type="float",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @ORM\Column(type="float", nullable=false)
     */
    private $Prix;
    /**
     * @var integer
     *     @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @ORM\Column(type="integer", nullable=false)
     */
    private $nbrPlace;
    /**
     * @var integer
     *     @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @ORM\Column(type="integer", nullable=false)
     */
    private $NumTel;
    /**
     *
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idetudiant",referencedColumnName="id")
     */
    private $idetudiant;

    /**
     * @var integer
     *
     * @ORM\Column(name="NbrRes", type="integer", nullable=true)
     */
    private $NbrRes;
    /**
     * @return mixed
     */
    public function getIdcovoiturage()
    {
        return $this->idcovoiturage;
    }

    /**
     * @param mixed $idcovoiturage
     */
    public function setIdcovoiturage($idcovoiturage)
    {
        $this->idcovoiturage = $idcovoiturage;
    }

    /**
     * @return mixed
     */
    public function getDepart()
    {
        return $this->Depart;
    }

    /**
     * @param mixed $Depart
     */
    public function setDepart($Depart)
    {
        $this->Depart = $Depart;
    }

    /**
     * @return mixed
     */
    public function getArrive()
    {
        return $this->Arrive;
    }

    /**
     * @param mixed $Arrive
     */
    public function setArrive($Arrive)
    {
        $this->Arrive = $Arrive;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->Type;
    }

    /**
     * @param mixed $Type
     */
    public function setType($Type)
    {
        $this->Type = $Type;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->Prix;
    }

    /**
     * @param mixed $Prix
     */
    public function setPrix($Prix)
    {
        $this->Prix = $Prix;
    }

    /**
     * @return mixed
     */
    public function getNbrPlace()
    {
        return $this->nbrPlace;
    }

    /**
     * @param mixed $nbrPlace
     */
    public function setNbrPlace($nbrPlace)
    {
        $this->nbrPlace = $nbrPlace;
    }

    /**
     * @return mixed
     */
    public function getNumTel()
    {
        return $this->NumTel;
    }

    /**
     * @param mixed $NumTel
     */
    public function setNumTel($NumTel)
    {
        $this->NumTel = $NumTel;
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
     * @return \DateTime
     */
    public function getTemps()
    {
        return $this->temps;
    }

    /**
     * @param \DateTime $temps
     */
    public function setTemps($temps)
    {
        $this->temps = $temps;
    }

    /**
     * @return int
     */
    public function getNbrRes()
    {
        return $this->NbrRes;
    }

    /**
     * @param int $NbrRes
     */
    public function setNbrRes($NbrRes)
    {
        $this->NbrRes = $NbrRes;
    }


}