<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $media = new Media();
        $media->setLien("lien fictif");
        $media->setAlt();

        $manager->persist($media);

        $user = new User();
        $user->setEmail("lala@lala.lala");
        $user->setPassword("lalalala");
        $user->setRoles(["ROLE_USER"]);

        $manager->persist($user);

        $manager->flush();
    }
}
