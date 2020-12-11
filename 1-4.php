<?php

class Product {
    private $id;
    private $brand;
    private $title;
    private $price;
    private $description;

    function __construct($id, $brand, $title, $price, $description) {
        $this->id = $id;
        $this->brand = $brand;
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
    }

    public function getId() {
        return $this->id;
    }
    public function petBrand() {
        return $this->brand;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getDescription() {
        return $this->description;
    }

    function showProducts() {
        echo "Артикул: {$this->id}<br> 
            Модель: {$this->brand} {$this->title}<br> 
            Стоимость: {$this->price} р.<br>
            Описание: {$this->description}<br> ";
    }
    
}

class Phone extends Product {
    private $camera;
    private $simCount;
    private $screenDg;
    private $os;
    private $memory;

    function __construct($id, $brand, $title, $price, $description, $camera, $simCount, $screenDg, $os, $memory) {
        $this->camera = $camera;
        $this->simCount = $simCount;
        $this->screenDg = $screenDg;
        $this->os = $os;
        $this->memory = $memory;
        parent::__construct($id, $brand, $title, $price, $description);
    }

    public function getCamera() {
        return $this->camera;
    }
    public function getSimCount() {
        return $this->simCount;
    }
    public function getScreenDg() {
        return $this->screenDg;
    }
    public function getOs() {
        return $this->os;
    }
    public function getMemory() {
        return $this->memory;
    }

    function showProducts() {
        parent::showProducts();
        echo "Камера: {$this->camera} Мп<br> 
            Количество sim-карт: {$this->simCount}<br> 
            Диагональ экрана: {$this->screenDg}<br>
            OS: {$this->os}<br>
            Память: {$this->memory} Гб<hr> ";
    }
}

class Charger extends Product {
    private $power;

    function __construct($id, $brand, $title, $price, $description, $power) {
        $this->power = $power;
        parent::__construct($id, $brand, $title, $price, $description);
    }

    public function getPower() {
        return $this->power;
    }

    function showProducts() {
        parent::showProducts();
        echo "Мощность: {$this->power} Вт<hr> ";
    }
}

$p1 = new Phone(rand(1000,9999), 'Apple', 'iPhone 11', 55199, 
    'Смартфон Apple iPhone 11 128 ГБ в металлическом корпусе черного цвета имеет 
    не только совершенный дизайн, но и совершенное техническое исполнение. Благодаря 
    этому смартфон является очень производительным устройством. Четкую и слаженную 
    работу всех составляющих смартфона поддерживает быстродействующий процессор Apple 
    A13 Bionic, состоящий из шести ядер. А дополняет его оперативная память на 4 Гб. 
    В собственной памяти смартфона можно хранить до 128 ГБ информации.
    Смартфон Apple iPhone 11 128 ГБ оснащен тыловой камерой (сдвоенной) с шестилинзовым 
    объективом и множеством настроек, что дает возможность фотографировать при любом 
    освещении и получать при этом четкие снимки. Несъемный аккумулятор смартфона обладает 
    хорошей емкостью 3110 мА•ч и может заряжаться беспроводным способом. Для защиты данных 
    в смартфоне имеется сканер лица. А чтобы легко и быстро рассчитываться в магазинах 
    за покупки, смартфон поддерживает технологию Apple Pay.',
    12, 1, '6.1"', 'iOS 13', 128);
$p2 = new Charger(rand(1000,9999), 'Apple', 'MD836ZM/A', 1699,
    'Сетевое зарядное устройство Apple MD836ZM/A отличается компактностью и эффективностью. 
    Модель гарантирует быструю зарядку устройств Apple при включении в сеть 100-240 В. 
    Показатель выходного тока аксессуара равен 2400 мА, а напряжения – 5.2 В.
    Apple MD836ZM/A использует USB для подключения устройств. Аксессуар поддерживает 
    совместимость с любыми моделями Apple iPad, iPhone и iPod, поэтому считается универсальным. 
    USB-адаптер поставляется без кабеля, поэтому пользователям понадобится приобретать его отдельно.',
    12);

$products = [$p1, $p2];
foreach ($products as $product){
    $product->showProducts();
}