<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Apply;
use App\Models\comment;
use App\Models\postFile;
use App\Models\replyComment;
use App\Models\partPost;
use App\Models\applyFile;
use App\Models\applyRate;
use App\Models\fortfolio;
use App\Models\fortDetiles;
use App\Models\user_detiles;
use App\Models\listCategory;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Validation\Rules\Unique;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'indrajaya',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'username' => 'susanna',
            'password' => bcrypt('password'),
        ]);
        User::create([
            'username' => 'Udina',
            'password' => bcrypt('password'),
        ]);
        user_detiles::create([
            'user_id' => 1,
/*             'profile' => Str::random(10) . ".jpg", */
            'first_name' => 'Deni',
            'middle_name' => 'Indra',
            'last_name' => 'jaya',
            'address' => 'Rancamulya Asri',
            'city' => 'Kab. Bandung',
            'country' => 'Indonesia',
            'm_phone' => '0894561237',
            'email' => 'alamat@gmail.com',
        ]);
        user_detiles::create([
            'user_id' => 2,
            'profile' => Str::random(10) . ".jpg",
            'first_name' => 'Susanna',
            'middle_name' => 'Minako',
            'last_name' => 'Hinata',
            'address' => 'Pameungpeuk',
            'city' => 'Kab. Bandung',
            'country' => 'Indonesia',
            'm_phone' => '0812456789',
            'email' => 'mautauaja@gmail.com',
        ]);
        user_detiles::create([
            'user_id' => 3,
            'profile' => Str::random(10) . ".jpg",
            'first_name' => 'Udin',
            'middle_name' => 'Komarudin',
            'last_name' => 'Firmansah',
            'address' => 'Balendah',
            'city' => 'Kab. Bandung',
            'country' => 'Indonesia',
            'm_phone' => '0813574833',
            'email' => 'udir@gmail.com',
        ]);
        Post::create([
            'deadline' => time()+(1*60*60*24),
            'user_id' => 1,
            'level' => 'Bronze',
            'reward' => 100,
            'title' => 'Saya mencari yang Bisa menggambar Sampul buku',
            'slug' => 'mencari_yang_bisa_menggambar_sampul_buku',
            'description' => 'Saya memiliki hasil karya tulis, saya ingin membuat buku dari hasil karya tulis saya ini. Saya butuh mode sampul buku yang sesusai dengan isi dari karya tulis saya. Tema karya tulis saya "Ai banyak mengubah cara pandang Dunia",'
        ]);
        Post::create([
            'deadline' => time()+(2*60*60*24),
            'user_id' => 1,
            'level' => 'Silver',
            'reward' => 150,
            'title' => 'Buatkan saya Logo',
            'slug' => 'buatkan_saya_logo',
            'description' => 'Saya mencari resep terbaik, untuk pembuatan bakso, yang sekarang lagi viral terbuat dari sayur, dan tidak menggunakan pengawet. jangan cuma copas dari google, tapi memang resep asli,resep asli terjamin dan pernah di coba, khusus yang karyawan perusahaan bakso sayur saya utamakan.'
        ]);
        Post::create([
            'deadline' => time()+(3*60*60*24),
            'user_id' => 1,
            'level' => 'Stone',
            'reward' => 50,
            'title' => 'Buatkan saya lagu',
            'slug' => 'buatkan_saya_lagu',
            'description' => 'Saya mencari lagu untuk intro di youtube,durasi minta minimal 5 menit, gunakan cara accoustic. buat saya tertarik dengan karya terbaik anda, Terimakasih.'
        ]);
        Post::create([
            'deadline' => time()+(4*60*60*24),
            'user_id' => 2,
            'level' => 'Gold',
            'reward' => 200,
            'title' => 'Carikan Resep membuat Bakso',
            'slug' => 'carikan_resep_membuat_bakso',
            'description' => 'Saya mencari resep terbaik, untuk pembuatan bakso, yang sekarang lagi viral terbuat dari sayur, dan tidak menggunakan pengawet. jangan cuma copas dari google, tapi memang resep asli, dan sudah terjamin dan pernah di coba, khusus yang karyawan perusahaan bakso sayur saya utamakan'
        ]);
        fortfolio::create([
            'user_id' => 1,
            'title' => 'Fortfolio Judul Pertama',
            'slug' => 'fortfolio_judul_pertama',
            'description' => 'Terimakasih anda sudah membaca artikel dari Postingan pertama',
            'name_file' => Str::random(10) . ".jpg",
        ]);
        fortDetiles::create([
            'fortfolio_id' => 1,
            'title' => 'Fortfolio Detile Pertama',
            'slug' => 'fortfolio_detile_pertama',
            'description' => 'Terimakasih anda sudah membaca detile fortfolio dari fortfolio pertama',
            'name_file' => Str::random(10) . ".jpg",
        ]);
        postFile::create([
            'post_id' => 1,
            'name_file' => Str::random(10) . ".jpg",
        ]);
        partPost::create([
            'post_id' => 1,
            'title' => 'Mencari yang Bisa menggambar Sampul buku',
            'slug' => 'mencari_yang_bisa_menggambar_sampul_buku',
            'description' => 'Saya memiliki hasil karya tulis, saya ingin membuat buku dari hasil karya tulis saya ini.Sya butuh mode sampul buku yang sesusai dengan isi dari karya tulis saya. Thema karya tulis saya "tertawa saat bermain permainan jadul".',
        ]);
        listCategory::create([
            'post_id' => 1,
            'name' => "Web Design",
            'slug' => "web_design"
        ]);
        apply::create([
            'post_id' => 1,
            'user_id' => 2,
            'title' => 'Apply pertama Postingan Pertama',
            'slug' => 'apply_pertama_postingan_pertama',
            'description' => 'Terimakasih anda sudah membaca Apply pertama dari postingan pertama',
        ]);
        apply::create([
            'post_id' => 1,
            'user_id' => 3,
            'title' => 'Apply pertama Postingan Pertama',
            'slug' => 'apply_pertama_postingan_pertama_2',
            'description' => 'Terimakasih anda sudah membaca Apply kedua dari postingan pertama',
        ]);
        apply::create([
            'post_id' => 1,
            'user_id' => 2,
            'title' => 'Apply kedua Postingan Pertama',
            'slug' => 'apply_kedua_postingan_pertama_3',
            'description' => 'Terimakasih anda sudah membaca Apply kedua dari postingan pertama',
        ]);
        apply::create([
            'post_id' => 1,
            'user_id' => 3,
            'title' => 'Apply kedua Postingan Pertama',
            'slug' => 'apply_kedua_postingan_pertama_4',
            'description' => 'Terimakasih anda sudah membaca Apply kedua dari postingan pertama',
        ]);
        apply::create([
            'post_id' => 1,
            'user_id' => 2,
            'title' => 'Apply ketiga Postingan Pertama',
            'slug' => 'apply_ketiga_postingan_pertama_5',
            'description' => 'Terimakasih anda sudah membaca Apply kedua dari postingan pertama',
        ]);
        apply::create([
            'post_id' => 1,
            'user_id' => 3,
            'title' => 'Apply ketiga Postingan Pertama',
            'slug' => 'apply_ketiga_postingan_pertama_6',
            'description' => 'Terimakasih anda sudah membaca Apply kedua dari postingan pertama',
        ]);
        applyFile::create([
            'apply_id' => 1,
            'filename' => 'HNB6N0VPaYeDSR6Cb9Hdd3xhMRe9wEw99CGM4uzM.jpg',
            'title' => 'Apply Postingan Pertama',
            'slug' => 'apply_postingan_pertama',
        ]);
        applyFile::create([
            'apply_id' => 1,
            'filename' => 'HNB6N0VPaYeDSR6Cb9Hdd3xhMRe9wEw99CGM4uzN.jpg',
            'title' => 'Apply Postingan Kedua',
            'slug' => 'apply_postingan_kedua',
        ]);
        applyFile::create([
            'apply_id' => 1,
            'filename' => 'HNB6N0VPaYeDSR6Cb9Hdd3xhMRe9wEw99CGM4uzO.jpg',
            'title' => 'Apply Postingan Ketiga',
            'slug' => 'apply_postingan_ketiga',
        ]);
        applyFile::create([
            'apply_id' => 1,
            'filename' => 'HNB6N0VPaYeDSR6Cb9Hdd3xhMRe9wEw99CGM4uzP.jpg',
            'title' => 'Apply Postingan Empat',
            'slug' => 'apply_postingan_Empat',
        ]);
        applyRate::create([
            'apply_id' => 1,
            'rate' => 'noRate',
        ]);
        comment::create([
            'post_id' => 1,
            'user_id' => 1,
            'comment' => 'saya akan tolak jika anda bekerja tidak sungguh-sunguh',
            'slug' => 'ini_comment_pertama_dari_postingan_pertama',
        ]);
        comment::create([
            'post_id' => 1,
            'user_id' => 3,
            'comment' => 'apakah boleh menggunakan software opensouce',
            'slug' => 'apakah_bol_menggunakan_software_opensouce',
        ]);
        replyComment::create([
            'comment_id' => 1,
            'user_id' => 2,
            'replycomment' => 'apakah anda serius akan bayar kami ?',
            'slug' => 'apakah_anda_serius_akan_bayar_kami_?',
        ]);
        replyComment::create([
            'comment_id' => 1,
            'user_id' => 1,
            'replycomment' => 'jika anda bekerja dengan sungguh-sunguh akan saya bayar',
            'slug' => 'jika_anda_bekerja_dengan_sungguh-sunguh_akan_saya_bayar',
        ]);
        replyComment::create([
            'comment_id' => 2,
            'user_id' => 1,
            'replycomment' => 'boleh, selama hasil nya baik dan saya suka',
            'slug' => 'boleh,_selama_hasil_nya_baik_dan_saya_suka',
        ]);
    }
}
