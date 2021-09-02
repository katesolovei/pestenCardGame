<?php
include 'GameFunctions.php';

$spades = '&spades;';
$clubs = '&clubs;';
$hearts = '&hearts;';
$diams = '&diams;';
$cardsDeck = [];
$players = [];
$suits = [$spades, $clubs, $hearts, $diams];
$values = [2, 3, 4, 5, 6, 7, 8, 9, 10, 'J', 'Q', 'K', 'A'];

// Generate starting card deck
if (empty($cardsDeck)) {
    foreach ($suits as $suit) {
        foreach ($values as $value) {
            $card = new Card($suit, $value);
            array_push($cardsDeck, $card);
        }
    }
}

$deckObj = new CardDeck($cardsDeck);
$cardsDeck = $deckObj->shuffleDeck();

$players = playersCreating();
print_r(PHP_EOL);

echo 'Starting game with ';
$playersNumber = count($players);
$i = 1;
foreach ($players as $player) {
    echo $player->getName();
    if ($i !== $playersNumber) echo ', ';
    $i++;
}
print_r(PHP_EOL);

// Passing first seven cards to each player
foreach ($players as $player) {
    for ($i = 0; $i < 7; $i++) {
        $card = $deckObj->giveCard();
        $player->addCard($card);
        $newDeck = $deckObj->delCard($card);;
    }
    echo $player->getName() . " has been dealt:";
    foreach ($player->getCardSet() as $tmp) {
        echo $tmp->printCard();
    }
    print_r(PHP_EOL);
}

// Generating first card (top card)
$playCard = $newDeck->giveCard();
if (!empty($newDeck)) $newDeck = $newDeck->delCard($card);
print_r("Top card is: ");
echo $playCard->printCard();
print_r(PHP_EOL);

// Process of game
while ($playCard !== '') {
    foreach ($players as $player) {
        $playCard = changePlayCard($playCard, $player, $newDeck);
    }
}