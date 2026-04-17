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
                'airtel'           => $row[6],
                'telma'     => $row[7],
                'orange'              => $row[8],
                'mail'          =>$row[9],
              
            
            ]);

        }
    }
}
