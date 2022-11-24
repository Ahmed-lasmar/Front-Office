<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Conge
 *
 * @ORM\Table(name="conge")
 * @ORM\Entity
 */
class Conge
{
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'conges')]
    private $user;
    /**
     * @var int
     *
     * @ORM\Column(name="idCon", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcon;

    /**
     * @var int
     *
     * @ORM\Column(name="idPer", type="integer", nullable=false,unique=false)
     */
    private $idper;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dDepot", type="date", nullable=false,unique=false)
     */
    private $ddepot;

    /**
     * @var string
     *
     * @ORM\Column(name="typeDemande", type="string", length=255, nullable=false,unique=false)
     */
    private $typedemande;

    /**
     * @var string
     *
     * @ORM\Column(name="etatDemande", type="string", length=255, nullable=false,unique=false)
     */
    private $etatdemande;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dDepart", type="date", nullable=false,unique=false)
     */
    private $ddepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dRetour", type="date", nullable=false,unique=false)
     */
    private $dretour;

    public function getIdcon(): ?int
    {
        return $this->idcon;
    }

    public function getIdper(): ?int
    {
        return $this->idper;
    }

    public function setIdper(int $idper): self
    {
        $this->idper = $idper;

        return $this;
    }

    public function getDdepot(): ?\DateTimeInterface
    {
        return $this->ddepot;
    }

    public function setDdepot(\DateTimeInterface $ddepot): self
    {
        $this->ddepot = $ddepot;

        return $this;
    }

    public function getTypedemande(): ?string
    {
        return $this->typedemande;
    }

    public function setTypedemande(string $typedemande): self
    {
        $this->typedemande = $typedemande;

        return $this;
    }

    public function getEtatdemande(): ?string
    {
        return $this->etatdemande;
    }

    public function setEtatdemande(string $etatdemande): self
    {
        $this->etatdemande = $etatdemande;

        return $this;
    }

    public function getDdepart(): ?\DateTimeInterface
    {
        return $this->ddepart;
    }

    public function setDdepart(\DateTimeInterface $ddepart): self
    {
        $this->ddepart = $ddepart;

        return $this;
    }

    public function getDretour(): ?\DateTimeInterface
    {
        return $this->dretour;
    }

    public function setDretour(\DateTimeInterface $dretour): self
    {
        $this->dretour = $dretour;

        return $this;
    }


}
