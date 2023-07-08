<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $input = [
            'name' => $row[0],
            'email' => $row[1],
            'status' => $row[2],
            'password' => Hash::make('password')
        ];
        $student = auth()->guard('admin')->user()->students()->create($input);
        return $student;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students|max:255',
            "password" => 'required|confirmed|min:8',
            'status' => 'required|integer'
        ];
    }
}
