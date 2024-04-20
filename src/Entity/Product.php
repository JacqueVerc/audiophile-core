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
    #[ORM\OneToMany(targetEntity: ProductDescription::class, mappedBy: 'product', orphanRemoval: true)]
    private Collection $productDescription;

    #[ORM\Column(length: 100)]
    private ?string $category_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $feature_1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $feature_2 = null;

    #[ORM\Column(length: 75, nullable: true)]
    private ?string $box_product = null;

    #[ORM\Column(nullable: true)]
    private ?int $box_product_number = null;

    #[ORM\Column(length: 75, nullable: true)]
    private ?string $replace_product = null;

    #[ORM\Column(nullable: true)]
    private ?int $replace_product_number = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $manual_product = null;

    #[ORM\Column(nullable: true)]
    private ?int $manual_product_number = null;

    #[ORM\Column(length: 75, nullable: true)]
    private ?string $element_product = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $travel_product = null;

    #[ORM\Column(nullable: true)]
    private ?int $element_product_number = null;

    #[ORM\Column(nullable: true)]
    private ?int $travel_product_number = null;

    public function __construct()
    {
        $this->media = new ArrayCollection();
        $this->productDescription = new ArrayCollection();
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
    public function getProductDescription(): Collection
    {
        return $this->productDescription;
    }

    public function addProductDescription(ProductDescription $productDescription): static
    {
        if (!$this->productDescription->contains($productDescription)) {
            $this->productDescription->add($productDescription);
            $productDescription->setProduct($this);
        }

        return $this;
    }

    public function removeProductDescription(ProductDescription $productDescription): static
    {
        if ($this->productDescription->removeElement($productDescription)) {
            // set the owning side to null (unless already changed)
            if ($productDescription->getProduct() === $this) {
                $productDescription->setProduct(null);
            }
        }

        return $this;
    }

    public function getCategoryName(): ?string
    {
        return $this->category_name;
    }

    public function setCategoryName(string $category_name): static
    {
        $this->category_name = $category_name;

        return $this;
    }

    public function getFeature1(): ?string
    {
        return $this->feature_1;
    }

    public function setFeature1(?string $feature_1): static
    {
        $this->feature_1 = $feature_1;

        return $this;
    }

    public function getFeature2(): ?string
    {
        return $this->feature_2;
    }

    public function setFeature2(?string $feature_2): static
    {
        $this->feature_2 = $feature_2;

        return $this;
    }

    public function getBoxProduct(): ?string
    {
        return $this->box_product;
    }

    public function setBoxProduct(?string $box_product): static
    {
        $this->box_product = $box_product;

        return $this;
    }

    public function getBoxProductNumber(): ?int
    {
        return $this->box_product_number;
    }

    public function setBoxProductNumber(?int $box_product_number): static
    {
        $this->box_product_number = $box_product_number;

        return $this;
    }

    public function getReplaceProduct(): ?string
    {
        return $this->replace_product;
    }

    public function setReplaceProduct(?string $replace_product): static
    {
        $this->replace_product = $replace_product;

        return $this;
    }

    public function getReplaceProductNumber(): ?int
    {
        return $this->replace_product_number;
    }

    public function setReplaceProductNumber(?int $replace_product_number): static
    {
        $this->replace_product_number = $replace_product_number;

        return $this;
    }

    public function getManualProduct(): ?string
    {
        return $this->manual_product;
    }

    public function setManualProduct(?string $manual_product): static
    {
        $this->manual_product = $manual_product;

        return $this;
    }

    public function getManualProductNumber(): ?int
    {
        return $this->manual_product_number;
    }

    public function setManualProductNumber(?int $manual_product_number): static
    {
        $this->manual_product_number = $manual_product_number;

        return $this;
    }

    public function getElementProduct(): ?string
    {
        return $this->element_product;
    }

    public function setElementProduct(?string $element_product): static
    {
        $this->element_product = $element_product;

        return $this;
    }

    public function getTravelProduct(): ?string
    {
        return $this->travel_product;
    }

    public function setTravelProduct(?string $travel_product): static
    {
        $this->travel_product = $travel_product;

        return $this;
    }

    public function getElementProductNumber(): ?int
    {
        return $this->element_product_number;
    }

    public function setElementProductNumber(?int $element_product_number): static
    {
        $this->element_product_number = $element_product_number;

        return $this;
    }

    public function getTravelProductNumber(): ?int
    {
        return $this->travel_product_number;
    }

    public function setTravelProductNumber(?int $travel_product_number): static
    {
        $this->travel_product_number = $travel_product_number;

        return $this;
    }
}
