<?php

/**
 * @license MIT
 */

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * App fixtures.
 */
class AppFixtures extends Fixture
{
    /**
     * Load data.
     *
     * @param ObjectManager $manager manager
     */
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
