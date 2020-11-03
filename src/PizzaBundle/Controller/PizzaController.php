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
        return $this->renderPizzaList();
    }

    public function createPizzaAction(Request $request)
    {
        $pizza = new Pizza();
        
        $form = $this->createForm(PizzaType::class, $pizza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->savePizza($pizza);

            return $this->renderPizzaList();
        }

        return $this->render(
            'pizza/pizza_form.html.twig',[
                'form' => $form->createView(),
                'pizza' => $pizza
            ]
        );
    }

    public function editPizzaAction(Request $request, $id)
    {
        $pizza = $this->getPizzaRepository()->findOneBy(['id' => $id]);

        $form = $this->createForm(PizzaType::class, $pizza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->savePizza($pizza);

            return $this->renderPizzaList();
        }

        return $this->render(
            'pizza/pizza_form.html.twig',[
                'form' => $form->createView(),
                'pizza' => $pizza
            ]
        );
    }

    protected function savePizza($pizza)
    {
        $this->getDoctrineManager()->persist($pizza);
        $this->getDoctrineManager()->flush();
    }

    protected function renderPizzaList()
    {
        $pizzas = $this->getPizzaRepository()->findAll();

        return $this->render('pizza/pizza_list.html.twig', [
            'pizzas' => $pizzas,
        ]);
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
