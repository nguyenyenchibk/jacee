<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class TeachersImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.name' => 'required',
            '*.email' => 'required|email|unique:teachers',
        ])->validate();

        foreach ($rows as $row) {
        auth()->guard('admin')->user()->teachers()->create([
               'name' => $row['name'],
               'email' => $row['email'],
               'status' => 1,
               'password' => Hash::make($row['email']),
           ]);
       }
    }
}
