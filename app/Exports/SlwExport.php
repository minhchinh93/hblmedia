<?php

namespace App\Exports;

use App\Helpers\SellerWix;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class SlwExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private $time1;
    public function __construct($time1)
    {
        $this->time1 = $time1;
    }
    public function headings(): array
    {
        return [
            'stt',
            'id_name',
            'transaction_typeS',
            'amountS',
            'Store',
            'time',

        ];
    }

    public function collection()
    {
        $time1 = $this->time1;

        $selerwix = new SellerWix;
        $token = $selerwix->getToken();
        $translations = $selerwix->transaction($token, $time1);
        $i = 0;
        if ($translations['data']['getTransactionHistory']['logs'] != []) {
            $datas = $translations['data']['getTransactionHistory']['logs'];
            foreach ($datas as $data) {
                $amount = $data['amount'];
                $transaction_type = $data['transaction_type'];
                $description = $data['description'];
                $createdAt = $data['createdAt'];
                if ($transaction_type == "Cash") {
                    $pattern = '/.* order: (.*?) \(/m';
                } else {
                    $patterns = '/.* refund for order (.*?) \(/m';
                    if (preg_match($patterns, $description) == 0) {
                        $pattern = '/.* refund for order (.*?) because/';
                    } else {
                        $pattern = '/.* refund for order (.*?) \(/m';
                    }
                }

                preg_match($pattern, $description, $matches);

                $idNameStore = $selerwix->findNameStore($token, $matches[1]);

                $str = ($i++ . ',' . $idNameStore . ',' . $transaction_type . ',' . $createdAt . ',' . $matches[1] . ',' . $amount);

                $response[] = explode(",", $str);

            }
        } else {
            $response = null;
        }

        return collect($response);

    }
}
