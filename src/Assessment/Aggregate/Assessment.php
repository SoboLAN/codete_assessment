<?php

declare(strict_types=1);

namespace Codete\Assessment\Assessment\Domain\Aggregate;

use Codete\Assessment\Assessment\Domain\Client;
use Codete\Assessment\Assessment\Domain\Contract;
use Codete\Assessment\Assessment\Domain\Standard;
use Codete\Assessment\Assessment\Domain\Supervisor;
use Codete\Assessment\Assessment\Domain\ValueObject\Rating;
use Codete\Assessment\Assessment\Domain\ValueObject\Status;
use Codete\Assessment\Assessment\Domain\ValueObject\StatusReason;
use DateTime;

class Assessment
{
    private Supervisor $supervisor;
    private Status $status;
    private ?StatusReason $statusReason;
    private ?DateTime $assessmentDate;

    public function __construct(
        private Client $client,
        private Standard $standard
    ) {
        $this->status = new Status(Status::SCHEDULED);
    }

    public function getStandard(): Standard
    {
        return $this->standard;
    }

    public function assignTo(Supervisor $supervisor): void
    {
        $this->supervisor = $supervisor;
    }

    public function performAssessment(Rating $rating): void
    {
        $this->assessmentDate = new DateTime('now');
        $this->status = new Status(Status::COMPLETED);
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getSupervisor(): Supervisor
    {
        return $this->supervisor;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getDateOfAssessment(): ?DateTime
    {
        return $this->assessmentDate;
    }

    public function getContract(): Contract
    {
        return $this->contract;
    }
}
