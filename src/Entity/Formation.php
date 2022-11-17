<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity
 */
class Formation
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_For", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFor;

    /**
     * @var int
     * @Assert\NotBlank(message="nom doit etre non vide")
     *
     * @ORM\Column(name="Id_Formateur", type="integer", nullable=false)
     */
    private $idFormateur;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="la date doit etre non vide")
     *
     * @ORM\Column(name="Date_For", type="date", nullable=false)
     */
    private $dateFor;

    /**
     * @var string
     * @Assert\NotBlank(message="nom doit etre non vide")
     * @Assert\Length (
     *     min=3,
     *     max=20,
     *     minMessage="doit etre >=3",
     *     maxMessage="doit etre<=20" )
     *
     *
     * @ORM\Column(name="Nom_For", type="string", length=255, nullable=false)
     */
    private $nomFor;

    /**
     * @var int
     * @Assert\NotBlank (message="num doit etre nom vide")
     * @Assert\GreaterThanOrEqual(
     *   message = "Le nombre doit être supérieure à 15.",
     *   value = 15)
     *
     * @ORM\Column(name="Numbr_Max_Per", type="integer", nullable=false)
     */
    private $numbrMaxPer;

    public function getIdFor(): ?int
    {
        return $this->idFor;
    }

    public function getIdFormateur(): ?int
    {
        return $this->idFormateur;
    }

    public function setIdFormateur(int $idFormateur): self
    {
        $this->idFormateur = $idFormateur;

        return $this;
    }

    public function getDateFor(): ?\DateTimeInterface
    {
        return $this->dateFor;
    }

    public function setDateFor(\DateTimeInterface $dateFor): self
    {
        $this->dateFor = $dateFor;

        return $this;
    }

    public function getNomFor(): ?string
    {
        return $this->nomFor;
    }

    public function setNomFor(string $nomFor): self
    {
        $this->nomFor = $nomFor;

        return $this;
    }

    public function getNumbrMaxPer(): ?int
    {
        return $this->numbrMaxPer;
    }

    public function setNumbrMaxPer(int $numbrMaxPer): self
    {
        $this->numbrMaxPer = $numbrMaxPer;

        return $this;
    }


}
