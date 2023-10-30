<?php

namespace Codete\Assessment\Assessment\Domain;

use Codete\Assessment\General\Domain\ValueObject\UuId;
use DateTime;

class Contract
{
    public function __construct(
        private UuId $id,
        private Supervisor $supervisor,
        private Client $client,
        private DateTime $signDate,
        private ?DateTime $terminationDate = null
    ) {
    }

    public function id(): UuId
    {
        return $this->id;
    }

    public function getSupervisor(): Supervisor
    {
        return $this->supervisor;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function signedDate(): DateTime
    {
        return $this->signDate;
    }

    public function terminate(): void
    {
        $this->terminationDate = new DateTime('now');
    }

    public function getTerminationDate(): ?DateTime
    {
        return $this->terminationDate;
    }
}
