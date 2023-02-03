<?php

namespace App\DataFixtures;

use App\Entity\Beer;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Filesystem\Filesystem;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BeerFixtures extends Fixture implements DependentFixtureInterface
{  
    private Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public const BEERS = [
        'Left Blonde',
        'Karmelite',
        'La shtouff',
        'La Fada',
        'La Levrette'
    ];
    
    public function load(ObjectManager $manager): void
    {
        $this->filesystem->remove(__DIR__ . '/../../public/images/genres/');
        $this->filesystem->mkdir(__DIR__ . '/../../public/images/genres/');

        copy(
            './src/DataFixtures/beerImages/test2.png',
            __DIR__ . '/../../public/images/genres/test2.png'
        );

        for ($i = 0; $i < count(CategoryFixtures::CATEGORIES); $i++){
            foreach (self::BEERS as $beerKey => $beerName) {
                $beer = new Beer();
                $beer->setName((self::BEERS[$beerKey]));
                $beer->setPays('Belgique');
                $beer->setImage('test2.png');
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
