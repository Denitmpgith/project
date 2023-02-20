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
            'username' => 'Udin',
            'password' => bcrypt('password'),
        ]);
        user_detiles::create([
            'user_id' => 1,
            'profile' => Str::random(10) . ".jpg",
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
            'user_id' => 1,
            'level_id' => 1,
            'reward' => 100,
            'title' => 'Mencari yang Bisa menggambar Sampul buku',
            'slug' => 'mencari_yang_bisa_menggambar_sampul_buku',
            'description' => 'Saya memiliki hasil karya tulis, saya ingin membuat buku dari hasil karya tulis saya ini.Sya butuh mode sampul buku yang sesusai dengan isi dari karya tulis saya. Thema karya tulis saya "tertawa saat bermain permainan jadul",'
        ]);
        Post::create([
            'user_id' => 1,
            'level_id' => 1,
            'reward' => 50,
            'title' => 'buatkan saya Logo',
            'slug' => 'buatkan_saya_logo',
            'description' => 'saya mencari logo untuk thems "mari Bermain Bersama kami", buatkan gambar atau ilustrasi orang anak kecil mengajak orang dewasa untuk bermain bersama.'
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
            'user_id' => 1,
            'title' => 'Apply Postingan Pertama',
            'slug' => 'apply_postingan_pertama',
            'description' => 'Terimakasih anda sudah membaca Apply pertama dari postingan pertama',
        ]);
        apply::create([
            'post_id' => 1,
            'user_id' => 2,
            'title' => 'Apply Postingan Pertama',
            'slug' => 'apply_postingan_pertama',
            'description' => 'Terimakasih anda sudah membaca Apply kedua dari postingan pertama',
        ]);
        applyFile::create([
            'apply_id' => 1,
            'file' => 'namafile1.file',
            'title' => 'List Apply Postingan Pertama',
            'slug' => 'list_apply_postingan_pertama',
        ]);
        applyFile::create([
            'apply_id' => 2,
            'file' => 'namafile2.file',
            'title' => 'List Apply Postingan Pertama',
            'slug' => 'list_apply_postingan_pertama',
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
            'comment' => 'apakah bole menggunakan software opensouce',
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
