<?php

namespace App\Exports;

use App\Models\ChatbotContact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ChatbotContactsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return ChatbotContact::select('id', 'nombre', 'telefono', 'created_at')->orderByDesc('created_at')->get();
    }

    public function headings(): array
    {
        return [
            '#',
            'Nombre',
            'Teléfono',
            'Fecha de Registro',
        ];
    }
}
