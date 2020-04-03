<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RoutesRepository")
 */
class Routes
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PointOfInterest", inversedBy="routes")
     */
    private $POI;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Region", mappedBy="routes")
     */
    private $region;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $length;

    /**
     * @ORM\Column(type="integer")
     */
    private $duration;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function __construct()
    {
        $this->POI = new ArrayCollection();
        $this->region = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|PointOfInterest[]
     */
    public function getPOI(): Collection
    {
        return $this->POI;
    }

    public function addPOI(PointOfInterest $pOI): self
    {
        if (!$this->POI->contains($pOI)) {
            $this->POI[] = $pOI;
        }

        return $this;
    }

    public function removePOI(PointOfInterest $pOI): self
    {
        if ($this->POI->contains($pOI)) {
            $this->POI->removeElement($pOI);
        }

        return $this;
    }

    /**
     * @return Collection|Region[]
     */
    public function getRegion(): Collection
    {
        return $this->region;
    }

    public function addRegion(Region $region): self
    {
        if (!$this->region->contains($region)) {
            $this->region[] = $region;
            $region->setRoutes($this);
        }

        return $this;
    }

    public function removeRegion(Region $region): self
    {
        if ($this->region->contains($region)) {
            $this->region->removeElement($region);
            // set the owning side to null (unless already changed)
            if ($region->getRoutes() === $this) {
                $region->setRoutes(null);
            }
        }

        return $this;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function setLength(string $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

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
}
