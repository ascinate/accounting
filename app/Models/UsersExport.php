<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->select(
                'users.name',
                'users.email',
                'roles.name as role',
                'users.warehouse',
                'users.status'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Role',
            'Warehouse',
            'Status'
        ];
    }
}