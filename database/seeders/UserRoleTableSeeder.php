<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_role')->delete();
        
        \DB::table('user_role')->insert(array (
            0 => 
            array (
                'id' => 1915,
                'role_code' => 'super_admin',
                'user_id' => 1,
            ),
            1 => 
            array (
                'id' => 1925,
                'role_code' => 'lawyer',
                'user_id' => 258,
            ),
            2 => 
            array (
                'id' => 1926,
                'role_code' => 'lawyer',
                'user_id' => 259,
            ),
            3 => 
            array (
                'id' => 1927,
                'role_code' => 'lawyer',
                'user_id' => 260,
            ),
            4 => 
            array (
                'id' => 1928,
                'role_code' => 'lawyer',
                'user_id' => 261,
            ),
            5 => 
            array (
                'id' => 1929,
                'role_code' => 'customer',
                'user_id' => 262,
            ),
            6 => 
            array (
                'id' => 1930,
                'role_code' => 'lawyer',
                'user_id' => 263,
            ),
            7 => 
            array (
                'id' => 1931,
                'role_code' => 'customer',
                'user_id' => 264,
            ),
            8 => 
            array (
                'id' => 1932,
                'role_code' => 'customer',
                'user_id' => 265,
            ),
            9 => 
            array (
                'id' => 1933,
                'role_code' => 'lawyer',
                'user_id' => 266,
            ),
            10 => 
            array (
                'id' => 1934,
                'role_code' => 'customer',
                'user_id' => 248,
            ),
            11 => 
            array (
                'id' => 1935,
                'role_code' => 'customer',
                'user_id' => 267,
            ),
            12 => 
            array (
                'id' => 1936,
                'role_code' => 'lawyer',
                'user_id' => 267,
            ),
            13 => 
            array (
                'id' => 1937,
                'role_code' => 'law_firm',
                'user_id' => 268,
            ),
            14 => 
            array (
                'id' => 1938,
                'role_code' => 'law_firm',
                'user_id' => 269,
            ),
            15 => 
            array (
                'id' => 1939,
                'role_code' => 'lawyer',
                'user_id' => 269,
            ),
            16 => 
            array (
                'id' => 1940,
                'role_code' => 'customer',
                'user_id' => 269,
            ),
            17 => 
            array (
                'id' => 1941,
                'role_code' => 'law_firm',
                'user_id' => 270,
            ),
            18 => 
            array (
                'id' => 1942,
                'role_code' => 'law_firm',
                'user_id' => 271,
            ),
            19 => 
            array (
                'id' => 1943,
                'role_code' => 'law_firm',
                'user_id' => 272,
            ),
            20 => 
            array (
                'id' => 1944,
                'role_code' => 'law_firm',
                'user_id' => 273,
            ),
            21 => 
            array (
                'id' => 1945,
                'role_code' => 'lawyer',
                'user_id' => 274,
            ),
            22 => 
            array (
                'id' => 1946,
                'role_code' => 'law_firm',
                'user_id' => 275,
            ),
            23 => 
            array (
                'id' => 1947,
                'role_code' => 'customer',
                'user_id' => 276,
            ),
            24 => 
            array (
                'id' => 1948,
                'role_code' => 'lawyer',
                'user_id' => 276,
            ),
            25 => 
            array (
                'id' => 1949,
                'role_code' => 'customer',
                'user_id' => 277,
            ),
            26 => 
            array (
                'id' => 1950,
                'role_code' => 'customer',
                'user_id' => 278,
            ),
            27 => 
            array (
                'id' => 1951,
                'role_code' => 'customer',
                'user_id' => 279,
            ),
            28 => 
            array (
                'id' => 1952,
                'role_code' => 'law_firm',
                'user_id' => 280,
            ),
            29 => 
            array (
                'id' => 1953,
                'role_code' => 'customer',
                'user_id' => 281,
            ),
            30 => 
            array (
                'id' => 1954,
                'role_code' => 'customer',
                'user_id' => 282,
            ),
            31 => 
            array (
                'id' => 1955,
                'role_code' => 'law_firm',
                'user_id' => 283,
            ),
            32 => 
            array (
                'id' => 1956,
                'role_code' => 'customer',
                'user_id' => 284,
            ),
            33 => 
            array (
                'id' => 1957,
                'role_code' => 'lawyer',
                'user_id' => 284,
            ),
            34 => 
            array (
                'id' => 1958,
                'role_code' => 'lawyer',
                'user_id' => 285,
            ),
            35 => 
            array (
                'id' => 1959,
                'role_code' => 'lawyer',
                'user_id' => 286,
            ),
            36 => 
            array (
                'id' => 1960,
                'role_code' => 'lawyer',
                'user_id' => 287,
            ),
            37 => 
            array (
                'id' => 1961,
                'role_code' => 'lawyer',
                'user_id' => 288,
            ),
            38 => 
            array (
                'id' => 1962,
                'role_code' => 'customer',
                'user_id' => 289,
            ),
            39 => 
            array (
                'id' => 1963,
                'role_code' => 'law_firm',
                'user_id' => 290,
            ),
            40 => 
            array (
                'id' => 1964,
                'role_code' => 'law_firm',
                'user_id' => 289,
            ),
            41 => 
            array (
                'id' => 1965,
                'role_code' => 'lawyer',
                'user_id' => 289,
            ),
            42 => 
            array (
                'id' => 1966,
                'role_code' => 'customer',
                'user_id' => 291,
            ),
            43 => 
            array (
                'id' => 1967,
                'role_code' => 'law_firm',
                'user_id' => 291,
            ),
            44 => 
            array (
                'id' => 1968,
                'role_code' => 'lawyer',
                'user_id' => 292,
            ),
            45 => 
            array (
                'id' => 1969,
                'role_code' => 'law_firm',
                'user_id' => 292,
            ),
            46 => 
            array (
                'id' => 1970,
                'role_code' => 'customer',
                'user_id' => 292,
            ),
            47 => 
            array (
                'id' => 1971,
                'role_code' => 'lawyer',
                'user_id' => 293,
            ),
            48 => 
            array (
                'id' => 1972,
                'role_code' => 'customer',
                'user_id' => 293,
            ),
            49 => 
            array (
                'id' => 1973,
                'role_code' => 'customer',
                'user_id' => 259,
            ),
            50 => 
            array (
                'id' => 1974,
                'role_code' => 'law_firm',
                'user_id' => 259,
            ),
            51 => 
            array (
                'id' => 1975,
                'role_code' => 'customer',
                'user_id' => 274,
            ),
            52 => 
            array (
                'id' => 1976,
                'role_code' => 'lawyer',
                'user_id' => 294,
            ),
            53 => 
            array (
                'id' => 1977,
                'role_code' => 'law_firm',
                'user_id' => 294,
            ),
            54 => 
            array (
                'id' => 1978,
                'role_code' => 'law_firm',
                'user_id' => 295,
            ),
            55 => 
            array (
                'id' => 1979,
                'role_code' => 'lawyer',
                'user_id' => 295,
            ),
            56 => 
            array (
                'id' => 1980,
                'role_code' => 'lawyer',
                'user_id' => 296,
            ),
            57 => 
            array (
                'id' => 1981,
                'role_code' => 'lawyer',
                'user_id' => 265,
            ),
            58 => 
            array (
                'id' => 1982,
                'role_code' => 'lawyer',
                'user_id' => 297,
            ),
            59 => 
            array (
                'id' => 1983,
                'role_code' => 'customer',
                'user_id' => 298,
            ),
            60 => 
            array (
                'id' => 1984,
                'role_code' => 'customer',
                'user_id' => 299,
            ),
            61 => 
            array (
                'id' => 1985,
                'role_code' => 'customer',
                'user_id' => 300,
            ),
            62 => 
            array (
                'id' => 1986,
                'role_code' => 'customer',
                'user_id' => 301,
            ),
            63 => 
            array (
                'id' => 1987,
                'role_code' => 'customer',
                'user_id' => 302,
            ),
            64 => 
            array (
                'id' => 1988,
                'role_code' => 'customer',
                'user_id' => 303,
            ),
            65 => 
            array (
                'id' => 1989,
                'role_code' => 'customer',
                'user_id' => 304,
            ),
            66 => 
            array (
                'id' => 1990,
                'role_code' => 'customer',
                'user_id' => 305,
            ),
            67 => 
            array (
                'id' => 1991,
                'role_code' => 'lawyer',
                'user_id' => 306,
            ),
            68 => 
            array (
                'id' => 1992,
                'role_code' => 'lawyer',
                'user_id' => 307,
            ),
            69 => 
            array (
                'id' => 1993,
                'role_code' => 'customer',
                'user_id' => 2,
            ),
            70 => 
            array (
                'id' => 1994,
                'role_code' => 'lawyer',
                'user_id' => 2,
            ),
            71 => 
            array (
                'id' => 1995,
                'role_code' => 'lawyer',
                'user_id' => 3,
            ),
            72 => 
            array (
                'id' => 1996,
                'role_code' => 'customer',
                'user_id' => 4,
            ),
            73 => 
            array (
                'id' => 1997,
                'role_code' => 'lawyer',
                'user_id' => 5,
            ),
            74 => 
            array (
                'id' => 1998,
                'role_code' => 'lawyer',
                'user_id' => 6,
            ),
            75 => 
            array (
                'id' => 1999,
                'role_code' => 'lawyer',
                'user_id' => 7,
            ),
            76 => 
            array (
                'id' => 2000,
                'role_code' => 'lawyer',
                'user_id' => 8,
            ),
            77 => 
            array (
                'id' => 2001,
                'role_code' => 'lawyer',
                'user_id' => 9,
            ),
            78 => 
            array (
                'id' => 2002,
                'role_code' => 'lawyer',
                'user_id' => 6,
            ),
            79 => 
            array (
                'id' => 2003,
                'role_code' => 'lawyer',
                'user_id' => 10,
            ),
            80 => 
            array (
                'id' => 2004,
                'role_code' => 'lawyer',
                'user_id' => 11,
            ),
            81 => 
            array (
                'id' => 2005,
                'role_code' => 'lawyer',
                'user_id' => 12,
            ),
            82 => 
            array (
                'id' => 2006,
                'role_code' => 'lawyer',
                'user_id' => 13,
            ),
            83 => 
            array (
                'id' => 2007,
                'role_code' => 'lawyer',
                'user_id' => 14,
            ),
            84 => 
            array (
                'id' => 2008,
                'role_code' => 'lawyer',
                'user_id' => 15,
            ),
            85 => 
            array (
                'id' => 2009,
                'role_code' => 'lawyer',
                'user_id' => 16,
            ),
            86 => 
            array (
                'id' => 2010,
                'role_code' => 'lawyer',
                'user_id' => 17,
            ),
            87 => 
            array (
                'id' => 2011,
                'role_code' => 'law_firm',
                'user_id' => 17,
            ),
            88 => 
            array (
                'id' => 2012,
                'role_code' => 'customer',
                'user_id' => 18,
            ),
            89 => 
            array (
                'id' => 2013,
                'role_code' => 'lawyer',
                'user_id' => 18,
            ),
            90 => 
            array (
                'id' => 2014,
                'role_code' => 'lawyer',
                'user_id' => 18,
            ),
            91 => 
            array (
                'id' => 2015,
                'role_code' => 'customer',
                'user_id' => 19,
            ),
            92 => 
            array (
                'id' => 2016,
                'role_code' => 'customer',
                'user_id' => 17,
            ),
            93 => 
            array (
                'id' => 2017,
                'role_code' => 'customer',
                'user_id' => 16,
            ),
            94 => 
            array (
                'id' => 2018,
                'role_code' => 'lawyer',
                'user_id' => 19,
            ),
            95 => 
            array (
                'id' => 2019,
                'role_code' => 'law_firm',
                'user_id' => 19,
            ),
            96 => 
            array (
                'id' => 2020,
                'role_code' => 'customer',
                'user_id' => 20,
            ),
            97 => 
            array (
                'id' => 2021,
                'role_code' => 'lawyer',
                'user_id' => 21,
            ),
            98 => 
            array (
                'id' => 2022,
                'role_code' => 'customer',
                'user_id' => 22,
            ),
            99 => 
            array (
                'id' => 2023,
                'role_code' => 'law_firm',
                'user_id' => 23,
            ),
        ));
        \DB::table('user_role')->insert(array (
            0 => 
            array (
                'id' => 2024,
                'role_code' => 'law_firm',
                'user_id' => 24,
            ),
            1 => 
            array (
                'id' => 2025,
                'role_code' => 'lawyer',
                'user_id' => 24,
            ),
            2 => 
            array (
                'id' => 2026,
                'role_code' => 'law_firm',
                'user_id' => 25,
            ),
            3 => 
            array (
                'id' => 2027,
                'role_code' => 'lawyer',
                'user_id' => 26,
            ),
            4 => 
            array (
                'id' => 2028,
                'role_code' => 'law_firm',
                'user_id' => 27,
            ),
            5 => 
            array (
                'id' => 2029,
                'role_code' => 'lawyer',
                'user_id' => 28,
            ),
            6 => 
            array (
                'id' => 2030,
                'role_code' => 'lawyer',
                'user_id' => 29,
            ),
            7 => 
            array (
                'id' => 2031,
                'role_code' => 'lawyer',
                'user_id' => 30,
            ),
            8 => 
            array (
                'id' => 2032,
                'role_code' => 'lawyer',
                'user_id' => 31,
            ),
            9 => 
            array (
                'id' => 2033,
                'role_code' => 'lawyer',
                'user_id' => 32,
            ),
            10 => 
            array (
                'id' => 2034,
                'role_code' => 'lawyer',
                'user_id' => 33,
            ),
            11 => 
            array (
                'id' => 2035,
                'role_code' => 'lawyer',
                'user_id' => 34,
            ),
            12 => 
            array (
                'id' => 2036,
                'role_code' => 'lawyer',
                'user_id' => 35,
            ),
            13 => 
            array (
                'id' => 2037,
                'role_code' => 'lawyer',
                'user_id' => 36,
            ),
            14 => 
            array (
                'id' => 2038,
                'role_code' => 'lawyer',
                'user_id' => 37,
            ),
            15 => 
            array (
                'id' => 2039,
                'role_code' => 'law_firm',
                'user_id' => 36,
            ),
            16 => 
            array (
                'id' => 2040,
                'role_code' => 'lawyer',
                'user_id' => 4,
            ),
            17 => 
            array (
                'id' => 2041,
                'role_code' => 'law_firm',
                'user_id' => 4,
            ),
            18 => 
            array (
                'id' => 2042,
                'role_code' => 'lawyer',
                'user_id' => 38,
            ),
            19 => 
            array (
                'id' => 2043,
                'role_code' => 'lawyer',
                'user_id' => 39,
            ),
            20 => 
            array (
                'id' => 2045,
                'role_code' => 'lawyer',
                'user_id' => 41,
            ),
            21 => 
            array (
                'id' => 2048,
                'role_code' => 'lawyer',
                'user_id' => 43,
            ),
            22 => 
            array (
                'id' => 2049,
                'role_code' => 'law_firm',
                'user_id' => 25,
            ),
            23 => 
            array (
                'id' => 2050,
                'role_code' => 'lawyer',
                'user_id' => 44,
            ),
            24 => 
            array (
                'id' => 2051,
                'role_code' => 'customer',
                'user_id' => 45,
            ),
            25 => 
            array (
                'id' => 2052,
                'role_code' => 'lawyer',
                'user_id' => 46,
            ),
            26 => 
            array (
                'id' => 2053,
                'role_code' => 'law_firm',
                'user_id' => 46,
            ),
            27 => 
            array (
                'id' => 2054,
                'role_code' => 'customer',
                'user_id' => 46,
            ),
            28 => 
            array (
                'id' => 2055,
                'role_code' => 'lawyer',
                'user_id' => 47,
            ),
            29 => 
            array (
                'id' => 2056,
                'role_code' => 'customer',
                'user_id' => 48,
            ),
            30 => 
            array (
                'id' => 2057,
                'role_code' => 'customer',
                'user_id' => 49,
            ),
            31 => 
            array (
                'id' => 2058,
                'role_code' => 'lawyer',
                'user_id' => 50,
            ),
            32 => 
            array (
                'id' => 2059,
                'role_code' => 'law_firm',
                'user_id' => 51,
            ),
            33 => 
            array (
                'id' => 2060,
                'role_code' => 'lawyer',
                'user_id' => 52,
            ),
            34 => 
            array (
                'id' => 2061,
                'role_code' => 'lawyer',
                'user_id' => 51,
            ),
            35 => 
            array (
                'id' => 2062,
                'role_code' => 'lawyer',
                'user_id' => 53,
            ),
            36 => 
            array (
                'id' => 2063,
                'role_code' => 'law_firm',
                'user_id' => 53,
            ),
            37 => 
            array (
                'id' => 2064,
                'role_code' => 'customer',
                'user_id' => 53,
            ),
            38 => 
            array (
                'id' => 2065,
                'role_code' => 'customer',
                'user_id' => 54,
            ),
            39 => 
            array (
                'id' => 2066,
                'role_code' => 'customer',
                'user_id' => 55,
            ),
            40 => 
            array (
                'id' => 2067,
                'role_code' => 'lawyer',
                'user_id' => 55,
            ),
            41 => 
            array (
                'id' => 2068,
                'role_code' => 'law_firm',
                'user_id' => 55,
            ),
            42 => 
            array (
                'id' => 2069,
                'role_code' => 'lawyer',
                'user_id' => 56,
            ),
            43 => 
            array (
                'id' => 2070,
                'role_code' => 'customer',
                'user_id' => 56,
            ),
            44 => 
            array (
                'id' => 2071,
                'role_code' => 'customer',
                'user_id' => 57,
            ),
            45 => 
            array (
                'id' => 2072,
                'role_code' => 'lawyer',
                'user_id' => 57,
            ),
            46 => 
            array (
                'id' => 2073,
                'role_code' => 'lawyer',
                'user_id' => 58,
            ),
            47 => 
            array (
                'id' => 2074,
                'role_code' => 'law_firm',
                'user_id' => 58,
            ),
            48 => 
            array (
                'id' => 2075,
                'role_code' => 'law_firm',
                'user_id' => 57,
            ),
            49 => 
            array (
                'id' => 2076,
                'role_code' => 'lawyer',
                'user_id' => 59,
            ),
            50 => 
            array (
                'id' => 2077,
                'role_code' => 'lawyer',
                'user_id' => 60,
            ),
            51 => 
            array (
                'id' => 2078,
                'role_code' => 'customer',
                'user_id' => 58,
            ),
            52 => 
            array (
                'id' => 2079,
                'role_code' => 'customer',
                'user_id' => 61,
            ),
            53 => 
            array (
                'id' => 2080,
                'role_code' => 'lawyer',
                'user_id' => 62,
            ),
            54 => 
            array (
                'id' => 2081,
                'role_code' => 'customer',
                'user_id' => 63,
            ),
            55 => 
            array (
                'id' => 2082,
                'role_code' => 'lawyer',
                'user_id' => 22,
            ),
            56 => 
            array (
                'id' => 2083,
                'role_code' => 'customer',
                'user_id' => 64,
            ),
            57 => 
            array (
                'id' => 2084,
                'role_code' => 'law_firm',
                'user_id' => 65,
            ),
            58 => 
            array (
                'id' => 2085,
                'role_code' => 'lawyer',
                'user_id' => 65,
            ),
            59 => 
            array (
                'id' => 2086,
                'role_code' => 'customer',
                'user_id' => 65,
            ),
            60 => 
            array (
                'id' => 2087,
                'role_code' => 'customer',
                'user_id' => 66,
            ),
            61 => 
            array (
                'id' => 2088,
                'role_code' => 'customer',
                'user_id' => 67,
            ),
            62 => 
            array (
                'id' => 2089,
                'role_code' => 'customer',
                'user_id' => 68,
            ),
            63 => 
            array (
                'id' => 2090,
                'role_code' => 'lawyer',
                'user_id' => 69,
            ),
            64 => 
            array (
                'id' => 2091,
                'role_code' => 'customer',
                'user_id' => 70,
            ),
            65 => 
            array (
                'id' => 2092,
                'role_code' => 'lawyer',
                'user_id' => 71,
            ),
            66 => 
            array (
                'id' => 2093,
                'role_code' => 'lawyer',
                'user_id' => 72,
            ),
            67 => 
            array (
                'id' => 2094,
                'role_code' => 'customer',
                'user_id' => 73,
            ),
            68 => 
            array (
                'id' => 2095,
                'role_code' => 'lawyer',
                'user_id' => 74,
            ),
            69 => 
            array (
                'id' => 2096,
                'role_code' => 'lawyer',
                'user_id' => 75,
            ),
            70 => 
            array (
                'id' => 2097,
                'role_code' => 'customer',
                'user_id' => 76,
            ),
            71 => 
            array (
                'id' => 2098,
                'role_code' => 'customer',
                'user_id' => 77,
            ),
            72 => 
            array (
                'id' => 2099,
                'role_code' => 'lawyer',
                'user_id' => 78,
            ),
            73 => 
            array (
                'id' => 2100,
                'role_code' => 'customer',
                'user_id' => 79,
            ),
            74 => 
            array (
                'id' => 2101,
                'role_code' => 'lawyer',
                'user_id' => 80,
            ),
            75 => 
            array (
                'id' => 2102,
                'role_code' => 'lawyer',
                'user_id' => 81,
            ),
            76 => 
            array (
                'id' => 2103,
                'role_code' => 'lawyer',
                'user_id' => 82,
            ),
            77 => 
            array (
                'id' => 2104,
                'role_code' => 'customer',
                'user_id' => 83,
            ),
            78 => 
            array (
                'id' => 2105,
                'role_code' => 'customer',
                'user_id' => 84,
            ),
            79 => 
            array (
                'id' => 2106,
                'role_code' => 'lawyer',
                'user_id' => 85,
            ),
            80 => 
            array (
                'id' => 2107,
                'role_code' => 'customer',
                'user_id' => 86,
            ),
            81 => 
            array (
                'id' => 2108,
                'role_code' => 'customer',
                'user_id' => 87,
            ),
            82 => 
            array (
                'id' => 2109,
                'role_code' => 'lawyer',
                'user_id' => 88,
            ),
            83 => 
            array (
                'id' => 2110,
                'role_code' => 'customer',
                'user_id' => 89,
            ),
            84 => 
            array (
                'id' => 2111,
                'role_code' => 'lawyer',
                'user_id' => 90,
            ),
            85 => 
            array (
                'id' => 2112,
                'role_code' => 'customer',
                'user_id' => 97,
            ),
            86 => 
            array (
                'id' => 2113,
                'role_code' => 'customer',
                'user_id' => 36,
            ),
            87 => 
            array (
                'id' => 2114,
                'role_code' => 'customer',
                'user_id' => 99,
            ),
            88 => 
            array (
                'id' => 2115,
                'role_code' => 'customer',
                'user_id' => 100,
            ),
            89 => 
            array (
                'id' => 2116,
                'role_code' => 'customer',
                'user_id' => 102,
            ),
            90 => 
            array (
                'id' => 2117,
                'role_code' => 'customer',
                'user_id' => 103,
            ),
            91 => 
            array (
                'id' => 2118,
                'role_code' => 'lawyer',
                'user_id' => 104,
            ),
            92 => 
            array (
                'id' => 2119,
                'role_code' => 'customer',
                'user_id' => 105,
            ),
            93 => 
            array (
                'id' => 2120,
                'role_code' => 'customer',
                'user_id' => 107,
            ),
            94 => 
            array (
                'id' => 2121,
                'role_code' => 'lawyer',
                'user_id' => 109,
            ),
            95 => 
            array (
                'id' => 2122,
                'role_code' => 'customer',
                'user_id' => 110,
            ),
            96 => 
            array (
                'id' => 2123,
                'role_code' => 'customer',
                'user_id' => 113,
            ),
            97 => 
            array (
                'id' => 2124,
                'role_code' => 'lawyer',
                'user_id' => 114,
            ),
            98 => 
            array (
                'id' => 2125,
                'role_code' => 'customer',
                'user_id' => 115,
            ),
            99 => 
            array (
                'id' => 2126,
                'role_code' => 'customer',
                'user_id' => 117,
            ),
        ));
        \DB::table('user_role')->insert(array (
            0 => 
            array (
                'id' => 2127,
                'role_code' => 'lawyer',
                'user_id' => 118,
            ),
            1 => 
            array (
                'id' => 2128,
                'role_code' => 'lawyer',
                'user_id' => 119,
            ),
            2 => 
            array (
                'id' => 2129,
                'role_code' => 'customer',
                'user_id' => 120,
            ),
            3 => 
            array (
                'id' => 2130,
                'role_code' => 'lawyer',
                'user_id' => 121,
            ),
            4 => 
            array (
                'id' => 2131,
                'role_code' => 'lawyer',
                'user_id' => 122,
            ),
            5 => 
            array (
                'id' => 2132,
                'role_code' => 'lawyer',
                'user_id' => 123,
            ),
            6 => 
            array (
                'id' => 2133,
                'role_code' => 'customer',
                'user_id' => 124,
            ),
            7 => 
            array (
                'id' => 2134,
                'role_code' => 'lawyer',
                'user_id' => 125,
            ),
            8 => 
            array (
                'id' => 2135,
                'role_code' => 'lawyer',
                'user_id' => 126,
            ),
            9 => 
            array (
                'id' => 2136,
                'role_code' => 'lawyer',
                'user_id' => 127,
            ),
            10 => 
            array (
                'id' => 2137,
                'role_code' => 'customer',
                'user_id' => 128,
            ),
            11 => 
            array (
                'id' => 2138,
                'role_code' => 'customer',
                'user_id' => 129,
            ),
            12 => 
            array (
                'id' => 2139,
                'role_code' => 'customer',
                'user_id' => 130,
            ),
            13 => 
            array (
                'id' => 2140,
                'role_code' => 'lawyer',
                'user_id' => 131,
            ),
            14 => 
            array (
                'id' => 2141,
                'role_code' => 'lawyer',
                'user_id' => 132,
            ),
            15 => 
            array (
                'id' => 2142,
                'role_code' => 'customer',
                'user_id' => 133,
            ),
            16 => 
            array (
                'id' => 2143,
                'role_code' => 'lawyer',
                'user_id' => 134,
            ),
            17 => 
            array (
                'id' => 2144,
                'role_code' => 'law_firm',
                'user_id' => 134,
            ),
            18 => 
            array (
                'id' => 2145,
                'role_code' => 'lawyer',
                'user_id' => 135,
            ),
            19 => 
            array (
                'id' => 2146,
                'role_code' => 'customer',
                'user_id' => 136,
            ),
            20 => 
            array (
                'id' => 2147,
                'role_code' => 'customer',
                'user_id' => 137,
            ),
            21 => 
            array (
                'id' => 2148,
                'role_code' => 'customer',
                'user_id' => 138,
            ),
            22 => 
            array (
                'id' => 2149,
                'role_code' => 'lawyer',
                'user_id' => 139,
            ),
            23 => 
            array (
                'id' => 2150,
                'role_code' => 'customer',
                'user_id' => 140,
            ),
            24 => 
            array (
                'id' => 2151,
                'role_code' => 'lawyer',
                'user_id' => 141,
            ),
            25 => 
            array (
                'id' => 2152,
                'role_code' => 'customer',
                'user_id' => 142,
            ),
            26 => 
            array (
                'id' => 2153,
                'role_code' => 'customer',
                'user_id' => 143,
            ),
            27 => 
            array (
                'id' => 2154,
                'role_code' => 'lawyer',
                'user_id' => 144,
            ),
            28 => 
            array (
                'id' => 2155,
                'role_code' => 'customer',
                'user_id' => 145,
            ),
            29 => 
            array (
                'id' => 2156,
                'role_code' => 'customer',
                'user_id' => 146,
            ),
            30 => 
            array (
                'id' => 2157,
                'role_code' => 'lawyer',
                'user_id' => 147,
            ),
            31 => 
            array (
                'id' => 2158,
                'role_code' => 'lawyer',
                'user_id' => 148,
            ),
        ));
        
        
    }
}