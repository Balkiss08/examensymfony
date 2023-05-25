<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 5,
     * max = 50,
     * minMessage = "Le nom d'un produit doit comporter au moins {{ limit }} caractères",
     * maxMessage = "Le nom d'un produit doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 5,
     * max = 50,
     * minMessage = "La description d'un produit doit comporter au moins {{ limit }} caractères",
     * maxMessage = "La description d'un produit doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $description;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     * min = 5,
     * max = 50,
     * minMessage = "La description d'un produit doit comporter au moins {{ limit }} caractères",
     * maxMessage = "La description d'un produit doit comporter au plus {{ limit }} caractères"
     * )
     */
    private $image;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     * @Assert\NotEqualTo(
     * value = 0,
     * message = "Le prix d’un produit  ne doit pas être égal à 0 "
     * )
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */ 
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(): ?self
    {
        $this->id = $id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
    public function setDescription(): ?self
    {
        return $this->description;
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
 public function getImage(): ?User
    {
        return $this->user;
    }

    public function setImage(?User $image): self
    {
        $this->image = $image;
        
        return $this;
 }





}
