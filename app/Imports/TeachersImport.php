<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class TeachersImport implements ToModel
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
        $teacher = auth()->guard('admin')->user()->teachers()->create($input);
        return $teacher;
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
}
