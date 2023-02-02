<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORIES = [
        'Le caractère de l\'Ambree',
        'La douceur de la Blonde',
        'La fraicheur des Fruitées',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORIES as $key => $categoryName) {
           $category = new Category();
           $category->setName($categoryName);
           $category->setImage('/public/build/images/ficheproduit3.9cdf662e.png');
            $manager->persist($category);
            $this->addReference('tutorial_' . $key,$category);

            $manager->flush();
        }
    }
}
