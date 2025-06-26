<?php

/**
 * @licence MIT
 */

namespace App\Tests\Service;

use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Service\TaskService;
use App\Tests\WebBaseTestCase;

/**
 * Class TaskServiceIntegrationTest.
 */
class TaskServiceTest extends WebBaseTestCase
{
    private TaskService $taskService;
    private TaskRepository $taskRepository;

    /**
     * Set up.
     */
    protected function setUp(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        $this->taskService = $container->get(TaskService::class);
        $this->taskRepository = $container->get(TaskRepository::class);
    }

    /**
     * Test saving and retrieving a task.
     */
    public function testSave(): void
    {
        $task = new Task();
        $task->setTitle('Integration Task');
        $task->setCategory($this->createCategory());
        $task->setCreatedAt(new \DateTimeImmutable());
        $task->setUpdatedAt(new \DateTimeImmutable());

        $this->taskService->save($task);

        $savedTask = $this->taskRepository->find($task->getId());

        $this->assertNotNull($savedTask);
        $this->assertEquals('Integration Task', $savedTask->getTitle());
    }

    /**
     * Test deleting a task.
     */
    public function testDelete(): void
    {
        $task = new Task();
        $task->setTitle('Task to Delete');
        $task->setCreatedAt(new \DateTimeImmutable());
        $task->setUpdatedAt(new \DateTimeImmutable());
        $task->setCategory($this->createCategory());

        $this->taskService->save($task);
        $taskId = $task->getId();

        $this->taskService->delete($task);

        $deletedTask = $this->taskRepository->find($taskId);
        $this->assertNull($deletedTask);
    }

    /**
     * Test getPaginatedList returns expected results.
     */
    public function testGetPaginatedList(): void
    {
        // Create 11 tasks to exceed pagination limit
        for ($i = 0; $i < 11; ++$i) {
            $task = new Task();
            $task->setTitle('Task '.$i);
            $task->setCreatedAt(new \DateTimeImmutable());
            $task->setUpdatedAt(new \DateTimeImmutable());
            $task->setCategory($this->createCategory());
            $this->taskService->save($task);
        }

        $pagination = $this->taskService->getPaginatedList(1);

        $this->assertLessThanOrEqual(10, count($pagination->getItems()));
        $this->assertGreaterThan(0, $pagination->getTotalItemCount());
    }
}
