<?php

namespace App\Exports;
use App\Cashflow;

use Maatwebsite\Excel\Concerns\FromCollection;

class CashflowExport implements FromCollection
{	
	
    public function collection()
    {
        return Cashflow::orderBy('id', 'DESC')->get();
    }
}

