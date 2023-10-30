<?php

declare(strict_types=1);

namespace Codete\Assessment\Assessment\Domain\ValueObject;

use Codete\Assessment\General\Domain\Exception\InvalidValueObjectException;
use Codete\Assessment\General\Domain\ValueObject\IntegerValueObject;

use Stringable;

final class Status extends IntegerValueObject implements Stringable
{
    public const SCHEDULED = 1;
    public const COMPLETED = 2;
    public const LOCKED = 3;
    public const INACTIVE = 4;

    //provided as integer in order to store more compactly in the data layer
    public function __construct(protected readonly int $value)
    {
        parent::__construct($value);
        $this->validate();
    }

    public function __toString(): string
    {
        return match($this->getValue()) {
            self::SCHEDULED => 'scheduled',
            self::COMPLETED => 'completed',
            self::LOCKED => 'locked',
            self::INACTIVE => 'inactive'
        };
    }

    private function validate(): void
    {
        if (!in_array($this->getValue(), [self::SCHEDULED, self::COMPLETED, self::LOCKED, self::INACTIVE])) {
            throw InvalidValueObjectException::fromValueObjectInfo($this->getValue(), self::class);
        }
    }
}
