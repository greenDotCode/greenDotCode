<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PriceRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;

/**
 * @ApiResource(
 *      itemOperations={ "get", "put", "delete" },
 *      collectionOperations={ "get", "post" },
 * )
 * @ApiFilter(SearchFilter::class, properties={
 *     "region": "partial",
 * })
 * @ApiFilter(DateFilter::class, properties={ "createdAt" })
 * @ApiFilter(OrderFilter::class,
 *     properties={
 *          "createdAt", "buy", "sell"
 *     }
 * )
 * @ApiFilter(RangeFilter::class, properties={
 *      "tier", "rarity", "buy", "sell"
 * })
 * @ORM\Entity(repositoryClass=PriceRepository::class)
 */
class Price
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $region;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $buy;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sell;

    /**
     * @ORM\ManyToOne(targetEntity=Item::class, inversedBy="prices")
     */
    private ?Item $item;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $margin;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $marginPercentage;

    public function __construct()
    {
        $this->createdAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getBuy(): ?int
    {
        return $this->buy;
    }

    public function setBuy(?int $buy): self
    {
        $this->buy = $buy;

        return $this;
    }

    public function getSell(): ?int
    {
        return $this->sell;
    }

    public function setSell(?int $sell): self
    {
        $this->sell = $sell;

        return $this;
    }

    public function getItem(): ?Item
    {
        return $this->item;
    }

    public function setItem(?Item $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getMargin(): ?int
    {
        return $this->margin;
    }

    public function setMargin(?int $margin): self
    {
        $this->margin = $margin;

        return $this;
    }

    public function getMarginPercentage(): ?float
    {
        return $this->marginPercentage;
    }

    public function setMarginPercentage(?float $marginPercentage): self
    {
        $this->marginPercentage = $marginPercentage;

        return $this;
    }
}
