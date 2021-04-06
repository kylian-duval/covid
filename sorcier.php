<?php 

class sorcier extends personnage{

    //private:


    //public:
    function __construct($PDO)
    {
         Parent::__construct($PDO);
    }

    function soin($soin){
        $this->_Vie + $soin;
    }
   

}