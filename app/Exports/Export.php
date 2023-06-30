<?php

namespace App\Exports;

use App\Models\CategoryProducts;
use Maatwebsite\Excel\Concerns\FromCollection;

class Export implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CategoryProducts::all();
    }
}
