<?php

namespace App\DataFixtures;

use App\Entity\Media;
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

        $manager->flush();
    }
}
