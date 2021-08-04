<?php

namespace App\Entity;

use App\Repository\MedicamentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
/**
 * @ORM\Entity(repositoryClass=MedicamentRepository::class)
 */
class Medicament
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups("post:read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups("post:read")
     */
    private $nomm;

    /**
     * @ORM\Column(type="float")
     *  @Groups("post:read")
     */
    private $prix_achat;

    /**
     * @ORM\Column(type="integer")
     *
     */
    private $qte;

    /**
     * @ORM\Column(type="float")
     *
     */
    private $remise;

    /**
     * @ORM\Column(type="integer")
     *
     */
    private $ug;

    /**
     * @ORM\Column(type="float")
     *
     */
    private $tauxug;

    /**
     * @ORM\Column(type="boolean")
     *
     */
    private $validation;


    /**
     * @ORM\ManyToOne(targetEntity=Fournisseur::class, inversedBy="medicaments")
     * @ORM\JoinColumn(name="fournisseur", referencedColumnName="id")
     * @Groups("post:read")
     */
    private $fournisseur;

    /**
     * @ORM\OneToOne(targetEntity=PrixMed::class, mappedBy="medicament", cascade={"persist", "remove"})
     */
    private $prixMed;
    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("post:read")
     */
    private $xpgroht;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("post:read")
     */
    private $xppharht;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("post:read")
     */
    private $xprixphattc;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Groups("post:read")
     */
    private $xprixpubttc;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $taux;


    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $tva;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $xcfug;

    /**
     * @ORM\ManyToOne(targetEntity=Devise::class, inversedBy="medicaments")
     */
    private $uv;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     *
     */

    private $xug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomm(): ?string
    {
        return $this->nomm;
    }

    public function setNomm(string $nomm): self
    {
        $this->nomm = $nomm;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrixAchat()
    {
        return $this->prix_achat;
    }

    /**
     * @param mixed $prix_achat
     */
    public function setPrixAchat($prix_achat): void
    {
        $this->prix_achat = $prix_achat;
    }



    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

        return $this;
    }

    public function getRemise(): ?float
    {
        return $this->remise;
    }

    public function setRemise(float $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getUg(): ?int
    {
        return $this->ug;
    }

    public function setUg(int $ug): self
    {
        $this->ug = $ug;

        return $this;
    }

    public function getTauxug(): ?float
    {
        return $this->tauxug;
    }

    public function setTauxug(float $tauxug): self
    {
        $this->tauxug = $tauxug;

        return $this;
    }

    public function getValidation(): ?bool
    {
        return $this->validation;
    }

    public function setValidation(bool $validation): self
    {
        $this->validation = $validation;

        return $this;
    }



    public function getFournisseur()
    {
        return $this->fournisseur;
    }
    public function setFournisseur($fournisseur)
    {
        $this->fournisseur = $fournisseur;
    }

    public function __toString()
    {
        return $this->nomm;
    }

    public function getPrixMed(): ?PrixMed
    {
        return $this->prixMed;
    }

    /**
     * @return mixed
     */
    public function getXpgroht()
    {
        return $this->xpgroht;
    }

    /**
     * @param mixed $xpgroht
     */
    public function setXpgroht($xpgroht): void
    {
        $this->xpgroht = $xpgroht;
    }

    /**
     * @return mixed
     */
    public function getXppharht()
    {
        return $this->xppharht;
    }

    /**
     * @param mixed $xppharht
     */
    public function setXppharht($xppharht): void
    {
        $this->xppharht = $xppharht;
    }

    /**
     * @return mixed
     */
    public function getXprixphattc()
    {
        return $this->xprixphattc;
    }

    /**
     * @param mixed $xprixphattc
     */
    public function setXprixphattc($xprixphattc): void
    {
        $this->xprixphattc = $xprixphattc;
    }

    /**
     * @return mixed
     */
    public function getXprixpubttc()
    {
        return $this->xprixpubttc;
    }

    /**
     * @param mixed $xprixpubttc
     */
    public function setXprixpubttc($xprixpubttc): void
    {
        $this->xprixpubttc = $xprixpubttc;
    }

    public function setPrixMed(PrixMed $prixMed): self
    {
        // set the owning side of the relation if necessary
        if ($prixMed->getMedicament() !== $this) {
            $prixMed->setMedicament($this);
        }

        $this->prixMed = $prixMed;

        return $this;
    }

    public function getXcfug(): ?float
    {
        return $this->xcfug;
    }

    public function setXcfug(?float $xcfug): self
    {
        $this->xcfug = $xcfug;

        return $this;
    }

    public function getUv(): ?Devise
    {
        return $this->uv;
    }

    public function setUv(?Devise $uv): self
    {
        $this->uv = $uv;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaux()
    {
        return $this->taux;
    }

    /**
     * @param mixed $taux
     */
    public function setTaux($taux): void
    {
        $this->taux = $taux;
    }

    /**
     * @return mixed
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * @param mixed $tva
     */
    public function setTva($tva): void
    {
        $this->tva = $tva;
    }

    public function getXug(): ?string
    {
        return $this->xug;
    }

    public function setXug(?string $xug): self
    {
        $this->xug = $xug;

        return $this;
    }



}
