<?php

namespace App\DataFixtures;

use App\Factory\EventCategoryFactory;
use App\Factory\EventFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        EventCategoryFactory::createMany(7);
        EventFactory::createMany(100, function () {
            return [
                'category' => EventCategoryFactory::randomRange(0, 3),
            ];
        });
    }
}
