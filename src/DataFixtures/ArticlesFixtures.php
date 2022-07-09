<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\Articles;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArticlesFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger){}
    
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 5000; $i++) {
            $r = rand(1, 15);
            $p = rand(1, 5);
            $article = new Articles();
            $article->setTitle($faker->sentence($r));
            $article->setDescription($faker->paragraph($p));
            $article->setIsValid('1');
            $article->setMetaTitle($faker->sentence($r));
            $article->setMetaDescription($faker->sentence($r));
            $article->setSlug($this->slugger->slug($faker->sentence($r)));
            $article->setCreatedAt(new \DateTimeImmutable());
            $article->setUpdatedAt(new \DateTimeImmutable());

            $category = $this->getReference('category_'.$faker->numberBetween(0, 2));
            $article->addCatagory($category);

            $user = $this->getReference('user_'.$faker->numberBetween(0, 49));
            $article->setUser($user);

            $manager->persist($article);

            $this->addReference('article_'.$i, $article);
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
