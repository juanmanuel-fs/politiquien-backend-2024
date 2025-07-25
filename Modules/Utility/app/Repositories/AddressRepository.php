<?php

namespace Modules\Utility\Repositories;

use Modules\Utility\Data\AddressData;
use Modules\Utility\Models\Address;

class AddressRepository
{
    public function create(AddressData $addressData): ?Address
    {
        return Address::create();
    }

}
