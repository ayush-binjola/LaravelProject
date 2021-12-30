<?php

namespace App\Exports;

use App\Models\Mall;
use Maatwebsite\Excel\Concerns\FromCollection;

class MallExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Mall::all();
    }
}
