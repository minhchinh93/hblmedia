<?php

namespace App\Http\Controllers\admin;

use App\Exports\ExportSw;
use App\Exports\SlwExport;
use App\Helpers\SellerWix;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class sellerwixController extends Controller
{

    public function index(Request $request)
    {
        $selerwix = new SellerWix;
        $token = $selerwix->getToken();
        if ($request->time1 != null) {
            $result = $selerwix->get_dataStore($token, $request->Store_ID, $request->time1, $request->time2);
            // dump($result);
            if (count($result) < 2) {

                $total = $result['data']['getPaginationOrders']['pageInfo']['total'];
                $datas = $result['data']['getPaginationOrders']['orders'];

                if ($datas != []) {
                    // dump($datas);
                    foreach ($datas as $data) {

                        if ($data['order_supplier'] != []) {
                            $total_price[] = $data['order_supplier'][0]['total_price'];
                            $sw_prices[] = $data['order_supplier'][0]['total_price'] - $data['order_supplier'][0]['shipping_price'];
                            $shipping_price[] = $data['order_supplier'][0]['shipping_price'];
                            $id = $data['order_supplier'][0]['tracking_id'];
                            if ($id != null) {
                                $tracking_url = $data['order_supplier'][0]['tracking_url'];
                                if ($data['order_supplier'][0]['carrier_code'] == 'DHLECS') {
                                    $progressBarType = $selerwix->gettrackDhl($id);
                                } else {
                                    $progressBarType = $selerwix->gettracking($id);
                                    // $progressBarType = 'null';
                                }

                            } else {
                                $tracking_url = 'n0 fullfill';
                                $progressBarType = 'n0 fullfill';
                            }

                            $response[] = [
                                $data['name'],
                                $data['order_from'],
                                $data['store']['name'],
                                $data['order_status'],
                                $data['purchase_date'],
                                $data['latest_ship_date'],
                                $progressBarType ?? null,
                                $tracking_url,
                                $data['order_supplier'][0]['tracking_id'],
                                $data['order_supplier'][0]['fulfill_status'],
                                $data['order_supplier'][0]['method_fulfill'],
                                // $data['order_supplier'][0]['lasted_tracking_supplier_name'],
                            ];

                        } else {
                            $total_price[] = 0;
                            $sw_prices[] = 0;
                            $shipping_price[] = 0;
                            $response = null;
                        }
                    }
                } else {
                    $total_price[] = 0;
                    $sw_prices[] = 0;
                    $shipping_price[] = 0;
                    $response = null;

                }

            } else {
                $total_price[] = 0;
                $sw_prices[] = 0;
                $shipping_price[] = 0;
                $response = null;

            }
        } else {
            $total = 0;
            $datas = null;
            $total_price[] = 0;
            $sw_prices[] = 0;
            $shipping_price[] = 0;
            $response = null;

        }
        // dd($response);
        return view('admin.Sellerwix.index',
            ['total' => count($datas),
                'datas' => $datas,
                'id' => $request->id,
                'total_price' => array_sum($total_price),
                'sw_prices' => array_sum($sw_prices),
                'shipping_price' => array_sum($shipping_price),
                'response' => $response,
            ]);

    }
    public function sellerwixKetoan(Request $request)
    {
        $selerwix = new SellerWix;
        $token = $selerwix->getToken();
        if ($request->time1 != null) {
            $result = $selerwix->get_dataStore($token, $request->Store_ID, $request->time1, $request->time2);
            if (count($result) < 2) {
                $total = count($result['data']['getPaginationOrders']['orders']);
                // $total = $result['data']['getPaginationOrders']['pageInfo']['total'];
                // dd($total);
                $datas = $result['data']['getPaginationOrders']['orders'];
                if ($datas != []) {
                    foreach ($datas as $data) {
                        if ($data['order_supplier'] != []) {
                            $total_price[] = $data['order_supplier'][0]['total_price'];
                            $sw_prices[] = $data['order_supplier'][0]['total_price'] - $data['order_supplier'][0]['shipping_price'];
                            $shipping_price[] = $data['order_supplier'][0]['shipping_price'];
                            // $id = $data['order_supplier'][0]['tracking_id'];
                            // $tracking_id = $selerwix->gettracking($id);
                            // dd($tracking_id);
                            // dd($tracking_id['trackDetails'][0]['progressBarType']);
                            // if ($tracking_id['trackDetails'] != null) {
                            //     $tracking_id['trackDetails'][0]['progressBarType'];
                            // }
                            // $response[] = [
                            //     $data['name'],
                            //     $data['order_from'],
                            //     $data['store']['name'],
                            //     $data['order_status'],
                            //     $data['purchase_date'],
                            //     $data['latest_ship_date'],
                            //     $tracking_id['trackDetails'][0]['progressBarType'] ?? null,
                            //     $data['order_supplier'][0]['tracking_url'],
                            //     $data['order_supplier'][0]['tracking_id'],
                            //     $data['order_supplier'][0]['fulfill_status'],
                            //     $data['order_supplier'][0]['method_fulfill'],
                            //     $data['order_supplier'][0]['lasted_tracking_supplier_name'],
                            // ];

                        } else {
                            $total_price[] = 0;
                            $sw_prices[] = 0;
                            $shipping_price[] = 0;
                        }
                    }
                } else {
                    $total_price[] = 0;
                    $sw_prices[] = 0;
                    $shipping_price[] = 0;

                }

            } else {
                $total_price[] = 0;
                $sw_prices[] = 0;
                $shipping_price[] = 0;

            }
        } else {
            $total = 0;
            $datas = null;
            $total_price[] = 0;
            $sw_prices[] = 0;
            $shipping_price[] = 0;

        }
        // dd($response);
        return view('admin.Sellerwix.sellerwixKetoan',
            ['total' => $total,
                'datas' => $datas,
                'id' => $request->id,
                'total_price' => array_sum($total_price),
                'sw_prices' => array_sum($sw_prices),
                'shipping_price' => array_sum($shipping_price),
            ]);

    }
    public function getIdStore()
    {
        $selerwix = new SellerWix;
        $token = $selerwix->getToken();
        $result = $selerwix->getIDStore($token);
        if ($result['data']) {
            $data = $result['data']['stores']['stores'];
            $total = count($result['data']['stores']['stores']);
        } else {
            $total = 0;
            $data = null;
        }

        return view('admin.Sellerwix.getIdStore',
            ['total' => $total,
                'datas' => $data,
            ]);
    }
    public function transactions(Request $request)
    {

        $selerwix = new SellerWix;
        $token = $selerwix->getToken();
        $time1 = $request->time1;
        $translations = $selerwix->transaction($token, $time1);
        if ($translations['data']['getTransactionHistory']['logs'] != []) {
            $total = count($translations['data']['getTransactionHistory']['logs']);
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

                $str = ($amount . ',' . $transaction_type . ',' . $createdAt . ',' . $matches[1] . ',' . $idNameStore);

                $response[] = explode(",", $str);

            }
        } else {
            $total = 0;
            $response = null;
        }

        return view('admin.Sellerwix.translation',
            ['total' => $total,
                'datas' => $response,
            ]);
    }

    public function exportUsers($id, $time1, $time2)
    {
        return Excel::download(new ExportSw($id, $time1, $time2), 'ExportSw1.xlsx');
    }
    public function exportslw($time1)
    {
        return Excel::download(new SlwExport($time1), "{$time1}.xlsx");
    }

}
