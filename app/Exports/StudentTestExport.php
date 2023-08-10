<?php

namespace App\Exports;

use App\Models\StudentTest;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentTestExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            '#Test ID',
            'Test Name',
            'Student Email',
            'Average'
        ];
    }

    public function collection()
    {
        return StudentTest::leftJoin('tests', 'student_test.test_id', '=', 'tests.id')
        ->leftJoin('students', 'students.id', '=', 'student_test.student_id')
        ->select('tests.id as test_id', 'tests.name as test_name', 'students.email as student_email', 'student_test.average as average')
        ->orderBy('test_id', 'asc')
        ->get();
    }
}
