<?php

declare(strict_types=1);

namespace Codete\Assessment\Assessment\Domain\ValueObject;

use Codete\Assessment\General\Domain\Exception\InvalidValueObjectException;
use Codete\Assessment\General\Domain\ValueObject\IntegerValueObject;

use Stringable;

final class Rating extends IntegerValueObject implements Stringable
{
    public const PASSED = 1;
    public const FAILED = 2;

    //provided as integer in order to store more compactly in the data layer
    public function __construct(protected readonly int $value)
    {
        parent::__construct($value);
        $this->validate();
    }

    public function __toString(): string
    {
        return match($this->getValue()) {
            self::PASSED => 'passed',
            self::FAILED => 'failed',
        };
    }

    private function validate(): void
    {
        if (!in_array($this->getValue(), [self::PASSED, self::FAILED])) {
            throw InvalidValueObjectException::fromValueObjectInfo($this->getValue(), self::class);
        }
    }
}
