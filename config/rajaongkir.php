<?php

return [

    /*
    |--------------------------------------------------------------------------
    | End Point Api ( Konfigurasi Server Akun )
    |--------------------------------------------------------------------------
    |
    | Starter : http://rajaongkir.com/api/starter
    | Basic : http://rajaongkir.com/api/basic
    | Pro : http://pro.rajaongkir.com/api
    |
    */

    'end_point_api' => env('RAJAONGKIR_ENDPOINTAPI', 'https://rajaongkir.com/api/starter'),

    /*
    |--------------------------------------------------------------------------
    | Api key
    |--------------------------------------------------------------------------
    |
    | Isi dengan api key yang didapatkan dari rajaongkir
    |
    */

    'api_key' => env('RAJAONGKIR_APIKEY', '06879f55636d4856b2afbf7444e4b024'),
];
