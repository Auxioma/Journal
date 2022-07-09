<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Trait\CreatedAtTrait;
use App\Entity\Trait\UpdatedAtTrait;
use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    use CreatedAtTrait;
    use UpdatedAtTrait;
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $Title;

    #[ORM\Column(type: 'text')]
    private $Description;

    #[ORM\Column(type: 'string', length: 255)]
    private $Slug;

    #[ORM\Column(type: 'boolean')]
    private $IsValid;

    #[ORM\Column(type: 'string', length: 255)]
    private $MetaTitle;

    #[ORM\Column(type: 'string', length: 255)]
    private $MetaDescription;

    #[ORM\OneToMany(mappedBy: 'Article', targetEntity: Pictures::class, orphanRemoval: true)]
    private $pictures;

    #[ORM\OneToMany(mappedBy: 'Articles', targetEntity: Comments::class, orphanRemoval: true)]
    private $comments;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'Articles')]
    private $Catagory;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    private $User;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->Catagory = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

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

    public function isIsValid(): ?bool
    {
        return $this->IsValid;
    }

    public function setIsValid(bool $IsValid): self
    {
        $this->IsValid = $IsValid;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->MetaTitle;
    }

    public function setMetaTitle(string $MetaTitle): self
    {
        $this->MetaTitle = $MetaTitle;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->MetaDescription;
    }

    public function setMetaDescription(string $MetaDescription): self
    {
        $this->MetaDescription = $MetaDescription;

        return $this;
    }

    /**
     * @return Collection<int, Pictures>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Pictures $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setArticle($this);
        }

        return $this;
    }

    public function removePicture(Pictures $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getArticle() === $this) {
                $picture->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Comments>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comments $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticles($this);
        }

        return $this;
    }

    public function removeComment(Comments $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArticles() === $this) {
                $comment->setArticles(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCatagory(): Collection
    {
        return $this->Catagory;
    }

    public function addCatagory(Category $catagory): self
    {
        if (!$this->Catagory->contains($catagory)) {
            $this->Catagory[] = $catagory;
        }

        return $this;
    }

    public function removeCatagory(Category $catagory): self
    {
        $this->Catagory->removeElement($catagory);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }
}
