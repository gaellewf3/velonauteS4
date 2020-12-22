<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

abstract class BaseFixture extends Fixture
{
    private $manager;

    /** 
     * @var Generator
     */
    protected $faker; 

    /**
     * Liste de références vers des entités
     * @var string[]
     */
    private $references = [];

    /**
     * 
     */
    abstract protected function loadData(): void;

    /**
     * 
     */
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create('fr_FR');

        $this->loadData();
        $this->manager->flush();
    }

    /**
     * Créer un certain nombre d'entités
     * @param int $count  
     * @param string $groupName     
     * @param callable $factory     
     */
    protected function createMany(int $count, string $itineraire, callable $factory): void
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = $factory($i);

            if ($entity === null) {
                throw new \LogicException('L\'entité doit être retournée !');
            }

            $this->manager->persist($entity);

            $reference = sprintf('%s_%d', $itineraire, $i);
            $this->addReference($reference, $entity);
        }
    }
}
