<?php

namespace Tests;

use App\Cart;
use App\Element;
use App\Item;
use App\Product;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function view()
    {
        $cart = new Cart();
        $item = new Item();

        $expected = 'お客様のショッピングカートに商品はありません。';
        $this->assertEquals($expected, $cart->show());

        foreach($item->list as $key => $val)
        {
            $conditions = $item->conditions($val['title'], $val['price'], $val['quantity']);
            if($conditions) {
                $product = new Product($val['title'], $val['price']);
                $element = new Element($product, $val['quantity']);
                $cart->add($element);
            }
        }

        $expected = "Amazon Web Services 業務システム設計・移行ガイド\t3456\t1".PHP_EOL
            ."プログラマの数学第2版\t2376\t2".PHP_EOL
            ."小計 (3 点): \\8208";
        $this->assertEquals($expected, $cart->show());
    }
}
