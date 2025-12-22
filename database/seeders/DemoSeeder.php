<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Wisata;
use App\Models\Review;
use App\Models\User;

/**
 * DemoSeeder: insert sample data untuk demo
 * Jalankan: php artisan db:seed --class=DemoSeeder
 */
class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'Alam', 'slug' => 'alam', 'description' => 'Wisata alam dan outdoor'],
            ['name' => 'Kuliner', 'slug' => 'kuliner', 'description' => 'Tempat makan dan mencoba kuliner lokal'],
            ['name' => 'Modern', 'slug' => 'modern', 'description' => 'Tempat modern dan hiburan'],
            ['name' => 'Budaya', 'slug' => 'budaya', 'description' => 'Wisata budaya dan bersejarah'],
            ['name' => 'Relaksasi', 'slug' => 'relaksasi', 'description' => 'Tempat relaksasi dan spa'],
        ];

        $categoryIds = [];
        foreach ($categories as $cat) {
            $categoryIds[] = Category::create($cat)->id;
        }

        // Create demo users
        $adminUser = User::create([
            'name' => 'Admin BmsTrip',
            'email' => 'admin@bmstrip.local',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        $normalUser1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        $normalUser2 = User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        $normalUser3 = User::create([
            'name' => 'Ahmad Wijaya',
            'email' => 'ahmad@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);

        // Create 20+ wisatas with images from Unsplash
        $wisatas = [
            // ALAM (0)
            [
                'category_id' => $categoryIds[0],
                'title' => 'Curug Cipendok',
                'slug' => 'curug-cipendok',
                'description' => "Curug Cipendok adalah air terjun multi tingkat yang indah di Banyumas. Terletak di ketinggian, air terjun ini memiliki beberapa tingkat dengan total tinggi mencapai 92 meter. Tempat ini ideal untuk trekking, berenang di kolam air, dan menikmati keindahan alam.\n\nFasilitas:\n- Taman air terjun\n- Kolam renang alami\n- Jalur trekking\n- Saung untuk istirahat\n- Warung makanan\n- Parkir luas",
                'location' => 'Cilongok, Banyumas',
                'price' => 10000,
                'image' => 'https://assets.pikiran-rakyat.com/crop/0x0:1080x898/x/photo/2021/11/02/3656934002.jpg',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[0],
                'title' => 'Baturraden',
                'slug' => 'baturraden',
                'description' => "Baturraden adalah destinasi wisata alam yang terletak di lereng Gunung Slamet. Pemandangan pegunungan yang indah, udara sejuk, dan hutan pinus menjadi daya tarik utama.\n\nAktivitas:\n- Trekking mendaki\n- Camping\n- Fotografi alam\n- Picnic area\n- Area berkuda\n- Resort dan villa",
                'location' => 'Purwokerto, Banyumas',
                'price' => 25000,
                'image' => 'https://infopurwokerto.com/wp-content/uploads/2021/04/baturraden.jpg',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[0],
                'title' => 'Telaga Sunyi',
                'slug' => 'telaga-sunyi',
                'description' => "Telaga Sunyi adalah danau alami yang menarik dengan pemandangan yang tenang. Dikelilingi oleh bukit-bukit hijau, tempat ini cocok untuk relaksasi dan fotografi.\n\nFasilitas:\n- Tepi danau yang indah\n- Area piknik\n- Warung kopi dan makanan\n- Parkir kendaraan\n- Jalan setapak untuk berjalan",
                'location' => 'Desa Limpakuwus , Banyumas',
                'price' => 20000,
                'image' => 'https://jogja.disway.id/upload/2c01ee4ea267a82be813c888277a77da.jpg',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[0],
                'title' => 'Pancuran 7',
                'slug' => 'Pancuran7',
                'description' => "Pancuran 7 adalah mata air alami dengan stalaktit dan stalakmit yang menakjubkan. Di dalamnya terdapat kolam air yang jernih dan sejuk.\n\nPenawaran:\n- Eksplorasi \n- Pemandu wisata berpengalaman\n- Peralatan keselamatan\n- Fotografi bawah tanah",
                'location' => 'Baturaden, Banyumas',
                'price' => 15000,
                'image' => 'https://tse4.mm.bing.net/th/id/OIP._-VWCoX674XukBPDApjx0gHaEK?rs=1&pid=ImgDetMain&o=7&rm=3',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[0],
                'title' => 'Bukit Tengtung',
                'slug' => 'bukit-tengtung',
                'description' => "Bukit Tengtung menawarkan pemandangan 360 derajat dari puncaknya. Sunrise dan sunset di sini sangat menakjubkan dan populer untuk fotografi.\n\nAktivitas:\n- Melihat sunrise\n- Fotografi landscape\n- Camping di puncak\n- Trekking\n- Picnic bersama keluarga",
                'location' => 'Desa Limpakuwus, Banyumas',
                'price' => 15000,
                'image' => 'https://pagaralampos.disway.id/upload/0760a6b8238067660b5f6ad55791b5b4.jpg',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[0],
                'title' => 'Air Terjun Pengantin',
                'slug' => 'curug-pengantin',
                'description' => "Curug Pengantin adalah air terjun tersembunyi yang jarang dikunjungi. Dengan ketinggian 15 meter dan kolam yang dalam, tempat ini sempurna untuk berenang dan relaksasi.\n\nKarakteristik:\n- Air jernih dan sejuk\n- Pemandangan alam asri\n- Jalur mendaki sedang\n- Cocok untuk keluarga",
                'location' => 'Kedungbanteng, Banyumas',
                'price' => 5000,
                'image' => 'https://i.pinimg.com/736x/c7/3c/fa/c73cfac974ea1dcfaf1ee840b514fce4.jpg',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[0],
                'title' => 'Hutan Pinus Limpakuwus',
                'slug' => 'hutan-pinus-limpakuwus',
                'description' => "Hutan Pinus Limpakuwus menawarkan pengalaman melihat perkebunan pinus yang luas di ketinggian. \n\nKegiatannya:\n- Mengambil foto di perkebunan\n- Tasting teh lokal\n- Mempelajari proses pembuatan teh\n- Membeli produk teh organik",
                'location' => 'Limpakuwus, Banyumas',
                'price' => 15000,
                'image' => 'https://unimmafm.com/wp-content/uploads/2023/10/6a9380db-74c6-48b6-8600-a74dab51d70e.jpg',
                'published' => true,
            ],
            // KULINER (1)
            [
                'category_id' => $categoryIds[1],
                'title' => 'Warung Soto Jl Bank',
                'slug' => 'warung-soto-jl-bank',
                'description' => "Warung Soto Ayam Bank adalah tempat kuliner tradisional yang terkenal dengan soto ayamnya yang lezat. Resep turun temurun dengan bumbu khas membuat rasanya unik.\n\nMenu Unggulan:\n- Soto Ayam\n- Nasi Kuning\n- Perkedel\n- Tahu Goreng\n- Minuman Tradisional",
                'location' => 'Jl. RA Wiryaatmaja, Purwokerto',
                'price' => 25000,
                'image' => 'https://th.bing.com/th/id/R.78a38cce9854ff36d9564078af450804?rik=1Smfrq6Ffz1s5A&riu=http%3a%2f%2f3.bp.blogspot.com%2f-V_RLEU0zG3E%2fUsfqDN_GfrI%2fAAAAAAAAEdQ%2fiyS9uyfdo1I%2fs1600%2fDSC03230.JPG&ehk=gsFLV20YKWpqrkaIy4GMkLCyxy0M8ZlRoxUGbFQgmIs%3d&risl=&pid=ImgRaw&r=0',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[1],
                'title' => 'Serba Sambal',
                'slug' => 'serba-sambal',
                'description' => "Serba sambal adalah hidangan khas rumahan dengan rasa yang autentik dengan porsi mengenyangkan. Terdiri dari nasi putih dengan berbagai lauk pelengkap.\n\nVariasi Lauk:\n- Telur\n- Ikan Teri\n- Tempe Goreng\n- Sambal Terasi\n- Kangkung\n- Udang Kecil",
                'location' => 'Pasar Manis, Purwokerto',
                'price' => 50000,
                'image' => 'https://serbasambal.com/wp-content/uploads/2017/08/serba-sambal-super-hot-1080x608.jpg',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[1],
                'title' => 'Getuk Goreng Bu Diyem',
                'slug' => 'getuk-goreng-budiyem',
                'description' => "Getuk Goreng Legendaris adalah makanan khas Banyumas yang terkenal manis dan legit.\n\nCiri Khas:\n- Kulit renyah\n- Isi melimpah\n- Bumbu tradisional\n- Disajikan dengan sambal kental",
                'location' => 'Sokaraja, Banyumas',
                'price' => 20000,
                'image' => 'https://visitjawatengah.jatengprov.go.id/assets/images/5dbc60b2-9d9f-4b20-980a-055c12de9a3c.jpg',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[1],
                'title' => 'Warung Bakso Samiasih',
                'slug' => 'warung-bakso-samiasih',
                'description' => "Warung Bakso Samiasih menyajikan bakso sapi dengan kuah kaldu yang gurih dan dalam. Bahan-bahan dipilih langsung dari pasar terbaik.\n\nMenu:\n- Bakso Sapi\n- Bakso Urat\n- Pangsit\n- Es Cendol\n- Minuman Jahe",
                'location' => 'Jl. Pramuka No.23 53141 Banyumas',
                'price' => 30000,
                'image' => 'https://tse1.mm.bing.net/th/id/OIP.NSLxF2tAsL1OxchADfUAUgHaDV?rs=1&pid=ImgDetMain&o=7&rm=3',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[1],
                'title' => 'Kedai Kopi Keprok',
                'slug' => 'kedai-kopi-keprok',
                'description' => "Kedai Kopi Keprok menyajikan kopi lokal Banyumas yang kaya rasa. Proses pemanggangan dilakukan tradisional untuk hasil optimal.\n\nVarietas Kopi:\n- Kopi Hitam\n- Kopi Susu\n- Kopi Tubruk\n- Kopi Es\n- Makanan Ringan",
                'location' => 'Jl. raya karanggintung, Purwokerto',
                'price' => 25000,
                'image' => 'https://tse2.mm.bing.net/th/id/OIP.jRg5N2MMmgVvWdcCx0TI4QHaDa?rs=1&pid=ImgDetMain&o=7&rm=3',
                'published' => true,
            ],
            // MODERN (2)
            [
                'category_id' => $categoryIds[2],
                'title' => 'Alun-Alun Purwokerto',
                'slug' => 'alun-alun-purwokerto',
                'description' => "Alun-Alun Purwokerto adalah pusat hiburan dan wisata modern dengan berbagai atraksi.\n\nFasilitas:\n- Area bermain keluarga\n- Taman bunga\n- Panggung seni\n- Perpustakaan digital\n- Area olahraga\n- Food court modern",
                'location' => 'Jl. Raya Purwokerto',
                'price' => 0,
                'image' => 'https://media.suara.com/pictures/970x544/2022/12/30/66999-alun-alun-purwokerto.jpg',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[2],
                'title' => 'Taman Rekreasi Bale Kemambang',
                'slug' => 'taman-rekreasi-bale-kemambang',
                'description' => "Taman Rekreasi Bale Kemambang adalah taman hiburan keluarga dengan wahana permainan yang menarik.\n\nWahana:\n- Roller Coaster Mini\n- Komidi Putar\n- Rumah Hantu\n- Kolam Renang\n- Area Arcade\n- Taman Bermain Anak",
                'location' => 'Purwokerto',
                'price' => 10000,
                'image' => 'https://static.gatra.com/foldershared/images/2019/fuad/10-Oct/asdw31.jpg',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[2],
                'title' => 'Bioskop Cinema Rajawali',
                'slug' => 'bioskop-cinema-rajawali',
                'description' => "Bioskop Cinema Rajawali menawarkan pengalaman menonton film terbaru dengan teknologi terkini.\n\nFitur:\n- Layar IMAX\n- Kursi Reclining\n- Surround Sound\n- Concession Stand Premium\n- Parkir Bermerek",
                'location' => 'Jl Letnan Jenderal S. Parman , Purwokerto',
                'price' => 35000,
                'image' => 'https://tse2.mm.bing.net/th/id/OIP.INr6Z9UXWZ3j8Kt4Fm_y9wHaET?rs=1&pid=ImgDetMain&o=7&rm=3',
                'published' => true,
            ],
            [
                'category_id' => $categoryIds[2],
                'title' => 'Pusat Belanja Rita Supermall',
                'slug' => 'pusat-belanja-rita-supermall',
                'description' => "Pusat Belanja Rita Supermall adalah mall terbesar dengan berbagai brand internasional dan lokal.\n\nFasilitas:\n- 300+ Toko\n- Food Court\n- Bioskop\n- Arcade Game\n- Kolam Renang\n- Hotel\n- Parkir 5 Lantai",
                'location' => 'Jl. Jendral Sudirman, Purwokerto',
                'price' => 0,
                'image' => 'https://www.shutterstock.com/image-photo/rita-super-mall-night-purwokerto-600w-1612905604.jpg',
                'published' => true,
            ],
            // BUDAYA (3)
            [
                'category_id' => $categoryIds[3],
                'title' => 'Museum Wayang',
                'slug' => 'museum-wayang',
                'description' => "Museum wayang adalah museum bersejarah yang menyimpan koleksi wayang dari berbagai era.\n\nKoleksi:\n- Barang Antik\n- Senjata Tradisional\n- Tekstil Kuno\n- Keramik Klasik\n- Foto Historis",
                'location' => 'Jl. Budi Utomo No.1 53192 Banyumas',
                'price' => 5000,
                'image' => 'https://radarbanyumas.disway.id/upload/cae6ae17e75bd33d99c5d0470d6b63ce.jpeg',
                'published' => true,
            ],
            // RELAKSASI (4)
            [
                'category_id' => $categoryIds[4],
                'title' => 'Resort Curug Bayan',
                'slug' => 'resort-curug-bayan',
                'description' => "Resort Curug Bayan adalah resort mewah dengan pemandangan gunung dan air terjun yang menakjubkan.\n\nFasilitas:\n- Villa Pribadi\n- Infinity Pool\n- Restaurant Gourmet\n- Spa\n- Gym\n- Pemandu Hiking",
                'location' => 'Baturraden, Banyumas',
                'price' => 1000000,
                'image' => 'https://jogja.disway.id/upload/4b0da1f77dfc9c002aada70a6f3a1265.jpg',
                'published' => true,
            ],

        ];

        // Insert wisatas
        $createdWisatas = [];
        foreach ($wisatas as $w) {
            $createdWisatas[] = Wisata::create($w);
        }

        // Add sample reviews
        $reviews = [
            ['wisata_id' => $createdWisatas[0]->id, 'user_id' => $normalUser1->id, 'rating' => 5, 'comment' => 'Tempat yang sangat indah! Air terjunnya spektakuler dan air dingin sekali. Cocok untuk keluarga.'],
            ['wisata_id' => $createdWisatas[0]->id, 'user_id' => $normalUser2->id, 'rating' => 4, 'comment' => 'Pemandangan alam yang indah tapi jalurnya cukup menantang untuk anak kecil.'],
            ['wisata_id' => $createdWisatas[1]->id, 'user_id' => $normalUser3->id, 'rating' => 5, 'comment' => 'Udaranya sejuk, pemandangan gunung bagus. Sarapan pagi di sini sangat nikmat!'],
            ['wisata_id' => $createdWisatas[2]->id, 'user_id' => $normalUser1->id, 'rating' => 4, 'comment' => 'Danau yang tenang dan indah. Cocok untuk fotografi dan piknik keluarga.'],
            ['wisata_id' => $createdWisatas[3]->id, 'user_id' => $normalUser2->id, 'rating' => 5, 'comment' => 'Goa yang menakjubkan! Stalaktit dan stalakmitnya sangat indah. Pemandu wisatanya ramah.'],
            ['wisata_id' => $createdWisatas[7]->id, 'user_id' => $normalUser3->id, 'rating' => 5, 'comment' => 'Soto ayamnya enak banget! Bumbu tradisional yang pas. Harganya juga terjangkau.'],
            ['wisata_id' => $createdWisatas[8]->id, 'user_id' => $normalUser1->id, 'rating' => 4, 'comment' => 'Nasi kucing yang lezat dengan berbagai pilihan lauk. Recommended!'],
            ['wisata_id' => $createdWisatas[9]->id, 'user_id' => $normalUser2->id, 'rating' => 5, 'comment' => 'Lumpia gorengnya super renyah dan gurih! Jadi langganan setiap kali ke Banyumas.'],
            ['wisata_id' => $createdWisatas[14]->id, 'user_id' => $normalUser3->id, 'rating' => 4, 'comment' => 'Museum yang menarik dengan koleksi artefak langka. Cocok untuk edukasi.'],
            ['wisata_id' => $createdWisatas[18]->id, 'user_id' => $normalUser1->id, 'rating' => 5, 'comment' => 'Pijat tradisionalnya sangat menyenangkan! Terapis profesional dan harga terjangkau.'],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
