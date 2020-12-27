<?php

namespace App\DataFixtures;

use App\Entity\Itineraire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ItineraireFixtures extends BaseFixture
{
    public function loadData(): void
    {
        // Générer 10 itinéraires 
        $this->createMany(30, 'itineraire', function() {
            return (new Itineraire())
                ->setNom($this->faker->name)
                ->setRegion($this->faker->city)
                ->setDescription($this->faker->realText())
                ->setInformations($this->faker->realText())
                ->setFilename($this->faker->realText())
                ->setUpdatedAt($this->faker->dateTime())
            ;
        });
    }
}