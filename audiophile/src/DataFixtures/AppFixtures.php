<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Media;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $produit = new Product();
        $produit->setName("xx99 mark II headphones");
        $produit->setDescription("Experience natural, lifelike audio and exceptional build quality made for the passionate music enthusiast.");
        $produit->setAvailable(true);
        $produit->setPrice(10);

        $manager->persist($produit);

        $produit2 = new Product();
        $produit2->setName("XX59 headphones");
        $produit2->setDescription("Experience natural, lifelike audio made for the passionate music enthusiast.");
        $produit2->setAvailable(true);
        $produit2->setPrice(10);

        $manager->persist($produit2);

        $produit3 = new Product();
        $produit3->setName("speaker xx");
        $produit3->setDescription("surround hd sound.");
        $produit3->setAvailable(true);
        $produit3->setPrice(10);

        $manager->persist($produit3);

        $categorie = new Category();
        $categorie->setName('headphones');
        $categorie->setDescription('');
        $categorie->addProduct($produit);
        $categorie->addProduct($produit2);

        $manager->persist($categorie);

        $categorie2 = new Category();
        $categorie2->setName('speakers');
        $categorie2->setDescription('');
        $categorie2->addProduct($produit3);

        $manager->persist($categorie2);

        $media = new Media();
        $media->setLien("lien fictif");
        $media->setAlt();
        $media->setProduct($produit);

        $manager->persist($media);

        $user = new User();
        $user->setEmail("lala@lala.lala");
        $user->setPassword("lalalala");
        $user->setRoles(["ROLE_USER"]);
        $user->setName('Jean');
        $user->setFirstName('Mich');


        $manager->persist($user);

        $manager->flush();
    }
}
