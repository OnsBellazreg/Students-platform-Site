<?php
/**
 * Created by PhpStorm.
 * User: esprit
 * Date: 02/12/2018
 * Time: 16:21
 */

namespace OnsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Demande
 *
 * @ORM\Table(name="Demande")
 * @ORM\Entity
 */
class Demande
{
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $idDemande;
    /**
     * @ORM\ManyToOne(targetEntity="\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idetudiant",referencedColumnName="id")
     */
    private $idetudiant;
    /**
     * @ORM\ManyToOne(targetEntity="Foyer")
     * @ORM\JoinColumn(name="idFoyer",referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $idFoyer;
    /**
     * @var integer
     *     @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
     * @ORM\Column(type="integer")
     */
    private $status=0;



    /**
     * @return mixed
     */
    public function getIdDemande()
    {
        return $this->idDemande;
    }

    /**
     * @param mixed $idDemande
     */
    public function setIdDemande($idDemande)
    {
        $this->idDemande = $idDemande;
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
    public function getIdFoyer()
    {
        return $this->idFoyer;
    }

    /**
     * @param mixed $idFoyer
     */
    public function setIdFoyer($idFoyer)
    {
        $this->idFoyer = $idFoyer;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


}