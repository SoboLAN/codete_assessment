<?php

declare(strict_types=1);

namespace Codete\Assessment\Assessment\Domain\ValueObject;

use Codete\Assessment\General\Domain\Exception\InvalidValueObjectException;
use Codete\Assessment\General\Domain\ValueObject\IntegerValueObject;

use Stringable;

final class StatusReason extends IntegerValueObject implements Stringable
{
    public const SUSPENSION = 1;
    public const WITHDRAWAL = 2;
    public const UNLOCKING = 3;
    public const EXPIRATION = 4;

    //provided as integer in order to store more compactly in the data layer
    public function __construct(protected readonly int $value)
    {
        parent::__construct($value);
        $this->validate();
    }

    public function __toString(): string
    {
        return match($this->getValue()) {
            self::SUSPENSION => 'suspension',
            self::WITHDRAWAL => 'withdrawal',
            self::UNLOCKING => 'unlocking',
            self::EXPIRATION => 'expiration'
        };
    }

    private function validate(): void
    {
        if (!in_array($this->getValue(), [self::SUSPENSION, self::WITHDRAWAL, self::UNLOCKING, self::EXPIRATION])) {
            throw InvalidValueObjectException::fromValueObjectInfo($this->getValue(), self::class);
        }
    }
}
