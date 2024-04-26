<?php
//app/Helpers/Envato/User.php
namespace App\Helpers;

class SellerWix
{
    /**
     * @param int $user_id User-id
     *
     * @return string
     */
    public function getToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sellerwix.com/users/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"email":"haihotan290@gmail.com","password":"Haiholong290@@#!"}',
            CURLOPT_HTTPHEADER => array(
                'authority: api.sellerwix.com',
                'accept: application/json, text/plain, */*',
                'accept-language: en-US,en;q=0.9,vi;q=0.8',
                'content-type: application/json;charset=UTF-8',
                'origin: https://sellerwix.com',
                'referer: https://sellerwix.com/',
                'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="101", "Google Chrome";v="101"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Windows"',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-site',
                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $array_selerwix = json_decode($response, true);
        return $array_selerwix['token'];

    }
    // public static function get_dataStore($token, $store_id, $time1, $time2)
    // {

    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://api.sellerwix.com/graphql',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => '{"operationName":"MainQuery","variables":{"pageIndex":0,"pageSize":1000,"filters":[{"level":2,"index":0,"filters":[{"field":"Order.store_id","operator":"in","value":"' . $store_id . '","data_type":"FindLookup","isAmbiguous":false,"unit":null,"label":"SPYRAMID,PursueZX"}]},{"level":2,"index":1,"filters":[{"field":"Order.purchase_date","operator":"gte","value":"' . $time1 . '","unit":null,"data_type":"DateTime","isAmbiguous":false,"label":"' . $time1 . '"}]},{"level":2,"index":2,"filters":[{"field":"Order.purchase_date","operator":"lte","value":"' . $time2 . '","unit":null,"data_type":"DateTime","isAmbiguous":false,"label":"' . $time1 . '"}]}],"search_area":"Order"},"query":"query MainQuery($pageIndex: Int, $pageSize: Int, $store_id: String, $filters: [FilterGroup], $search_area: String, $sorted: [SortedInput]) {\\n  getPaginationOrders(pageIndex: $pageIndex, pageSize: $pageSize, store_id: $store_id, filters: $filters, search_area: $search_area, sorted: $sorted) {\\n    pageInfo {\\n      total\\n      pageIndex\\n      pageSize\\n    }\\n    orders {\\n      id\\n      is_request_review\\n      is_skip_request_review\\n      name\\n      total_price_amount\\n      currency_code\\n      shipping_name\\n      shipping_address1\\n      shipping_address2\\n      shipping_city\\n      shipping_state\\n      shiping_method\\n      shipping_phone\\n      order_status\\n      shipping_zip\\n      shipping_country_code\\n      order_from\\n      purchase_date\\n      system_order_status\\n      store_id\\n      is_clone\\n      createdAt\\n      latest_ship_date\\n      gift_message\\n      store {\\n        name\\n        type\\n        is_connect\\n      }\\n      ext\\n      note\\n      updatedAt\\n      tracking_url\\n      tracking_status\\n      tracking_id\\n      order_supplier {\\n        id\\n        order_id\\n        tax\\n        supplier {\\n          id\\n          code\\n          name\\n        }\\n        is_new_track\\n        order_items {\\n          availability\\n        }\\n        total_price\\n        shipping_price\\n        discount_price\\n        supplier_status\\n        supplier_message\\n        tracking_id\\n        tracking_url\\n        carrier_code\\n        carrier_name\\n        fulfill_status\\n        fulfill_message\\n        supplier_channel_id\\n        submit_date\\n        createdAt\\n        updatedAt\\n        method_fulfill\\n        gift_fee\\n      }\\n      submit_date\\n      price_supplier\\n      order_item_channel {\\n        id\\n      }\\n      order_items {\\n        id\\n        parent_id\\n        item_supplier {\\n          id\\n          supplier_selected\\n        }\\n        is_custom_product_supplier\\n        order_supplier {\\n          supplier_status\\n        }\\n      }\\n    }\\n  }\\n}\\n"}',
    //         CURLOPT_HTTPHEADER => array(
    //             'authority: api.sellerwix.com',
    //             'accept: */*',
    //             'accept-language: en-US,en;q=0.9,vi;q=0.8',
    //             'authorization: ' . $token,
    //             'content-type: application/json',
    //             'origin: https://sellerwix.com',
    //             'referer: https://sellerwix.com/',
    //             'sec-ch-ua: "Not?A_Brand";v="8", "Chromium";v="108", "Google Chrome";v="108"',
    //             'sec-ch-ua-mobile: ?0',
    //             'sec-ch-ua-platform: "Windows"',
    //             'sec-fetch-dest: empty',
    //             'sec-fetch-mode: cors',
    //             'sec-fetch-site: same-site',
    //             'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/108.0.0.0 Safari/537.36',
    //         ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);

    //     $array_selerwix = json_decode($response, true);

    //     return $array_selerwix;

    // }
    public static function get_dataStore($token, $store_id, $time1, $time2)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sellerwix.com/graphql',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"operationName":"MainQuery","variables":{"pageIndex":0,"pageSize":10000,"filters":[{"level":2,"index":0,"filters":[{"field":"Order.store_id","operator":"in","value":"' . $store_id . '","unit":null,"data_type":"FindLookup","isAmbiguous":false,"label":"HBL Store"}]},{"level":2,"index":1,"filters":[{"field":"Order.purchase_date","operator":"gte","value":"2023-' . $time1 . '","unit":null,"data_type":"DateTime","isAmbiguous":false,"label":"2023-' . $time1 . '"}]},{"level":2,"index":2,"filters":[{"field":"Order.purchase_date","operator":"lte","value":"2023-' . $time2 . '","unit":null,"data_type":"DateTime","isAmbiguous":false,"label":"2023-' . $time2 . '"}]}],"search_area":"Order"},"query":"query MainQuery($pageIndex: Int, $pageSize: Int, $store_id: String, $filters: [FilterGroup], $search_area: String, $sorted: [SortedInput]) {\\n  getPaginationOrders(pageIndex: $pageIndex, pageSize: $pageSize, store_id: $store_id, filters: $filters, search_area: $search_area, sorted: $sorted) {\\n    pageInfo {\\n      total\\n      pageIndex\\n      pageSize\\n    }\\n    orders {\\n      id\\n      is_request_review\\n      is_skip_request_review\\n      name\\n      total_price_amount\\n      currency_code\\n      shipping_name\\n      shipping_address1\\n      shipping_address2\\n      shipping_city\\n      shipping_state\\n      shiping_method\\n      shipping_phone\\n      order_status\\n      shipping_zip\\n      shipping_country_code\\n      order_from\\n      purchase_date\\n      system_order_status\\n      store_id\\n      is_clone\\n      createdAt\\n      latest_ship_date\\n      gift_message\\n      store {\\n        name\\n        type\\n        is_connect\\n      }\\n      ext\\n      note\\n      updatedAt\\n      tracking_url\\n      tracking_status\\n      tracking_id\\n      order_supplier {\\n        id\\n        order_id\\n        tax\\n        supplier {\\n          id\\n          code\\n          name\\n        }\\n        status_from_supplier\\n        is_new_track\\n        order_items {\\n          availability\\n        }\\n        total_price\\n        shipping_price\\n        discount_price\\n        supplier_status\\n        supplier_message\\n        tracking_id\\n        tracking_url\\n        carrier_code\\n        carrier_name\\n        fulfill_status\\n        fulfill_message\\n        supplier_channel_id\\n        submit_date\\n        createdAt\\n        updatedAt\\n        method_fulfill\\n        gift_fee\\n      }\\n      submit_date\\n      price_supplier\\n      order_item_channel {\\n        id\\n      }\\n      order_items {\\n        id\\n        parent_id\\n        item_supplier {\\n          id\\n          supplier_selected\\n        }\\n        is_custom_product_supplier\\n        order_supplier {\\n          supplier_status\\n        }\\n      }\\n    }\\n  }\\n}\\n"}',
            CURLOPT_HTTPHEADER => array(
                'authority: api.sellerwix.com',
                'accept: */*',
                'accept-language: en-US,en;q=0.9,vi;q=0.8',
                'authorization: ' . $token,
                'content-type: application/json',
                'origin: https://app.sellerwix.com',
                'referer: https://app.sellerwix.com/',
                'sec-ch-ua: "Chromium";v="112", "Google Chrome";v="112", "Not:A-Brand";v="99"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Windows"',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-site',
                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $tracking_id = json_decode($response, true);
        // if ($tracking_id['tracking_id'] != null) {
        //     dd($tracking_id['tracking_id']);
        //     if ($tracking_id['trackDetails'][0]['errorCode'] != '504') {
        //         $progressBarType = $tracking_id['trackDetails'][0]['progressBarType'];
        //     } else {
        //         $progressBarType = 'tracking khac';
        //     }
        // } else {
        //     $progressBarType = 'n0 fullfill';
        // }
        // dd($tracking_id);
        return $tracking_id;
    }

    // public static function get_dataStore($token, $store_id, $time1, $time2)
    // {

    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => 'https://api.sellerwix.com/graphql',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => '{"operationName":"MainQuery","variables":{"pageIndex":0,"pageSize":100,"filters":[{"level":2,"index":0,"filters":[{"field":"Order.store_id","operator":"in","value":"' . $store_id . '","data_type":"FindLookup","isAmbiguous":false,"unit":null,"label":"BiCi Store"}]},{"level":2,"index":1,"filters":[{"field":"Order.purchase_date","operator":"gte","value":"' . $time1 . '","unit":null,"data_type":"DateTime","isAmbiguous":false,"label":"' . $time1 . '"},{"field":"Order.purchase_date","operator":"lte","value":"' . $time2 . '","unit":null,"data_type":"DateTime","isAmbiguous":false,"label":"' . $time2 . '"}]}],"search_area":"Order"},"query":"query MainQuery($pageIndex: Int, $pageSize: Int, $store_id: String, $filters: [FilterGroup], $search_area: String, $sorted: [SortedInput]) {\\n  getPaginationOrders(pageIndex: $pageIndex, pageSize: $pageSize, store_id: $store_id, filters: $filters, search_area: $search_area, sorted: $sorted) {\\n    pageInfo {\\n      total\\n      pageIndex\\n      pageSize\\n    }\\n    orders {\\n      id\\n      is_request_review\\n      is_skip_request_review\\n      name\\n      total_price_amount\\n      currency_code\\n      shipping_name\\n      shipping_address1\\n      shipping_address2\\n      shipping_city\\n      shipping_state\\n      shiping_method\\n      shipping_phone\\n      order_status\\n      shipping_zip\\n      shipping_country_code\\n      order_from\\n      purchase_date\\n      system_order_status\\n      store_id\\n      is_clone\\n      createdAt\\n      latest_ship_date\\n      gift_message\\n      store {\\n        name\\n        type\\n        is_connect\\n      }\\n      ext\\n      note\\n      updatedAt\\n      tracking_url\\n      tracking_status\\n      tracking_id\\n      order_supplier {\\n        id\\n        order_id\\n        tax\\n        supplier {\\n          id\\n          code\\n          name\\n        }\\n        is_new_track\\n        order_items {\\n          availability\\n        }\\n        total_price\\n        shipping_price\\n        discount_price\\n        supplier_status\\n        supplier_message\\n        tracking_id\\n        tracking_url\\n        carrier_code\\n        carrier_name\\n        fulfill_status\\n        fulfill_message\\n        supplier_channel_id\\n        submit_date\\n        createdAt\\n        updatedAt\\n        method_fulfill\\n        gift_fee\\n      }\\n      submit_date\\n      price_supplier\\n      order_item_channel {\\n        id\\n      }\\n      order_items {\\n        id\\n        parent_id\\n        item_supplier {\\n          id\\n          supplier_selected\\n        }\\n        is_custom_product_supplier\\n        order_supplier {\\n          supplier_status\\n        }\\n      }\\n    }\\n  }\\n}\\n"}',
    //         CURLOPT_HTTPHEADER => array(
    //             'authority: api.sellerwix.com',
    //             'accept: */*',
    //             'accept-language: en-US,en;q=0.9,vi;q=0.8',
    //             'authorization: ' . $token,
    //             'content-type: application/json',
    //             'origin: https://sellerwix.com',
    //             'referer: https://sellerwix.com/',
    //             'sec-ch-ua: "Google Chrome";v="107", "Chromium";v="107", "Not=A?Brand";v="24"',
    //             'sec-ch-ua-mobile: ?0',
    //             'sec-ch-ua-platform: "Windows"',
    //             'sec-fetch-dest: empty',
    //             'sec-fetch-mode: cors',
    //             'sec-fetch-site: same-site',
    //             'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36',
    //         ),
    //     ));

    //     $response = curl_exec($curl);
    //     curl_close($curl);
    //     $array_selerwix = json_decode($response, true);

    //     return $array_selerwix;

    // }

    public function findNameStore($token, $id)
    {

        $curl = curl_init();
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sellerwix.com/graphql',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"operationName":"MainQuery","variables":{"pageIndex":0,"pageSize":100,"filters":[{"level":1,"index":0,"filters":[{"field":"name","operator":"like","value":"' . $id . '","data_type":"String"},{"field":"shipping_name","operator":"like","value":"' . $id . '","data_type":"String"},{"field":"shipping_phone","operator":"like","value":"' . $id . '","data_type":"String"},{"field":"$order_supplier.tracking_id$","operator":"like","value":"' . $id . '","data_type":"String"}]}],"search_area":"Order"},"query":"query MainQuery($pageIndex: Int, $pageSize: Int, $store_id: String, $filters: [FilterGroup], $search_area: String, $sorted: [SortedInput]) {\\n  getPaginationOrders(pageIndex: $pageIndex, pageSize: $pageSize, store_id: $store_id, filters: $filters, search_area: $search_area, sorted: $sorted) {\\n    pageInfo {\\n      total\\n      pageIndex\\n      pageSize\\n    }\\n    orders {\\n      id\\n      is_request_review\\n      is_skip_request_review\\n      name\\n      total_price_amount\\n      user_confirm\\n      currency_code\\n      buyer_email\\n      shipping_name\\n      shipping_address1\\n      shipping_address2\\n      shipping_city\\n      shipping_state\\n      shipping_country\\n      shiping_method\\n      shipping_phone\\n      order_status\\n      shipping_zip\\n      shipping_country_code\\n      order_from\\n      purchase_date\\n      order_id_channel\\n      system_order_status\\n      marketplace_id\\n      store_id\\n      is_clone\\n      createdAt\\n      ioss\\n      ioss_cost\\n      latest_ship_date\\n      shipping_notification\\n      gift_message\\n      send_gift_message\\n      store {\\n        name\\n        type\\n        is_connect\\n        gift_message_template {\\n          id\\n          store_id\\n        }\\n      }\\n      ext\\n      note\\n      updatedAt\\n      tracking_url\\n      tracking_status\\n      tracking_id\\n      order_supplier {\\n        id\\n        order_id\\n        tax\\n        supplier {\\n          id\\n          code\\n          name\\n        }\\n        total_price\\n        shipping_price\\n        discount_price\\n        supplier_status\\n        supplier_message\\n        tracking_id\\n        tracking_url\\n        carrier_code\\n        carrier_name\\n        fulfill_status\\n        fulfill_message\\n        supplier_channel_id\\n        submit_date\\n        createdAt\\n        updatedAt\\n        total_new_tracking\\n        lasted_tracking_supplier_name\\n        method_fulfill\\n        gift_fee\\n      }\\n      submit_date\\n      price_supplier\\n      order_item_channel {\\n        id\\n      }\\n      order_items {\\n        id\\n        parent_id\\n        item_supplier {\\n          id\\n          supplier_selected\\n        }\\n        is_custom_product_supplier\\n        order_supplier {\\n          supplier_status\\n        }\\n      }\\n    }\\n  }\\n}\\n"}',
            CURLOPT_HTTPHEADER => array(
                'authority: api.sellerwix.com',
                'accept: */*',
                'accept-language: en-US,en;q=0.9,vi;q=0.8',
                'authorization: ' . $token,
                'content-type: application/json',
                'origin: https://sellerwix.com',
                'referer: https://sellerwix.com/',
                'sec-ch-ua: "Google Chrome";v="105", "Not)A;Brand";v="8", "Chromium";v="105"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Windows"',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-site',
                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $array_storeNane = json_decode($response, true);
        if ($array_storeNane['data']['getPaginationOrders']['orders'] != []) {
            $storeNane = $array_storeNane['data']['getPaginationOrders']['orders'][0]['store']['name'];
        } else {
            $storeNane = 'ko tim thay sotre';

        }

        return $storeNane;

    }
    public function transaction($token, $time1)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sellerwix.com/graphql',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"operationName":"getTransactionHistory","variables":{"pageIndex":0,"pageSize":100,"filters":[{"level":2,"index":0,"filters":[{"field":"updatedAt","operator":"eq","value":"' . $time1 . '","unit":"","data_type":"DateTime","isAmbiguous":false,"label":"' . $time1 . '"}]}],"search_area":"TransactionHistory"},"query":"query getTransactionHistory($pageIndex: Int, $pageSize: Int, $sorted: [SortedInput], $filters: [FilterGroup!]!, $search_area: String) {\\n  getTransactionHistory(pageIndex: $pageIndex, pageSize: $pageSize, sorted: $sorted, filters: $filters, search_area: $search_area) {\\n    logs {\\n      id\\n      amount\\n      transaction_type\\n      description\\n      updatedAt\\n      createdAt\\n      approved\\n      invoice_number\\n      is_invoice\\n      objectType\\n    }\\n    pageInfo {\\n      pageIndex\\n      pageSize\\n      total\\n    }\\n  }\\n}\\n"}',
            CURLOPT_HTTPHEADER => array(
                'authority: api.sellerwix.com',
                'accept: */*',
                'accept-language: en-US,en;q=0.9,vi;q=0.8',
                'authorization:  ' . $token,
                'content-type: application/json',
                'origin: https://sellerwix.com',
                'referer: https://sellerwix.com/',
                'sec-ch-ua: "Google Chrome";v="105", "Not)A;Brand";v="8", "Chromium";v="105"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Windows"',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-site',
                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $transaction = json_decode($response, true);
        return $transaction;

    }
    public function getIDStore($token)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sellerwix.com/graphql',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"operationName":null,"variables":{"pageIndex":0,"pageSize":100},"query":"query ($pageIndex: Int, $pageSize: Int, $sorted: [SortedInput]) {\\n  stores(pageIndex: $pageIndex, pageSize: $pageSize, sorted: $sorted) {\\n    pageInfo {\\n      total\\n      pageIndex\\n      pageSize\\n    }\\n    stores {\\n      id\\n      name\\n      shop_status\\n      type\\n      expires_access_token\\n      refresh_token_expires_in\\n      domain\\n      is_template\\n      is_connect\\n      auto_get_order\\n      auto_sync_product\\n      auto_fulfill\\n      auto_tracking\\n      auto_update_product\\n      channel {\\n        name\\n        code\\n        is_customize\\n      }\\n      setting_stores {\\n        name\\n        value {\\n          setting_hour\\n          market_place\\n          status\\n          was_paid\\n          was_shipped\\n          send_bcc\\n        }\\n      }\\n      locations {\\n        id\\n        name\\n        is_active\\n        location_channel_id\\n      }\\n    }\\n  }\\n}\\n"}',
            CURLOPT_HTTPHEADER => array(
                'authority: api.sellerwix.com',
                'accept: */*',
                'accept-language: en-US,en;q=0.9,vi;q=0.8',
                'authorization: ' . $token,
                'content-type: application/json',
                'origin: https://sellerwix.com',
                'referer: https://sellerwix.com/',
                'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="101", "Google Chrome";v="101"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Windows"',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-site',
                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.54 Safari/537.36',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $transaction = json_decode($response, true);

        return $transaction;

    }
    public function getNameStore($token, $id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.sellerwix.com/graphql',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"operationName":"MainQuery","variables":{"pageIndex":0,"pageSize":100,"filters":[{"level":1,"index":0,"filters":[{"field":"name","operator":"like","value":"701-7138529-7163460","data_type":"String"},{"field":"shipping_name","operator":"like","value":"701-7138529-7163460","data_type":"String"},{"field":"shipping_phone","operator":"like","value":"701-7138529-7163460","data_type":"String"},{"field":"$order_supplier.tracking_id$","operator":"like","value":"701-7138529-7163460","data_type":"String"}]}],"search_area":"Order"},"query":"query MainQuery($pageIndex: Int, $pageSize: Int, $store_id: String, $filters: [FilterGroup], $search_area: String, $sorted: [SortedInput]) {\\n  getPaginationOrders(pageIndex: $pageIndex, pageSize: $pageSize, store_id: $store_id, filters: $filters, search_area: $search_area, sorted: $sorted) {\\n    pageInfo {\\n      total\\n      pageIndex\\n      pageSize\\n    }\\n    orders {\\n      id\\n      is_request_review\\n      is_skip_request_review\\n      name\\n      total_price_amount\\n      user_confirm\\n      currency_code\\n      buyer_email\\n      shipping_name\\n      shipping_address1\\n      shipping_address2\\n      shipping_city\\n      shipping_state\\n      shipping_country\\n      shiping_method\\n      shipping_phone\\n      order_status\\n      shipping_zip\\n      shipping_country_code\\n      order_from\\n      purchase_date\\n      order_id_channel\\n      system_order_status\\n      marketplace_id\\n      store_id\\n      is_clone\\n      createdAt\\n      ioss\\n      ioss_cost\\n      latest_ship_date\\n      shipping_notification\\n      gift_message\\n      send_gift_message\\n      store {\\n        name\\n        type\\n        is_connect\\n        gift_message_template {\\n          id\\n          store_id\\n        }\\n      }\\n      ext\\n      note\\n      updatedAt\\n      tracking_url\\n      tracking_status\\n      tracking_id\\n      order_supplier {\\n        id\\n        order_id\\n        tax\\n        supplier {\\n          id\\n          code\\n          name\\n        }\\n        total_price\\n        shipping_price\\n        discount_price\\n        supplier_status\\n        supplier_message\\n        tracking_id\\n        tracking_url\\n        carrier_code\\n        carrier_name\\n        fulfill_status\\n        fulfill_message\\n        supplier_channel_id\\n        submit_date\\n        createdAt\\n        updatedAt\\n        total_new_tracking\\n        lasted_tracking_supplier_name\\n        method_fulfill\\n        gift_fee\\n      }\\n      submit_date\\n      price_supplier\\n      order_item_channel {\\n        id\\n      }\\n      order_items {\\n        id\\n        parent_id\\n        item_supplier {\\n          id\\n          supplier_selected\\n        }\\n        is_custom_product_supplier\\n        order_supplier {\\n          supplier_status\\n        }\\n      }\\n    }\\n  }\\n}\\n"}',
            CURLOPT_HTTPHEADER => array(
                'authority: api.sellerwix.com',
                'accept: */*',
                'accept-language: en-US,en;q=0.9,vi;q=0.8',
                'authorization:' . $token,
                'content-type: application/json',
                'origin: https://sellerwix.com',
                'referer: https://sellerwix.com/',
                'sec-ch-ua: "Google Chrome";v="105", "Not)A;Brand";v="8", "Chromium";v="105"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Windows"',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-site',
                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }
    public function gettracking($id)
    {
        $curl = curl_init();
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.ups.com/track/api/Track/GetStatus?loc=en_US',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"Locale":"en_US","TrackingNumber":["' . $id . '"],"Requester":"st/trackdetails","returnToValue":""}',
            CURLOPT_HTTPHEADER => array(
                'authority: www.ups.com',
                'accept: application/json, text/plain, */*',
                'accept-language: en-US,en;q=0.9,vi;q=0.8',
                'content-type: application/json',
                'cookie: CONSENTMGR=consent:true%7Cts:1651131330431; bm_sz=1A4A1AB806814A158E081635DCFDB3DB~YAAQdetGaIHilwCDAQAANs7oPhEMVtme3jDdP/b71sb5Xw0lzvs+ioVUdJgLY+kWC4OGYUcTKnaHB65ctX1sUzAuyeYKvuUo80xvGqk8XkRhamhjhpEcI5gMMq/TKlZbBBAeOtOmYV4itNxDSA8PTIhIF8aUCKI7dv5qgTIuG0C35pIyIWcZN/iUfhK/kYfnvBpRCHUvD0R3DxXLUA8mTQQDjYa4bpQkmcB0XFaHfpuRIOgiwDfLKFHhOxOc/8pETNRkoFko/x68GI+q4Z/sBHRYJUOOhPy0PCr6+qLRRFI=~3682865~3617606; at_check=true; AMCVS_036784BD57A8BB277F000101%40AdobeOrg=1; AMCV_036784BD57A8BB277F000101%40AdobeOrg=-2121179033%7CMCIDTS%7C19251%7CMCMID%7C41490525932510522522216816084088740080%7CMCAAMLH-1663812588%7C3%7CMCAAMB-1663812588%7CRKhpRz8krg2tLO6pguXWp5olkAcUniQYPHaMWWgdJ3xzPWQmdj0y%7CMCOPTOUT-1663214988s%7CNONE%7CMCCIDH%7C1429808140%7CvVersion%7C5.3.0; _gcl_au=1.1.1896907940.1663207789; ak_bmsc=0DF48CD87E9540738060274174ED6B76~000000000000000000000000000000~YAAQdetGaIrilwCDAQAAKNPoPhG1CpqbrBW15SzIWLAwmupGEVNV53lECgTSKhRfPijQVqDirvCY6ceRFMHRjVC/U0OVhQogu32N3UJXcpzS8E9jdyMgqjfVh1jAy7x2D+7DsJrYq/8scLdYU11v9U3Le6uMXvO8y7EkViknZ6bmzaNFjCB9OMJ4uq30rYPqUHc9VzH8J7Sj8f/z2gONX6FCRf8v/gDLJ6taImZ44ulVzBX9fRLLooAtcpEOu5gDfRmwwujMZ0AHKFMHGUoXg+/zLIUo/H0VlrCdyINacAKCX4WllVC6FpZHvYkwNF8/JI7EikxuJT3F2lBCcGdHIrNdiGcPHiXwiuzSWGloJ830ysSYlwM0G54sX6S7V7aK2chZrEANqONXe12e4g0jMWIS3ANKJmr6qx3U1PB1eTciQHACy6ymwANHqZgCSRS4f1FOzBwvuq2jg3IHopExgMO1zeXvLJSAMDPf18Jk0MPBa1mXWs7KDjI=; s_cc=true; akacd_RWASP-default-phased-release=3840660590~rv=92~id=71f34ffb53624b3565f9444922854e54; _fbp=fb.1.1663207791443.1082097583; PIM-SESSION-ID=umDP8Q4f9TsUZR6c; aam_cms=segments%3D22945449%7C9625302; aam_uuid=41217697746060091122190056634914074932; mboxEdgeCluster=38; s_vnum=1664557200392%26vn%3D2; s_invisit=true; dayssincevisit_s=Less%20than%201%20day; st_cur_page=st_track; AKA_A2=A; alertsHide=true; X-CSRF-TOKEN=CfDJ8Jcj9GhlwkdBikuRYzfhrpIW8aDJS0oFLIzxs7nu0MzB8YEWoYpV_cwsNcLhzEqnElSdH514uBvfUGSRH6nkrHj4U6zRfuuS88CN3RuOlyAGtBdmj4ijSSsX-kKqQCfe1DAo9Y5q8tI5JMzipiRo8Uk; JSESSIONID=925CB6D4CBC23D324707B4D0FE8F60CB; _abck=742CC5F19E21F4A55594EB91A3B179C6~0~YAAQdetGaPvnmACDAQAAxXMuPwhnrZeGdTSEKrEJcWfWQuHdYtrAiNk6V1EfZbV2LREQqg5/3eRKEF5g4cfkYr7zAgBYXX5MIoM4A6cRGDN1cC44niqb/DHzMev5dcyuBYnG1lhq/jNe1hkIeXaTMI/Xmtz8+gDLnvG3omnWrgctW0UpUeHUzRCAP6hERQIhCGoMb/VT11aLI40ZH0Fz3YpeNOfame7CKMmLiL107i/etVSrj04+Fa5ASpXJB4iK7OS3BTGaeKYDUSdiBsp6Mlnc7G6iUaUI+fg0B42hl1h7Vsjtd+u6WCroiRyz+zpuVYGvEZ4dYbEb+uEtFi435kZvpUgl/5IB439G6AmvwbA6Uh1PKWfajWST937gUGqqItNlTM8D1zKMq8IrsTCF4uWq~-1~-1~-1; s_nr=1663212466130-Repeat; dayssincevisit=1663212466131; X-XSRF-TOKEN-ST=CfDJ8Jcj9GhlwkdBikuRYzfhrpLnLyLrXcKf4wpS54hFHt1dFKC-kwZMNbI8B1wxFM27SaJkTCscMA5RHdXIWXgoPPt052ZR3SRTkvUav2280jdwhGUicV-8ztCKtiJiZOe7HjcD6aHk_OtEc5Cvu6f1x4k; mbox=PC#0291a2b7236445348cd7444cf529fa6d.38_0#1726457271|session#c0bec165242b4d208b4aeab113a9e351#1663214331; utag_main=v_id:01806f18af75002231e952a32c6005074004706c00bd0$_sn:4$_se:31$_ss:0$_st:1663214270316$vapi_domain:ups.com$dc_visit:2$_prevpage:ups%3Aus%3Aen%3Atrack%3Bexp-1663215951827$_prevpageid:tracking%2FtrackWeb%2Ftra(3det).html%3Bexp-1663215951828$ses_id:1663210090526%3Bexp-session$_pn:16%3Bexp-session$fs_sample_user:undefined%3Bexp-session$dc_event:14%3Bexp-session$dc_region:ap-east-1%3Bexp-session; RT="z=1&dm=ups.com&si=67581ea4-0530-489b-9346-743c9fd446af&ss=l82ez1ok&sl=k&tt=tfu&bcn=%2F%2F684d0d4c.akstat.io%2F"; _abck=742CC5F19E21F4A55594EB91A3B179C6~-1~YAAQdetGaC/5mACDAQAAGmE0PwgaI2BjM7XC1v5bxLbnbSXEcXtWhjOBOHl2MY4cONldQGAfBKt57s1NwFQKRdxu3UhLysMNG09338z7Pgo6ibVJl4DH3EH5NvLA2wppjtLy9LRRjTxAQRxU2meMU8m7zgtx1Uwoa9G4Me9iJ26cIaI+UeMAjbkxFwiQCgeQgqlO68iAzPwlv8WfMFvvj1pivo84XMFhPst0SpLHRnK/tYw+/hVSHApsmYUeJpEA7jGQSQz23pmN/G/fVUYB6Es9G9j3WiKztiqft6+KwwGTCH5PVXTHqEVbiDZbliwWjaCBVP0cc2l7VNZQfHiK5xgOmEAaZPYOOBiFzp94dNzkFv4HKg133H8fOW0G4kA/bugVOmfyRzMIqHEYTtgERT2n~0~-1~-1',
                'origin: https://www.ups.com',
                'referer: https://www.ups.com/track?loc=en_US&tracknum=92748903029216543405818998&requester=ST/trackdetails',
                'sec-ch-ua: "Google Chrome";v="105", "Not)A;Brand";v="8", "Chromium";v="105"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Windows"',
                'sec-fetch-dest: empty',
                'sec-fetch-mode: cors',
                'sec-fetch-site: same-origin',
                'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36',
                'x-xsrf-token: CfDJ8Jcj9GhlwkdBikuRYzfhrpLnLyLrXcKf4wpS54hFHt1dFKC-kwZMNbI8B1wxFM27SaJkTCscMA5RHdXIWXgoPPt052ZR3SRTkvUav2280jdwhGUicV-8ztCKtiJiZOe7HjcD6aHk_OtEc5Cvu6f1x4k',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $tracking_id = json_decode($response, true);
        if ($tracking_id['trackDetails'] != null) {
            if ($tracking_id['trackDetails'][0]['errorCode'] != '504') {
                $progressBarType = $tracking_id['trackDetails'][0]['progressBarType'];
            } else {
                $progressBarType = 'tracking khac';
            }
        } else {
            $progressBarType = 'n0 fullfill';
        }
        return $progressBarType;
    }
    public function gettrackDhl($id)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.dhlecs.com/webtrack/v4/tracking',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"trackedValue":"' . $id . '","offset":0,"locale":"en-US","googleRecaptchaResponse":"03AEkXODCIYe1-8rI1ZQKe5AAU8fWT4zqHVNYRBsRd04PdAXvaJE15ZwVJ3nwvJCUO34r3yECbLshrHCszPtf_8eUbLbj4K5BkEvs5IcDQ5P4rG6q8cQgUPsb1tZku2vDb-r5ynlUNqd3sE01mtJ8mAPBELmtErbR8-BFGOz-QE2ZGi7zhH7cHegRynBP61K4Zl7AX5A-cGetBOuIAm6YAPcRZtCszEFtkkvfX6Z7KSPRzEZqJI1wv6wjqlfjNrhnAyCFjjR61CwBq4LIF0X81gAUs30pIvRtgZp-iQAHni7xmZqOIIlE799QSadvFVPvflk_Z_H57GXOmcjQp6yrKm0huMEYjRAzjELPsbi8dCmVyl5xn7xNvEJ_Qj7uTYm7zDZPTZftbtQ7XZ13lM1c2jvWeNH2EAkR6u-xJykoQMeryo3YfzUDPJ1fJOxVjPT3xGQCTnhj5oHjkkNMXjfO2YQFNCnQqWuVQ7hOzO4NJx5CoJl0N3UNgMg18P_aLZGcH6xjRlB18sn5HWoGvst2NTaqXdYJvKKjBrg"}',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Accept-Language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5',
                'Connection: keep-alive',
                'Content-Type: application/json',
                'Origin: https://webtrack.dhlglobalmail.com',
                'Referer: https://webtrack.dhlglobalmail.com/',
                'Sec-Fetch-Dest: empty',
                'Sec-Fetch-Mode: cors',
                'Sec-Fetch-Site: cross-site',
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36',
                'sec-ch-ua: "Google Chrome";v="107", "Chromium";v="107", "Not=A?Brand";v="24"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Windows"',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $tracking_id = json_decode($response, true);
        if ($tracking_id['total'] == 1) {
            if ($tracking_id['packages'] != '') {
                $progressBarType = $tracking_id['packages'][0]['status'];
            } else {
                $progressBarType = 'tracking khac';
            }
        } else {
            $progressBarType = 'n0 fullfill';
        }
        return $progressBarType;
    }
}
