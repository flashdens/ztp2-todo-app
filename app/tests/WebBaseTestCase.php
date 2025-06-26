<?php

/**
 * @license MIT
 */

namespace App\Tests;

use App\Entity\Category;
use App\Entity\Note;
use App\Entity\Task;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\NoteRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Base test case class providing common setup and helper methods for web tests.
 */
class WebBaseTestCase extends WebTestCase
{
    /**
     * Test client.
     */
    protected KernelBrowser $client;

    /**
     * Doctrine Entity Manager.
     */
    protected EntityManagerInterface $entityManager;

    /**
     * Create a user with specified roles and email.
     *
     * @param array  $roles User roles
     * @param string $email User email
     *
     * @return User User entity
     */
    protected function createUser(array $roles, string $email): User
    {
        $passwordHasher = static::getContainer()->get('security.password_hasher');
        $user = new User();
        $user->setEmail($email);
        $user->setRoles($roles);
        $user->setPassword(
            $passwordHasher->hashPassword(
                $user,
                'p@55w0rd'
            )
        );
        $userRepository = static::getContainer()->get(UserRepository::class);
        $userRepository->save($user);

        return $user;
    }

    /**
     * Create a category with default values and persist it.
     *
     * @return Category The created Category entity
     */
    protected function createCategory(): Category
    {
        $category = new Category();
        $category->setTitle('test cat');
        $category->setUpdatedAt(new \DateTimeImmutable('now'));
        $category->setCreatedAt(new \DateTimeImmutable('now'));
        $categoryRepository = self::getContainer()->get(CategoryRepository::class);
        $categoryRepository->save($category);

        return $category;
    }

    /**
     * Create a note with default values and persist it.
     *
     * @return Note The created Note entity
     */
    protected function createNote(): Note
    {
        $note = new Note();
        $note->setTitle('Test Note');
        $note->setText('This is a test note.');
        $note->setCreatedAt(new \DateTimeImmutable('now'));
        $note->setUpdatedAt(new \DateTimeImmutable('now'));
        $note->setCategory($this->createCategory());

        $noteRepository = self::getContainer()->get(NoteRepository::class);
        $noteRepository->save($note);

        return $note;
    }

    /**
     * Create a task with default values and persist it.
     *
     * @return Task The created Task entity
     */
    private function createTask(): Task
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
