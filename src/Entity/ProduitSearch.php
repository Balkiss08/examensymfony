<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
class ProduitSearch
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Produit")
     */
    private $produit;
    public function getProduit(): ?Produit
    {
        return $this->produit;
    }
    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;
        return $this;
    }
}