<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $input = [
            'name' => $row['name'],
            'email' => $row['email'],
            'status' => $row['status'],
            'password' => Hash::make("1234567890")
        ];
        $student = auth()->guard('admin')->user()->students()->create($input);
        return $student;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students|max:255',
            'password' => 'required|confirmed|min:8',
            'status' => 'required|integer'
        ];
    }

    public function customValidationMessages()
    {
        return [
            'name.in' => ':attribute invalid',
            'email.in' => ':attribute invalid',
            'status.in' => ':attribute invalid',
        ];
    }
}
