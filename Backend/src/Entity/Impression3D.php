<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Impression3DRepository")
 */
class Impression3D
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
     * @ORM\Column(type="integer")
     */
    private $Temps;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Matiere;

    /**
     * @ORM\Column(type="integer")
     */
    private $Prix;

    /**
     * @ORM\Column(type="integer")
     */
    private $Heure;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="Utilisateur")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendrier", inversedBy="Calendrier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Calendrier;

    /**
     * @ORM\Column(type="string")
     */
    private $PrintFilename;

    public function getPrintFilename()
    {
        return $this->PrintFilename;
    }

    public function setPrintFilename($PrintFilename)
    {
        $this->PrintFilename = $PrintFilename;

        return $this;
    }
    private $date;
    Private $Noma;

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

    public function getTemps(): ?int
    {
        return $this->Temps;
    }

    public function setTemps(int $Temps): self
    {
        $this->Temps = $Temps;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->Matiere;
    }

    public function setMatiere(string $Matiere): self
    {
        $this->Matiere = $Matiere;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getHeure(): ?int
    {
        return $this->Heure;
    }

    public function setHeure(int $Heure): self
    {
        $this->Heure = $Heure;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateur $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }

    public function getCalendrier(): ?Calendrier
    {
        return $this->Calendrier;
    }

    public function setCalendrier(?Calendrier $Calendrier): self
    {
        $this->Calendrier = $Calendrier;

        return $this;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }


    public function getNoma()
    {
        return $this->Noma;
    }

    public function setNoma($Noma): void
    {
        $this->Noma = $Noma;
    }

}
