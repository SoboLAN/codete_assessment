<?php

declare(strict_types=1);

namespace Codete\Assessment\General\Domain\ValueObject;

abstract class IntegerValueObject
{
    public function __construct(protected readonly int $value) {}

    public function getValue(): int
    {
        return $this->value;
    }
}
