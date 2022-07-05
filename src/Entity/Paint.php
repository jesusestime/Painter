<?php

namespace App\Entity;

use App\Repository\PaintRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaintRepository::class)]
class Paint
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2, nullable: true)]
    private $lenght;

    #[ORM\Column(type: 'decimal', precision: 6, scale: 2, nullable: true)]
    private $height;

    #[ORM\Column(type: 'boolean')]
    private $onSale;

    #[ORM\Column(type: 'decimal', precision: 12, scale: 2, nullable: true)]
    private $price;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $dateCompletion;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'boolean')]
    private $porfolio;

    #[ORM\Column(type: 'string', length: 255)]
    private $slug;

    #[ORM\Column(type: 'string', length: 255)]
    private $file;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'paints')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'paints')]
    private $categorie;

    #[ORM\OneToMany(mappedBy: 'paint', targetEntity: Comment::class)]
    private $comments;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getLenght(): ?string
    {
        return $this->lenght;
    }

    public function setLenght(?string $lenght): self
    {
        $this->lenght = $lenght;

        return $this;
    }

    public function getHeight(): ?string
    {
        return $this->height;
    }

    public function setHeight(?string $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function isOnSale(): ?bool
    {
        return $this->onSale;
    }

    public function setOnSale(bool $onSale): self
    {
        $this->onSale = $onSale;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDateCompletion(): ?\DateTimeInterface
    {
        return $this->dateCompletion;
    }

    public function setDateCompletion(?\DateTimeInterface $dateCompletion): self
    {
        $this->dateCompletion = $dateCompletion;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isPorfolio(): ?bool
    {
        return $this->porfolio;
    }

    public function setPorfolio(bool $porfolio): self
    {
        $this->porfolio = $porfolio;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
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

    /**
     * @return Collection<int, Category>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Category $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
        }

        return $this;
    }

    public function removeCategorie(Category $categorie): self
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPaint($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPaint() === $this) {
                $comment->setPaint(null);
            }
        }

        return $this;
    }
}
