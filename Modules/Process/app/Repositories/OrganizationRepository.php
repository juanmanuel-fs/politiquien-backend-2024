<?php

namespace Modules\Process\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Modules\Process\Data\OrganizationData;
use Modules\Process\Interfaces\OrganizationRepositoryInterface;
use Modules\Process\Models\Organization;

class OrganizationRepository implements OrganizationRepositoryInterface
{

    public function all(): ?Collection
    {
        return Organization::all();
    }

    public function allFromProcess($ids): ?Collection
    {
        return Organization::whereIn('id', $ids)->get();
    }

    public function findByName(string $name): ?Organization
    {
        return Organization::where('name',$name)->first();
    }

    public function findByJneId(int $jneId): ?Organization
    {
        return Organization::where('jne_id',$jneId)->first();
    }

    public function findOrCreate(OrganizationData $organizationData): ?Organization
    {
        $organization = $this->findByJneId($organizationData->jneId);

        if(!$organization)
        {
            $organization = $this->create($organizationData);
        }

        return $organization;
    }

    public function find(string $slug): ?Organization
    {
        return Organization::where('slug', $slug)->first();
    }

    public function existsSlug(string $slug, $id = null): bool
    {
        return Organization::where('slug', $slug)->where('id', '!=', $id)->exists();
    }

    public function create(OrganizationData $organizationData): ?Organization
    {
        $slug = Str::slug($organizationData->name);

        return Organization::create([
            'jne_id'    =>  $organizationData->jneId,
            'name'      =>  $organizationData->name,
            'slug'      =>  $slug,
            'description'   =>  $organizationData->description,
            'image'         =>  $organizationData->image,
            'type'          =>  $organizationData->type ?? '0',
            'registered_at' =>  $organizationData->registeredAt,
            'phone1'        =>  $organizationData->phone1,
            'phone2'        =>  $organizationData->phone2,
            'website'       =>  $organizationData->website,
            'email'         =>  $organizationData->email,
            'holder'        =>  $organizationData->holder,
            'alternate'     =>  $organizationData->alternate,
            'comment'       =>  $organizationData->comment,
            'registered'    =>  $organizationData->registered ?? '0',
            'state'         =>  $organizationData->state ?? '0',
            'status'        =>  $organizationData->status ?? true,
        ]);
    }

    public function update(OrganizationData $organizationData, int $id): ?Organization
    {
        $organization = $this->find($id);

        if($organization)
        {
            $organizationUpdate = $organizationData;
            $organizationUpdate['slug'] = Str::slug($organizationUpdate->name);

            $organization->update([$organizationUpdate]);
            $organization->touch();

            return $organization;
        }

        return null;
    }

    public function delete(int $id): ?Organization
    {
        $organizationDelete = $this->find($id);
        $organization = $organizationDelete;
        $organizationDelete->delete();

        return $organization;
    }

    public function logicalDelete(int $id): ?Organization
    {
        $organization = $this->find($id);
        $organization['status'] = false;
        $organization['deleted_at'] = now();
        $organization->save();
        $organization->touch();

        return $organization;
    }
}
