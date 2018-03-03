<?php 





interface Shape {
  public function calcArea();
}

class Circle implements Shape {
  private $radius;
   
  public function __construct($radius)
  {
    $this -> radius = $radius;
  }
  public function calcArea()
  {
    return $this -> radius * $this -> radius * pi();
  }
}

class Rectangle implements Shape {
  private $width;
  private $height;
   
  public function __construct($width, $height)
  {
    $this -> width = $width;
    $this -> height = $height;
  }
      
  public function calcArea()
  {
    return $this -> width * $this -> height;
  }
}

class Triangle implements Shape {
  private $a;
  private $b;
  private $c;
   
  public function __construct($a, $b , $c)
  {
    $this -> a = $a;
    $this -> b = $b;
    $this -> c = $c;
  }
      
  public function calcArea()
  {
    $p = (float) (($this -> a + $this -> b + $this -> c) / 2);
    return  sqrt($p * ($p - $this -> a) * ($p - $this -> b) * ($p - $this -> c));
  }
}

$array_shaps = array();

$json = file_get_contents('./figures.json');

$json_data = json_decode($json,true);

foreach ($json_data as $value1) {
	switch($value1)
  {
    case "circle":
      array_push($array_shaps, new Circle());
    case "rectangle":
      array_push($array_shaps, new Rectangle());
    case "triangle":
      array_push($array_shaps, new Triangle());
  }
}

usort($array_shaps, function($a, $b)
{
    return $a->calcArea() < $b->calcArea();
});

foreach ($array_shaps as $key => $value2)
{
    echo "{$key} => {$value2} ";
    switch($value1)
    {
      case "circle":
        echo "Circle, Radius = {$value2->radius}.\n";
      case "rectangle":
        echo "Rectangle, Height = {$value2->height} , Width = {$value2->width}.\n";
      case "triangle":
        echo "Triangle, A = {$value2->a} , B = {$value2->b} , C = {$value2->c}.\n";
    }
}
?>
