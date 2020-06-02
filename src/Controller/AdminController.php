<?php

namespace App\Controller;

use App\Repository\PizzaRepository;
use App\Repository\PizzeriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(PizzeriaRepository $pizzeriaRepo, PizzaRepository $pizzaRepo)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $pizzerias = $pizzeriaRepo->findAll();

        $pizzas = $pizzaRepo->findAll();

        return $this->render('admin/index.html.twig', [
            "pizzerias" => $pizzerias,
            "pizzas" => $pizzas,
        ]);
    }
}
