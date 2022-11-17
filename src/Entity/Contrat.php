<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contrat
 *
 * @ORM\Table(name="contrat")
 * @ORM\Entity
 */
class Contrat
{
    /**
     * @var int
     *
     * @ORM\Column(name="Id_Contrat", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idContrat;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_contrat", type="string", length=255, nullable=false)
     */
    private $typeContrat;

    /**
     * @var int
     *
     * @ORM\Column(name="salaire", type="integer", nullable=false)
     */
    private $salaire;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sate_embauche", type="date", nullable=false)
     */
    private $sateEmbauche;

    public function getIdContrat(): ?int
    {
        return $this->idContrat;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getSalaire(): ?int
    {
        return $this->salaire;
    }

    public function setSalaire(int $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getSateEmbauche(): ?\DateTimeInterface
    {
        return $this->sateEmbauche;
    }

    public function setSateEmbauche(\DateTimeInterface $sateEmbauche): self
    {
        $this->sateEmbauche = $sateEmbauche;

        return $this;
    }


}
