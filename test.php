<pre>


<?php

// print_r($_SERVER);
// print_r($_GET);
// print_r($_POST);


class mic{
    private $color;
    private $mode;
    private $volume;

    public function __construct($color=null)
    {
        $this->color;
        echo "constructing .........";
    }
    function __destruct()
    {
        return 0;
    }
    public  function on_mode(){
        $this->mode = "on";
    }
    public  function off_mode(){
        $this->mode = "off";
    }
     public  function get_mode(){
        return $this->mode;
    } 

}

$mic1 = new mic();
$mic1->on_mode();

echo $mic1->get_mode();
$mic1->off_mode();

echo $mic1->get_mode();
?>
</pre>