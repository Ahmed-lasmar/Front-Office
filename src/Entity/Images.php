<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 */
class Images
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Offreemploi::class, inversedBy="images")
     * @ORM\JoinColumn(name="offreemploi", referencedColumnName="id_offre")
     */
    private $offreemploi;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOffreemploi(): ?Offreemploi
    {
        return $this->offreemploi;
    }

    public function setOffreemploi(?Offreemploi $offreemploi): self
    {
        $this->offreemploi = $offreemploi;

        return $this;
    }
}
