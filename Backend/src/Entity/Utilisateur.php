<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Impression3D", mappedBy="Utilisateur")
     */
    private $Utilisateur;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Formprint;



    public function __construct()
    {
        $this->Utilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
         {
             return $this->Prenom;
         }

    public function setPrenom(string $Prenom): self
    {
             $this->Prenom = $Prenom;

             return $this;
    }



    /**
     * @return Collection|Impression3D[]
     */
    public function getUtilisateur(): Collection
    {
        return $this->Utilisateur;
    }

    public function addUtilisateur(Impression3D $utilisateur): self
    {
        if (!$this->Utilisateur->contains($utilisateur)) {
            $this->Utilisateur[] = $utilisateur;
            $utilisateur->setUtilisateur($this);
        }

        return $this;
    }

    public function removeUtilisateur(Impression3D $utilisateur): self
    {
        if ($this->Utilisateur->contains($utilisateur)) {
            $this->Utilisateur->removeElement($utilisateur);
            // set the owning side to null (unless already changed)
            if ($utilisateur->getUtilisateur() === $this) {
                $utilisateur->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return (string) $this->id;
    }

    public function getFormprint(): ?bool
    {
        return $this->Formprint;
    }

    public function setFormprint(bool $Formprint): self
    {
        $this->Formprint = $Formprint;

        return $this;
    }

}
