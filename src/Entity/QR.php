<?php

namespace App\Entity;

use App\Repository\QRRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QRRepository::class)]
class QR
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[Assert\Length(
        min: 10,
        max: 255,
        minMessage: 'La question doit contenir au minimum {{ limit }} charactères',
        maxMessage: 'La question doit contenir au maximum {{ limit }} charactères',
    )]
    #[ORM\Column(length: 255)]
    private ?string $question = null;

    #[Assert\Length(
        min: 10,
        max: 255,
        minMessage: 'La réponse doit contenir au minimum {{ limit }} charactères',
        maxMessage: 'La réponse doit contenir au maximum {{ limit }} charactères',
    )]
    #[ORM\Column(length: 255)]
    private ?string $reponse = null;

    #[ORM\Column(nullable: true)]
    private ?bool $aRevoir = null;

    #[ORM\Column(nullable: true)]
    private ?bool $aFaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getReponse(): ?string
    {
        return $this->reponse;
    }

    public function setReponse(string $reponse): self
    {
        $this->reponse = $reponse;

        return $this;
    }

    public function isARevoir(): ?bool
    {
        return $this->aRevoir;
    }

    public function setARevoir(?bool $aRevoir): self
    {
        $this->aRevoir = $aRevoir;

        return $this;
    }

    public function isAFaire(): ?bool
    {
        return $this->aFaire;
    }

    public function setAFaire(bool $aFaire): self
    {
        $this->aFaire = $aFaire;

        return $this;
    }
}
