<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\RegionRepository")
 */
class Region
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=3)
     */
    private $latitude;

    /**
     * @ORM\Column(type="decimal", precision=9, scale=6)
     */
    private $longitude;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $latitudeDelta;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $longitudeDelta;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Routes", inversedBy="region")
     */
    private $routes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitudeDelta(): ?string
    {
        return $this->latitudeDelta;
    }

    public function setLatitudeDelta(string $latitudeDelta): self
    {
        $this->latitudeDelta = $latitudeDelta;

        return $this;
    }

    public function getLongitudeDelta(): ?string
    {
        return $this->longitudeDelta;
    }

    public function setLongitudeDelta(string $longitudeDelta): self
    {
        $this->longitudeDelta = $longitudeDelta;

        return $this;
    }

    public function getRoutes(): ?Routes
    {
        return $this->routes;
    }

    public function setRoutes(?Routes $routes): self
    {
        $this->routes = $routes;

        return $this;
    }
}
