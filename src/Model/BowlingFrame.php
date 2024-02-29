<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class BowlingFrame
{
    private int $roll1 = 0;

    private int $roll2 = 0;

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, mixed $payload): void
    {
        if ($this->sum() > 10 && $this->roll1 < 10) {
            $violation = $context->buildViolation('The sum of both rolls must not exceed 10');
            if ($this->roll1 > $this->roll2) {
                $violation->atPath('roll1')->addViolation();
            } else {
                $violation->atPath('roll2')->addViolation();
            }
        } elseif ($this->sum() > 10 && 10 == $this->roll1) {
            $context->buildViolation('There may only be one strike per frame')->addViolation();
        }
    }

    public function toArray(): array
    {
        return [$this->roll1, $this->roll2];
    }

    public function sum(): int
    {
        return array_sum($this->toArray());
    }

    public function isSpare(): bool
    {
        return $this->roll1 < 10 && 10 === $this->sum();
    }

    public function isStrike(): bool
    {
        return 10 === $this->roll1;
    }

    public function getRoll1(): int
    {
        return $this->roll1;
    }

    public function setRoll1(int $roll1): void
    {
        $this->roll1 = $roll1;
    }

    public function getRoll2(): int
    {
        return $this->roll2;
    }

    public function setRoll2(int $roll2): void
    {
        $this->roll2 = $roll2;
    }
}
