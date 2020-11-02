<?php

namespace PizzaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use PizzaBundle\Entity\Pizza;
use PizzaBundle\Form\PizzaType;

class PizzaController extends Controller
{
    public function pizzaListAction(Request $request)
    {
        $pizzas = $this->getPizzaRepository()->findAll();

        return $this->render('pizza/pizza_list.html.twig', [
            'pizzas' => $pizzas,
        ]);
    }

    public function createPizzaAction(Request $request)
    {
        $pizza = new Pizza();
        $form = $this->createForm(PizzaType::class, $pizza);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrineManager()->persist($pizza);
            $this->getDoctrineManager()->flush();

            $pizzas = $this->getPizzaRepository()->findAll();

            return $this->render('pizza/pizza_list.html.twig', [
                'pizzas' => $pizzas,
            ]);
        }

        return $this->render(
            'pizza/pizza_form.html.twig',
            ['form' => $form->createView()]
        );
    }

    public function editPizzaAction(Request $request, $id)
    {
        $pizza = $this->getPizzaRepository()->findOneBy(['id' => $id]);

        $form = $this->createForm(PizzaType::class, $pizza);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrineManager()->persist($pizza);
            $this->getDoctrineManager()->flush();

            $pizzas = $this->getPizzaRepository()->findAll();

            return $this->render('pizza/pizza_list.html.twig', [
                'pizzas' => $pizzas,
            ]);
        }

        return $this->render(
            'pizza/pizza_form.html.twig',
            ['form' => $form->createView()]
        );
    }

    protected function getPizzaRepository()
    {
        return $this->get('app.pizza.repository');
    }

    protected function getDoctrineManager()
    {
        return $this->getDoctrine()->getManager();
    }
}
