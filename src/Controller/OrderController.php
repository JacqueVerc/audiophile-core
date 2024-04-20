<?php

namespace App\Controller;

use App\Entity\CustomerAdress;
use App\Form\CustomerAddressFormType;
use App\Form\RegistrationFormType;
use App\Repository\CustomerAdressRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/order', name: 'app_order')]
class OrderController extends AbstractController
{
    #[Route('/validate', name: 'app_order_validate')]
    public function getUserAdress(CustomerAdressRepository $customerAdressRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $customer = $customerAdressRepository->findOneBy(['user' => $this->getUser()]);

        $customerForm = new CustomerAdress();
        $form = $this->createForm(CustomerAddressFormType::class, $customerForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $customerForm->setUser($this->getUser());

            $entityManager->persist($customerForm);

            $entityManager->flush();
        }

        return $this->render('order/index.html.twig', [
            'customerAddressForm' => $form,
            'customer' => $customer,
        ]);
    }
}
