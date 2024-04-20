<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    /**
     * @var Collection<int, Media>
     */
    #[ORM\OneToMany(targetEntity: Media::class, mappedBy: 'product')]
    private Collection $media;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column]
    private ?bool $available = null;

    #[ORM\Column(length: 50)]
    private ?string $slug = null;

    /**
     * @var Collection<int, ProductDescription>
     */
    #[ORM\ManyToMany(targetEntity: ProductDescription::class, mappedBy: 'products')]
    private Collection $productDescriptions;

    #[ORM\Column(length: 255)]
    private ?string $feature_1 = null;

    #[ORM\Column(length: 255)]
    private ?string $feature_2 = null;

    public function __construct()
    {
        $this->media = new ArrayCollection();
        $this->productDescriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedia(Media $media): static
    {
        if (!$this->media->contains($media)) {
            $this->media->add($media);
            $media->setProduct($this);
        }

        return $this;
    }

    public function removeMedia(Media $media): static
    {
        if ($this->media->removeElement($media)) {
            // set the owning side to null (unless already changed)
            if ($media->getProduct() === $this) {
                $media->setProduct(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): static
    {
        $this->available = $available;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, ProductDescription>
     */
    public function getProductDescriptions(): Collection
    {
        return $this->productDescriptions;
    }

    public function getFeature1(): ?string
    {
        return $this->feature_1;
    }

    public function setFeature1(string $feature_1): static
    {
        $this->feature_1 = $feature_1;

        return $this;
    }

    public function getFeature2(): ?string
    {
        return $this->feature_2;
    }

    public function setFeature2(string $feature_2): static
    {
        $this->feature_2 = $feature_2;

        return $this;
    }
}
