<?php

/**
 * @license MIT
 */

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category entity represents a category for tasks or other entities.
 */
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\Table(name: 'categories')]
class Category
{
    /**
     * The unique identifier of the category.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * The title of the category.
     */
    #[ORM\Column(length: 64)]
    #[Assert\Length(min: 3, max: 64)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    private ?string $title = null;

    /**
     * The datetime when the category was created.
     */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Gedmo\Timestampable(on: 'create')]
    #[Assert\Type(\DateTimeImmutable::class)]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * The datetime when the category was last updated.
     */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Gedmo\Timestampable(on: 'update')]
    #[Assert\Type(\DateTimeImmutable::class)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * The slug generated from the title.
     */
    #[ORM\Column(length: 64, nullable: true)]
    #[Assert\Type('string')]
    #[Assert\Length(min: 3, max: 64)]
    #[Gedmo\Slug(fields: ['title'])]
    private ?string $slug = null;

    /**
     * Gets the category ID.
     *
     * @return int|null the unique identifier of the category
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Gets the category title.
     *
     * @return string|null the title of the category
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Sets the category title.
     *
     * @param string $title the title to set
     *
     * @return static returns itself for method chaining
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the creation datetime.
     *
     * @return \DateTimeImmutable|null the datetime when the category was created
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Sets the creation datetime.
     *
     * @param \DateTimeImmutable $createdAt the datetime to set
     *
     * @return static returns itself for method chaining
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Gets the last updated datetime.
     *
     * @return \DateTimeImmutable|null the datetime when the category was last updated
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * Sets the last updated datetime.
     *
     * @param \DateTimeImmutable $updatedAt the datetime to set
     *
     * @return static returns itself for method chaining
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Gets the slug.
     *
     * @return string|null the slug generated from the title
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * Sets the slug.
     *
     * @param string|null $slug the slug to set
     *
     * @return static returns itself for method chaining
     */
    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
