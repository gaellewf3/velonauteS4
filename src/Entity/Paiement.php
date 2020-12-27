<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaiementRepository::class)
 */
class Paiement
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero_carte;

    /**
     * @ORM\Column(type="integer")
     */
    private $code_securite;

    /**
     * @ORM\Column(type="integer")
     */
    private $expiration_mois;

    /**
     * @ORM\Column(type="integer")
     */
    private $expiration_annee;

    /**
     * @ORM\Column(type="string", columnDefinition="enum('visa', 'mastercard', 'amex')")
     */
    private $type_carte;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumeroCarte(): ?int
    {
        return $this->numero_carte;
    }

    public function setNumeroCarte(int $numero_carte): self
    {
        $this->numero_carte = $numero_carte;

        return $this;
    }

    public function getCodeSecurite(): ?int
    {
        return $this->code_securite;
    }

    public function setCodeSecurite(int $code_securite): self
    {
        $this->code_securite = $code_securite;

        return $this;
    }

    public function getExpirationMois(): ?int
    {
        return $this->expiration_mois;
    }

    public function setExpirationMois(int $expiration_mois): self
    {
        $this->expiration_mois = $expiration_mois;

        return $this;
    }

    public function getExpirationAnnee(): ?int
    {
        return $this->expiration_annee;
    }

    public function setExpirationAnnee(int $expiration_annee): self
    {
        $this->expiration_annee = $expiration_annee;

        return $this;
    }

    /**
     * Get the value of type_carte
     */ 
    public function getTypeCarte(): ?string
    {
        return $this->type_carte;
    }

    /**
     * Set the value of type_carte
     *
     * @return  self
     */ 
    public function setTypeCarte($type_carte)
    {
        $this->type_carte = $type_carte;

        return $this;
    }
}
