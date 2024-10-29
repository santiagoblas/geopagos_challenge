<?php

namespace Tennis;

use function PHPUnit\Framework\isInstanceOf;

class TennisTournament {
    private array $players;

    public function __construct(array $players)
    {
        $players = array_filter($players,function($player) {
            if ($player instanceof TennisPlayer) {
                return true;
            }
            return false;
        });

        $this->players = $players;
    }

    public function get_players() : array {
        return $this->players;
    }

    public function dispute($players_to_compete = []) : TennisPlayer {
        if (count($players_to_compete) == 0) {
            $players_to_compete = $this->players;
            shuffle($players_to_compete);
        }

        $next_round_players = [];
            
        for ($i = 0; $i < count($players_to_compete); $i += 2) { 
            $player_a = $players_to_compete[$i];
            $player_b = $players_to_compete[$i + 1];

            $match = new TennisMatch($player_a, $player_b);

            $next_round_players[] = $match->dispute();
        }

        if (count($next_round_players) > 1) {
            $this->dispute($next_round_players);
        }

        return $next_round_players[0];
    }
}