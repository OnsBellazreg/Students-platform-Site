<?php

namespace MyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="idReclamation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="objetReclamation", type="string", length=1000, nullable=false)
     */
    private $objetreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="descReclamation", type="string", length=1000, nullable=false)
     */
    private $descreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="statusReclamation", type="string", length=1000, nullable=false)
     */
    private $statusreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="dateReclamation", type="string", length=1000, nullable=false)
     */
    private $datereclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="destinationReclamation", type="string", length=1000, nullable=false)
     */
    private $destinationreclamation;

    /**
     * @var string
     *
     * @ORM\Column(name="ReponseReclamation", type="string", length=1000, nullable=false)
     */
    private $reponsereclamation;


}

