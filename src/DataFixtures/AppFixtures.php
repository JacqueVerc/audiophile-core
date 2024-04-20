<?php

namespace App\DataFixtures;

use App\Entity\Cart;
use App\Entity\CartLine;
use App\Entity\Category;
use App\Entity\Media;
use App\Entity\Product;
use App\Entity\ProductDescription;
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
        $produit->setFeature1('Experience unrivalled stereo sound thanks to innovative acoustic technology. With improved ergonomics designed for full day wearing, these revolutionary earphones have been finely crafted to provide you with the perfect fit, delivering complete comfort.');
        $produit->setFeature2('The YX1 Wireless Earphones features customizable controls for volume, music, calls, and voice assistants built into both earbuds. The new 7-hour battery life can be extended up to 28 hours with the charging case, giving you uninterrupted play time.');

        $manager->persist($produit);

        $produit2 = new Product();
        $produit2->setName("XX59 Headphones");
        $produit2->setSlug("xx59-headphones");
        $produit2->setDescription("Enjoy your audio almost anywhere and customize it to your specific tastes with the XX59 headphones. The stylish yet durable versatile wireless headset is a brilliant companion at home or on the move.");
        $produit2->setAvailable(true);
        $produit2->setPrice(899);
        $produit2->setFeature1('These headphones have been created from durable, high-quality materials tough enough to take anywhere. Its compact folding design fuses comfort and minimalist style making it perfect for travel. Flawless transmission is assured by the wireless tech.');
        $produit2->setFeature2('More than a simple pair of headphones, this headset features a pair of built-in microphones for clear, hands-free calling when paired with a compatible smartphone. Controlling music and calls is also intuitive thanks to easy-access touch buttons.');

        $manager->persist($produit2);

        $produit3 = new Product();
        $produit3->setName("XX99 Mark I Headphones");
        $produit3->setSlug("xx99-mark-one-headphones");
        $produit3->setDescription("As the gold standard for headphones, the classic XX99 Mark I offers detailed and accurate audio reproduction for audiophiles, mixing engineers, and music aficionados alike in studios and on the go.");
        $produit3->setAvailable(true);
        $produit3->setPrice(1750);
        $produit3->setFeature1('As the headphones all others are measured against, the XX99 Mark I demonstrates over five decades of audio expertise, redefining the critical listening experience. This pair of closed-back headphones are made of industrial, aerospace-grade materials.');
        $produit3->setFeature2('From the handcrafted microfiber ear cushions to the robust metal headband with inner damping element, the components work together to deliver comfort and uncompromising sound. Its closed-back design delivers up to 27 dB of passive noise cancellation.');

        $manager->persist($produit3);

        $produit4 = new Product();
        $produit4->setName("XX99 Mark II Headphones");
        $produit4->setSlug("xx99-mark-two-headphones");
        $produit4->setDescription('The new XX99 Mark II headphones is the pinnacle of pristine audio. It redefines your premium headphone experience by reproducing the balanced depth and precision of studio-quality sound.');
        $produit4->setAvailable(true);
        $produit4->setPrice(2999);
        $produit4->setFeature1('Featuring a genuine leather head strap and premium earcups, these headphones deliver superior comfort for those who like to enjoy endless listening. It includes intuitive controls designed for any situation.');
        $produit4->setFeature2('The advanced Active Noise Cancellation with built-in equalizer allow you to experience your audio world on your terms. It lets you enjoy your audio in peace, but quickly interact with your surroundings when you need to. Combined with Bluetooth 5.0.');

        $manager->persist($produit4);

        $produit5 = new Product();
        $produit5->setName("ZX7 Speaker");
        $produit5->setSlug("zx7-speaker");
        $produit5->setDescription("Stream high quality sound wirelessly with minimal to no loss. The ZX7 speaker uses high-end audiophile components that represents the top of the line powered speakers for home or studio use.");
        $produit5->setAvailable(true);
        $produit5->setPrice(3500);
        $produit5->setFeature1('Reap the advantages of a flat diaphragm tweeter cone. This provides a fast response rate and excellent high frequencies that lower tiered bookshelf speakers cannot provide. The woofers are made from aluminum that produces a unique and clear sound.');
        $produit5->setFeature2('The ZX7 speaker is the perfect blend of stylish design and high performance. It houses an encased MDF wooden enclosure which minimises acoustic resonance. Dual connectivity allows pairing through bluetooth or traditional optical and RCA input.');

        $manager->persist($produit5);

        $produit6 = new Product();
        $produit6->setName("ZX9 Speaker");
        $produit6->setSlug("zx9-speaker");
        $produit6->setDescription("Upgrade your sound system with the all new ZX9 active speaker. It’s a bookshelf speaker system that offers truly wireless connectivity -- creating new possibilities for more pleasing and practical audio setups.");
        $produit6->setAvailable(true);
        $produit6->setPrice(4500);
        $produit6->setFeature1('Connect via Bluetooth or nearly any wired source. This speaker features optical, digital coaxial, USB Type-B, stereo RCA, and stereo XLR inputs, allowing you to have up to five wired source devices connected for easy switching.');
        $produit6->setFeature2('Discover clear, more natural sounding highs than the competition with ZX9’s signature planar diaphragm tweeter. Equally important is its powerful room-shaking bass courtesy of a 6.5” aluminum alloy bass unit. You’ll be able to enjoy equal sound quality.');

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

                $accessory = new ProductDescription();
                $accessory->setName('test');
                $accessory->setQuantity(1);
                $accessory->addProduct($product);

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
