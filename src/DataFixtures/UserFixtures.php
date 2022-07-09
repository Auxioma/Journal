<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        
        $faker = Faker\Factory::create('fr_FR');

        // Je met 50 User
        for( $i=0; $i <= 49; $i++ ) {

            $user = new User();
            $user->setEmail($faker->companyEmail());
            $user->setPassword($this->encoder->hashPassword( $user, '123456789'));
            $user->setIsVerified('1');

            $manager->persist($user);

            $this->addReference('user_'.$i, $user);
            
        }

        $manager->flush();
        
    }
}
