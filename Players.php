<?php
include 'DealWithCards.php';
include 'CardDeck.php';

class Players implements DealWithCards
{
    /** @var string */
    private $name;
    /** @var Card[]  */
    private $cardSet = [];

    public function __construct($name){
        $this->name = $name;
    }

    /***
     * Get player's name
     *
     * @return string
     */
    public function getName(){
        return $this->name;
    }

    /***
     * Get player's card set
     *
     * @return Card[]
     */
    public function getCardSet(){
        return $this->cardSet;
    }

    /***
     * @param Card $card
     */
    public function addCard($card){
        array_push($this->cardSet, $card);
    }

    /***
     *  Remove card from player's card set
     *
     * @param Card $card
     * @return Card[]|CardDeck
     */
    public function delCard($card){
        if (($key = array_search($card, $this->cardSet)) !== false) {
            unset($this->cardSet[$key]);
        }
        return $this->cardSet;
    }

    /***
     * @param CardDeck $deck
     * @return string|void
     */
    public function printDeck($deck){
        foreach ($deck as $cardInDeck){
            echo " $cardInDeck ";
        }
    }

}