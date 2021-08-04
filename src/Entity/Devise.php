<?php

namespace App\Entity;

use App\Repository\DeviseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=DeviseRepository::class)
 */
class Devise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("post:read")
     */
    private $nomdev;

    /**
     * @ORM\Column(type="float")
     * @Groups("post:read")
     */
    private $cout;

    /**
     * @ORM\Column(type="float")
     * @Groups("post:read")
     */
    private $unitedev;

    /**
     * @ORM\OneToMany(targetEntity=Medicament::class, mappedBy="uv")
     */
    private $medicaments;

    public function __construct()
    {
        $this->medicaments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomdev(): ?string
    {
        return $this->nomdev;
    }

    public function setNomdev(string $nomdev): self
    {
        $this->nomdev = $nomdev;

        return $this;
    }

    public function getCout(): ?float
    {
        return $this->cout;
    }

    public function setCout(float $cout): self
    {
        $this->cout = $cout;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnitedev()
    {
        return $this->unitedev;
    }


    public function setUnitedev(float $unitedev): self
    {
        $this->unitedev = $unitedev;

        return $this;
    }

    /**
     * @return Collection|Medicament[]
     */
    public function getMedicaments(): Collection
    {
        return $this->medicaments;
    }

    public function addMedicament(Medicament $medicament): self
    {
        if (!$this->medicaments->contains($medicament)) {
            $this->medicaments[] = $medicament;
            $medicament->setUv($this);
        }

        return $this;
    }

    public function removeMedicament(Medicament $medicament): self
    {
        if ($this->medicaments->removeElement($medicament)) {
            // set the owning side to null (unless already changed)
            if ($medicament->getUv() === $this) {
                $medicament->setUv(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nomdev;
    }

}
