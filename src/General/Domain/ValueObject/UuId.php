<?php

declare(strict_types=1);

namespace Codete\Assessment\General\Domain\ValueObject;

use Codete\Assessment\General\Domain\Exception\InvalidValueObjectException;
use Ramsey\Uuid\Uuid as RamseyUuId;
use Stringable;

class UuId implements Stringable
{
    public function __construct(private readonly string $value)
    {
        $this->validate();
    }

    public static function getRandom(): self
    {
        return new self(RamseyUuId::uuid4()->toString());
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    private function validate(): void
    {
        if (!RamseyUuId::isValid($this->getValue())) {
            throw InvalidValueObjectException::fromValueObjectInfo($this->getValue(), self::class);
        }
    }
}
