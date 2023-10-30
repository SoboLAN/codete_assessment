<?php

declare(strict_types=1);

namespace Codete\Assessment\Assessment\Domain;

use Codete\Assessment\Assessment\Domain\ValueObject\Name;
use Codete\Assessment\General\Domain\ValueObject\UuId;

class Client
{
    public function __construct(
        private UuId $id,
        private Name $name
    ) {
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function changeName(Name $name): void
    {
        $this->name = $name;
    }

    public function id(): UuId
    {
        return $this->id;
    }
}
