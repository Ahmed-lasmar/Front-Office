<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Participation
 *
 * @ORM\Table(name="participation")
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEvent", type="integer", nullable=false)
     */
    private $idevent;

    /**
     *
     * @ORM\Column(name="idParticipation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idparticipation;

    /**
     *@Assert\NotBlank(message="L'id doit etre non vide")
     * @var int
     *
     * @ORM\Column(name="idUser", type="integer", nullable=false)
     */
    private $iduser;

    /**
     *@Assert\NotBlank(message="L'email doit etre non vide")
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     * @var string
     *
     * @ORM\Column(name="Pmail", type="string", length=30, nullable=false)
     */
    private $pmail;

    public function getIdevent(): ?int
    {
        return $this->idevent;
    }

    public function setIdevent(int $idevent): self
    {
        $this->idevent = $idevent;

        return $this;
    }

    public function getIdparticipation(): ?int
    {
        return $this->idparticipation;
    }

    public function getIduser(): ?int
    {
        return $this->iduser;
    }

    public function setIduser(int $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getPmail(): ?string
    {
        return $this->pmail;
    }

    public function setPmail(string $pmail): self
    {
        $this->pmail = $pmail;

        return $this;
    }


}
