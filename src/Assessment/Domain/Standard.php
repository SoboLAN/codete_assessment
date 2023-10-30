<?php

declare(strict_types=1);

namespace Codete\Assessment\Assessment\Domain;

use Codete\Assessment\General\Domain\Exception\InvalidValueObjectException;
use Codete\Assessment\General\Domain\ValueObject\StringValueObject;

final class Standard extends StringValueObject
{
    public const STANDARD_EASY = 'easy';
    public const STANDARD_MEDIUM = 'medium';
    public const STANDARD_HARD = 'hard';

    public function __construct(protected readonly string $value)
    {
        parent::__construct($value);
        $this->validate();
    }

    public function equals(self $s): bool
    {
        return $this->getValue() === $s->getValue();
    }

    private function validate(): void
    {
        if (!in_array($this->getValue(), [self::STANDARD_EASY, self::STANDARD_MEDIUM, self::STANDARD_HARD])) {
            throw InvalidValueObjectException::fromValueObjectInfo($this->getValue(), self::class);
        }
    }
}
