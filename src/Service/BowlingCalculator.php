<?php

namespace App\Service;

use App\Model\BowlingFinalFrame;
use App\Model\BowlingGame;

class BowlingCalculator
{
    public function __construct()
    {
    }

    public function calculate(BowlingGame $data)
    {
        $totalFrames = array_merge($data->getFrames(), [$data->getFinalFrame()]);
        $lastIndex = array_key_last($totalFrames);
        $score = 0;

        foreach ($totalFrames as $ix => $frame) {
            $score += $frame->sum();
            if (!$frame instanceof BowlingFinalFrame) {
                if ($frame->isStrike()) {
                    $nextFrame = $totalFrames[$ix + 1];
                    if ($nextFrame->isStrike()) {
                        if ($nextFrame instanceof BowlingFinalFrame) {
                            $score += $nextNextFrame->sum();
                        } else {
                            $nextNextFrame = $totalFrames[$ix + 2];
                            $score += $nextFrame->sum() + $nextNextFrame->getRoll1();
                        }
                    } else {
                        $score += $nextFrame->sum();
                    }
                } elseif ($frame->isSpare()) {
                    $nextFrame = $totalFrames[$ix + 1];
                    $score += $nextFrame->getRoll1();
                }
            } else {
                if ($frame->isSpare() || $frame->isStrike()) {
                    $score += $frame->getRoll3();
                }
            }
            dump(sprintf('Frame %d = %d', $ix + 1, $score));
        }

        return $score;
    }
}
