<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Evaluation
 *
 * @ORM\Table(name="evaluation", indexes={@ORM\Index(name="id_entretien", columns={"id_entretien"})})
 * @ORM\Entity
 */
class Evaluation
{
    /**
     *
     * @var int
     *
     * @ORM\Column(name="id_evaluation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvaluation;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_entretien", type="integer", nullable=true)
     */
    private $idEntretien;

    /**
     * @Assert\NotBlank(message="Connot be Blanc")
     *
     * @var int|null
     *
     * @ORM\Column(name="note", type="integer", nullable=true)
     */
    private $note;

    /**
     * @var string|null
     *
     * @ORM\Column(name="avis", type="string", length=30, nullable=true)
     */
    private $avis;

    /**
     * @ORM\OneToOne(targetEntity=Entretien::class, inversedBy="evaluation",cascade={"persist"})
     * @ORM\JoinColumn(name="entretien", referencedColumnName="id_entretien")
     *
     */
    private $entretien;

    /**
     * @return mixed
     */
    public function getEntretien()
    {
        return $this->entretien;
    }

    /**
     * @param mixed $entretien
     */
    public function setEntretien($entretien): void
    {
        $this->entretien = $entretien;
    }


    public function getIdEvaluation(): ?int
    {
        return $this->idEvaluation;
    }

    public function getIdEntretien(): ?int
    {
        return $this->idEntretien;
    }

    public function setIdEntretien(?int $idEntretien): self
    {
        $this->idEntretien = $idEntretien;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getAvis(): ?string
    {
        return $this->avis;
    }

    public function setAvis(?string $avis): self
    {
        $this->avis = $avis;

        return $this;
    }


}
