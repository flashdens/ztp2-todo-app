<?php

/**
 * @license MIT
 */

namespace App\Tests\Controller;

use App\Entity\Enum\UserRole;
use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Tests\WebBaseTestCase;

/**
 * Functional tests for TaskController.
 */
class TaskControllerTest extends WebBaseTestCase
{
    /**
     * Setup before each test.
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
     * Test that the task index page is reachable.
     */
    public function testTaskIndexPageIsReachable(): void
    {
        $this->client->request('GET', '/task');
        $this->assertResponseIsSuccessful();
    }

    /**
     * Test that the task creation page is reachable.
     */
    public function testTaskCreatePageIsReachable(): void
    {
        $this->client->request('GET', '/task/create');
        $this->assertResponseIsSuccessful();
    }

    /**
     * Test that the task edit page is reachable.
     */
    public function testTaskEditPageIsReachable(): void
    {
        $task = $this->createTask();
        $this->client->request('GET', '/task/'.$task->getId().'/edit');
        $this->assertResponseIsSuccessful();
    }

    /**
     * Test that the task delete page is reachable.
     */
    public function testTaskDeletePageIsReachable(): void
    {
        $task = $this->createTask();
        $this->client->request('GET', '/task/'.$task->getId().'/delete');
        $this->assertResponseIsSuccessful();
    }

    /**
     * Create and persist a Task entity.
     *
     * @return Task The created Task entity
     */
    private function createTask()
    {
        $task = new Task();
        $task->setTitle('Test Task');
        $task->setCreatedAt(new \DateTimeImmutable());
        $task->setUpdatedAt(new \DateTimeImmutable());
        $task->setCategory($this->createCategory());

        $taskRepository = self::getContainer()->get(TaskRepository::class);
        $taskRepository->save($task);

        return $task;
    }
}
