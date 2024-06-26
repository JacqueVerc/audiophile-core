<?php

namespace App\Controller;

use App\Entity\CartLine;
use App\Entity\ProductDescription;
use App\Repository\CartRepository;
use App\Repository\CategoryRepository;
use App\Repository\ProductDescriptionRepository;
use App\Repository\ProductRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/category', name: 'app_category')]
class CategoryController extends AbstractController
{
    #[Route('/{category}', name: 'app_category_category')]
    public function getProductsFromCategory(string $category, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $category]); // dump and die (dd) the products of the category
        $products = $category->getProducts();

        return $this->render('category/index.html.twig', [
            'category' => $category,
            'products' => $products,
        ]);
    }

    #[Route('/{category}/{products}', name: 'app_category_category_produit')]
    public function getProducts(string $products, ProductRepository $productRepository): Response
    {
        $product = $productRepository->findOneBy(['slug' => $products]);
        $productDescriptions = $product->getProductDescriptions()->getValues();

        // dd($productDescriptions);
        return $this->render('product/index.html.twig', [
            'product' => $product,
            'productDescriptions' => $productDescriptions,
        ]);
    }
}
