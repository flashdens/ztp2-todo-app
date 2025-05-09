<?php

/**
 * Note service interface.
 */

namespace App\Service;

use App\Entity\Note;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface NoteServiceInterface.
 */
interface NoteServiceInterface
{
    /**
     * Get paginated list.
     *
     * @param int $page Page number
     *
     * @return PaginationInterface Paginated list
     */
    public function getPaginatedList(int $page): PaginationInterface;

    /**
     * Save entity.
     *
     * @param Note $note Task entity
     */
    public function save(Note $note): void;

    /**
     * Delete entity.
     *
     * @param Note $note Task entity
     */
    public function delete(Note $note): void;
}
