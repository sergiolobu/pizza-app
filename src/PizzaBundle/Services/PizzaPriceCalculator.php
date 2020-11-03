<?php
namespace PizzaBundle\Services;


class PizzaPriceCalculator
{
    public function getPrice($ingredients)
    {
        $price = 0;
        $totalPrice = 0;

        foreach ($ingredients as $ingredient) 
        {
            $price = $price + $ingredient->getPrice();    
        }

        $totalPrice = $price + $price / 2;

        return $totalPrice;
    }
}