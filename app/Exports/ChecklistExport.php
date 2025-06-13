<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\AssessmentCheckList;

class ChecklistExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
   
    public function headings():array{
        return [
            'checklist',
            'health_facility_type',
        ];
    }
    public function collection()
    {   
     
        return AssessmentCheckList::select(
            'checklist',
            'health_facility_type',
        )->get();
    }
}
