<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductsExport implements FromQuery, WithTitle
{
    private $month;
    private $year;

    public function __construct(int $year, int $month)
    {
        $this->month = $month;
        $this->year  = $year;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function query()
    {
        return Product::query()
            ->whereYear('expiration_date', $this->year)
            ->whereMonth('expiration_date', $this->month);
    }

    public function title(): string
    {
        return 'Month ' . $this->month;
    }
}
