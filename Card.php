<?php


class Card
{
    protected $suit;
    protected $value;

    public function __construct(string $suit, string $value){
        $this->suit = $suit;
        $this->value = $value;
    }

    public function setSuit($suit){
        $this->suit = $suit;
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function getSuit(){
        return $this->suit;
    }

    public function getValue(){
        return $this->value;
    }

    public function printCard(){
        return html_entity_decode($this->suit).$this->value . " ";
    }

//    public abstract function delCard($card);
}