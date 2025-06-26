<?php

/**
 * @license MIT
 */

namespace App\Tests\Controller;

use App\Entity\Enum\UserRole;
use App\Tests\WebBaseTestCase;

/**
 * Note controller test.
 */
class NoteControllerTest extends WebBaseTestCase
{
    /**
     * Setup before each test.
     * Logs in an admin user.
     */
    protected function setUp(): void
    {
        $this->client = static::createClient();

        $adminUser = $this->createUser([
            UserRole::ROLE_USER->value,
            UserRole::ROLE_ADMIN->value,
        ], 'admin@example.com');

        $this->client->loginUser($adminUser);
    }

    /**
     * Test that the note index page is reachable and returns 200 status.
     */
    public function testNoteIndexPageIsReachable(): void
    {
        $this->client->request('GET', '/note');
        $this->assertResponseIsSuccessful();
    }

    /**
     * Test that the note creation page is reachable and returns 200 status.
     */
    public function testNoteCreatePageIsReachable(): void
    {
        $this->client->request('GET', '/note/create');
        $this->assertResponseIsSuccessful();
    }

    /**
     * Test that the note view page is reachable for an existing note.
     */
    public function testNoteViewPageIsReachable(): void
    {
        $note = $this->createNote();

        $this->client->request('GET', '/note/'.$note->getId());
        $this->assertResponseIsSuccessful();
    }

    /**
     * Test that the note edit page is reachable for an existing note.
     */
    public function testNoteEditPageIsReachable(): void
    {
        $note = $this->createNote();

        $this->client->request('GET', '/note/'.$note->getId().'/edit');
        $this->assertResponseIsSuccessful();
    }

    /**
     * Test that the note delete page is reachable for an existing note.
     */
    public function testNoteDeletePageIsReachable(): void
    {
        $note = $this->createNote();

        $this->client->request('GET', '/note/'.$note->getId().'/delete');
        $this->assertResponseIsSuccessful();
    }
}
