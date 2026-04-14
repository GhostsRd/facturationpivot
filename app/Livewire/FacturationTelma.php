<?php

namespace App\Livewire;

use Livewire\Component;

class FacturationTelma extends Component
{
    public function render()
    {
        return view('livewire.facturation-telma');
    }

    public function model(array $row)
{
    DB::table('ddbs')->insert([
        'numero'          => trim($row['numero']),
        'utilisateur'     => strtoupper($row['utilisateur']),
        'service'         => $row['services'],
        'code_budgetaire' => $row['code_budgetaire'],
        'gl_code'         => $row['gl_code'],
        'departement'     => $row['departement'],
        'created_at'      => now(),
        'updated_at'      => now(),
    ]);
}
}
