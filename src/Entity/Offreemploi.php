<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Offreemploi
 *
 * @ORM\Table(name="offreemploi")
 * @ORM\Entity
 */
class Offreemploi
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_offre", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOffre;

    /**
     * @var string
     * @Assert\NotBlank(message=" nom offre doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer nom min 5 caracteres"
     *
     *     )
     * @ORM\Column(name="nomOffre", type="string", length=50, nullable=false)
     */
    private $nomoffre;

    /**
     * @var string
     * @Assert\NotBlank(message=" description doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer description min 20 caracteres",
     *     max=500,
     *
     *     )
     * @ORM\Column(name="description", type="string", length=50, nullable=false)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(message=" skills doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer skills min 5 caracteres"
     *
     *     )
     * @ORM\Column(name="skills", type="string", length=50, nullable=false)
     */
    private $skills;

    /**
     * @var string
     * @Assert\NotBlank(message=" lien picture doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer un lien picture au mini de 20 caracteres"
     *
     *     )
     * @ORM\Column(name="picture", type="string", length=50, nullable=false)
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="offreemploi",cascade={"persist"})
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=Rate::class, mappedBy="offreemploi",cascade={"persist"})
     */
    private $rating;



    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->rating = new ArrayCollection();
    }

    public function getIdOffre(): ?int
    {
        return $this->idOffre;
    }

    public function getNomoffre(): ?string
    {
        return $this->nomoffre;
    }

    public function setNomoffre(string $nomoffre): self
    {
        $this->nomoffre = $nomoffre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSkills(): ?string
    {
        return $this->skills;
    }

    public function setSkills(string $skills): self
    {
        $this->skills = $skills;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setOffreemploi($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getOffreemploi() === $this) {
                $image->setOffreemploi(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Rate>
     */
    public function getRating(): Collection
    {
        return $this->rating;
    }

    public function addRating(Rate $rating): self
    {
        if (!$this->rating->contains($rating)) {
            $this->rating[] = $rating;
            $rating->setOffreemploi($this);
        }

        return $this;
    }

    public function removeRating(Rate $rating): self
    {
        if ($this->rating->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getOffreemploi() === $this) {
                $rating->setOffreemploi(null);
            }
        }

        return $this;
    }
}
