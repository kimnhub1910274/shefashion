<?php

namespace App\Imports;

use App\Models\CategoryProducts;
use Maatwebsite\Excel\Concerns\ToModel;

class Import implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CategoryProducts([
            'cate_name' => $row[0],
            'meta_keywords' => $row[1],
            'meta_desc' => $row[2],
            'cate_quantity' => $row[3],
            'cate_status' => $row[4],
        ]);
    }
}
