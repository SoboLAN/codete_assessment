<?php

declare(strict_types=1);

namespace Codete\Assessment\General\Domain\ValueObject;

abstract class StringValueObject
{
    public function __construct(protected readonly string $value) {}

    public function getValue(): string
    {
        return $this->value;
    }
}
