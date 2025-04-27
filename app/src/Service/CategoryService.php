<?php

/**
 * Category service.
 */

namespace App\Service;

use App\Repository\CategoryRepository;
use App\Entity\Category;
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
     *
     * @constant int
     */
    private const PAGINATOR_ITEMS_PER_PAGE = 3;

    /**
     * Constructor.
     *
     * @param CategoryRepository     $CategoryRepository Category repository
     * @param PaginatorInterface $paginator      Paginator
     */
    public function __construct(private readonly CategoryRepository $categoryRepository, private readonly PaginatorInterface $paginator)
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
                'sortFieldAllowList' => ['Category.id', 'Category.createdAt', 'Category.updatedAt', 'Category.title', 'category.title'],
                'defaultSortFieldName' => 'Category.updatedAt',
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
        $category->setUpdatedAt(new \DateTime());
        if (null === $category->getId()) {
            $category->setCreatedAt(new \DateTime());
        }
        $this->categoryRepository->save($category);
    }

    public function delete(Category $category): void
    {
        $this->categoryRepository->delete($category);
    }
}