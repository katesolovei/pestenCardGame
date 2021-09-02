<?php
include 'Card.php';

class CardDeck extends Card implements DealWithCards
{
    /*** @var Card[]|null */
    private $deck = [];

    public function __construct(array $deck){
        $this->deck = $deck;
    }

    /***
     * Shuffle Card Deck
     *
     * @return Card[]|null
     */
    public function shuffleDeck(){
        shuffle($this->deck);
        return $this->deck;
    }

    /***
     * Return the fist card from Deck
     *
     * @return Card|mixed
     */
    public function giveCard(){
        return $this->deck[0];
    }

    /***
     * Return the Deck's object
     *
     * @return $this
     */
    public function getDeck(){
        return $this;
    }

    /***
     * Return array of cards in the deck
     *
     * @return array|Card[]|null
     */
    public function getDeckArray(){
        return $this->deck;
    }

    /***
     * Remove given card from current deck
     *
     * @param Card $card
     * @return $this
     */
    public function delCard($card){
        array_splice($this->deck, 0,1);
        return $this->getDeck();
    }

    /***
     * Print list of cards in Deck
     *
     * @param $deck
     */
    public function printDeck($deck){
        foreach ($this->deck as $cardInDeck){
            $card = new Card($cardInDeck->suit, $cardInDeck->value);
            echo $card->printCard($cardInDeck);
        }
    }
}