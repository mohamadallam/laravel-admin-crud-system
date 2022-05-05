<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ExportOrder implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::select(["id", "customer_id", "description", "total_price"])->get();
    }
    public function headings(): array
    {
        return [
            'id',
            'customer id',
            'description',
            'total_price',
        ];
    }
}
