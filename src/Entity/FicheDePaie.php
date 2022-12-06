<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * FicheDePaie
 *
 * @ORM\Table(name="fiche_de_paie")
 * @ORM\Entity
 */
class FicheDePaie
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_FP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFp;

    /**
     * @var int
     * @Assert\NotBlank(message=" Identite de personnel  doit etre non vide")
     * @ORM\Column(name="ID_Per", type="integer", nullable=false)
     */
    private $idPer;

    /**
     * @var int
     * @Assert\NotBlank(message=" Salaire Initial doit etre non vide")
     *
     *
     *
     * @ORM\Column(name="Salaire_init", type="integer", nullable=false)
     */
    private $salaireInit;

    /**
     * @var int
     *  @Assert\NotBlank(message=" Identite de Prime doit etre non vide")
     * @ORM\Column(name="ID_Prime", type="integer", nullable=false)
     */
    private $idPrime;

    /**
     * @var int
     *  @Assert\NotBlank(message=" Salaire Total doit etre non vide")
     * @ORM\Column(name="Salaire_total", type="integer", nullable=false)
     */
    private $salaireTotal;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message=" datePaiement doit etre non vide")
     *
     * @ORM\Column(name="Date_paiement", type="date", nullable=false)
     */
    private $datePaiement;


    /**
     * @var string
     *  @Assert\NotBlank(message=" etatPaiement doit etre non vide")
     *
     *
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 100,
     *      minMessage = "doit etre >=2 ",
     *      maxMessage = "doit etre <=100" )
     * @ORM\Column(name="Etat_paiement", type="string", length=255, nullable=false)
     */

    private $etatPaiement;

    public function getIdFp(): ?int
    {
        return $this->idFp;
    }

    public function getIdPer(): ?int
    {
        return $this->idPer;
    }

    public function setIdPer(int $idPer): self
    {
        $this->idPer = $idPer;

        return $this;
    }

    public function getSalaireInit(): ?int
    {
        return $this->salaireInit;
    }

    public function setSalaireInit(int $salaireInit): self
    {
        $this->salaireInit = $salaireInit;

        return $this;
    }

    public function getIdPrime(): ?int
    {
        return $this->idPrime;
    }

    public function setIdPrime(int $idPrime): self
    {
        $this->idPrime = $idPrime;

        return $this;
    }

    public function getSalaireTotal(): ?int
    {
        return $this->salaireTotal;
    }

    public function setSalaireTotal(int $salaireTotal): self
    {
        $this->salaireTotal = $salaireTotal;

        return $this;
    }

    public function getDatePaiement(): ?\DateTimeInterface
    {
        return $this->datePaiement;
    }

    public function setDatePaiement(\DateTimeInterface $datePaiement): self
    {
        $this->datePaiement = $datePaiement;

        return $this;
    }

    public function getEtatPaiement(): ?string
    {
        return $this->etatPaiement;
    }

    public function setEtatPaiement(string $etatPaiement): self
    {
        $this->etatPaiement = $etatPaiement;

        return $this;
    }


}
