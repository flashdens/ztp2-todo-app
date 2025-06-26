<?php

/**
 * Task.php.
 *
 * This file is part of the App\Entity namespace.
 *
 * @license MIT
 */

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Task entity.
 */
#[ORM\Entity(repositoryClass: TaskRepository::class)]
#[ORM\Table(name: 'tasks')]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Gedmo\Timestampable(on: 'create')]
    #[Assert\Type(\DateTimeImmutable::class)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Gedmo\Timestampable(on: 'create')]
    #[Assert\Type(\DateTimeImmutable::class)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 255)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    private ?string $title = null;

    #[ORM\ManyToOne(targetEntity: Category::class, cascade: ['all'], fetch: 'EXTRA_LAZY')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\Type(Category::class)]
    private ?Category $category = null;

    #[ORM\Column(length: 1024, nullable: true)]
    #[Assert\Length(min: 2, max: 1024)]
    #[Assert\Type('string')]
    private ?string $comment = null;

    /**
     * Gets the task ID.
     *
     * @return int|null The task ID
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Gets the creation date and time of the task.
     *
     * @return \DateTimeImmutable|null The creation datetime
     */
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Sets the creation date and time of the task.
     *
     * @param \DateTimeImmutable $createdAt The creation datetime
     *
     * @return $this
     */
    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Gets the last update date and time of the task.
     *
     * @return \DateTimeImmutable|null The last update datetime
     */
    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * Sets the last update date and time of the task.
     *
     * @param \DateTimeImmutable $updatedAt The last update datetime
     *
     * @return $this
     */
    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Gets the title of the task.
     *
     * @return string|null The task title
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Sets the title of the task.
     *
     * @param string $title The task title
     *
     * @return $this
     */
    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Gets the category of the task.
     *
     * @return Category|null The category entity
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * Sets the category of the task.
     *
     * @param Category|null $category The category entity
     *
     * @return $this
     */
    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Gets the comment associated with the task.
     *
     * @return string|null The comment text
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    /**
     * Sets the comment associated with the task.
     *
     * @param string|null $comment The comment text
     *
     * @return $this
     */
    public function setComment(?string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }
}
