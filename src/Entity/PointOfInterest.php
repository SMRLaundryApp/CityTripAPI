<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PointOfInterestRepository")
 */
class PointOfInterest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Coordinates", mappedBy="pointOfInterest")
     */
    private $coordinates;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Category", inversedBy="pointOfInterests")
     */
    private $Category;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Routes", mappedBy="POI")
     */
    private $routes;

    public function __construct()
    {
        $this->coordinates = new ArrayCollection();
        $this->Category = new ArrayCollection();
        $this->routes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Coordinates[]
     */
    public function getCoordinates(): Collection
    {
        return $this->coordinates;
    }

    public function addCoordinate(Coordinates $coordinate): self
    {
        if (!$this->coordinates->contains($coordinate)) {
            $this->coordinates[] = $coordinate;
            $coordinate->setPointOfInterest($this);
        }

        return $this;
    }

    public function removeCoordinate(Coordinates $coordinate): self
    {
        if ($this->coordinates->contains($coordinate)) {
            $this->coordinates->removeElement($coordinate);
            // set the owning side to null (unless already changed)
            if ($coordinate->getPointOfInterest() === $this) {
                $coordinate->setPointOfInterest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->Category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->Category->contains($category)) {
            $this->Category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->Category->contains($category)) {
            $this->Category->removeElement($category);
        }

        return $this;
    }

    /**
     * @return Collection|Routes[]
     */
    public function getRoutes(): Collection
    {
        return $this->routes;
    }

    public function addRoute(Routes $route): self
    {
        if (!$this->routes->contains($route)) {
            $this->routes[] = $route;
            $route->addPOI($this);
        }

        return $this;
    }

    public function removeRoute(Routes $route): self
    {
        if ($this->routes->contains($route)) {
            $this->routes->removeElement($route);
            $route->removePOI($this);
        }

        return $this;
    }
}
