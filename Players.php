<?php
include 'DealWithCards.php';
include 'CardDeck.php';

class Players implements DealWithCards
{
    private $name;
    private $cardSet = [];

    public function __construct($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function getCardSet(){
        return $this->cardSet;
    }

    public function addCard($card){
        array_push($this->cardSet, $card);
    }

    public function delCard($card){
        if (($key = array_search($card, $this->cardSet)) !== false) {
            unset($this->cardSet[$key]);
        }
    }

    public function printDeck($deck){
        foreach ($deck as $cardInDeck){
            echo " $cardInDeck ";
        }
    }

}