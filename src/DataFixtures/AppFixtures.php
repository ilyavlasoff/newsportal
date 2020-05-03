<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        //add admin
        $admin = new User();
        $admin->setUsername('testadmin');
        $admin->setPassword(
            $this->passwordEncoder->encodePassword(
                $admin,
                'testadminpassword'
            )
        );
        $admin->setRoles([User::roleAdmin]);
        $admin->setEmail('testadmin@test.com');
        $admin->setDescription('123');
        $admin->setIsActivated(true);
        $admin->setUserPic('default_pic.jpg');
        $manager->persist($admin);
        // add user
        $user = new User();
        $user->setUsername('testuser');
        $user->setPassword(
            $this->passwordEncoder->encodePassword(
                $user,
                'testuserpassword'
            )
        );
        $user->setRoles([User::roleUser]);
        $user->setEmail('testuser@test.com');
        $user->setDescription('456');
        $user->setIsActivated(true);
        $user->setUserPic('default_pic.jpg');
        $manager->persist($user);

        $manager->flush();
    }
}
