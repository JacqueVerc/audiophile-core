<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, CommandLine>
     */
    #[ORM\OneToMany(targetEntity: CommandLine::class, mappedBy: 'orders', orphanRemoval: true)]
    private Collection $commandLine;

    #[ORM\OneToOne(mappedBy: 'orders', cascade: ['persist', 'remove'])]
    private ?Cart $cart = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $orderNumber = null;

    #[ORM\Column]
    private ?bool $valid = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function __construct()
    {
        $this->commandLine = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CommandLine>
     */
    public function getCommandLine(): Collection
    {
        return $this->commandLine;
    }

    public function addCommandLine(CommandLine $commandLine): static
    {
        if (!$this->commandLine->contains($commandLine)) {
            $this->commandLine->add($commandLine);
            $commandLine->setOrders($this);
        }

        return $this;
    }

    public function removeCommandLine(CommandLine $commandLine): static
    {
        if ($this->commandLine->removeElement($commandLine)) {
            // set the owning side to null (unless already changed)
            if ($commandLine->getOrders() === $this) {
                $commandLine->setOrders(null);
            }
        }

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): static
    {
        // unset the owning side of the relation if necessary
        if ($cart === null && $this->cart !== null) {
            $this->cart->setOrders(null);
        }

        // set the owning side of the relation if necessary
        if ($cart !== null && $cart->getOrders() !== $this) {
            $cart->setOrders($this);
        }

        $this->cart = $cart;

        return $this;
    }

    public function getOrderNumber(): ?string
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(string $orderNumber): static
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function isValid(): ?bool
    {
        return $this->valid;
    }

    public function setValid(bool $valid): static
    {
        $this->valid = $valid;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }
}
