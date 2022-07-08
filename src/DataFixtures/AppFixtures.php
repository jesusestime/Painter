<?php

namespace App\DataFixtures;

use App\Entity\Blogpost;
use App\Entity\Category;
use App\Entity\Paint;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager): void
    {
        // use faker_components

        $faker = Factory::create();
        
        // create_user
        $user=new User();
        $user->setEmail('user@mail.com')
             ->setLastname($faker->lastName())
             ->setFirstname($faker->firstName())
             ->setTelephone($faker->phoneNumber())
             ->setAbout($faker->text())
             ->setInstagram('instagram')
             ->setFacebook('facebook');
        $password=$this->encoder->hashPassword($user,'000000');
        $user->setPassword($password);
        
        $manager->persist($user);
       


        //create_blogpost
        for($i=0;$i<10;$i++){
            $blogpost=new Blogpost();

            $blogpost->setTitle($faker->word(3,true))
                     ->setContent($faker->text(350))
                     ->setSlug($faker->slug(4))
                     ->setUser($user)
                     ->setCreatedAt(new DateTimeImmutable("now"));

            $manager->persist($blogpost);
            

        }
        //create_categories
        for($i=0;$i<5;$i++){
            $category=new Category();

            $category->setName($faker->word())
                     ->setDescription($faker->word(10,true))
                     ->setSlug($faker->slug(4));

            $manager->persist($category);
          

            //create 2 paint/category

            for($j=0;$j<2;$j++){
                $paint=new Paint();
    
                $paint->setName($faker->word())
                      ->setLenght($faker->randomFloat(2,20,60))
                      ->setHeight($faker->randomFloat(2,20,60))
                      ->setOnSale($faker->randomElement([true,false]))
                      ->setPrice($faker->randomFloat(2,100,99999))
                      ->setDateCompletion(new DateTimeImmutable("yesterday"))
                      ->setCreatedAt(new DateTimeImmutable("now"))
                      ->setDescription($faker->text())
                      ->setPorfolio($faker->randomElement([true,false]))
                      ->setSlug($faker->slug(4))
                      ->setFile('img/paint-2.jpg')
                      ->addCategorie($category)
                      ->setUser($user);
                      
    
                $manager->persist($paint);
                $manager->flush($paint);
            }


        }
    }
}
