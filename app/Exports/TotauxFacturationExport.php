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
    $totalGeneral = 0;

    foreach ($this->totaux as $nomBudget => $numeros) {
        $sousTotalBudget = 0;

        // 1. On ajoute tous les numéros de ce budget
        foreach ($numeros as $numTel => $montant) {
            $data[] = [
                'budget'  => $nomBudget,
                'numero'  => $numTel,
                'montant' => $montant
            ];
            $sousTotalBudget += $montant;
        }

        // 2. On ajoute la ligne de SOUS-TOTAL juste en dessous des numéros du groupe
       

        // On ajoute une ligne vide pour "respirer" entre deux budgets (optionnel)
       // $data[] = ['budget' => '', 'numero' => '', 'montant' => ''];

        // On cumule pour le total de fin de page
        $totalGeneral += $sousTotalBudget;
    }

    // 3. On ajoute la ligne de TOTAL GÉNÉRAL tout en bas du fichier
   


       $data[] = ['budget' => '', 'numero' => '', 'montant' => ''];

        $data[] = ['budget' => 'Total par code budgetaire', 'numero' => '', 'montant' => ''];

    foreach ($this->totaux as $nomBudget => $numeros) {
        $sousTotalBudget = 0;

        // 1. On ajoute tous les numéros de ce budget
        foreach ($numeros as $numTel => $montant) {
        
            $sousTotalBudget += $montant;
        }

        // 2. On ajoute la ligne de SOUS-TOTAL juste en dessous des numéros du groupe
        $data[] = [
            'budget'  => " $nomBudget", // Petit préfixe pour le voir de loin
            'numero'  => '',
            'montant' => $sousTotalBudget
        ];

      
    }

     $data[] = ['budget' => '', 'numero' => '', 'montant' => ''];

     $data[] = [
        'budget'  => '------TOTAL GÉNÉRAL------',
        'numero'  => '',
        'montant' => $totalGeneral
    ];
    
        return collect($data);
    }

    public function headings(): array
    {
        return ['Budget', 'Numéro Téléphone', 'Montant TTC'];
    }

    
}