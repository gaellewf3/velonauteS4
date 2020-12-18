<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
class Commandes
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
    private $id_membre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut_paiement;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="prenom")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdMembre(): ?string
    {
        return $this->id_membre;
    }

    public function setIdMembre(string $id_membre): self
    {
        $this->id_membre = $id_membre;

        return $this;
    }

    public function getStatutPaiement(): ?string
    {
        return $this->statut_paiement;
    }

    public function setStatutPaiement(string $statut_paiement): self
    {
        $this->statut_paiement = $statut_paiement;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
