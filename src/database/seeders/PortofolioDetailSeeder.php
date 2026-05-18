<?php

namespace Database\Seeders;

use App\Models\Portofolio;
use App\Models\PortofolioDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PortofolioDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nokoribite = Portofolio::where(
            'slug',
            'nokoribite'
        )->first();

        if ($nokoribite) {

            PortofolioDetail::create([

                'portofolio_id' => $nokoribite->id,

                'project_description' => '

                    <p>
                        Nokoribite merupakan platform marketplace berbasis web
                        yang dirancang untuk membantu penjualan makanan
                        mendekati tanggal kedaluwarsa dengan sistem
                        diskon dinamis.
                    </p>

                    <p>
                        Sistem ini bertujuan untuk mengurangi food waste
                        pada ritel modern sekaligus membantu konsumen
                        memperoleh produk dengan harga lebih terjangkau.
                    </p>

                ',

                'problem_analysis' => '

                    <p>
                        Tingginya tingkat food waste pada supermarket
                        dan toko modern menjadi permasalahan utama
                        yang diangkat dalam proyek ini.
                    </p>

                    <p>
                        Banyak produk makanan yang sebenarnya masih layak
                        konsumsi harus dibuang karena tidak terjual sebelum
                        mendekati tanggal kedaluwarsa.
                    </p>

                    <p>
                        Selain merugikan pihak toko, kondisi ini juga
                        berdampak terhadap lingkungan dan pemborosan
                        sumber daya pangan.
                    </p>

                ',

                'system_requirements' => '

                    <ul>
                        <li>Manajemen produk makanan</li>
                        <li>Sistem diskon otomatis</li>
                        <li>Keranjang belanja</li>
                        <li>Checkout dan pembayaran online</li>
                        <li>Dashboard admin</li>
                        <li>Monitoring transaksi</li>
                    </ul>

                ',

                'architecture_explanation' => '

                    <p>
                        Sistem menggunakan arsitektur MVC
                        (Model View Controller) berbasis Laravel.
                    </p>

                    <p>
                        Frontend dibangun menggunakan Blade dan Livewire
                        untuk menghasilkan antarmuka interaktif,
                        sedangkan backend menggunakan Laravel
                        sebagai framework utama.
                    </p>

                    <p>
                        Filament digunakan untuk dashboard administrasi
                        agar proses pengelolaan data lebih efisien.
                    </p>

                ',

                'tech_stack_explanation' => '

                    <p>
                        Laravel digunakan sebagai backend framework utama
                        untuk mengelola routing, autentikasi,
                        dan logika bisnis aplikasi.
                    </p>

                    <p>
                        Filament v3 digunakan untuk membangun admin panel,
                        sedangkan MariaDB digunakan sebagai database utama.
                    </p>

                    <p>
                        Docker digunakan untuk containerization
                        agar environment pengembangan lebih konsisten.
                    </p>

                ',

                'erd_image' =>
                    'portofolio-details/erd.png',

                'flowchart_image' =>
                    'portofolio-details/usecase.png',

                'conclusion' => '

                    <p>
                        Nokoribite diharapkan mampu membantu
                        mengurangi tingkat food waste melalui
                        digitalisasi penjualan makanan mendekati
                        tanggal kedaluwarsa.
                    </p>

                ',
            ]);
        }

        $billing = Portofolio::where(
            'slug',
            'rt-rw-net-billing-system'
        )->first();

        if ($billing) {

            PortofolioDetail::create([

                'portofolio_id' => $billing->id,

                'project_description' => '

                    <p>
                        RT/RW Net Billing System merupakan platform e-billing
                        yang dirancang khusus untuk penyedia layanan internet
                        di tingkat RT/RW untuk mengelola invoice dan pembayaran
                        secara otomatis.
                    </p>

                    <p>
                        Sistem ini memudahkan penyedia layanan dalam
                        mengelola pelanggan dan pembayaran bulanan
                        dengan integrasi gateway pembayaran online.
                    </p>

                ',

                'problem_analysis' => '

                    <p>
                        Banyak penyedia RT/RW Net yang masih menggunakan
                        sistem manual dalam pencatatan pembayaran pelanggan,
                        sehingga sering terjadi kesalahan pencatatan
                        dan kehilangan data pembayaran.
                    </p>

                    <p>
                        Diperlukan sistem yang terintegrasi untuk
                        meningkatkan efisiensi pengelolaan pembayaran
                        dan memberikan transparansi kepada pelanggan.
                    </p>

                ',

                'system_requirements' => '

                    <ul>
                        <li>Manajemen pelanggan</li>
                        <li>Generate invoice otomatis</li>
                        <li>Integrasi payment gateway (Midtrans)</li>
                        <li>Tracking pembayaran</li>
                        <li>Laporan keuangan</li>
                        <li>Notifikasi pembayaran</li>
                    </ul>

                ',

                'architecture_explanation' => '

                    <p>
                        Sistem dibangun menggunakan Laravel sebagai framework
                        utama dengan Filament untuk admin dashboard
                        yang user-friendly.
                    </p>

                    <p>
                        Livewire digunakan untuk membuat komponen interaktif
                        tanpa perlu page reload, meningkatkan user experience.
                    </p>

                ',

                'tech_stack_explanation' => '

                    <p>
                        Laravel dipilih karena kemudahan dalam membuat
                        REST API dan mengelola database relational.
                    </p>

                    <p>
                        Midtrans sebagai payment gateway mendukung berbagai
                        metode pembayaran yang populer di Indonesia.
                    </p>

                    <p>
                        Livewire untuk real-time update tanpa API call berlebihan,
                        sehingga meningkatkan performa sistem.
                    </p>

                ',

                'erd_image' =>
                    'portofolio-details/erd.png',

                'flowchart_image' =>
                    'portofolio-details/usecase.png',

                'conclusion' => '

                    <p>
                        RT/RW Net Billing System diharapkan dapat meningkatkan
                        efisiensi pengelolaan pembayaran dan memberikan
                        pengalaman yang lebih baik bagi pelanggan.
                    </p>

                ',
            ]);
        }

        $portfolio = Portofolio::where(
            'slug',
            'personal-developer-portfolio'
        )->first();

        if ($portfolio) {

            PortofolioDetail::create([

                'portofolio_id' => $portfolio->id,

                'project_description' => '

                    <p>
                        Personal Developer Portfolio merupakan website portofolio
                        pribadi yang menampilkan profil, project, dan skill
                        seorang developer dengan desain minimalis modern.
                    </p>

                    <p>
                        Website ini dirancang untuk showcase karya dan
                        membantu dalam mencari peluang kerja atau kolaborasi
                        dengan memberikan presentasi yang profesional.
                    </p>

                ',

                'problem_analysis' => '

                    <p>
                        Banyak developer yang kesulitan dalam menampilkan
                        karya mereka dengan cara yang menarik dan profesional.
                        Portfolio yang baik dapat membantu dalam mendapatkan
                        peluang kerja lebih baik.
                    </p>

                    <p>
                        Diperlukan website portofolio yang responsif,
                        cepat, dan memiliki tampilan yang menarik
                        untuk meninggalkan kesan baik kepada recruiter.
                    </p>

                ',

                'system_requirements' => '

                    <ul>
                        <li>Halaman profil dan about</li>
                        <li>Gallery project dengan detail</li>
                        <li>Contact form</li>
                        <li>Responsive design</li>
                        <li>SEO friendly</li>
                        <li>Fast loading performance</li>
                    </ul>

                ',

                'architecture_explanation' => '

                    <p>
                        Website dibangun menggunakan Laravel dengan Blade
                        sebagai template engine untuk rendering HTML.
                    </p>

                    <p>
                        Tailwind CSS digunakan untuk styling agar website
                        responsif dan memiliki tampilan yang modern.
                    </p>

                    <p>
                        Vite digunakan sebagai build tool untuk bundling
                        CSS dan JavaScript dengan cepat.
                    </p>

                ',

                'tech_stack_explanation' => '

                    <p>
                        Laravel dipilih karena fleksibilitasnya dalam
                        membuat website dinamis dengan performa tinggi.
                    </p>

                    <p>
                        Blade menyediakan template engine yang powerful
                        untuk membuat halaman dengan logika kompleks.
                    </p>

                    <p>
                        Tailwind CSS mempercepat proses styling dengan
                        utility-first approach yang sangat produktif.
                    </p>

                ',

                'erd_image' =>
                    'portofolio-details/erd.png',

                'flowchart_image' =>
                    'portofolio-details/usecase.png',

                'conclusion' => '

                    <p>
                        Personal Developer Portfolio menunjukkan kemampuan
                        dalam full-stack web development dengan fokus pada
                        clean code dan user experience yang optimal.
                    </p>

                ',
            ]);
        }
    }
}
