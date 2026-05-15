<?php

namespace App\Repositories;

use App\Models\CarMod;

class CarModRepository
{
    public function getPaginated(int $resultsPerPage = 9)
    {
        return CarMod::paginate($resultsPerPage);
    }
    
}
