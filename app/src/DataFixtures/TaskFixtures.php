<?php

/**
 * Task fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Task;
use DateTimeImmutable;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

/**
 * Class TaskFixtures.
 */
class TaskFixtures extends AbstractBaseFixtures
{
    /**
     * Faker.
     */
    protected Generator $faker;

    /**
     * Persistence object manager.
     */
    protected ObjectManager $manager;

    /**
     * Load.
     */
    public function loadData( ): void
    {
        $this->faker = Factory::create();

        for ($i = 0; $i < 10; ++$i) {
            $task = new Task();
            $task->setTitle($this->faker->sentence);
            $task->setCreatedAt(
                DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-100 days', '-1 days'))
            );
            $task->setUpdatedAt(
                ($this->faker->dateTimeBetween('-100 days', '-1 days'))
            );
            $this->manager->persist($task);
        }

        $this->manager->flush();
    }
}
