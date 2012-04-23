<?php
namespace Lyrica\EirinBundle\Utility;

class Elo
{
    /**
     * @var int A beginning persona's default score
     */
    const ROOKIE = 1400;
    
    /**
     * Calculates the new score
     *
     * @param int $elo the persona's elo
     * @param int $opp the opponent's elo
     * @param float $res win = 1, draw = 0.5, loss = 0
     * @param int $mat the number of matches played by the persona
     * @param bool $vet if the persona has achieved 2400 elo
     *
     * @return int the new elo score
     */
    public static function calculate($elo, $opp, $res, $mat, $vet)
    {
        // p(D) : victory probability
        $diff = $opp - $elo; // inverted for calc purposes
        $p = 1 / (1 + pow(10, $diff / 400));
        
        // k : Development coefficient
        $k = ($mat < 30 ? 30 : ($vet ? 15 : 10));
        
        return round($elo + $k * ($res - $p));
    }
}