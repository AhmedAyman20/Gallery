<?php


class Car {
    static $Number = 10;
    public $Number_Wheels = 4;
    public $Number_Doors = 4 ;
    private $Car_Numbers = 10;
    protected $Car_Material ="Metal";

    function __construct()
    {
        echo "Welcome User"."<br>";
    }

    function get(){                                                // Here it will return the number of cars
        return $this->Car_Numbers;
    }
    function set($num){                                           // Here it will check then update
        if ($num==5) $this->Car_Numbers=5;
    }
    function greeting(){
        echo self::$Number++;
    }

    function Welcome(){
        echo "Welcome BMW" . "<br>";
    }

    function Car_Details(){
        return "This Car has" . $this->Number_Doors . "wheels". "<br>";
    }

    static function Car_motor(){
        echo self::$Number=20;
    }

}

class Car_Functions extends Car{
    function w(){
        echo  $this->Car_Material;
    }

    static function display(){
        parent::Car_motor();
    }

}



        $BMW = new Car();
        $BMW = new Car();
        $BMW->greeting();
        $Volvo = new Car();
        //$Volvo->greeting();
        // $a = (int)readline('Enter an integer: ');
        // echo "This is what You have entered" . $a ."<br>";
        // $BMW-> greeting();
        // $Volvo-> Welcome();

        // echo car::$Number;

        // echo $BMW->Number_Doors. "<br>";
        // $BMW->Number_Doors=11 ;
        // echo $BMW->Number_Doors  . " The updated Number of doors" . "<br>";
        // echo $BMW->Car_Details()  . "<br>";
        // $BMW->set(5);
        // echo $BMW->get() . "<br>";
        // $BMW->Car_Numbers=100;
        // echo $BMW->Car_Numbers . "<br>";


        // echo $Volvo->Number_Doors ;
        // $Volvo->Number_Doors=5;
        // echo $Volvo->Car_Details() . "<br>" ;

        // $KIA = new Car();
        // echo $KIA->Number_Doors . "     KIA Number_Doors" . "<br>";


        // $lol = new Car_Functions();
        // $lol->w();                            //QQQQQ  Can be accessed here
        // $lol->Car_Material;                    //      But Not there

        // echo Car::$Number  . "<br>";                // this is how to access static property

        // Car_Functions::display();
?>

