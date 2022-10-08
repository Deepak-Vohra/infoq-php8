<?php
interface Sort 
{   
    public function sortArray();
}

#[Attribute]
class Validate {}

#[Attribute(Attribute::TARGET_CLASS|Attribute::IS_REPEATABLE)]
class SortType {

function __construct($sortType){
        $this->sortType = $sortType;
    }
}

class SortImpl implements Sort
{
     
    public string $sortType="";
    public $arrayToSort=array("B", "A", "f", "C");


    #[Validate]
    public function arrayEmpty()
    {
        if (count($this->arrayToSort) === 0) {
            throw new RuntimeException("Array is empty; please provide a non-empty array");
        }
    }

    #[Validate]
    public function arraySize()
    {
        if (sizeof($this->arrayToSort) < 2) {
            throw new RuntimeException("Please provide an array of size 2 or more");
        }
    }


    public function sortArray()
    { 
        
         if ($this->sortType == "asc") {
             sort($this->arrayToSort);
             foreach ($this->arrayToSort as $key => $val) {
                echo "$key = $val ";
             }  
        } elseif ($this->sortType == "desc") {
             rsort($this->arrayToSort);
             foreach ($this->arrayToSort as $key => $val) {
                echo "$key = $val ";
             }  
        } else {
              
             shuffle($this->arrayToSort);
             foreach ($this->arrayToSort as $key => $val) {
                echo "$key = $val ";
             }  
        }
    }
}

function performSort(Sort $sort)
{
    $reflection = new ReflectionObject($sort);

    foreach ($reflection->getMethods() as $method) {
        $attributes = $method->getAttributes(Validate::class);

        if (count($attributes) > 0) {
            $methodName = $method->getName();

            $sort->$methodName();
        }
    }

    $sort->sortArray();
}

#[SortType(sortType: "desc")] 
#[SortType(sortType: "shuffle")]  
#[SortType(sortType: "asc")]              
class QSort
{
}

$sort = new SortImpl();
// Getting class attribute with ReflectionClass
$ref    =   new ReflectionClass(QSort::class);
$attrs  =   $ref->getAttributes();  

foreach ($attrs as $attr) {
   $attrArray = $attr->getArguments();
   $sortType = $attrArray["sortType"];
    $sort->sortType=$sortType; 
    performSort($sort);
    echo "<br/>";
} 
