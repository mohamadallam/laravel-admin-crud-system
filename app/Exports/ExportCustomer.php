<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportCustomer implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::select(["id", "name", "address", "mobile"])->get();
    }
    public function headings(): array
    {
        return [
            'id',
            'name',
            'address',
            'mobile',
        ];
    }
}
