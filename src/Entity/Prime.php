<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Prime
 *
 * @ORM\Table(name="prime")
 * @ORM\Entity
 */
class Prime
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_Prime", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPrime;

    /**
     * @var string
     * @Assert\NotBlank(message=" Type de Prime  doit etre non vide")
     * @ORM\Column(name="Type_Prime", type="string", length=255, nullable=false)
     */
    private $typePrime;

    /**
     * @var int
     * @Assert\NotBlank(message=" Valeur de Prime  doit etre non vide")
     * @ORM\Column(name="Valeur_Prime", type="integer", nullable=false)
     */
    private $valeurPrime;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message=" Date de Prime  doit etre non vide")
     * @ORM\Column(name="Date_Prime", type="date", nullable=false)
     */
    private $datePrime;

    public function getIdPrime(): ?int
    {
        return $this->idPrime;
    }

    public function getTypePrime(): ?string
    {
        return $this->typePrime;
    }

    public function setTypePrime(string $typePrime): self
    {
        $this->typePrime = $typePrime;

        return $this;
    }

    public function getValeurPrime(): ?int
    {
        return $this->valeurPrime;
    }

    public function setValeurPrime(int $valeurPrime): self
    {
        $this->valeurPrime = $valeurPrime;

        return $this;
    }

    public function getDatePrime(): ?\DateTimeInterface
    {
        return $this->datePrime;
    }

    public function setDatePrime(\DateTimeInterface $datePrime): self
    {
        $this->datePrime = $datePrime;

        return $this;
    }


}
