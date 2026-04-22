<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class FactureAirtel implements ToCollection, WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
    public function collection($rows)
    {
        set_time_limit(300);
        $data = [];

        foreach ($rows as $row) {

            // ignorer ligne vide ou header
            if (empty($row[1])) continue;

            $msisdn = $row[1] ?? null;

            if ($msisdn) {
                $msisdn = (string) $msisdn;

                // ajouter 0 si absent
                if (!str_starts_with($msisdn, '0')) {
                    $msisdn = '0' . $msisdn;
                }
            }


            $data[] = [
                'N_DOSSIER'         => $row[0] ?? null,
                'MSISDN'                => $msisdn,
                'N_FACTURE' => $row[2] ?? null,
                'MONTANT_HT'         => isset($row[3]) ? number_format((float) $row[3], 2, '.', '') : null,
                'DROIT_ACCISE'                =>isset($row[4]) ? number_format((float) $row[4], 2, '.', '') : null,
                'TVA'            => isset($row[5]) ? number_format((float) $row[5], 2, '.', '') : null,
                'MONTANT_TTC'            => isset($row[6]) ? number_format((float) $row[6], 2, '.', '') : null,
                'REMISE'       => isset($row[7]) ? number_format((float) $row[7], 2, '.', '') : null,
                'TOTAL_PAYER'               => isset($row[8]) ? number_format((float) $row[8], 2, '.', '') : null,
                'Date' => now()->format('Y-m-d'),
            ];
        }

        // insert en une seule requête (beaucoup plus rapide)
        DB::connection('mysql_second')
            ->table('facture_airtel')
            ->insert($data);
            }
}
