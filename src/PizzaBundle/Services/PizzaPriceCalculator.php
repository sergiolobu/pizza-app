<?php
namespace PizzaBundle\Services;


class PizzaPriceCalculator
{
    public function calculate($pizza)
    {
        $price = 0;
        $totalPrice = 0;
        
        foreach ($pizza->getIngredients() as $ingredient) 
        {
            $price = $price + $ingredient->getPrice();    
        }

        $totalPrice = $price + $price / 2;

        return $totalPrice;
    }
}