<?php

abstract class Good {
    private $id;
    private $title;
    private $quantity;
    private $unit;
    private $costPrice;
    private $salePrice;

    function __construct($id, $title, $quantity, $unit, $costPrice, $salePrice) {
        $this->id = $id;
        $this->title = $title;
        $this->quantity = $quantity;
        $this->unit = $unit;
        $this->costPrice = $costPrice;
        $this->salePrice = $salePrice;
    }

    public function getId() {
        return $this->id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getQuantity() {
        return $this->quantity;
    }
    public function getUnit() {
        return $this->unit;
    }
    public function getCostPrice() {
        return $this->costPrice;
    }
    public function getSalePrice() {
        return $this->salePrice;
    }

    abstract public function totalPrice();
    abstract public function profit();

    function showGoods() {
        echo "Артикул: {$this->id}<br> 
            Наименование: {$this->title}<br> 
            Количество: {$this->quantity} {$this->unit}<br>
            Себестоимость: {$this->costPrice} р/{$this->unit}<br>
            Цена за единицу товара: {$this->salePrice} р/{$this->unit}<br>
            Общая стоимость: {$this->totalPrice()} р.<br>
            Доход с продаж: {$this->profit()} р.<hr>";
    }
}

class PieceGood extends Good {
    public function totalPrice() {
        return $this->getSalePrice() * $this->getQuantity();
    }
    public function profit() {
        return ($this->getSalePrice() - $this->getCostPrice()) * $this->getQuantity();
    }
    public function createDigitalGood($quantity, $costPrice) {
        return new DigitalGood(rand(1000,9999), $this->getTitle(), $quantity, $this->getUnit(), $costPrice, $this->getSalePrice()/2);
    }
}

class DigitalGood extends PieceGood {
    private $type = 'Цифровой товар';

    function showGoods() {
        echo "<p style='color:red'>{$this->type}</p>";
        parent::showGoods();
    }
}

class WeightGood extends Good {
    public function totalPrice() {
        return $this->getSalePrice() * $this->getQuantity();
    }
    public function profit() {
        return ($this->getSalePrice() - $this->getCostPrice()) * $this->getQuantity();
    }
} 

$p1 = new PieceGood (rand(1000,9999), 'Книга', 3, 'шт', 150, 200);
$p2 = $p1->createDigitalGood(10, 50);
$p3 = new WeightGood (rand(1000,9999), 'Сахар', 2.5, 'кг', 40, 80);

$goods = [$p1, $p2, $p3];
foreach ($goods as $good) {
    $good->showGoods();
}

