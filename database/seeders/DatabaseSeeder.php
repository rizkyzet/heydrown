<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('roles')->insert([[
            'nama' => 'admin',

        ], [
            'nama' => 'pelanggan'
        ]]);

        DB::table('users')->insert([
            'name' => 'Mochamad Rizky',
            'email' => 'rizkyzetzet121@gmail.com',
            'password' => bcrypt('qwer121'),
            'role_id' => 1,
            'email_verified_at' => now()
        ]);

        DB::table('kategori')->insert([[
            'nama' => 'Short Shirts',
            'slug' => Str::slug('Short Shirts')
        ], [
            'nama' => 'Long Shirts',
            'slug' => Str::slug('Long Shirts')
        ], [
            'nama' => 'Short Pants',
            'slug' => Str::slug('Short Pants')
        ], [
            'nama' => 'Long Pants',
            'slug' => Str::slug('Long Pants')
        ]]);


        DB::table('produk')->insert([
            [
                'nama' => 'Heydrown Shirt One',
                'slug' => 'heydrown-shirt-one',
                'foto' => 'produk-image/shirt-one.jpg',
                'foto_hd' => 'produk-image-hd/hd-shirt-one.jpg',
                'deskripsi' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam ad rerum modi placeat necessitatibus, iusto nemo, eligendi itaque repellat, beatae perspiciatis architecto asperiores sint quos aperiam iure a autem saepe quibusdam vel? Perspiciatis quisquam iure beatae maiores veritatis laudantium quia.',
                'harga' => 200000,
                'berat' => 0.25,
                'kategori_id' => 1

            ],
            [
                'nama' => 'Heydrown Shirt Two',
                'slug' => 'heydrown-shirt-two',
                'foto' => 'produk-image/shirt-two.jpg',
                'foto_hd' => 'produk-image-hd/hd-shirt-two.jpg',
                'deskripsi' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam ad rerum modi placeat necessitatibus, iusto nemo, eligendi itaque repellat, beatae perspiciatis architecto asperiores sint quos aperiam iure a autem saepe quibusdam vel? Perspiciatis quisquam iure beatae maiores veritatis laudantium quia.',
                'harga' => 250000,
                'berat' => 0.24,
                'kategori_id' => 1

            ],
        ]);


        DB::table('ukuran')->insert([
            [
                'tipe' => 'S',
                'slug' => 's'
            ],
            [
                'tipe' => 'M',
                'slug' => 'm'
            ],
            [
                'tipe' => 'L',
                'slug' => 'l'
            ],
            [
                'tipe' => 'XL',
                'slug' => 'xl'
            ],
        ]);

        DB::table('stok')->insert([
            [
                'produk_id' => 1,
                'ukuran_id' => 1,
                'jumlah' => 20
            ],
            [
                'produk_id' => 1,
                'ukuran_id' => 2,
                'jumlah' => 23
            ],
            [
                'produk_id' => 2,
                'ukuran_id' => 3,
                'jumlah' => 40
            ],
            [
                'produk_id' => 2,
                'ukuran_id' => 4,
                'jumlah' => 50
            ],
        ]);
    }
}
