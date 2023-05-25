<?php
namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity(repositoryClass="App\Repository\ModeleRepository")
*/
class Modele
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
private $nom;
/**
* @ORM\Column(type="text", nullable=true)
*/

private $cars;
public function __construct()
{
$this->cars = new ArrayCollection();
}
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

 /**
 * @return Collection|Car[]
 */
 public function getCars(): Collection
 {
 return $this->cars;
 }
 public function addCars(Car $car): self
 {
 if (!$this->cars->contains($car)) {
 $this->cars[] = $car;
 $car->setModele($this);
 }
 return $this;
 }
 public function removeCar(Car $car): self
 {
 if ($this->cars->contains($car)) {
 $this->cars->removeElement($car);
 // set the owning side to null (unless already changed)
 if ($car->getModele() === $this) {
 $car->setModele(null);
 }
 }
 return $this;
 }
}