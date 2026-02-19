<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrencyCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('currency_codes')->delete();
        
        \DB::table('currency_codes')->insert(array (
            0 => 
            array (
                'code' => 'ALL',
                'id' => 1,
                'symbol' => 'Lek',
            ),
            1 => 
            array (
                'code' => 'USD',
                'id' => 2,
                'symbol' => '$',
            ),
            2 => 
            array (
                'code' => 'AFN',
                'id' => 3,
                'symbol' => '?',
            ),
            3 => 
            array (
                'code' => 'ARS',
                'id' => 4,
                'symbol' => '$',
            ),
            4 => 
            array (
                'code' => 'AWG',
                'id' => 5,
                'symbol' => 'ƒ',
            ),
            5 => 
            array (
                'code' => 'AUD',
                'id' => 6,
                'symbol' => '$',
            ),
            6 => 
            array (
                'code' => 'AZN',
                'id' => 7,
                'symbol' => '???',
            ),
            7 => 
            array (
                'code' => 'BSD',
                'id' => 8,
                'symbol' => '$',
            ),
            8 => 
            array (
                'code' => 'BBD',
                'id' => 9,
                'symbol' => '$',
            ),
            9 => 
            array (
                'code' => 'BYR',
                'id' => 10,
                'symbol' => 'p.',
            ),
            10 => 
            array (
                'code' => 'EUR',
                'id' => 11,
                'symbol' => '€',
            ),
            11 => 
            array (
                'code' => 'BZD',
                'id' => 12,
                'symbol' => 'BZ$',
            ),
            12 => 
            array (
                'code' => 'BMD',
                'id' => 13,
                'symbol' => '$',
            ),
            13 => 
            array (
                'code' => 'BOB',
                'id' => 14,
                'symbol' => '$b',
            ),
            14 => 
            array (
                'code' => 'BAM',
                'id' => 15,
                'symbol' => 'KM',
            ),
            15 => 
            array (
                'code' => 'BWP',
                'id' => 16,
                'symbol' => 'P',
            ),
            16 => 
            array (
                'code' => 'BGN',
                'id' => 17,
                'symbol' => '??',
            ),
            17 => 
            array (
                'code' => 'BRL',
                'id' => 18,
                'symbol' => 'R$',
            ),
            18 => 
            array (
                'code' => 'GBP',
                'id' => 19,
                'symbol' => '£',
            ),
            19 => 
            array (
                'code' => 'BND',
                'id' => 20,
                'symbol' => '$',
            ),
            20 => 
            array (
                'code' => 'KHR',
                'id' => 21,
                'symbol' => '?',
            ),
            21 => 
            array (
                'code' => 'CAD',
                'id' => 22,
                'symbol' => '$',
            ),
            22 => 
            array (
                'code' => 'KYD',
                'id' => 23,
                'symbol' => '$',
            ),
            23 => 
            array (
                'code' => 'CLP',
                'id' => 24,
                'symbol' => '$',
            ),
            24 => 
            array (
                'code' => 'CNY',
                'id' => 25,
                'symbol' => '¥',
            ),
            25 => 
            array (
                'code' => 'COP',
                'id' => 26,
                'symbol' => '$',
            ),
            26 => 
            array (
                'code' => 'CRC',
                'id' => 27,
                'symbol' => '?',
            ),
            27 => 
            array (
                'code' => 'HRK',
                'id' => 28,
                'symbol' => 'kn',
            ),
            28 => 
            array (
                'code' => 'CUP',
                'id' => 29,
                'symbol' => '?',
            ),
            29 => 
            array (
                'code' => 'EUR',
                'id' => 30,
                'symbol' => '€',
            ),
            30 => 
            array (
                'code' => 'CZK',
                'id' => 31,
                'symbol' => 'K?',
            ),
            31 => 
            array (
                'code' => 'DKK',
                'id' => 32,
                'symbol' => 'kr',
            ),
            32 => 
            array (
                'code' => 'DOP ',
                'id' => 33,
                'symbol' => 'RD$',
            ),
            33 => 
            array (
                'code' => 'XCD',
                'id' => 34,
                'symbol' => '$',
            ),
            34 => 
            array (
                'code' => 'EGP',
                'id' => 35,
                'symbol' => '£',
            ),
            35 => 
            array (
                'code' => 'SVC',
                'id' => 36,
                'symbol' => '$',
            ),
            36 => 
            array (
                'code' => 'GBP',
                'id' => 37,
                'symbol' => '£',
            ),
            37 => 
            array (
                'code' => 'EUR',
                'id' => 38,
                'symbol' => '€',
            ),
            38 => 
            array (
                'code' => 'FKP',
                'id' => 39,
                'symbol' => '£',
            ),
            39 => 
            array (
                'code' => 'FJD',
                'id' => 40,
                'symbol' => '$',
            ),
            40 => 
            array (
                'code' => 'EUR',
                'id' => 41,
                'symbol' => '€',
            ),
            41 => 
            array (
                'code' => 'GHC',
                'id' => 42,
                'symbol' => '¢',
            ),
            42 => 
            array (
                'code' => 'GIP',
                'id' => 43,
                'symbol' => '£',
            ),
            43 => 
            array (
                'code' => 'EUR',
                'id' => 44,
                'symbol' => '€',
            ),
            44 => 
            array (
                'code' => 'GTQ',
                'id' => 45,
                'symbol' => 'Q',
            ),
            45 => 
            array (
                'code' => 'GGP',
                'id' => 46,
                'symbol' => '£',
            ),
            46 => 
            array (
                'code' => 'GYD',
                'id' => 47,
                'symbol' => '$',
            ),
            47 => 
            array (
                'code' => 'EUR',
                'id' => 48,
                'symbol' => '€',
            ),
            48 => 
            array (
                'code' => 'HNL',
                'id' => 49,
                'symbol' => 'L',
            ),
            49 => 
            array (
                'code' => 'INR',
                'id' => 50,
                'symbol' => '₹',
            ),
        ));
        
        
    }
}