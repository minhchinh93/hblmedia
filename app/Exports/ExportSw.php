<?php

namespace App\Exports;

use App\Helpers\SellerWix;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportSw implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    private $id;
    private $time1;
    private $time2;
    public function __construct($id, $time1, $time2)
    {
        $this->id = $id;
        $this->time1 = $time1;
        $this->time2 = $time2;

    }
    public function headings(): array
    {
        return [
            'Name',
            'order_from',
            'store',
            'order_status',
            'fulfill_status',
            'total_price',
            'shipping_price',
            'sw_prices',
            'discount_price',
        ];
    }

    public function collection()
    {
        $id = $this->id;
        $time1 = $this->time1;
        $time2 = $this->time2;

        $selerwix = new SellerWix;
        $token = $selerwix->getToken();
        $results = $selerwix->get_dataStore($token, $id, $time1, $time2);
        if (count($results) < 2) {
            $datas = $results['data']['getPaginationOrders']['orders'];
            foreach ($datas as $data) {
                if (count($data['order_supplier']) > 0) {
                    $result[] = [
                        $data['name'],
                        $data['order_from'],
                        $data['store']['name'],
                        $data['order_status'],
                        $data['order_supplier'][0]['fulfill_status'],
                        $data['order_supplier'][0]['total_price'],
                        $data['order_supplier'][0]['shipping_price'],
                        $data['order_supplier'][0]['total_price'] - $data['order_supplier'][0]['shipping_price'],
                        $data['order_supplier'][0]['discount_price'],
                    ];
                }
            }
        } else {
            $datas = null;
        }
        return collect($result);
    }

}
