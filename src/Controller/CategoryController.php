<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/category', name: 'app_category')]
class CategoryController extends AbstractController
{
    #[Route('/{category}', name: 'app_category_category')]
    public function getProductsFromCategory(string $category, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy(['name' => $category]);
        $products = $category->getProducts();

        return $this->render('category/index.html.twig', [
            'category' => $category,
            'products' => $products,
        ]);
    }
}
