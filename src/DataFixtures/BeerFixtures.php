<?php

namespace App\DataFixtures;

use App\Entity\Beer;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BeerFixtures extends Fixture implements DependentFixtureInterface
{
    public const BEERS = [
        'Left Blonde',
        'Karmelite',
        'La shtouff',
        'La Fada',
        'La Levrette'
    ];
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < count(CategoryFixtures::CATEGORIES); $i++){
            foreach (self::BEERS as $beerKey => $beerName) {
                $beer = new Beer();
                $beer->setName((self::BEERS[$beerKey]));
                $beer->setPays('Belgique');
                $beer->setImage('');
                $category = $this->getReference('category_' . $i);
                $beer->setCategory($category);
                $this->addReference('category_' . $i . '_beer_' . $beerKey, $beer);
                $manager->persist($beer);
            }  
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
