<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $admin->setEmail('eva.guegan@hotmail.fr');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'password1'
        ));
        $admin->setRoles(1);
        $manager->persist($admin);

        $admin2 = new Admin();
        $admin2->setEmail('dev-sdvi@sdvi.fr');
        $admin2->setPassword($this->passwordEncoder->encodePassword(
            $admin2,
            'password2'
        ));
        $admin2->setRoles(1);
        $manager->persist($admin2);

        $manager->flush();
    }
}
