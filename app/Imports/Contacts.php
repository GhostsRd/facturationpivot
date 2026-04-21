<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;

class Contacts implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection($rows)
    {
        foreach ($rows as $row) {
           // dd($row[1]);
            DB::connection('mysql_second')
            ->table('base_flotte_telephoniques_pivot')->insert([
                'nom'        => $row[0],
                'prenom'               => $row[1],
                'poste'=> $row[2],
                'services'        => $row[3],
                'localite'               =>$row[4],
                'budget'           => $row[5],
                'airtel'           => isset($row[6]) ? str_pad((string)$row[6], 10, '0', STR_PAD_LEFT) : null,
                'telma'     => isset($row[7]) ? str_pad((string)$row[7], 10, '0', STR_PAD_LEFT) : null,
                'orange'              => isset($row[8]) ? str_pad((string)$row[8], 10, '0', STR_PAD_LEFT) : null,
                'mail'          => $row[9],
              c
            
            ]);

        }
    }
}
