<?php
namespace Test;

use PHPUnit\Framework\TestCase;
use Tennis\TennisPlayer;
use Tennis\TennisTournament;

class TennisTournamentTest extends TestCase {

    public function test_tournament_instantiation() {
        $players = array();
        $players[] = new TennisPlayer("David", 75);
        $players[] = new TennisPlayer("Simón", 80);
        $players[] = new TennisPlayer("Brenda", 58);
        $players[] = new TennisPlayer("Lara", 88);
        $players[] = new TennisPlayer("Zamantha", 45);

        $players_with_intruder = array_merge($players, ["not TennisPlayer"]);

        $tournament = new TennisTournament($players_with_intruder);

        $this->assertEquals($players, $tournament->get_players(), "Should be TennisPlayer validation failed");

        $amount = count($tournament->get_players());
        $is_power_of_2 = ( $amount > 0 ) && ( ( $amount & ( $amount - 1 ) ) == 0 );

        $this->assertTrue($is_power_of_2, "Amount of Players is not a power of 2");
    }

    public function test_tournament_dispute() {
        $players = array();
        $players[] = new TennisPlayer("David", 75);
        $players[] = new TennisPlayer("Simón", 80);
        $players[] = new TennisPlayer("Brenda", 58);

        $lara = new TennisPlayer("Lara", 88);
        $players[] = $lara;

        $tournament = new TennisTournament($players);

        $this->assertEquals($lara, $tournament->dispute(), "Amount of Players is not a power of 2");
    }
}