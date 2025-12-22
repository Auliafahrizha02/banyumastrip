<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\About;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::firstOrCreate(
            ['city' => 'Banyumas'],
            [
                'title' => 'Tentang Banyumas',
                'description' => "Banyumas adalah sebuah kota yang terletak di Provinsi Jawa Tengah, Indonesia. Kota ini terkenal sebagai pusat wisata alam yang kaya dengan keindahan pegunungan, air terjun yang spektakuler, dan budaya lokal yang masih kental.\n\nSejarah:\nBanyumas memiliki sejarah panjang dan telah menjadi pusat pemerintahan dan perdagangan di Jawa Tengah sejak zaman Kerajaan Mataram. Kota ini juga dikenal sebagai pusat seni tradisional dan budaya Jawa.\n\nGeografi:\nBerletak di kaki Gunung Slamet, Banyumas memiliki topografi yang unik dengan pemandangan alam yang menakjubkan. Udara sejuk dan suasana asri menjadikan kota ini destinasi wisata favorit.\n\nBudaya & Seni:\nPenduduk Banyumas terkenal dengan keramahan dan kehangatan mereka. Kota ini juga memiliki berbagai pertunjukan seni tradisional seperti Wayang Kulit dan tari-tarian lokal yang khas.\n\nKuliner:\nBanyumas terkenal dengan kuliner autentiknya seperti Soto Ayam Banyumas, Getuk Goreng, dan berbagai makanan tradisional lainnya yang lezat dan menggugah selera.\n\nWisata:\nDengan lebih dari 20 destinasi wisata yang tersebar di berbagai lokasi, Banyumas menawarkan pengalaman wisata yang tak terlupakan. Dari wisata alam, kuliner, budaya, hingga relaksasi, semuanya dapat ditemukan di sini.",
                'image' => 'https://1.bp.blogspot.com/-XBack8WAWQE/YBloIZMVFYI/AAAAAAAABbo/81Car6i_PV4u1hSNF8NgNG38tzHSSFGMACNcBGAsYHQ/s2048/Kab.Banyumas1.jpg',
            ]
        );
    }
}
