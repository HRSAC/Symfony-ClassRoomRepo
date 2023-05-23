<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Cours;
use App\Entity\Eleve;
use App\Entity\Absence;
use App\Entity\Contacte;
use DateInterval;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
        /**
     * @var Generator
     */
    private Generator $faker;
    private UserPasswordHasherInterface $hasher;
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
        
    }

    public function load(ObjectManager $manager): void
    {

        for ($i=0; $i < 2 ; $i++){

            $user = new User();
            $user->setNomUser($this->faker->firstName())
            ->setPrenomUser($this->faker->lastName())
            ->setMail($this->faker->email())
            ->setDateNaissUser($this->faker->dateTime())
            ->setRoles(['ROLE_USER'])
            ->setSexe("1")
            ->setTelephone("0675847234");
            

            $hashPassword = $this->hasher->hashPassword(
                $user, 'password'
            );
            $user->setPassword($hashPassword);
            
            $manager->persist($user);
            $manager->flush();

        }
    }
}