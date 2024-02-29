<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class BowlingFinalFrame extends BowlingFrame
{
    private int $roll3 = 0;

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, mixed $payload): void
    {
        if (0 === $this->sum() && $this->roll3 > 0) {
            $context
                ->buildViolation('A third roll is not allowed for the 10th frame in this round')
                ->atPath('roll3')
                ->addViolation();
        }
    }

    public function getRoll3(): int
    {
        return $this->roll3;
    }

    public function setRoll3(int $roll3): void
    {
        $this->roll3 = $roll3;
    }
}
