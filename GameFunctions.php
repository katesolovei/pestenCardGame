<?php
include 'Players.php';

/***
 * @param array $players Array of Players initialised by empty array
 * @return Players[] $players Array of Players
 */
function playersCreating(array $players = [])
{
    $number = readline("How many people will play? (Not more then 7): ");
    while ($number > 7) {
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

/***
 * Generate Card for next player's turn
 *
 * @param Players $player
 * @param Card $playCard
 * @return array[Player, Card]
 */
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

/***
 * Changing top card
 *
 * @param Card $playCard previous top card
 * @param Players $player player, who has to make next turn
 * @param CardDeck|null $deck playing Deck
 * @return Card|string
 */
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