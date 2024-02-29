<?php

namespace App\Tests;

use App\Model\BowlingFinalFrame;
use App\Model\BowlingGame;
use App\Service\BowlingCalculator;
use PHPUnit\Framework\TestCase;

class BowlingCalculatorTest extends TestCase
{
    /**
     * @dataProvider provideGameData
     */
    public function testCalculate(BowlingGame $gameData, int $expectedScore)
    {
        $calculator = new BowlingCalculator();

        $result = $calculator->calculate($gameData);

        $this->assertEquals($expectedScore, $result);
    }
    
    private function arrayToTestData(array $data)
    {
        $fixtureGame = new BowlingGame();
        foreach ($data as $key => $value) {
            $frame = ($key < 9) ? 
                $fixtureGame->getFrames()[$key] : $fixtureGame->getFinalFrame();
            $frame->setRoll1($value[0]);
            $frame->setRoll2($value[1]);

            if ($frame instanceof BowlingFinalFrame) {
                $frame->setRoll3($value[2]);
            }
        }
        return $fixtureGame;
    }

    public function provideGameData(): array
    {
        return [
            [
                $this->arrayToTestData([
                    [5,5],
                    [4,5],
                    [8,2],
                    [10,0],
                    [0,10],
                    [10,0],
                    [6,2],
                    [10,0],
                    [4,6],
                    [10,10,0],
                ]),
                169,
            ],
            [
                $this->arrayToTestData([
                    [5,5],
                    [4,0],
                    [8,1],
                    [10,0],
                    [0,10],
                    [10,0],
                    [10,0],
                    [10,0],
                    [4,6],
                    [10,10,5],
                ]),
                186,
            ],
            [
                $this->arrayToTestData([
                    [10,0],
                    [10,0],
                    [10,0],
                    [10,0],
                    [10,0],
                    [10,0],
                    [10,0],
                    [10,0],
                    [10,0],
                    [10,10,10],
                ]),
                300,
            ],
        ];
    }
}