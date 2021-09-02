<?php
include 'Players.php';

$spades = '&spades;';
$clubs = '&clubs;';
$hearts = '&hearts;';
$diams = '&diams;';
$cardsDeck = [];
$players = [];
$suits = [$spades, $clubs, $hearts, $diams];
$values = [2, 3, 4, 5, 6, 7, 8, 9, 10, 'J', 'Q', 'K', 'A'];

if (empty($cardsDeck)) {
    foreach ($suits as $suit) {
        foreach ($values as $value) {
            $card = new Card($suit, $value);
            array_push($cardsDeck, $card);
        }
    }
}

function playersCreating(array $players = [])
{
    $number = readline("How many people will play? (Not more then 7): ");
    while ($number>7){
        print_r("Too many players. Try again!" . PHP_EOL);
        $number = readline("How many people will play? (Not more then 7): ");
    }
    if ($number <= 7) {
        for ($i = 1; $i <= $number; $i++) {
            $name = readline("Input name of the $i player: ");
            $player = new Players($name);
            array_push($players, $player);
        }
    }
    return $players;
}

$deckObj = new CardDeck($cardsDeck);
$cardsDeck = $deckObj->shuffleDeck();

$players = playersCreating();
echo 'Starting game with ';
$playersNumber = count($players);
$i = 1;
foreach ($players as $player) {
    echo $player->getName();
    if ($i !== $playersNumber) echo ', ';
    $i++;
}
print_r(PHP_EOL);
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

$playCard = $newDeck->giveCard();
if (!empty($newDeck)) $newDeck = $newDeck->delCard($card);
print_r("Top card is: ");
echo $playCard->printCard();
print_r(PHP_EOL);

function playerTurn(Players $player, Card $playCard)
{
    $result = [
        'player' => $player,
        'playCard' => $playCard
    ];
    $newPlayCard = $result['playCard'];
    $suit = $playCard->getSuit();
    $value = $playCard->getValue();
    $playerDeck = $player->getCardSet();
    if (!empty($playerDeck)) {
        foreach ($playerDeck as $card) {
            $userCardSuit = $card->getSuit();
            $userCardValue = $card->getValue();
            if (($userCardSuit === $suit) or ($userCardValue === $value)) {
                $newPlayCard = $card;
                break;
            }
        }
    }
    $result = [
        'player' => $player,
        'playCard' => $newPlayCard
    ];
    return $result;
}

function changePlayCard(Card $playCard, Players $player, CardDeck|null $deck)
{
    $curData = playerTurn($player, $playCard);
    $res = '';
    if (!empty($curData['player']->getCardSet())) {

        $curData['player']->delCard($curData['playCard']);
        if ($curData['playCard'] == $playCard) {
            if (!empty($deck->getDeckArray())) {
                $card = $deck->giveCard();
                if (!empty($card)) {
                    $deck = $deck->delCard($card);;
                    $curData['player']->addCard($card);
                    $res = $playCard;
                    echo $curData['player']->getName() . " doesn't have a suitable card, taking from deck " . $card->printCard() . ";";
                    print_r(PHP_EOL);
                }
            } else {
                $res = $playCard;
                echo $curData['player']->getName() . " does not!";
                print_r(PHP_EOL);
            }
        } else {
            $res = $curData['playCard'];
            echo $curData['player']->getName() . " plays " . $curData['playCard']->printCard();
            print_r(PHP_EOL);
        }
    }
    if (empty($curData['player']->getCardSet())) {
        echo $player->getName() . " has won!";
        die();
    }
    return $res;
}

while ($playCard !== '') {
    foreach ($players as $player) {
        $playCard = changePlayCard($playCard, $player, $newDeck);
    }
}