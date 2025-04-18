<?php

/**
 * Category fixtures.
 */

namespace App\DataFixtures;

use App\Entity\Category;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;
use Faker\Generator;

/**
 * Class CategoryFixtures.
 *
 * @psalm-suppress MissingConstructor
 */
class CategoryFixtures extends AbstractBaseFixtures
{
    /**
     * Load data.
     *
     * @psalm-suppress PossiblyNullPropertyFetch
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress UnusedClosureParam
     */
    public function loadData(): void
    {
        if (!$this->manager instanceof ObjectManager || !$this->faker instanceof Generator) {
            return;
        }

        $this->createMany(20, 'category', function (int $i) {
            $category = new Category();
            $category->setTitle($this->faker->unique()->word);
            $category->setCreatedAt(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
            );
            $category->setUpdatedAt(
                    $this->faker->dateTimeBetween('-100 days', '-1 days')
            );

            return $category;
        });
    }
}
