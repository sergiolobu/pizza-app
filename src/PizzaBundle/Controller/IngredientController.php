<?php

namespace PizzaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use PizzaBundle\Entity\Ingredient;
use PizzaBundle\Form\IngredientType;

class IngredientController extends Controller
{
    public function ingredientListAction(Request $request)
    {
        return $this->renderIngredientList();
    }

    public function createIngredientAction(Request $request)
    {
        $ingredient = new Ingredient();

        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            $this->saveIngredient($ingredient);

            return $this->renderIngredientList();
        }

        return $this->render(
            'ingredient/ingredient_form.html.twig',
            ['form' => $form->createView()]
        );
    }

    public function editIngredientAction(Request $request, $id)
    {
        $ingredient = $this->getIngredientRepository()->findOneBy(['id' => $id]);

        $form = $this->createForm(IngredientType::class, $ingredient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->saveIngredient($ingredient);

            return $this->renderIngredientList();
        }

        return $this->render(
            'ingredient/ingredient_form.html.twig',
            ['form' => $form->createView()]
        );
    }

    protected function saveIngredient($ingredient)
    {
        $this->getDoctrineManager()->persist($ingredient);
        $this->getDoctrineManager()->flush();
    }

    protected function renderIngredientList()
    {
        $ingredients = $this->getIngredientRepository()->findAll();

        return $this->render('ingredient/ingredient_list.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }

    protected function getIngredientRepository()
    {
        return $this->get('app.ingredient.repository');
    }

    protected function getDoctrineManager()
    {
        return $this->getDoctrine()->getManager();
    }
}
