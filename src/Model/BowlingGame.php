<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class BowlingGame
{
    #[Assert\Valid]
    /** @var BowlingFrame[] */
    private array $frames = [];

    #[Assert\Valid]
    private BowlingFinalFrame $finalFrame;

    public function __construct()
    {
        $this->frames = [
            new BowlingFrame(), // 1
            new BowlingFrame(), // 2
            new BowlingFrame(), // 3
            new BowlingFrame(), // 4
            new BowlingFrame(), // 5
            new BowlingFrame(), // 6
            new BowlingFrame(), // 7
            new BowlingFrame(), // 8
            new BowlingFrame(), // 9
        ];
        $this->finalFrame = new BowlingFinalFrame(); // extraroll
    }

    public function getFrames(): array
    {
        return $this->frames;
    }

    public function setFrames(array $frames): void
    {
        $this->frames = $frames;
    }

    public function getFinalFrame(): BowlingFinalFrame
    {
        return $this->finalFrame;
    }

    public function setFinalFrame(BowlingFinalFrame $finalFrame): void
    {
        $this->finalFrame = $finalFrame;
    }
}
