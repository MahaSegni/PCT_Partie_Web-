<?php

namespace App\Entity;

use App\Repository\PrixMedRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrixMedRepository::class)
 */
class PrixMed
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $xpgroht;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $xppharht;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $xprixphattc;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $xprixpubttc;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $taux;

    /**
     * @ORM\OneToOne(targetEntity=Medicament::class, inversedBy="prixMed", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="medicament", referencedColumnName="id")
     */
    private $medicament;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tva;
    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $xcfug;
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fournisseur;

    /**
     * @return mixed
     */
    public function getXcfug()
    {
        return $this->xcfug;
    }

    /**
     * @param mixed $xcfug
     */
    public function setXcfug($xcfug): void
    {
        $this->xcfug = $xcfug;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getXpgroht(): ?float
    {
        return $this->xpgroht;
    }

    public function setXpgroht(?float $xpgroht): self
    {
        $this->xpgroht = $xpgroht;

        return $this;
    }

    public function getXppharht(): ?float
    {
        return $this->xppharht;
    }

    public function setXppharht(?float $xppharht): self
    {
        $this->xppharht = $xppharht;

        return $this;
    }

    public function getXprixphattc(): ?float
    {
        return $this->xprixphattc;
    }

    public function setXprixphattc(?float $xprixphattc): self
    {
        $this->xprixphattc = $xprixphattc;

        return $this;
    }

    public function getXprixpubttc(): ?float
    {
        return $this->xprixpubttc;
    }

    public function setXprixpubttc(?float $xprixpubttc): self
    {
        $this->xprixpubttc = $xprixpubttc;

        return $this;
    }

    public function getTaux(): ?float
    {
        return $this->taux;
    }

    public function setTaux(?float $taux): self
    {
        $this->taux = $taux;

        return $this;
    }

    public function getMedicament(): ?Medicament
    {
        return $this->medicament;
    }

    public function setMedicament(Medicament $medicament): self
    {
        $this->medicament = $medicament;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(?float $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getFournisseur(): ?int
    {
        return $this->fournisseur;
    }

    public function setFournisseur(int $fournisseur): self
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    
}
