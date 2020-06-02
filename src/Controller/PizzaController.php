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

        $tabInstance[] = $detailPizza->getQuantiteIngredients();

        for ($i=0, $size = count($tabInstance); $i<$size; $i++) {
            $quantite[] = $tabInstance[$i]; // ici pour utiliser getQuantite
            $prix[] = $tabInstance[$i]; // ici pour utiliser getCout

            $qteEnKg[] = IngredientPizza::convertirGrammeEnKilo($quantite[$i]);
            $calcul[] = $qteEnKg[$i] * $prix[$i];
        }

        $total = array_sum($calcul);

        return $this->render("Pizza/detail.html.twig", [
            "detailPizza" => $detailPizza,
//            "test" => $test,
            "total" => $total
        ]);
    }
}
