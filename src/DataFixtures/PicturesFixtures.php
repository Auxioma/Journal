<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Pictures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Smknstd\FakerPicsumImages\FakerPicsumImagesProvider;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PicturesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new FakerPicsumImagesProvider($faker));
        
        for($i=0; $i<=10000; $i++) {
            
            $Articles = $this->getReference('article_'.$faker->numberBetween(0, 5000));
            
            $picture = new Pictures();
            $picture->setName($faker->image('public/images/articles', 4000, 3000));
            $picture->setAlt($faker->sentence(3));
            $picture->setArticle($Articles);

            $manager->persist($picture);

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ArticlesFixtures::class,
        ];
    }
}
 