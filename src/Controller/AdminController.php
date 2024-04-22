<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\CategoryFormType;
use App\Form\ProductFormType;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'app_admin_')]
class AdminController extends AbstractController
{
    #[Route('/add/product', name: 'add_product')]
    public function addProduct(Request $request, EntityManagerInterface $entityManager, ProductRepository $productRepository): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductFormType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (!$form->get('feature1')->getData()){
                $product->setFeature1("");
            }
            if (!$form->get('feature2')->getData()){
                $product->setFeature2("");
            }
            $entityManager->persist($product);

            $entityManager->flush();

            $product = new Product();
            $form = $this->createForm(ProductFormType::class, $product);
        }

        return $this->render('admin/product/index.html.twig', [
            'productForm' => $form,
            'products' => $productRepository->findAll(),
        ]);
    }

    #[Route('/add/category', name: 'add_category')]
    public function addCategory(Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);

            $entityManager->flush();

            $category = new Category();
            $form = $this->createForm(CategoryFormType::class, $category);
        }

        return $this->render('admin/category/index.html.twig', [
            'categoryForm' => $form,
            'categories' => $categoryRepository->findAll()
        ]);
    }

    #[Route('/delete/category/{id}', name: 'delete_category')]
    public function deleteCategory(Request $request, EntityManagerInterface $entityManager, Category $category): Response
    {
        $entityManager->remove($category);

        $entityManager->flush();

        return $this->redirectToRoute('app_admin_add_category');
    }

    #[Route('/delete/product/{id}', name: 'delete_product')]
    public function deleteProduct(Request $request, EntityManagerInterface $entityManager, Product $product): Response
    {
        $entityManager->remove($product);

        $entityManager->flush();

        return $this->redirectToRoute('app_admin_add_product');
    }
}
