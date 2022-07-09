<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    use CreatedAtTrait;
    use UpdatedAtTrait;
        
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Name;

    #[ORM\Column(type: 'string', length: 255)]
    private $Slug;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $Image;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'categories')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private $SubCategory;

    #[ORM\OneToMany(mappedBy: 'SubCategory', targetEntity: self::class)]
    private $categories;

    #[ORM\Column(type: 'boolean')]
    private $IsValid;

    #[ORM\ManyToMany(targetEntity: Articles::class, mappedBy: 'Catagory')]
    private $Articles;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->CreatedAt = new \DateTimeImmutable();
        $this->Articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->Slug;
    }

    public function setSlug(string $Slug): self
    {
        $this->Slug = $Slug;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    public function getSubCategory(): ?self
    {
        return $this->SubCategory;
    }

    public function setSubCategory(?self $SubCategory): self
    {
        $this->SubCategory = $SubCategory;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(self $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setSubCategory($this);
        }

        return $this;
    }

    public function removeCategory(self $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getSubCategory() === $this) {
                $category->setSubCategory(null);
            }
        }

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->IsValid;
    }

    public function setIsValid(bool $IsValid): self
    {
        $this->IsValid = $IsValid;

        return $this;
    }

    /**
     * @return Collection<int, Articles>
     */
    public function getArticles(): Collection
    {
        return $this->Articles;
    }

    public function addArticle(Articles $article): self
    {
        if (!$this->Articles->contains($article)) {
            $this->Articles[] = $article;
            $article->addCatagory($this);
        }

        return $this;
    }

    public function removeArticle(Articles $article): self
    {
        if ($this->Articles->removeElement($article)) {
            $article->removeCatagory($this);
        }

        return $this;
    }
}
