<?php
/**
 * Created by PhpStorm.
 * User: esprit
 * Date: 27/11/2018
 * Time: 20:38
 */

namespace OnsBundle\Entity;
use UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
    /**
     * Foyer
     *
     * @ORM\Table(name="foyer")
     * @ORM\Entity(repositoryClass="OnsBundle\Repository\FoyerRepository")
     */
class Foyer
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFoyer;

    /**
     * @var string
     *    @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="The name cannot be a number"
     * )
     * @ORM\Column(name="nomFoyer", type="string", length=100, nullable=false)
     */
    private $nomfoyer;


    /**
     * @var string
     *    @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="the name cannot be a number"
     * )
     *
     * @ORM\Column(name="Responsable", type="string", length=20, nullable=false)
     */
    private $Responsable;

    /**
     * @var string
     *    @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your adress cannot be a number"
     * )
     *
     * @ORM\Column(name="adresse", type="string", length=40, nullable=false)
     */
    private $adresse;



    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *     @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
    /**
     * @Assert\GreaterThan(0)
     * @ORM\Column(type="integer", nullable=false)
     */
    private $nbrPlace;

    /**
     * @var integer
     *     @Assert\Type(
     *     type="integer",
     *     message="The value {{ value }} is not a valid {{ type }}."
     * )
    /**
     * @Assert\GreaterThan(0)
     * @ORM\Column(name="prix" , type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="NbrDem", type="integer", nullable=true)
     */
    private $NbrDem;

    /**
     * @return int
     */
    public function getNbrDem()
    {
        return $this->NbrDem;
    }

    /**
     * @param int $NbrDem
     */
    public function setNbrDem($NbrDem)
    {
        $this->NbrDem = $NbrDem;
    }

    /**
     * @return int
     */
    public function getIdFoyer()
    {
        return $this->idFoyer;
    }

    /**
     * @param int $idFoyer
     */
    public function setIdFoyer($idFoyer)
    {
        $this->idFoyer = $idFoyer;
    }


    /**
     * @return string
     */
    public function getNomfoyer()
    {
        return $this->nomfoyer;
    }

    /**
     * @param string $nomfoyer
     */
    public function setNomfoyer($nomfoyer)
    {
        $this->nomfoyer = $nomfoyer;
    }

    /**
     * @return string
     */
    public function getResponsable()
    {
        return $this->Responsable;
    }

    /**
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @param string $Responsable
     */
    public function setResponsable($Responsable)
    {
        $this->Responsable = $Responsable;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getNbrPlace()
    {
        return $this->nbrPlace;
    }

    /**
     * @param int $nbrPlace
     */
    public function setNbrPlace($nbrPlace)
    {
        $this->nbrPlace = $nbrPlace;
    }


}