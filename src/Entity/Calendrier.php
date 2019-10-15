<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CalendrierRepository")
 */
class Calendrier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Impression3D", mappedBy="Calendrier")
     */
    private $Calendrier;

    public function __construct()
    {
        $this->Calendrier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }

    /**
     * @return Collection|Impression3D[]
     */
    public function getCalendrier(): Collection
    {
        return $this->Calendrier;
    }

    public function addCalendrier(Impression3D $calendrier): self
    {
        if (!$this->Calendrier->contains($calendrier)) {
            $this->Calendrier[] = $calendrier;
            $calendrier->setCalendrier($this);
        }

        return $this;
    }

    public function removeCalendrier(Impression3D $calendrier): self
    {
        if ($this->Calendrier->contains($calendrier)) {
            $this->Calendrier->removeElement($calendrier);
            // set the owning side to null (unless already changed)
            if ($calendrier->getCalendrier() === $this) {
                $calendrier->setCalendrier(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->id;
    }
}
