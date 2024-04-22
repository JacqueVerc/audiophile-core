<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\CommandLine;
use App\Entity\CustomerAdress;
use App\Entity\Order;
use App\Form\CustomerAddressFormType;
use App\Form\RegistrationFormType;
use App\Processor\CartProcessor;
use App\Repository\CartLineRepository;
use App\Repository\CartRepository;
use App\Repository\CustomerAdressRepository;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrderController extends AbstractController
{
    #[Route('/order/validate', name: 'app_order_validate')]
    public function userAdressForm(CartProcessor $cartProcessor, CustomerAdressRepository $customerAdressRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $isConfirmed = $request->query->get('isConfirmed');
        $customerForm = new CustomerAdress();
        $form = $this->createForm(CustomerAddressFormType::class, $customerForm);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oldAdress = $customerAdressRepository->findOneBy(['user' => $this->getUser()]);
            if ($oldAdress) {
                $entityManager->remove($oldAdress);
            }
            $customerForm->setUser($this->getUser());

            $entityManager->persist($customerForm);

            $entityManager->flush();

            $customerForm = new CustomerAdress();
            $form = $this->createForm(CustomerAddressFormType::class, $customerForm);
        }
        $customer = $customerAdressRepository->findOneBy(['user' => $this->getUser()]);

        $res = array_merge(
            $cartProcessor->getCart($this->getUser()),
            [
            'customerAddressForm' => $form,
            'customer' => $customer,
            'isConfirmed' => $isConfirmed,
            ]
        );

        return $this->render('order/index.html.twig', $res);
    }

    #[Route('/order/confirm', name: 'app_order_confirm')]
    public function confirmOrder(UserRepository $userRepository, OrderRepository $orderRepository, CartRepository $cartRepository, EntityManagerInterface $manager): Response
    {
        $order = new Order();

        $cart = $cartRepository->findOneBy(['user' => $this->getUser()]);
        foreach ($cart->getCartLines() as $cartLine){
            $commandLine = new CommandLine();
            $commandLine->setQuantity($cartLine->getQuantity());
            $commandLine->setProduct($cartLine->getProduct());
            $commandLine->setOrders($order);

            $manager->remove($cartLine);

            $manager->persist($commandLine);
        }
        $orderNumer = count($orderRepository->findAll()) + 1;

        $order->setUser($this->getUser());
        $order->setDate(new \DateTime());
        $order->setOrderNumber($orderNumer);
        $order->setValid(true);

        $manager->persist($order);

        $manager->flush();
        return $this->redirectToRoute('app_order_validate', ['isConfirmed' => true]);
    }
}
