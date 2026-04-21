<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TotauxFacturationExport implements FromCollection, WithHeadings
{
    protected $totaux;

    public function __construct(array $totaux)
    {
        $this->totaux = $totaux;
    }

    public function collection()
    {
        $data = [];

        // On transforme votre tableau associatif en lignes plates pour Excel
        foreach ($this->totaux as $nomBudget => $numeros) {
            foreach ($numeros as $numTel => $montant) {
                $data[] = [
                    'budget'  => $nomBudget,
                    'numero'  => $numTel,
                    'montant' => $montant
                ];
            }
            
            // OPTIONNEL : Ajouter une ligne de sous-total par budget
            $data[] = [
                'budget'  => "TOTAL $nomBudget",
                'numero'  => '',
                'montant' => array_sum($numeros)
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return ['Budget', 'Numéro Téléphone', 'Montant TTC'];
    }
}