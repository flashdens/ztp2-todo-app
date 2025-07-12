<?php

/**
 * @license MIT
 */

namespace App\Entity;

use App\Repository\NoteRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Note entity representing a note with title, text, and category.
 */
#[ORM\Entity(repositoryClass: NoteRepository::class)]
#[ORM\Table(name: 'notes')]
class Note
{
    /**
     * Unique identifier of the note.
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * Creation datetime of the note.
     */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Gedmo\Timestampable(on: 'create')]
    #[Assert\Type(DateTimeImmutable::class)]
    private ?DateTimeImmutable $createdAt = null;

    /**
     * Last updated datetime of the note.
     */
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    #[Gedmo\Timestampable(on: 'update')]
    #[Assert\Type(DateTimeImmutable::class)]
    private ?DateTimeImmutable $updatedAt = null;

    /**
     * Title of the note.
     */
    #[ORM\Column(length: 255)]
    #[Assert\Length(min: 3, max: 255)]
    #[Assert\Type('string')]
    #[Assert\NotBlank]
    private ?string $title = null;

    /**
     * Text content of the note.
     */
    #[ORM\Column(length: 1024, nullable: true)]
    #[Assert\Length(min: 3, max: 1024)]
    #[Assert\Type('string')]
    private ?string $text = null;

    /**
     * Associated category of the note.
     */
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    /**
     * Gets the note ID.
     *
     * @return int|null the unique identifier of the note
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Gets the creation datetime.
     *
     * @return DateTimeImmutable|null the datetime when the note was created
     */
    public function getCreatedAt(): ?DateTimeImmutable
    {
        return $this->createdAt;
    }

    /**
     * Sets the creation datetime.
     *
     * @param DateTimeImmutable $createdAt the datetime to set
     *
     * @return static returns itself for method chaining
     */
    public function setCreatedAt(DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Gets the last updated datetime.
     *
     * @return DateTimeImmutable|null the datetime when the note was last updated
     */
    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    /**
     * Sets the last updated datetime.
     *
     * @param DateTimeImmutable $updatedAt the datetime to set
     *
     * @return static returns itself for method chaining
     */
    public function setUpdatedAt(DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Gets the title.
     *
     * @return string|null the title of the note
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Sets the title.
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
     * Gets the text content.
     *
     * @return string|null the text content of the note
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Sets the text content.
     *
     * @param string|null $text the text content to set
     *
     * @return static returns itself for method chaining
     */
    public function setText(?string $text): static
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Gets the associated category.
     *
     * @return Category|null the associated category
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * Sets the associated category.
     *
     * @param Category|null $category the category to associate
     *
     * @return static returns itself for method chaining
     */
    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
