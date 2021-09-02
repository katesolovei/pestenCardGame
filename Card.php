<?php


class Card
{
    /** @var string */
    protected $suit;
    /** @var string */
    protected $value;

    public function __construct(string $suit, string $value){
        $this->suit = $suit;
        $this->value = $value;
    }

    /***
     * @param string $suit
     */
    public function setSuit($suit){
        $this->suit = $suit;
    }

    /***
     * @param string $value
     */
    public function setValue($value){
        $this->value = $value;
    }

    /***
     * @return string suit of generated card
     */
    public function getSuit(){
        return $this->suit;
    }

    /***
     * @return string value of generated card
     */
    public function getValue(){
        return $this->value;
    }

    /***
     * @return string line with decoded html symbol of card suit
     */
    public function printCard(){
        return html_entity_decode($this->suit).$this->value . " ";
    }
}