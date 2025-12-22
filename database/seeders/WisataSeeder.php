<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Wisata;
use App\Models\Review;
use App\Models\User;

class WisataSeeder extends Seeder
{
    public function run(): void
    {
        // Categories
        $alam = Category::firstOrCreate(['slug' => 'alam'], ['name' => 'Alam', 'description' => 'Wisata alam dan outdoor']);
        $kuliner = Category::firstOrCreate(['slug' => 'kuliner'], ['name' => 'Kuliner', 'description' => 'Tempat makan dan mencoba kuliner lokal']);
        $modern = Category::firstOrCreate(['slug' => 'modern'], ['name' => 'Modern', 'description' => 'Tempat modern dan hiburan']);
        $budaya = Category::firstOrCreate(['slug' => 'budaya'], ['name' => 'Budaya', 'description' => 'Wisata budaya dan bersejarah']);
        $relaksasi = Category::firstOrCreate(['slug' => 'relaksasi'], ['name' => 'Relaksasi', 'description' => 'Tempat relaksasi dan spa']);

        // Get or create users
        $admin = User::firstOrCreate(['email' => 'admin@bmstrip.local'], [
            'name' => 'Admin BmsTrip',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $user1 = User::firstOrCreate(['email' => 'budi@example.com'], [
            'name' => 'Budi Santoso',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $user2 = User::firstOrCreate(['email' => 'siti@example.com'], [
            'name' => 'Siti Nurhaliza',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // ALAM - Wisatas
        $wisata1 = Wisata::firstOrCreate(['slug' => 'curug-cipendok'], [
            'category_id' => $alam->id,
            'title' => 'Curug Cipendok',
            'description' => "Curug Cipendok adalah air terjun multi tingkat yang indah di Banyumas. Terletak di ketinggian, air terjun ini memiliki beberapa tingkat dengan total tinggi mencapai 92 meter.\n\nFasilitas:\n- Taman air terjun\n- Kolam renang alami\n- Jalur trekking\n- Saung untuk istirahat\n- Warung makanan",
            'location' => 'Cilongok, Banyumas',
            'price' => 10000,
            'image' => 'https://assets.pikiran-rakyat.com/crop/0x0:1080x898/x/photo/2021/11/02/3656934002.jpg',
            'published' => true,
        ]);

        $wisata2 = Wisata::firstOrCreate(['slug' => 'baturraden'], [
            'category_id' => $alam->id,
            'title' => 'Baturraden',
            'description' => "Baturraden adalah destinasi wisata alam di lereng Gunung Slamet. Pemandangan pegunungan yang indah, udara sejuk, dan hutan pinus.\n\nAktivitas:\n- Trekking mendaki\n- Camping\n- Fotografi alam\n- Area berkuda",
            'location' => 'Purwokerto, Banyumas',
            'price' => 20000,
            'image' => 'https://infopurwokerto.com/wp-content/uploads/2021/04/baturraden.jpg',
            'published' => true,
        ]);

        $wisata3 = Wisata::firstOrCreate(['slug' => 'telaga-sunyi'], [
            'category_id' => $alam->id,
            'title' => 'Telaga sunyi',
            'description' => "Telaga Sunyi adalah danau alami dengan pemandangan yang tenang. Dikelilingi bukit-bukit hijau, cocok untuk relaksasi dan fotografi.\n\nFasilitas:\n- Tepi danau indah\n- Area piknik\n- Warung kopi\n- Jalan setapak",
            'location' => 'Desa Limpakuwus, Banyumas',
            'price' => 20000,
            'image' => 'https://jogja.disway.id/upload/2c01ee4ea267a82be813c888277a77da.jpg',
            'published' => true,
        ]);

        $wisata4 = Wisata::firstOrCreate(['slug' => 'pancuran7'], [
            'category_id' => $alam->id,
            'title' => 'Pancuran 7',
            'description' => "Pancuran 7 adalah mata air alami dengan stalaktit dan stalakmit yang menakjubkan. Di dalamnya terdapat kolam air yang jernih dan sejuk.\n\nPenawaran:\n- Eksplorasi \n- Pemandu wisata berpengalaman\n- Peralatan keselamatan\n- Fotografi bawah tanah",
            'location' => 'Baturaden, Banyumas',
            'price' => 15000,
            'image' => 'https://tse4.mm.bing.net/th/id/OIP._-VWCoX674XukBPDApjx0gHaEK?rs=1&pid=ImgDetMain&o=7&rm=3',
            'published' => true,
        ]);

        $wisata5 = Wisata::firstOrCreate(['slug' => 'bukit-tengtung'], [
            'category_id' => $alam->id,
            'title' => 'Bukit Tengtung',
            'description' => "Bukit Tengtung menawarkan pemandangan 360 derajat dari puncaknya. Sunrise dan sunset di sini sangat menakjubkan dan populer untuk fotografi.\n\nAktivitas:\n- Melihat sunrise\n- Fotografi landscape\n- Camping di puncak\n- Trekking\n- Picnic keluarga",
            'location' => 'Desa Limpakuwus, Banyumas',
            'price' => 15000,
            'image' => 'https://pagaralampos.disway.id/upload/0760a6b8238067660b5f6ad55791b5b4.jpg',
            'published' => true,
        ]);

        $wisata6 = Wisata::firstOrCreate(['slug' => 'curug-pengantin'], [
            'category_id' => $alam->id,
            'title' => 'Air Terjun Pengantin',
            'description' => "Curug Pengantin adalah air terjun tersembunyi yang jarang dikunjungi.\n\nKarakteristik:\n- Air jernih sejuk\n- Pemandangan asri\n- Jalur sedang\n- Cocok keluarga",
            'location' => 'Kedungbanteng, Banyumas',
            'price' => 5000,
            'image' => 'https://i.pinimg.com/736x/c7/3c/fa/c73cfac974ea1dcfaf1ee840b514fce4.jpg',
            'published' => true,
        ]);

        $wisata7 = Wisata::firstOrCreate(['slug' => 'hutan-pinus-limpakuwus'], [
            'category_id' => $alam->id,
            'title' => 'Hutan Pinus Limpakuwus',
            'description' => "Hutan Pinus Limpakuwus menawarkan pengalaman melihat perkebunan pinus yang luas di ketinggian.\n\nKegiatannya:\n- Fotografi perkebunan\n- Tasting teh lokal\n- Proses pembuatan teh\n- Membeli produk organik",
            'location' => 'Limpakuwus, Banyumas',
            'price' => 15000,
            'image' => 'https://unimmafm.com/wp-content/uploads/2023/10/6a9380db-74c6-48b6-8600-a74dab51d70e.jpg',
            'published' => true,
        ]);

        // KULINER - Wisatas
        $wisata8 = Wisata::firstOrCreate(['slug' => 'warung-soto-jl-bank'], [
            'category_id' => $kuliner->id,
            'title' => 'Warung Soto Jl Bank',
            'description' => "Warung Soto Ayam Meriah terkenal dengan soto ayamnya yang lezat. Resep turun temurun dengan bumbu khas.\n\nMenu Unggulan:\n- Soto Ayam\n- Nasi Kuning\n- Perkedel\n- Tahu Goreng\n- Minuman Tradisional",
            'location' => 'Jl. Sudirman, Purwokerto',
            'price' => 25000,
            'image' => 'https://th.bing.com/th/id/R.78a38cce9854ff36d9564078af450804?rik=1Smfrq6Ffz1s5A&riu=http%3a%2f%2f3.bp.blogspot.com%2f-V_RLEU0zG3E%2fUsfqDN_GfrI%2fAAAAAAAAEdQ%2fiyS9uyfdo1I%2fs1600%2fDSC03230.JPG&ehk=gsFLV20YKWpqrkaIy4GMkLCyxy0M8ZlRoxUGbFQgmIs%3d&risl=&pid=ImgRaw&r=0',
            'published' => true,
        ]);

        $wisata9 = Wisata::firstOrCreate(['slug' => 'serba-sambal'], [
            'category_id' => $kuliner->id,
            'title' => 'Serba Sambal',
            'description' => "Serba sambal adalah hidangan khas rumahan dengan rasa yang autentik dengan porsi mengenyangkan. Terdiri dari nasi putih dengan berbagai lauk pelengkap.\n\nVariasi Lauk:\n- Telur\n- Ikan Teri\n- Tempe Goreng\n- Sambal Terasi\n- Kangkung\n- Udang Kecil",
            'location' => 'Pasar Manis, Purwokerto',
            'price' => 50000,
            'image' => 'https://serbasambal.com/wp-content/uploads/2017/08/serba-sambal-super-hot-1080x608.jpg',
            'published' => true,
        ]);

        $wisata10 = Wisata::firstOrCreate(['slug' => 'getuk-goreng-budiyem'], [
            'category_id' => $kuliner->id,
            'title' => 'Getuk Goreng Bu Diyem',
            'description' => "Getuk Goreng Legendaris adalah makanan khas Banyumas yang terkenal manis dan legit.\n\nCiri Khas:\n- Kulit renyah\n- Isi melimpah\n- Bumbu tradisional\n- Disajikan dengan sambal kental",
            'location' => 'JSokaraja, Banyumas',
            'price' => 20000,
            'image' => 'https://visitjawatengah.jatengprov.go.id/assets/images/5dbc60b2-9d9f-4b20-980a-055c12de9a3c.jpg',
            'published' => true,
        ]);

        $wisata11 = Wisata::firstOrCreate(['slug' => 'warung-bakso-samiasih'], [
            'category_id' => $kuliner->id,
            'title' => 'Warung Bakso Samiasih',
            'description' => "Warung Bakso Samiasih menyajikan bakso sapi dengan kuah kaldu yang gurih dan dalam. Bahan-bahan dipilih langsung dari pasar terbaik.\n\nMenu:\n- Bakso Sapi\n- Bakso Urat\n- Pangsit\n- Es Cendol\n- Minuman Jahe",
            'location' => 'Jl. Pramuka No.23 53141 Banyumas',
            'price' => 30000,
            'image' => 'https://tse1.mm.bing.net/th/id/OIP.NSLxF2tAsL1OxchADfUAUgHaDV?rs=1&pid=ImgDetMain&o=7&rm=3',
            'published' => true,
        ]);

        $wisata12 = Wisata::firstOrCreate(['slug' => 'kedai-kopi-keprok'], [
            'category_id' => $kuliner->id,
            'title' => 'Kedai Kopi Keprok',
            'description' => "Kedai Kopi Keprok menyajikan kopi lokal Banyumas. Pemanggangan tradisional untuk hasil optimal.\n\nVarietas:\n- Kopi Hitam\n- Kopi Susu\n- Kopi Tubruk\n- Kopi Es\n- Makanan Ringan",
            'location' => 'Jl. raya karanggintung, Purwokerto',
            'price' => 12000,
            'image' => 'https://tse2.mm.bing.net/th/id/OIP.jRg5N2MMmgVvWdcCx0TI4QHaDa?rs=1&pid=ImgDetMain&o=7&rm=3',
            'published' => true,
        ]);

        // MODERN - Wisatas
        $wisata13 = Wisata::firstOrCreate(['slug' => 'alun-alun-purwokerto'], [
            'category_id' => $modern->id,
            'title' => 'Alun-Alun Purwokerto',
            'description' => "Alun-Alun Purwokerto adalah pusat hiburan modern dengan berbagai atraksi.\n\nFasilitas:\n- Area bermain keluarga\n- Taman bunga\n- Panggung seni\n- Perpustakaan digital\n- Food court modern",
            'location' => 'Jl. Raya Purwokerto',
            'price' => 0,
            'image' => 'https://media.suara.com/pictures/970x544/2022/12/30/66999-alun-alun-purwokerto.jpg',
            'published' => true,
        ]);

        $wisata14 = Wisata::firstOrCreate(['slug' => 'taman-rekreasi-bale-kemambang'], [
            'category_id' => $modern->id,
            'title' => 'Taman Rekreasi Bale Kemambang',
            'description' => "Taman Rekreasi Bale Kemambang adalah taman hiburan keluarga dengan wahana menarik.\n\nWahana:\n- Roller Coaster Mini\n- Komidi Putar\n- Rumah Hantu\n- Kolam Renang\n- Area Arcade",
            'location' => 'Purwokerto',
            'price' => 10000,
            'image' => 'https://static.gatra.com/foldershared/images/2019/fuad/10-Oct/asdw31.jpg',
            'published' => true,
        ]);

        $wisata15 = Wisata::firstOrCreate(['slug' => 'bioskop-cinema-rajawali'], [
            'category_id' => $modern->id,
            'title' => 'Bioskop Cinema Rajawali',
            'description' => "Bioskop Cinema Rajawali menawarkan pengalaman menonton dengan teknologi terkini.\n\nFitur:\n- Layar IMAX\n- Kursi Reclining\n- Surround Sound\n- Concession Premium\n- Parkir Luas",
            'location' => 'Jl Letnan Jenderal S. Parman , Purwokerto',
            'price' => 35000,
            'image' => 'https://tse2.mm.bing.net/th/id/OIP.INr6Z9UXWZ3j8Kt4Fm_y9wHaET?rs=1&pid=ImgDetMain&o=7&rm=3',
            'published' => true,
        ]);

        $wisata16 = Wisata::firstOrCreate(['slug' => 'pusat-belanja-rita-supermall'], [
            'category_id' => $modern->id,
            'title' => 'Pusat Belanja Rita Supermall',
            'description' => "Pusat Belanja Modern Banyumas adalah mall terbesar dengan brand internasional.\n\nFasilitas:\n- 300+ Toko\n- Food Court\n- Bioskop\n- Arcade Game\n- Kolam Renang\n- Hotel",
            'location' => 'Jl. Jendral Sudirman, Purwokerto',
            'price' => 0,
            'image' => 'https://www.shutterstock.com/image-photo/rita-super-mall-night-purwokerto-600w-1612905604.jpg',
            'published' => true,
        ]);

        // BUDAYA - Wisatas
        $wisata17 = Wisata::firstOrCreate(['slug' => 'museum-wayang'], [
            'category_id' => $budaya->id,
            'title' => 'Museum Wayang',
            'description' => "Museum wayang adalah museum bersejarah yang menyimpan koleksi wayang dari berbagai era.\n\nKoleksi:\n- Barang Antik\n- Senjata Tradisional\n- Tekstil Kuno\n- Keramik Klasik\n- Foto Historis",
            'location' => 'Jl. Budi Utomo No.1 53192 Banyumas',
            'price' => 5000,
            'image' => 'https://radarbanyumas.disway.id/upload/cae6ae17e75bd33d99c5d0470d6b63ce.jpeg',
            'published' => true,
        ]);

        // RELAKSASI - Wisatas

        $wisata22 = Wisata::firstOrCreate(['slug' => 'resort-curug-bayan'], [
            'category_id' => $relaksasi->id,
            'title' => 'Resort Curug Bayan',
            'description' => "Resort Curug Bayan adalah resort mewah dengan pemandangan gunung dan air terjun yang menakjubkan.\n\nFasilitas:\n- Villa Pribadi\n- Infinity Pool\n- Restaurant Gourmet\n- Spa\n- Gym\n- Pemandu Hiking",
            'location' => 'Baturraden, Banyumas',
            'price' => 1000000,
            'image' => 'https://jogja.disway.id/upload/4b0da1f77dfc9c002aada70a6f3a1265.jpg',
            'published' => true,
        ]);

        // Add reviews
        $reviews = [
            ['wisata_id' => $wisata1->id, 'user_id' => $user1->id, 'rating' => 5, 'comment' => 'Tempat yang sangat indah! Air terjunnya spektakuler dan air dingin sekali. Cocok untuk keluarga.'],
            ['wisata_id' => $wisata1->id, 'user_id' => $user2->id, 'rating' => 4, 'comment' => 'Pemandangan alam yang indah tapi jalurnya cukup menantang untuk anak kecil.'],
            ['wisata_id' => $wisata2->id, 'user_id' => $user1->id, 'rating' => 5, 'comment' => 'Udaranya sejuk, pemandangan gunung bagus. Sarapan pagi di sini sangat nikmat!'],
            ['wisata_id' => $wisata3->id, 'user_id' => $user2->id, 'rating' => 4, 'comment' => 'Danau yang tenang dan indah. Cocok untuk fotografi dan piknik keluarga.'],
            ['wisata_id' => $wisata4->id, 'user_id' => $user1->id, 'rating' => 5, 'comment' => 'Goa yang menakjubkan! Stalaktit dan stalakmitnya sangat indah. Pemandu wisatanya ramah.'],
            ['wisata_id' => $wisata8->id, 'user_id' => $user2->id, 'rating' => 5, 'comment' => 'Soto ayamnya enak banget! Bumbu tradisional yang pas. Harganya juga terjangkau.'],
            ['wisata_id' => $wisata9->id, 'user_id' => $user1->id, 'rating' => 4, 'comment' => 'Nasi kucing yang lezat dengan berbagai pilihan lauk. Recommended!'],
            ['wisata_id' => $wisata10->id, 'user_id' => $user2->id, 'rating' => 5, 'comment' => 'Lumpia gorengnya super renyah dan gurih! Jadi langganan setiap kali ke Banyumas.'],
            ['wisata_id' => $wisata17->id, 'user_id' => $user1->id, 'rating' => 4, 'comment' => 'Museum yang menarik dengan koleksi artefak langka. Cocok untuk edukasi.'],
            ['wisata_id' => $wisata5->id, 'user_id' => $user2->id, 'rating' => 5, 'comment' => 'Pemandangan sunrise dari puncak sangat spektakuler! Foto-fotoku jadi bagus.'],
        ];

        foreach ($reviews as $review) {
            Review::firstOrCreate(
                ['wisata_id' => $review['wisata_id'], 'user_id' => $review['user_id']],
                $review
            );
        }
    }
}
