<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportProduct implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'product_name' => $row[0],
            'product_image' => $row[1],
            'product_price' => $row[2],
            'product_desc' => $row[3],
            'category_id' => $row[4],
            'product_status' => $row[5],
            'product_quantity' => $row[6],
            'product_sold' => $row[7],
        ]);
    }
}
