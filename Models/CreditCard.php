<?php 
namespace Models;

class CreditCard {

    private $cardNumber;
    private $cardCompany;


    function __construct($cardNumber,$cardCompany){
        $this->cardNumber= $cardNumber;
        $this->cardCompany = $cardCompany;
    }

    function getCardNumber(){
        return $this->cardNumber;
    }

    function getCardCompany(){
        return $this->cardCompany;
    }

    function setCardNumber($num){
        $this->cardNumber = $num;
    }

    function setCardCompany($company){
        $this->cardCompany = $company;
    }

}
?>