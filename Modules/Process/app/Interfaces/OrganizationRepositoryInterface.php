<?php

namespace Modules\Process\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Modules\Process\Data\OrganizationData;
use Modules\Process\Data\ProcessData;
use Modules\Process\Models\Organization;

interface OrganizationRepositoryInterface
{
    public function all(): ?Collection;
    public function findByName(string $name): ?Organization;
    public function find(string $slug): ?Organization;
    public function existsSlug(string $slug, $id = null): bool;
    public function create(OrganizationData $organizationData): ?Organization;
    public function update(OrganizationData $organizationData, int $id): ?Organization;
    public function delete(int $id): ?Organization;
    public function logicalDelete(int $id): ?Organization;
}
