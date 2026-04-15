<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;

class Facture implements ToCollection
{
    
    public function collection($rows)
    {
        foreach ($rows as $row) {
           // dd($row[1]);
            DB::connection('mysql_second')
            ->table('facture')->insert([
                'NOM_DE_COMPTE'        => $row[0],
                'Compte'               => $row[1],
                'Profil_de_facturation'=> $row[2],
                'Facture_TELMA'        => $row[3],
                'msisdn'               =>$row[4],
                'Abonnement'           => $row[5],
                'Montant_HT'           => $row[6],
                'Droit_d_accises'     => $row[7],
                'TVA_TMP'              => $row[8],
                'Montant_TTC'          =>$row[9],
                'Date'                 => $row[10],
            
            ]);

        }
    }
}
