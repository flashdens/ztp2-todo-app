<?php

/**
 * Category service.
 */

namespace App\Service;

use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Repository\NoteRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class CategoryService.
 */
class CategoryService implements CategoryServiceInterface
{
    /**
     * Items per page.
     *
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     * See https://symfony.com/doc/current/best_practices.html#configuration
     */
    public const PAGINATOR_ITEMS_PER_PAGE = 10;

    /**
     * Constructor.
     *
     * @param CategoryRepository $categoryRepository Category repository
     * @param TaskRepository     $taskRepository     Task repository
     * @param NoteRepository     $noteRepository     Note repository
     * @param PaginatorInterface $paginator          Paginator
     */
    public function __construct(private readonly CategoryRepository $categoryRepository, private readonly TaskRepository $taskRepository, private readonly NoteRepository $noteRepository, private readonly PaginatorInterface $paginator)
    {
    }

    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->categoryRepository->queryAll(),
            $page,
            self::PAGINATOR_ITEMS_PER_PAGE,
            [
                'sortFieldAllowList' => ['category.id', 'category.createdAt', 'category.updatedAt', 'category.title'],
                'defaultSortFieldName' => 'category.updatedAt',
                'defaultSortDirection' => 'desc',
            ]
        );
    }

    /**
     * Save entity.
     *
     * @param Category $category Category entity
     */
    public function save(Category $category): void
    {
        $this->categoryRepository->save($category);
    }

    /**
     * Delete entity.
     *
     * @param Category $category Category entity
     */
    public function delete(Category $category): void
    {
        $this->categoryRepository->delete($category);
    }

    /**
     * Can Category be deleted?
     *
     * @param Category $category Category entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Category $category): bool
    {
        try {
            $result = $this->taskRepository->countByCategory($category);

            return !($result > 0);
        } catch (NoResultException|NonUniqueResultException) {
            return false;
        }
    }

    /**
     * Get a paginated list of tasks for a category.
     *
     * @param Category $category Category entity
     * @param int      $page     Page number
     *
     * @return PaginationInterface Paginated list of tasks
     */
    public function getTasksByCategory(Category $category, int $page = 1): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->taskRepository->findBy(['category' => $category]),
            $page,
            self::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Get a paginated list of notes for a category.
     *
     * @param Category $category Category entity
     * @param int      $page     Page number
     *
     * @return PaginationInterface Paginated list of notes
     */
    public function getNotesByCategory(Category $category, int $page = 1): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->noteRepository->findBy(['category' => $category]),
            $page,
            self::PAGINATOR_ITEMS_PER_PAGE
        );
    }
}
