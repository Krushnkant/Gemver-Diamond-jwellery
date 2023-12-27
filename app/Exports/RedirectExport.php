<?php

namespace App\Exports;

use App\Models\Redirect;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RedirectExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch only the desired columns
        return Redirect::select('from_url', 'to_url')->get();
    }

    public function headings(): array
    {
        // Custom headers for the columns
        return [
            'From URL',
            'To URL',
        ];
    }
}
