<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[Vich\Uploadable]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[Assert\NotBlank]
    #[Vich\UploadableField(mapping: "genre_images", fileNameProperty: "image")]
    private ?File $imageFile = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Beer::class, cascade: ["persist", "remove"])]
    private Collection $beers;

    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->beers = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {

            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    /**
     * @return Collection<int, Beer>
     */
    public function getBeers(): Collection
    {
        return $this->beers;
    }

    public function addBeer(Beer $beer): self
    {
        if (!$this->beers->contains($beer)) {
            $this->beers->add($beer);
            $beer->setCategory($this);
        }

        return $this;
    }

    public function removeBeer(Beer $beer): self
    {
        if ($this->beers->removeElement($beer)) {
            // set the owning side to null (unless already changed)
            if ($beer->getCategory() === $this) {
                $beer->setCategory(null);
            }
        }

        return $this;
    }
}
