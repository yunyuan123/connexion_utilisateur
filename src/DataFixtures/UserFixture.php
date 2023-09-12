<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    
    public function load(ObjectManager $manager):void
    {

        $user = new User();
        $user->setEmail('test@test.fr');
        $password = $this->hasher->hashPassword($user, 'coucou');
        $user->setPassword($password);
        $manager->persist($user);

        $admin = new User();
        $admin->setEmail('coucou@coucou.fr');
        $password = $this->hasher->hashPassword($admin, 'coucou123');
        $admin->setPassword($password);
        $admin->addRole('ROLE_ADMIN');
        $manager->persist($admin);

        $super = new User();
        $super->setEmail('super@super.fr');
        $password = $this->hasher->hashPassword($admin, 'super123');
        $super->setPassword($password);
        $super->addRole('ROLE_SUPER_ADMIN');
        $manager->persist($super);

        $manager->flush();
    }
}


