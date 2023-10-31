<?php

declare(strict_types=1);

namespace Codete\Assessment\Service;

use Codete\Assessment\Assessment\Domain\Aggregate\Assessment;
use Codete\Assessment\Assessment\Domain\AssessmentRepositoryInterface;
use Codete\Assessment\Assessment\Domain\Contract;
use Codete\Assessment\Assessment\Domain\Standard;
use Codete\Assessment\Assessment\Domain\Supervisor;
use Codete\Assessment\Assessment\Domain\ValueObject\Name;
use Codete\Assessment\Assessment\Domain\ValueObject\Rating;
use Codete\Assessment\General\Domain\ValueObject\UuId;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AssessmentService
{
    public function __construct(
        private readonly AssessmentRepositoryInterface $repository,
        private readonly ValidatorInterface $validator
    ) {
    }

    public function createSupervisor(Name $name, array $standards): Supervisor
    {
        $supervisor = new Supervisor(UuId::getRandom(), $name);

        foreach ($standards as $standard) {
            $standardObj = new Standard($standard);
            $supervisor->addStandard($standardObj);
        }

        $this->repository->store($supervisor);

        return $supervisor;
    }

    public function getSupervisorById(UuId $id): ?Supervisor
    {
        return $this->repository->getSupervisorById($id);
    }

    public function performAssessment(Assessment $assessment, Rating $rating): void
    {
        $supervisor = $assessment->getSupervisor();
        $client = $assessment->getClient();

        /** @var Contract $contract */
        $contract = $this->repository->getContractOfClient($client);

        if ($contract->getSupervisor()->id() !== $supervisor->id()) {
            throw new \Exception('The assessment can not be performed by the specified Supervisor');
        }

        if (!$supervisor->hasAuthorityForStandard($assessment->getStandard())) {
            throw new \Exception('Supervisor can not assess the requested standard');
        }

        
    }
}
