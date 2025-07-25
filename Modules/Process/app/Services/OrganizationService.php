<?php

namespace Modules\Process\Services;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\OrganizationData;
use Modules\Process\Models\Organization;
use Modules\Process\Repositories\OrganizationRepository;
use function PHPUnit\Framework\isEmpty;

class OrganizationService
{
    public function __construct(
        protected OrganizationRepository $organizationRepository
    ){}

    /**
     * @throws \Exception
     */
    public function getOrganizations(): Collection
    {
        $organizations = $this->organizationRepository->all();

        if(!$organizations)
            throw new \Exception('Organizations not found');

        return $organizations;
    }

    /**
     * @throws \Exception
     */
    public function getOrganization($id): Organization
    {
        $organization = $this->organizationRepository->find($id);

        if(!$organization)
            throw new \Exception('Organization not found');

        return $organization;
    }

    public function getFromProcess($ids): Collection
    {
        $organizations = $this->organizationRepository->allFromProcess($ids);

        if(!$organizations)
            throw new \Exception('Organizations not found');

        return $organizations;
    }

    /**
     * @throws \Exception
     */
    public function createOrganization(OrganizationData $organizationData): Organization
    {
        $organization = $this->organizationRepository->create($organizationData);

        if(!$organization)
            throw new \Exception('Organization not created');

        return $organization;
    }

    /**
     * @throws \Exception
     */
    public function updateOrganization(OrganizationData $organizationData, $id): Organization
    {
        $organization = $this->organizationRepository->update($organizationData, $id);

        if(!$organization)
            throw new \Exception('Organization not updated');

        return $organization;
    }

    /**
     * @throws \Exception
     */
    public function deleteOrganization($id): Organization
    {
        $organization = $this->organizationRepository->find($id);

        if(isEmpty($organization))
            throw new \Exception('Organization not found');

        return $this->organizationRepository->delete($id);
    }

}
