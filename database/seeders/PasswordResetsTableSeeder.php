<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PasswordResetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('password_resets')->delete();
        
        \DB::table('password_resets')->insert(array (
            0 => 
            array (
                'created_at' => '2023-01-07 19:09:51',
                'email' => 'mbilalnaeem5@gmail.com',
                'token' => '0Lsskbep253V1YmRR8kxL9X6C9G6Zg7eaGcsH9nr9EqUS1U7KXsH4spfPa6CW0fC',
            ),
            1 => 
            array (
                'created_at' => '2023-05-03 17:18:40',
                'email' => 'sheddy@gmail.com',
                'token' => '5qeHJplSZrXUTLnfYJFvi4L0B2ZOSgCULdCxhpTa2Jk3NqsnUsMf0Eggl3VIsA5T',
            ),
            2 => 
            array (
                'created_at' => '2023-10-02 19:56:40',
                'email' => 'jack@gmail.com',
                'token' => '9p14etPUEKg28hxFOQzh3Oa6aJfVUGh8U27bFZSfNFzitBKPfioymdWAQ8KMiXsC',
            ),
            3 => 
            array (
                'created_at' => '2023-10-04 16:07:57',
                'email' => 'mono@gmail.com',
                'token' => 'qIdE74VKqISwjoE4WLrVvY2zoIMwtF9XcpWAMxt5FK9ezlu8V28SNWwgoCndEMC5',
            ),
            4 => 
            array (
                'created_at' => '2023-10-12 12:42:43',
                'email' => 'ahsan.mono@gmail.com',
                'token' => 'wnfiEJBbe9AmfCqehWKHtKKnkG6Xr9GN2vZ7DOP7itXtel6dG0Tdje27DgXZhTy5',
            ),
            5 => 
            array (
                'created_at' => '2023-12-25 08:32:58',
                'email' => 'pnam749@gmail.com',
                'token' => 'QvizsLfK3Q89azUutlsmI8Gzbs41Ei2pyYUdkrsFb33qgqpNOJbxJwb3HzcH5baU',
            ),
            6 => 
            array (
                'created_at' => '2023-12-25 13:48:03',
                'email' => 'nhatnhinho321@gmail.com',
                'token' => 'q93OaZLiOu8B7Y546ISwt9CKQyUoNghsoHZsmiA6U8s5Z7NXS4c4sl7cP37P4nZG',
            ),
            7 => 
            array (
                'created_at' => '2024-01-04 12:08:14',
                'email' => 'thaikhanhha.tdtu@gmail.com',
                'token' => 'cQVcwV0Yhwb37xG2VLoBs4UJaGDICU0HMU0fWoCgm1RuPYvkUzT4TerOOQGo5cfo',
            ),
            8 => 
            array (
                'created_at' => '2024-01-04 12:17:19',
                'email' => 'nhatmeo2102@gmail.com',
                'token' => 'y9akG9LZmLabVqGRcMtuhJfbFm0rWemnhsHqJiYQO0B7BhwwV8D8I0d0b9CwpvtQ',
            ),
            9 => 
            array (
                'created_at' => '2024-01-08 08:04:20',
                'email' => 'nhat62480@gmail.com',
                'token' => 'v4w19D8Frjn0ZwZAhowrxnU98cya2k8Fw4HKEGDX5pfD2nq9kWRIssS0BfklvWID',
            ),
            10 => 
            array (
                'created_at' => '2024-04-01 15:41:22',
                'email' => 'mramir401@gmail.com',
                'token' => 'xDcpZsLDyBqgydbU6JxgOy6ftfZHM8DUTNwehb8FRtBNHY41WGO5DSq3decJBebu',
            ),
        ));
        
        
    }
}