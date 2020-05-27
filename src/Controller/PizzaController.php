<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Entity\IngredientPizza;
use App\Repository\PizzaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PizzaController
 * @package App\Controller
 */
class PizzaController extends AbstractController
{
    /**
     * @Route("/pizzas")
     *
     * @param PizzaRepository $pizzaRepo
     *
     * @return Response
     */
    public function listeAction(PizzaRepository $pizzaRepo): Response
    {
        // récupération des différentes pizzas
        $pizzas = $pizzaRepo->findAll();

        return $this->render("Pizza/liste.html.twig", [
            "pizzas" => $pizzas,
        ]);
    }

    /**
     * @Route(
     *     "/pizzas/detail-{pizzaId}",
     *     requirements={"pizzaId": "\d+"}
     * )
     *
     * @param int $pizzaId
     *
     * @return Response
     */
    public function detailAction(int $pizzaId, PizzaRepository $pizzaRepo): Response
    {
        $detailPizza = $pizzaRepo->findPizzaAvecDetailComplet($pizzaId);

        foreach ($detailPizza as $item) {
            $item['quantite'];
        }

        $quantite = [80, 105, 45, 60, 30, 48, 105];
        $prix = [3.7, 10.72, 7.9, 6.3, 2.68, 12.38, 12.32];

        for ($i=0, $size = count($quantite); $i<$size; $i++) {
            $qteEnKg[] = $quantite[$i] * 0.001;
            $calcul[] = $qteEnKg[$i] * $prix[$i];
        }

        $total = array_sum($calcul);

        return $this->render("Pizza/detail.html.twig", [
            "detailPizza" => $detailPizza,
            "calcul" => $calcul,
            "total" => $total
        ]);
    }
}
