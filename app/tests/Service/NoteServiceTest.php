<?php

/**
 * @licence MIT
 */

namespace App\Tests\Service;

use App\Entity\Note;
use App\Repository\NoteRepository;
use App\Service\NoteService;
use App\Tests\WebBaseTestCase;

/**
 * Class NoteServiceTest.
 *
 * Integration tests for NoteService using real services.
 */
class NoteServiceTest extends WebBaseTestCase
{
    private NoteService $noteService;
    private NoteRepository $noteRepository;

    /**
     * Set up.`.
     */
    protected function setUp(): void
    {
        $this->client = static::createClient();

        $container = static::getContainer();
        $this->noteService = $container->get(NoteService::class);
        $this->noteRepository = $container->get(NoteRepository::class);
    }

    /**
     * Test saving a note.
     */
    public function testSave(): void
    {
        $note = new Note();
        $note->setTitle('Integration Note');
        $note->setText('Test content for note');
        $note->setCreatedAt(new \DateTimeImmutable());
        $note->setUpdatedAt(new \DateTimeImmutable());
        $note->setCategory($this->createCategory());

        $this->noteService->save($note);

        $savedNote = $this->noteRepository->find($note->getId());

        $this->assertNotNull($savedNote);
        $this->assertEquals('Integration Note', $savedNote->getTitle());
    }

    /**
     * Test deleting a note.
     */
    public function testDelete(): void
    {
        $note = new Note();
        $note->setTitle('Note to Delete');
        $note->setText('This note will be deleted');
        $note->setCreatedAt(new \DateTimeImmutable());
        $note->setUpdatedAt(new \DateTimeImmutable());
        $note->setCategory($this->createCategory());

        $this->noteService->save($note);
        $noteId = $note->getId();

        $this->noteService->delete($note);

        $deletedNote = $this->noteRepository->find($noteId);
        $this->assertNull($deletedNote);
    }

    /**
     * Test paginated list.
     */
    public function testGetPaginatedList(): void
    {
        // Create 11 notes to exceed pagination limit
        for ($i = 0; $i < 11; ++$i) {
            $note = new Note();
            $note->setTitle('Note '.$i);
            $note->setText('Content for note '.$i);
            $note->setCreatedAt(new \DateTimeImmutable());
            $note->setUpdatedAt(new \DateTimeImmutable());
            $note->setCategory($this->createCategory());

            $this->noteService->save($note);
        }

        $pagination = $this->noteService->getPaginatedList(1);

        $this->assertLessThanOrEqual(10, count($pagination->getItems()));
        $this->assertGreaterThan(0, $pagination->getTotalItemCount());
    }
}
