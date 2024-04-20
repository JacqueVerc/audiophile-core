<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use App\Entity\CartLine;
use App\Entity\Category;
use App\Entity\Media;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class AppFixtures extends Fixture
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $produit = new Product();
        $produit->setName("YX1 Wireless Earphones");
        $produit->setSlug("yx1-earphones");
        $produit->setDescription("Tailor your listening experience with bespoke dynamic drivers from the new YX1 Wireless Earphones. Enjoy incredible high-fidelity sound even in noisy environments with its active noise cancellation feature.");
        $produit->setAvailable(true);
        $produit->setPrice(599);

        $manager->persist($produit);

        $produit2 = new Product();
        $produit2->setName("XX59 Headphones");
        $produit2->setSlug("xx59-headphones");
        $produit2->setDescription("Enjoy your audio almost anywhere and customize it to your specific tastes with the XX59 headphones. The stylish yet durable versatile wireless headset is a brilliant companion at home or on the move.");
        $produit2->setAvailable(true);
        $produit2->setPrice(899);

        $manager->persist($produit2);

        $produit3 = new Product();
        $produit3->setName("XX99 Mark I Headphones");
        $produit3->setSlug("xx99-mark-one-headphones");
        $produit3->setDescription("As the gold standard for headphones, the classic XX99 Mark I offers detailed and accurate audio reproduction for audiophiles, mixing engineers, and music aficionados alike in studios and on the go.");
        $produit3->setAvailable(true);
        $produit3->setPrice(1750);

        $manager->persist($produit3);

        $produit4 = new Product();
        $produit4->setName("XX99 Mark II Headphones");
        $produit4->setSlug("xx99-mark-two-headphones");
        $produit4->setDescription('The new XX99 Mark II headphones is the pinnacle of pristine audio. It redefines your premium headphone experience by reproducing the balanced depth and precision of studio-quality sound.');
        $produit4->setAvailable(true);
        $produit4->setPrice(2999);

        $manager->persist($produit4);

        $produit5 = new Product();
        $produit5->setName("ZX7 Speaker");
        $produit5->setSlug("zx7-speaker");
        $produit5->setDescription("Stream high quality sound wirelessly with minimal to no loss. The ZX7 speaker uses high-end audiophile components that represents the top of the line powered speakers for home or studio use.");
        $produit5->setAvailable(true);
        $produit5->setPrice(3500);

        $manager->persist($produit5);

        $produit6 = new Product();
        $produit6->setName("ZX9 Speaker");
        $produit6->setSlug("zx9-speaker");
        $produit6->setDescription("Upgrade your sound system with the all new ZX9 active speaker. It’s a bookshelf speaker system that offers truly wireless connectivity -- creating new possibilities for more pleasing and practical audio setups.");
        $produit6->setAvailable(true);
        $produit6->setPrice(4500);

        $manager->persist($produit6);

        $categorie = new Category();
        $categorie->setName('headphones');
        $categorie->setDescription('');
        $categorie->addProduct($produit2);
        $categorie->addProduct($produit3);
        $categorie->addProduct($produit4);

        $manager->persist($categorie);

        $categorie2 = new Category();
        $categorie2->setName('speakers');
        $categorie2->setDescription('');
        $categorie2->addProduct($produit5);
        $categorie2->addProduct($produit6);

        $manager->persist($categorie2);

        $categorie3 = new Category();
        $categorie3->setName('earphones');
        $categorie3->setDescription('');
        $categorie3->addProduct($produit);

        $manager->persist($categorie3);

//        $media = new Media();
//        $media->setLien("lien fictif");
//        $media->setAlt();
//        $media->setProduct($produit);
//
//        $manager->persist($media);

        $user = new User();
        $user->setEmail("lala@lala.lala");
        $user->setPassword("lalalala");
        $user->setRoles(["ROLE_USER"]);
        $user->setName('Jean');
        $user->setFirstName('Mich');

        $manager->persist($user);

        $cart = new Cart();
        $cart->setUser($user);

        $cartLine = new CartLine();
        $cartLine->setCart($cart);
        $cartLine->setProduct($produit);
        $cartLine->setQuantity(2);

        $cart->addCartLine($cartLine);

        $manager->persist($cartLine);

        $manager->persist($cart);


        $products = [$produit, $produit2, $produit3, $produit4, $produit5, $produit6];
        $array = ['desktop', 'mobile', 'tablet'];

        foreach ($products as $product) {
            foreach ($array as $item) {
                $media = new Media();
                $media->setLien('/images/products/product-' . $product->getSlug() . '/' . $item . '/image-category-page-preview-' . $product->getSlug() . '.jpg');
                $media->setAlt('prévisualisation du produit ' . $product->getName());
                $media->setProduct($product);
                $media->setType('preview');
                $media->setSize($item);
                $manager->persist($media);

                $media2 = new Media();
                $media2->setLien('/images/products/product-' . $product->getSlug() . '/' . $item . '/image-gallery-1-' . $product->getSlug() . '.jpg');
                $media2->setAlt('image de gallerie du produit ' . $product->getName());
                $media2->setProduct($product);
                $media2->setType('gallery1');
                $media2->setSize($item);
                $manager->persist($media2);

                $media3 = new Media();
                $media3->setLien('/images/products/product-' . $product->getSlug() . '/' . $item . '/image-gallery-2-' . $product->getSlug() . '.jpg');
                $media3->setAlt('image de gallerie du produit ' . $product->getName());
                $media3->setProduct($product);
                $media3->setType('gallery2');
                $media3->setSize($item);
                $manager->persist($media3);

                $media4 = new Media();
                $media4->setLien('/images/products/product-' . $product->getSlug() . '/' . $item . '/image-gallery-3-' . $product->getSlug() . '.jpg');
                $media4->setAlt('image de gallerie du produit ' . $product->getName());
                $media4->setProduct($product);
                $media4->setType('gallery3');
                $media4->setSize($item);
                $manager->persist($media4);

                $media5 = new Media();
                $media5->setLien('/images/products/product-' . $product->getSlug() . '/' . $item . '/image-product-' . $product->getSlug() . '.jpg');
                $media5->setAlt('image du produit ' . $product->getName());
                $media5->setProduct($product);
                $media5->setType('product');
                $media5->setSize($item);
                $manager->persist($media5);
            }
        }

        $manager->flush();
    }
}
