<?php

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\HttpClient\HttpClient;
use App\Entity\Task;
use App\Repository\TaskRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{

//    private TaskRepository $taskRepository;
//
//    public function __construct(TaskRepository $taskRepository)
//    {
//        $this->taskRepository = $taskRepository;
//    }
    public const TEST_ROUTE = '/task';
    /**
     * Set up tests.
     */

    private KernelBrowser $httpClient;

    public function setUp(): void
    {
        $this->httpClient = static::createClient();
    }


    public function testShowTask()
    {
        $task = new Task();
        $task->setTitle('test task');
        $task->setCreatedAt(
            new DateTimeImmutable()
        );
        $task->setUpdatedAt(
            new DateTimeImmutable()
        );

        $this->manager->persist($task);
        $this->manager->flush();

        $this->httpClient->request('GET', self::TEST_ROUTE . '/' . $task->getId());
        $result = $this->httpClient->getResponse();

        $this->assertEquals(200, $result->getStatusCode());
        $this->assertSelectorTextContains('td', $task->getId());

    }
}