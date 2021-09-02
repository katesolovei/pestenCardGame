<?php
include 'Card.php';

class CardDeck extends Card implements DealWithCards
{
    private $deck = [];

    public function __construct(array $deck){
        $this->deck = $deck;
    }

    public function shuffleDeck(){
        shuffle($this->deck);
        return $this->deck;
    }

    public function giveCard(){
        return $this->deck[0];
    }

    public function getDeck(){
        return $this;
    }
    public function getDeckArray(){
        return $this->deck;
    }

    public function delCard($card){
        array_splice($this->deck, 0,1);
        return $this->getDeck();
    }

    public function printDeck($deck){
        foreach ($this->deck as $cardInDeck){
            $card = new Card($cardInDeck->suit, $cardInDeck->value);
            echo $card->printCard($cardInDeck);
        }
    }
}