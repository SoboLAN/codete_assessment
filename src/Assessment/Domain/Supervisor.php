<?php

declare(strict_types=1);

namespace Codete\Assessment\Assessment\Domain;

use Codete\Assessment\Assessment\Domain\ValueObject\Name;
use Codete\Assessment\General\Domain\ValueObject\UuId;

class Supervisor
{
    /** @var Standard[] */
    private array $standards = [];

    public function __construct(
        private UuId $id,
        private Name $name
    ) {
    }

    public function addStandard(Standard $standard): void
    {
        foreach ($this->standards as $existingStandards) {
            if ($standard->equals($existingStandards)) {
                return;
            }
        }

        $this->standards[] = $standard;
    }

    public function removeStandard(Standard $standard): void
    {
        $this->standards = array_filter(
            $this->standards,
            function($existingStandard) use ($standard) {
                return !$standard->equals($existingStandard);
            }
        );
    }

    public function hasAuthorityForStandard(Standard $standard): bool
    {
        foreach ($this->standards as $existingStandard) {
            if ($existingStandard->equals($standard)) {
                return true;
            }
        }

        return false;
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
