<?php

/**
 * @licence MIT
 */

namespace App\Tests\Controller;

use App\Entity\Enum\UserRole;
use App\Tests\WebBaseTestCase;

/**
 * Category controller test.
 */
class CategoryControllerTest extends WebBaseTestCase
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
     * Test that the category index page is reachable and returns 200 status.
     */
    public function testCategoryIndexPageIsReachable(): void
    {
        $this->client->request('GET', '/category');
        $this->assertResponseIsSuccessful();
    }

    /**
     * Test that the category creation page is reachable and returns 200 status.
     */
    public function testCategoryCreatePageIsReachable(): void
    {
        $this->client->request('GET', '/category/create');
        $this->assertResponseIsSuccessful();
    }

    /**
     * Test that the category edit page is reachable for an existing category.
     */
    public function testCategoryEditPageIsReachable(): void
    {
        $category = $this->createCategory();

        $this->client->request('GET', '/category/'.$category->getId().'/edit');
        $this->assertResponseIsSuccessful();
    }

    /**
     * Test that the category delete page is reachable for an existing category.
     */
    public function testCategoryDeletePageIsReachable(): void
    {
        $category = $this->createCategory();

        $this->client->request('GET', '/category/'.$category->getId().'/delete');
        $this->assertResponseIsSuccessful();
    }
}
