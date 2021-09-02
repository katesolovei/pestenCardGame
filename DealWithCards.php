<?php

interface DealWithCards{
    /***
     * @param Card $card
     * @return CardDeck
     */
    public function delCard($card);

    /***
     * @param CardDeck $deck
     * @return string
     */
    public function printDeck($deck);
}