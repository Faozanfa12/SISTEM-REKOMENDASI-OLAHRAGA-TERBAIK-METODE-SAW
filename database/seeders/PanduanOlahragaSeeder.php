<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Alternatif;

class PanduanOlahragaSeeder extends Seeder {
    public function run(): void {
        $alt = Alternatif::pluck('id', 'nama_alternatif');

        DB::table('panduan_olahraga')->insert([
            [
                'alternatif_id' => $alt['Jalan Kaki'],
                'nama' => 'Jalan Kaki',
                'deskripsi_singkat' => 'Olahraga sederhana namun efektif untuk menjaga kesehatan dan kebugaran lansia.',
                'deskripsi_umum' => 'Aktivitas ringan yang dapat dilakukan kapan saja dan di mana saja.',
                'manfaat' => "Meningkatkan sirkulasi darah\nMemperkuat kesehatan jantung\nMenjaga kekuatan tulang\nMembantu mengendalikan berat badan\nMeningkatkan mood dan mengurangi stress",
                'durasi_ideal' => '20–30 menit per hari, 5x seminggu.',
                'batasan_medis' => 'Hindari jalan menanjak bagi penderita jantung atau Osteoartritis lutut parah.',
                'peringatan' => 'Gunakan alas kaki yang nyaman dan empuk. Istirahat bila terasa nyeri pada sendi.',
                'tata_cara' => "1. Gunakan sepatu yang nyaman dan mendukung kaki\n2. Mulai dengan pemanasan ringan 5-10 menit\n3. Jalan dengan tempo sedang dan tetap\n4. Pertahankan postur tubuh yang tegak\n5. Ayunkan lengan secara natural\n6. Ambil napas secara teratur\n7. Akhiri dengan pendinginan 5-10 menit",
                'gambar' => 'olahraga/jalan-kaki.jpg'
            ],
            [
                'alternatif_id' => $alt['Senam Lansia'],
                'nama' => 'Senam Lansia',
                'deskripsi_singkat' => 'Gerakan-gerakan yang dirancang khusus untuk meningkatkan kebugaran lansia.',
                'deskripsi_umum' => 'Serangkaian gerakan ringan yang dirancang khusus untuk seluruh tubuh lansia.',
                'manfaat' => "Menjaga fleksibilitas sendi\nMeningkatkan koordinasi tubuh\nMemperkuat otot\nMembantu keseimbangan\nMeningkatkan mood",
                'durasi_ideal' => '3–4x seminggu, @ 30 menit.',
                'batasan_medis' => 'Aman untuk sebagian besar kondisi bila dilakukan perlahan dan sesuai kemampuan.',
                'peringatan' => 'Hindari gerakan menghentak, jongkok penuh, atau melompat.',
                'tata_cara' => "1. Mulai dengan pemanasan ringan\n2. Lakukan gerakan secara perlahan dan terkontrol\n3. Fokus pada pernapasan\n4. Ikuti instruksi gerakan dengan benar\n5. Jangan memaksakan gerakan yang sulit\n6. Istirahat bila merasa lelah\n7. Akhiri dengan pendinginan",
                'gambar' => 'olahraga/senam-lansia.jpg'
            ],
            [
                'alternatif_id' => $alt['Yoga Ringan'],
                'nama' => 'Yoga Ringan',
                'deskripsi_singkat' => 'Kombinasi gerakan lembut dan teknik pernapasan untuk ketenangan jiwa dan raga.',
                'deskripsi_umum' => 'Latihan pernapasan, peregangan lembut, dan relaksasi untuk menenangkan pikiran.',
                'manfaat' => "Mengurangi stres dan kecemasan\nMeningkatkan fleksibilitas\nMemperbaiki postur tubuh\nMeningkatkan konsentrasi\nMenjaga keseimbangan",
                'durasi_ideal' => '20–40 menit, 2-3x seminggu.',
                'batasan_medis' => 'Sangat baik untuk Hipertensi & Diabetes karena efek relaksasinya.',
                'peringatan' => 'Hindari posisi terbalik (inversi) bila memiliki tekanan darah tinggi atau glaukoma.',
                'tata_cara' => "1. Siapkan matras yoga\n2. Mulai dengan posisi duduk dan pernapasan dalam\n3. Lakukan peregangan ringan\n4. Ikuti gerakan dasar yoga secara perlahan\n5. Fokus pada pernapasan dan pose\n6. Pertahankan setiap pose sesuai kemampuan\n7. Akhiri dengan relaksasi",
                'gambar' => 'olahraga/yoga-ringan.jpg'
            ],
            [
                'alternatif_id' => $alt['Bersepeda Pelan'],
                'nama' => 'Bersepeda Pelan',
                'deskripsi_singkat' => 'Olahraga kardio yang aman untuk sendi dan menyenangkan untuk dilakukan.',
                'deskripsi_umum' => 'Latihan kardiovaskular ringan (low-impact). Bisa menggunakan sepeda statis.',
                'manfaat' => "Meningkatkan kesehatan jantung\nMemperkuat otot kaki\nMelatih keseimbangan\nMengurangi stress pada sendi\nMembakar kalori",
                'durasi_ideal' => '15–25 menit, 3x seminggu.',
                'batasan_medis' => 'Tidak disarankan untuk penderita Osteoartritis lutut yang sedang meradang parah.',
                'peringatan' => 'Pastikan posisi duduk stabil dan sadel tidak terlalu tinggi untuk menghindari cedera.',
                'tata_cara' => "1. Sesuaikan tinggi sadel dengan postur tubuh\n2. Mulai dengan pemanasan ringan\n3. Kayuh sepeda dengan tempo stabil\n4. Pertahankan postur yang nyaman\n5. Jaga pernapasan tetap teratur\n6. Tingkatkan kecepatan secara bertahap\n7. Akhiri dengan pendinginan",
                'gambar' => 'olahraga/bersepeda.jpg'
            ],
            [
                'alternatif_id' => $alt['Tai Chi'],
                'nama' => 'Tai Chi',
                'deskripsi_singkat' => 'Seni gerak tradisional yang memadukan kelenturan dan keseimbangan.',
                'deskripsi_umum' => 'Seni bela diri Tiongkok kuno yang fokus pada gerakan lambat, pernapasan, dan fokus mental.',
                'manfaat' => "Meningkatkan keseimbangan\nMengurangi risiko jatuh\nMemperkuat otot inti\nMeningkatkan konsentrasi\nMeredakan stress",
                'durasi_ideal' => '30–45 menit, 2-3x seminggu.',
                'batasan_medis' => 'Aman untuk hampir semua kondisi, termasuk penderita radang sendi.',
                'peringatan' => 'Lakukan di tempat yang datar dan tidak licin untuk menghindari terpeleset.',
                'tata_cara' => "1. Pilih area yang tenang dan datar\n2. Mulai dengan pemanasan ringan\n3. Fokus pada pernapasan dalam\n4. Ikuti gerakan dengan perlahan\n5. Pertahankan keseimbangan\n6. Lakukan gerakan mengalir\n7. Akhiri dengan meditasi ringan",
                'gambar' => 'olahraga/tai-chi.jpg'
            ],
        ]);
    }
}