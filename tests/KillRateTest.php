<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\Constraint\IsIdentical;
use PHPUnit\Framework\TestCase;
use src\KillRate;

class KillRateTest extends TestCase {
    public function testAverageKillRateWithTwoPeople()
    {
        $peoples = [
            'A' => [
                'ageOfDeath' => 10,
                'yearOfDeath' => 12
            ],
            'B' => [
                'ageOfDeath' => 13,
                'yearOfDeath' => 17
            ],
        ];
        
        $killRate = new KillRate($peoples);
        $average = $killRate->getAverage();
        
        $expectedAverage = 4.5;

        $this->assertEquals($expectedAverage, $average);
    }

    public function testAverageKillRateWithThreePeople()
    {
        $peoples = [
            'A' => [
                'ageOfDeath' => 10,
                'yearOfDeath' => 12
            ],
            'B' => [
                'ageOfDeath' => 13,
                'yearOfDeath' => 17
            ],
            'C' => [
                'ageOfDeath' => 10,
                'yearOfDeath' => 15
            ],
        ];

        $killRate = new KillRate($peoples);
        $average = $killRate->getAverage();

        $expectedAverage = 7;
        $this->assertEquals($expectedAverage, $average);
    }
   
    public function testNegativeAge(){
        $peoples  = [
            'A' => [
                'ageOfDeath' => 0,
                'yearOfDeath' => 12
            ],
            'B' => [
                'ageOfDeath' => 13,
                'yearOfDeath' => 17
            ],
        ];
        $killRate = new KillRate($peoples);
        $average = $killRate->getAverage();
        $this->assertEquals(-1, $average);
    }

    public function testBornBeforeWitchTookControll(){
         $peoples  = [
            'A' => [
                'ageOfDeath' => 12,
                'yearOfDeath' => 12
            ],
            'B' => [
                'ageOfDeath' => 13,
                'yearOfDeath' => 17
            ],
        ];
        $killRate = new KillRate($peoples);
        $average = $killRate->getAverage();
        var_dump($average);
        $this->assertEquals(-1, $average);
    }
}