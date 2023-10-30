<?php

declare(strict_types=1);

namespace Codete\Assessment\General\Domain\Exception;

class InvalidValueObjectException extends \RuntimeException
{
    /**
     * @param mixed $value
     */
    public static function fromValueObjectInfo($value, string $className): self
    {
        $message = sprintf('The value %s for value-object %s is invalid', $value, $className);

        return new self($message);
    }
}
