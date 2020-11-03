<?php

namespace Test\PizzaBundle\Services;

use PizzaBundle\Entity\Pizza;
use PizzaBundle\Entity\Ingredient;
use PizzaBundle\Services\PizzaPriceCalculator;
use PHPUnit\Framework\TestCase;

class PizzaPriceCalculatorTest extends TestCase
{
    public function test_empty()
    {
        $stack = [];
        $this->assertEmpty($stack);

        return $stack;
    }

    public function test_if_ingredients_is_null_return_0()
    {
        $pizza = new Pizza();

        $pizzaPriceCalculator = new PizzaPriceCalculator();

        $this->assertEquals(0, $pizzaPriceCalculator->calculate($pizza));
    }

    public function test_if_ingredients_price_is_50_return_75()
    {
        $pizza = new Pizza();
        $ingredient = new Ingredient();

        $ingredient->setPrice(50);
        $pizza->addIngredient($ingredient);

        $pizzaPriceCalculator = new PizzaPriceCalculator();

        $this->assertEquals(75, $pizzaPriceCalculator->calculate($pizza));
    }
}