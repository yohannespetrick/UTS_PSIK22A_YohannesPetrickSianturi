-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 11, 2023 at 11:55 PM
-- Server version: 8.0.34-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ladangc2_ahm`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `about_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `image` varchar(250) DEFAULT NULL,
  `update_at` varchar(50) DEFAULT NULL,
  `update_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`about_id`, `title`, `description`, `image`, `update_at`, `update_by`) VALUES
(1, 'Astra Honda Motor', 'Sepeda motor kini bukan hanya menjadi sarana transportasi produktif bagi masyarakat Indonesia. Sepeda motor sudah menjadi bagian dari hobi dan gaya hidup, bahkan bisa mengantarkan pada prestasi tertentu yang membanggakan. Untuk menemani masyarakat beraktivitas dan menggapai beragam mimpinya, PT Astra Honda Motor menghadirkan solusi mobilitas bagi masyarakat dengan produk dan layanan terbaik. Sejak pertama kali hadir di Indonesia, sepeda motor Honda selalu dicintai dan dipercaya menjadi partner berkendara masyarakat. Berbekal kepercayaan ini, PT Astra Honda Motor secara konsisten melakukan inovasi pada produk dan teknologinya, terus meningkatkan layanan di jaringan penjualan dan purna jual Honda, serta intens beraktivitas dan berkomunikasi dengan masyarakat melalui berbagai platform.\r\n\r\nSebagai bagian dari bangsa Indonesia, PT Astra Honda Motor senantiasa memperkuat kontribusinya di berbagai bidang, seperti keselamatan berkendara, pendidikan, lingkungan, dan pemberdayaan masyarakat. Diharapkan perusahaan akan terus tumbuh dan berkembang bersama masyarakat dan dapat menjadi salah satu perusahaan kebanggaan bangsa Indonesia.', 'about-5716-MRWR-9843.jpg', '2023-10-10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` int NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `update_at` varchar(50) DEFAULT NULL,
  `update_by` int DEFAULT NULL,
  `pinned` enum('yes','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `image`, `update_at`, `update_by`, `pinned`) VALUES
(6, 'banner-1832-xRPz-5836.jpg', '2023-10-10', 3, 'yes'),
(7, 'banner-9633-sl6Q-1138.jpg', '2023-10-10', 3, 'no'),
(8, 'banner-6961-DAva-9177.jpg', '2023-10-10', 3, 'no');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `category_name` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `status` enum('Active','Non Active') DEFAULT NULL,
  `update_at` varchar(50) DEFAULT NULL,
  `update_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `slug`, `status`, `update_at`, `update_by`) VALUES
(3, 'AH-Jakarta', 'ah-jakarta', 'Active', '2023-10-10', 1),
(4, 'PROMO', 'promo', 'Active', '2023-10-10', 3),
(5, 'News', 'news', 'Active', '2023-10-10', 3),
(6, 'Event', 'event', 'Active', '2023-10-10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int NOT NULL,
  `contact_name` varchar(100) DEFAULT NULL,
  `contact_type` varchar(50) DEFAULT NULL,
  `contact_target` varchar(100) DEFAULT NULL,
  `update_at` varchar(50) DEFAULT NULL,
  `update_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `contact_name`, `contact_type`, `contact_target`, `update_at`, `update_by`) VALUES
(1, '0811-9-500-989', 'wa', 'https://wa.me/628119500989', '2023-10-10', 1),
(3, '@welovehonda_id', 'ig', 'http://instagram.com/welovehonda_id', '2023-10-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `update_at` varchar(50) DEFAULT NULL,
  `update_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `image`, `update_at`, `update_by`) VALUES
(2, 'gallery-8420-Hovh-9357.jpg', '2023-10-10', 3),
(3, 'gallery-2576-4lqw-5468.jpg', '2023-10-10', 3),
(4, 'gallery-2332-ALz5-9887.jpg', '2023-10-10', 3),
(5, 'gallery-7153-sApI-1108.jpg', '2023-10-10', 3),
(6, 'gallery-9534-W5Oh-0496.jpg', '2023-10-10', 3),
(7, 'gallery-4340-DbME-1013.jpg', '2023-10-10', 3),
(8, 'gallery-2419-5vC7-2439.jpg', '2023-10-10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `tautan` varchar(300) NOT NULL,
  `category_id` int DEFAULT NULL,
  `description` text,
  `image` varchar(250) DEFAULT NULL,
  `publish_at` varchar(50) DEFAULT NULL,
  `update_at` varchar(50) DEFAULT NULL,
  `update_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `title`, `tautan`, `category_id`, `description`, `image`, `publish_at`, `update_at`, `update_by`) VALUES
(12, 'Cegah Motor Mogok Sejak Dini', 'cegah-motor-mogok-sejak-dini', 3, 'Lebih baik mencegah dari pada mengobatinya. Kalimat ini terasa pas, dalam merawat motor agar tidak mendadak jadi mogok, terlebih di tengah perjalanan dan jauh dari bengkel. \r\n\r\nSeperti umum diketahui, mogok terjadi karena proses pembakaran di ruang mesin motor, tidak bekerja secara normal. \r\n\r\nDan sesungguhnya ada 3 syarat penting agar mesin bisa bekerja secara normal yakni ketersediaan bahan bakar,  kompresi, dan pengapian yang baik. \r\n\r\nJika salah satu syarat  tersebut mengalami gangguan dan tidak terpenuhi  dengan baik,  maka mesin tidak akan bisa menyala alias ngadat, alias bakal mogok.\r\n\r\nNah, bagaimana menghindari motor mogok mendadak. Inilah tip singkat cara mencegahnya:\r\n\r\n1.Pastikan BBM Tersedia\r\nUpayakan untuk selalu  ingat dan memeriksa ketersediaan bahan bakar di  dalam tangki. Terkadang  sebagai pengendara  sering lalai  atau lupa untuk mengisi bahan bakar. Kebiasan beginilah yang bisa membuat motor mogok.  Maka pastikan suplai bahan bakar di dalam tangki menuju mesin tidak tersumbat yang bisa mengakibatkan mesin tidak menyala. \r\n\r\nHindari membeli bahan bakar eceran karena biasanya banyak bensin eceran sudah tercampur uap air.  Pastikan untuk selalu mengunakan jenis bahan bakar sesuai anjuran pabrik.\r\n\r\n2. Pastikan Filter Udara Tidak tersumbat\r\nRutinkan mengecek filter udara,  agar  tidak ada benda-benda asing yang tersumbat. Pastikan aliran udara menuju mesin mengalir dengan lancar. Sama dengan prinsip pada bahan bakar, hindari air masuk ke filter udara karena akan mengakibatkan motor mogok.\r\n\r\n3. Pastikan Tidak Dimodifikasi Berlebihan\r\nHati hati dalam memodifikasi motor. Efek modifikasi yang berlebihan bisa menyeabkan motor mogok. Hindari memodifikasi bagian mesin secara berlebihan. Selain bisa membuat motor mogok, memodifikasi berlebihan akan menggugurkan garansi motor.\r\n\r\n4.Pastikan Fungsi Kelistrikan\r\nPastikan komponen-komponen kelistrikan berfungsi normal, misalnya untuk motor-motor yang masih menggunakan CDI (Capacitor Discharge Ignition). Pastikan komponen CDI dalam kondisi yang baik. \r\n\r\nCara mengecek CDI motor, bisa buka kabel yang menuju busi kemudian lepas kop busi, lalu tempelkan ujung kabel tersebut ke bagian logam misalnya di bagian mesin. Lantas, coba starter mesin melalui kick starter atau electric starter. Jika dari ujung kabel tersebut keluar percikan api berarti suplai api masih dalam kondisi baik.', 'berita-3265-27U4-3167.jpg', '2023-10-10', '2023-10-10', 3),
(13, 'Rawat Rantai, Hindari Berisik', 'rawat-rantai,-hindari-berisik', 3, 'Seiring usia sebuah sepeda motor manual,  pasti rantai akan menjadi kotor. Dan untuk memastikan  bahwa rantai kotor bisa terdeteksi dari bunyi berisik atau gerakannya yang semakin tidak lancar. \r\n\r\nPenyebab rantai motor berisik paling umum adalah karena kotor terutama setelah dipakai di jalanan berlumpur atau hujan. Hal ini bakal makin parah bila motor tak segera dicuci usai terpapar kotoran atau debu.\r\n\r\nMasalah lain yang bisa bikin rantai berisik yaitu komponennya sudah aus karena pemakaian. Selain itu bisa juga lantaran rantai kendor, terlalu kering atau sudah karatan.  Pemilik motor manual bisa memulai perawatan dengan beberapa cara :\r\n\r\nPakai Sikat Gigi \r\nAda tips  mudah  untuk merontokan semua kotoran ini, yakni dengan menggunakan  sikat gigi dan minyak tanah gosok   secara perlahan untuk merontokkan semua kotoran. \r\n\r\nPakai Pelumas\r\nSetelah rantai dibersihkan mulai aplikasikan pelumas. Sebaiknya menggunakan pelumas baru dan berkualitas, bukan yang bekas. Pelumas bisa dipakai untuk rantai yang sudah bersih, sebaiknya tak digunakan jika masih kotor karena akan menambah kotoran menempel.\r\n\r\nChain lube\r\nPelumas bukan satu-satunya alat buat merawat rantai, bisa  juga gunakan produk khusus rantai chain lube.\r\n\r\nFungsi chain lube  adalah juga untuk  melindungi rantai dari penumpuukan debu, sekaligus mengurangi suara bising dari gesekan rantai dan keausan atau penumpukan debu. \r\n\r\nProduk ini juga mampu melindungi gear dari karat. Anda hanya perlu menyemprotkannya secara merata sambil memutar rantai dengan cara menyalakan mesin lalu masukkan gigi satu.\r\n\r\nSetel rantai\r\nDi tengah pembersihan, pastikan rantai  tidak kendor.  Sesungguhnya rantaibisa  kendor  karena dua alasan yakni salah setel atau kurang perawatan. Pada umumnya logam pada rantai akan mengendur karena gaya tarik yang membuat rantai kelamaan lebih panjang.\r\n\r\nRantai kendur karena pemakaian adalah hal yang wajar, tetapi  hal ini tetap butuh perhatian. Nah, untuk mengencangkan rantai kendor, sebaiknya langsung ditangani  ahli  di bengkel. \r\n\r\nSilahkan kunjungi bengkel AHASS  terdekat, sekaligus  lakukan pemeriksaan dan perawatan motor berkala secara rutin di bengkel AHASS terdekat agar seluruh  fitur dan komponen sepeda motor tetap bisa bekerja secara optimal.\r\n\r\nAda baiknya memanfaatkan pula layanan booking service dan layanan kunjung AHASS untuk kebebasan waktu dalam melakukan service.', 'berita-1555-w4yJ-1599.jpg', '2023-10-10', '2023-10-10', 3),
(16, 'Program Sales Honda Vario 160 Agustus - Desember 2023?', 'program-sales-honda-vario-160-agustus---desember-2023?', 4, 'Dapatkan Special Gift mulai dari Rp 300.000* untuk setiap pembelian Honda Vario 160* selama periode Agustus-Desember 2023.?\r\n*syarat &amp; ketentuan berlaku?', 'berita-2426-t6uB-0281.jpg', '2023-10-10', '2023-10-10', 3),
(17, 'Program Sales Honda GTR150 Juli - September 2023', 'program-sales-honda-gtr150-juli---september-2023', 4, 'Dapatkan Diskon mulai dari Rp 1.000.000* untuk setiap pembelian Honda GTR150* selama periode Juli - September 2023.\r\n*syarat &amp; ketentuan berlaku', 'berita-5036-GA0H-9268.jpg', '2023-10-10', '2023-10-10', 3),
(18, 'Program Sales Honda CB150X Juli - September 2023', 'program-sales-honda-cb150x-juli---september-2023', 4, 'Dapatkan Diskon mulai dari Rp 1.500.000* untuk setiap pembelian Honda CB150X* selama periode Juli - September 2023.\r\n\r\n\r\n*syarat &amp; ketentuan berlaku', 'berita-4254-n0vW-6665.jpg', '2023-10-10', '2023-10-10', 3),
(19, 'Program Sales Honda Genio Agustus - September 2023?', 'program-sales-honda-genio-agustus---september-2023?', 4, 'Dapatkan Special Gift mulai dari Rp 200.000* untuk setiap pembelian Honda Genio* selama periode Agustus-September 2023.?\r\n*syarat &amp; ketentuan berlaku?', 'berita-2135-EQwQ-1972.jpg', '2023-10-10', '2023-10-10', 3),
(20, '137 Bikers Honda di Jakarta Camping Sambil Berbagi Ilmu di NGAYAB II', '137-bikers-honda-di-jakarta-camping-sambil-berbagi-ilmu-di-ngayab-ii', 3, 'Ngamping Bareng Paguyuban (NGAYAB) menjadi agenda rutin bagi Asosiasi Honda Jakarta (AHJ) yang diadakan setiap 6 bulan sekali. Setelah sukses melaksanakan agenda NGAYAB Babak I atau pertama pada November 2022 lalu, kembali AHJ melaksanakan NGAYAB Babak II atau kedua.\r\n\r\nKegiatan kali ini berlangsung pada hari Sabtu-Minggu, 29-30 Juli 2023 lalu yang mengambil lokasi di Pesona Bukit Damar, Megamendung Bogor - Jawa Barat. NGAYAB Babak II kali ini diikuti sebanyak 137 orang bikers perwakilan dari 34 klub/ komunitas yang tergabung di dalam AHJ.\r\n\r\nRangkaian acara yang berlangsung sejak siang hari hingga tengah malam ini diawali dengan registrasi di lokasi acara sekitar pukul 14.00 WIB. Usai pembagian tenda, berbagai acara menarik di area alam terbuka pun disajikan oleh Panitia Pelaksana yang diketuai Brad Agus Hilman. ', 'berita-3546-RuhC-6630.jpg', '2023-10-10', '2023-10-10', 3),
(21, 'Liga FPL Honda Community 2023-2024 is Back', 'liga-fpl-honda-community-2023-2024-is-back', 3, 'JADI JUARA &amp; MENANGKAN HADIAHNYA!\r\n\r\nBrad &amp; Sis, sekarang giliran lo yang jadi juara Liga FPL Honda Community! Menangkan hadiah total 12 juta rupiah! Buat pemenang di AKHIR MUSIM ada total hadiah Rp. 6.000.000 dan buat peserta dengan poin tertinggi setiap GAME WEEK, ada saldo tunai Rp. 150.000 buat lo! ?\r\n\r\nHadiah setiap GAME WEEK\r\nRp. 150,000\r\n\r\nHadiah AKHIR MUSIM\r\nPeringkat 1 = Rp 3.000.000,-\r\nPeringkat 2 = Rp 2.000.000,-\r\nPeringkat 3 = Rp 1.000.000,-\r\n\r\n \r\n\r\nCara ikutan:\r\n\r\n1. FOLLOW akun Instagram @honda.community\r\n\r\n2. SHARE dan LIKE postingan Liga FPL Honda Community 2023-2024.\r\n\r\n3. WAJIB tulis nama tim di kolom komentar postingan Liga FPL Honda Community 2023-2024 Instagram @honda.community, dan mention 3 orang teman untuk ajak mereka ikutan.\r\n\r\n4. GABUNG ke Liga FPL Honda Community dengan masukkan kode hl8j0f di situs https://fantasy.premierleague.com\r\n\r\n \r\n\r\nSyarat dan Ketentuan:\r\n\r\n\r\n1. Peserta wajib follow akun IG @honda.community.\r\n\r\n2. Setiap peserta otomatis mengikuti Liga FPL Honda Community sebagai Manager tim FPL masing-masing.\r\n\r\n3. Nama Manajer harus sesuai dengan nama pada kartu identitas (KTP) untuk klaim hadiah.\r\n\r\n4. Setiap Manajer harus mendaftarkan 1 tim.\r\n\r\n5. Manajer wajib menulis nama tim di kolom komentar postingan Liga FPL Honda Community 2023-2024 Instagram @honda.community.\r\n\r\n6. Nama tim tidak boleh mengandung unsur SARA, asusila, kebencian dan politik.\r\n\r\n7. Tipe liga FPL yang akan dilombakan adalah tipe Classic League.\r\n\r\n8. Kompetisi berjalan selama 1 musim mulai dari Game Week ke-1 dan berakhir di Game Week ke-38.\r\n\r\n9. Sistem perolehan poin mengikuti aturan resmi FPL.\r\n\r\n10. Batas pendaftaran tim akan ditutup pada 10 Agustus 2023 pukul 23:59 WIB, sebelum Game Week 1 dimulai.\r\n\r\n11. Pemenang GAME WEEK adalah tim yang memperoleh poin tertinggi berdasarkan periode GAME WEEK yang sudah ditetapkan website resmi FPL.\r\n\r\n12. Hadiah GAME WEEK diberikan pada tim dengan perolehan poin tertinggi yang sudah terdaftar pada Liga FPL Honda Community sejak GAME WEEK 1.\r\n\r\n13. Pemenang umum FPL Musim 2023/2024 adalah tim yang memperoleh poin akumulasi tertinggi berdasarkan periode FPL musim 2023/2024 yang diselenggarakan dari GAME WEEK 1 hingga GAME WEEK 38.\r\n\r\n14. Untuk klaim hadiah, pemenang diwajibkan mengirim hasil capture formasi tim, manajer dan HCID dalam periode maksimal 3 bulan setelah pengumuman pemenang melalui DM Instagram @honda.community atau email info@hondacommunity.net  \r\n\r\n15. Pemenang wajib/bersedia memiliki HCID saat konfirmasi hadiah.\r\n\r\n16. Syarat dan ketentuan dapat berubah jika diperlukan dan akan diumumkan lewat halaman ini.\r\n\r\n17. Peraturan yang berlaku di Liga FPL Honda Community ini mutlak mengikuti aturan resmi FPL yang berlaku di website fantasy.premierleague.com \r\n\r\n18. Dengan mengikuti Liga FPL Honda Community, artinya lo setuju dengan syarat dan ketentuan ini.\r\n \r\n\r\nSelamat bertanding, Brad &amp; Sis! ?\r\n\r\n \r\n\r\n-----', 'berita-0152-OqlR-1154.jpg', '2023-10-10', '2023-10-10', 3),
(22, 'Honda Community MXGP Gathering 2023 Jadi Cara Bikers Honda Dukung Delvintor Berlaga', 'honda-community-mxgp-gathering-2023-jadi-cara-bikers-honda-dukung-delvintor-berlaga', 6, 'Menyambut gelaran gelaran balap motocross dunia FIM Motocross World Championship (MXGP) kelas MX2, di Samota, Sumbawa, Nusa Tenggara Barat, yang berlangsung pada Minggu, 25 Juni 2023, para bikers motor Honda dari seluruh penjuru Tanah air menggelar rangkaian aktivitas seru untuk mengekspresikan dukungan Crosser andalan Honda, Delvintor Alfarizi.\r\n\r\n \r\n\r\nSeperti halnya dukungan yang datang dari sejumlah komunitas Honda yang ada di wilayah Sumatera Utara, yaitu CRF Padepokan Enduro, CB150X Adventure Id Medan, dan CB150X Adventure Id Binjai. Dimana melalui aktivitas bertajuk “ Honda Community MXGP Gathering 2023 “ yang juga berlangsung pada 25 Juni 2023,   para bikers CRF dengan penuh semangat memberikan dukungannya kepada satu-satunya pembalap Indonesia binaan Astra Honda Racing Team (AHRT) di kelas MX2 itu.\r\n\r\n \r\n\r\nDukungan dimulai dengan aktivitas city rolling  bersama motor kebanggaan Honda CRF yang mengambil titik start dari kantor Indako Ngumban Surbakti, Jl Gagak Hitam Ringroad hingga simpang Manhattan - melalui Jl Gatot Subroto – Jl. KH. Wahid Hasyim (Simp. Barat)- dan Jl. Sei Besitang hingga hingga menuju di Dominico Café.\r\n\r\n \r\n\r\nKesenangan berkendara selama city rolling juga dimanfaatkan para bikers untuk melancarkan aksi soslalnya dengan memberikan bantuan berupa bahan sembako kepada para tunawisma yang dijumpai di jalan. Senyum kebahagiaan sontak terpancar dari wajah para tunawisma yang mendapatkan bantuan dari para bikers Honda CRF.\r\n\r\n \r\n\r\nIndahnya momen kebersamaan para bikers juga semakin terlihat setibanya di Dominico Café, dimana beragam games seru khas bikers Honda yang selalu menghadirkan kekompakan dan persaudaraan. Antusias juga terlihat saat sesi nonton bareng (nobar) MXGP dan gathering Community untuk mendukung Crosser Honda Delvintor Alfarizi dimulai.\r\n\r\n \r\n\r\nBro Reynaldi dari CRF Padepokan Enduro mengungkapkan, sangat bersyukur dapat turut serta dalam aktivitas Honda Community MXGP Gathering 2023 yang tidak hanya menjadi wadah para bikers untuk mengekspresikan dukungan kepada Delvintor Alfarizi , namun juga memberikan pengalaman berkendara menyenangkan bersama Honda CRF, dan menumbuhkan kepekaan sosial melalui aksi sosial berbagai kepada sesama\r\n\r\n \r\n\r\nSementara itu Sutjipto, Marketing Communication Manager PT Indako Trading Coy selaku main dealer Honda di wilayah Sumatera Utara mengungkapkan, sangat mengapresiasi dukungan semangat Satu Hati yang diberikan sejumlah komunitas Honda kepada Crosser kebanggaan Honda. Pihaknya berharap dukungan ini dapat menjadi pemacu semangat Delvintor dalam berkontribusi mengharumkan nama bangsa dengan mencetak prestasi membanggakan untuk Indonesia.\r\n\r\n \r\n\r\nPada kesempatan ini, dukungan juga diberikan Crosser binaan AHRT lainnya yakni Nuzul Ramzidan yang juga turun di kelas MX2 sebagai wildcard, hingga harus merelakan seri Sumbawa. Pemuda berusia 18 tahun ini terjatuh di tikungan 8 saat sesi time practice (24/06). Ramzidan mengalami cedera pada lutut kirinya, sehingga harus mundur dan tidak mengikuti qualifying race dan balap di seri Sumbawa ini.\r\n\r\n[Sumut Honda Bikers]', 'berita-8875-mwqt-2860.jpg', '2023-10-10', '2023-10-10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `news_id` int NOT NULL,
  `title` varchar(225) DEFAULT NULL,
  `tautan` varchar(300) NOT NULL,
  `category_id` int DEFAULT NULL,
  `description` text,
  `image` varchar(250) DEFAULT NULL,
  `publish_at` varchar(50) DEFAULT NULL,
  `update_at` varchar(50) DEFAULT NULL,
  `update_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`news_id`, `title`, `tautan`, `category_id`, `description`, `image`, `publish_at`, `update_at`, `update_by`) VALUES
(2, 'Ajak Warga Jakut Tak Golput di 2024, Sahroni Malah Ditanya soal Pilgub DKI', 'ajak-warga-jakut-tak-golput-di-2024,-sahroni-malah-ditanya-soal-pilgub-dki', 1, 'Wakil Ketua Komisi III DPR RI Ahmad Sahroni mengisi reses di DPR dengan mengunjungi dapilnya di Kecamatan Koja dan Kelurahan Sunter Agung, Jakarta Utara, Minggu (23/7). Ia mengajak masyarakat sekitar berpartisipasi aktif di Pemilu 2024.\r\nTerlihat masyarakat antusias memadati GOR Rawabadak dan Sunter Muara, tempat diselenggarakannya kegiatan reses. Setiap masyarakat yang hadir pun turut mendapat bantuan berupa paket sembako.\r\nIa menekankan akan pentingnya menggunakan hak partisipasi dalam pemilu. Bahkan Sahroni meminta angka masyarakat yang tidak menggunakan hak pilihnya (golput) dapat ditekan, khususnya di wilayah Jakarta Utara.\r\nï¿½Pak bu, sebentar lagi kan mau pemilu, saya ingin bapak ibu semua gunakan hak suara dengan sebaik-baiknya. Jangan sampai golput, malah kalau bisa di Jakarta Utara, angka golputnya nol,ï¿½ papar Sahroni kepada warga, disampaikan dalam keterangan tertulis.', 'berita-0424-y7bz-4233.jpg', '2023-10-10', '2023-10-10', 1),
(3, 'Jokowi: Capres-Capres Itu Ngopi Bareng, Kok yang di Bawah Bertengkar?', 'jokowi:-capres-capres-itu-ngopi-bareng,-kok-yang-di-bawah-bertengkar?', 1, 'Presiden Jokowi menghadiri peringatan Hari Lahir (Harlah) ke-25 PKB di Solo. Dalam sambutannya, Jokowi menyinggung soal pesta demokrasi yang menyenangkan, jauh dari pertengkaran.\r\n&quot;Sudah sering kita dengar pemilu pesta demokrasi, yang namanya pesta harusnya, rakyat harus bersenang. Iya ndak? Rakyat itu bergembira,&quot; kata Jokowi, Minggu (23/7).\r\n&quot;Tidak boleh ada ketakutan-ketakutan, tidak boleh ada pertengkaran-pertengkaran. Mestinya seperti itu. Rakyat harus bersenang bergembira. Namanya pesta demokrasi,&quot; sambungnya.\r\nAtas dasar itu, ia berharap tidak ada kebencian dalam pemilu yang akan datang. Jokowi juga menyinggung soal sosok calon-calon presiden yang akan menggantikannya, justru dalam kondisi rukun dan baik.\r\nDia berharap kompetisi lima tahunan pada 2024 nanti tak ada dinamika yang buruk. Berjalan dengan damai.', 'berita-2697-nAAh-9784.jpg', '2023-10-10', '2023-10-10', 1),
(4, 'Bos Instagram: Android Lebih Baik Ketimbang iOS', 'bos-instagram:-android-lebih-baik-ketimbang-ios', 2, 'Debat Android vs iOS tak kunjung selesai, bahkan makin panas belakangan ini. Pemicu terbarunya kali ini dari pemimpin media sosial Instagram, Adam Mosseri.\r\n\r\nHead of Instagram tersebut percaya Android lebih baik dibandingkan iOS. Pernyataan tersebut dia ungkap di akun Threads miliknya ketika mengomentari postingannya MKBHD, akun milik YouTuber pengulas teknologi Marques Brownlee.\r\n\r\nBrownlee meminta follower-nya dan pengguna lain di Threads untuk mengeluarkan komentar atau pendapat kontroversial soal teknologi. Postingan tersebut ditanggapi Mosseri begini:\r\n\r\nTidak ada pernyataan lebih lanjut dari Mosseri, termasuk penjelasan alasan mengapa Android lebih baik dibandingkan iOS. Komentarnya mendapatkan lebih dari 3.500 like dan lebih dari 500 tanggapan per Sabtu (22/7) siang.\r\n\r\nPernyataan Mosseri langsung memicu perdebatan panas di internet. Ada netizen yang setuju, dengan salah satunya bilang Android terus berinovasi, sementara Apple stagnan. Ada juga netizen gak sependapat yang salah satunya sebut pengalaman aplikasi iOS lebih stabil, sedangkan aplikasi Android sering crash.\r\n\r\nDiskusi Android vs iOS juga menyebar ke platform lain macam Reddit. Forum internet tersebut menjadi tempat bagi pengguna membagikan pandangannya tentang apakah mereka setuju atau tidak dengan pernyataan Mosseri.\r\n\r\nSebelumnya, Consumer Intelligence Research Partners (CIRP) mengeluarkan laporan riset soal tren pengguna HP Android pindah ke iPhone meningkat dalam satu dekade terakhir. Surveinya menyebut tingkat migrasi ini telah berfluktuasi antara 10 dan 15 persen dalam beberapa tahun terakhir, dengan tren yang diamati sedikit naik dalam beberapa kuartal terakhir.', 'berita-3420-P1Fk-1202.jpg', '2023-10-10', '2023-10-10', 1),
(5, 'Elon Musk Bikin X.com Jadi Situs Twitter, Malah Diblokir Kominfo', 'elon-musk-bikin-x.com-jadi-situs-twitter,-malah-diblokir-kominfo', 2, 'Elon Musk resmi rebranding media sosial Twitter. Selain mengubah nama dan logonya, dia juga membuat domain X.com menjadi situs web Twitter.\r\n\r\nSayangnya, website X.com gak bisa diakses di Indonesia. Alamat tersebut diblokir Kementerian Komunikasi dan Informatika (Kominfo).\r\n\r\nBerdasarkan pantuan kumparan, Selasa (25/7), sebuah pesan atau notifikasi situs diblokir akan muncul ketika mencoba mengakses X.com di web browser. Berikut bunyi peringatannya:\r\n\r\n&quot;Maaf, akses ke situs ini diblokir sehubungan dengan Peraturan Menteri Kominfo No.19/2014 tentang Internet Sehat. Terima kasih atas pengertian Anda.&quot;\r\n\r\nBeruntung X.com tidak menggantikan sepenuhnya situs web Twitter.com, karena domain tersebut hanya dibuat untuk mengarahkan pengguna ke Twitter versi web. Dengan begitu, pengguna di  Indonesia masih bisa mengakses Twitter melalui alamat lama Twitter.com.\r\n\r\nTanggapan Kominfo\r\n\r\nKominfo sudah angkat bicara terkait isu X.com digunakan Twitter. Pemerintah mengatakan domain X.com diblokir karena pernah digunakan sebagai alamat situs web dengan konten negatif yang melanggar aturan di Indonesia.', 'berita-6322-Esax-4455.jpg', '2023-10-10', '2023-10-10', 1),
(6, 'Satpam Sekolah Internasional Nyambi Jual Sabu, Kini Diciduk Polisi', 'satpam-sekolah-internasional-nyambi-jual-sabu,-kini-diciduk-polisi', 3, 'Seorang satpam sekolah internasional di kawasan Cilandak, Jakarta Selatan, ketahuan menjual narkoba jenis sabu. Pria berinisial RR (29) itu pun akhirnya diciduk polisi.\r\n\r\nKapolsek Cilandak Kompol Wahid Key mengatakan, RR ditangkap pada Senin (17/7) lalu. \r\n\r\n&quot;Saat ditangkap, tersangka yang sedang bertugas di sekolah berusaha melarikan diri namun akhirnya tertangkap setelah terjadi kejar mengejar,&quot; kata Wahid dalam keterangannya, Minggu (23/7).\r\n\r\nMenurut Wahid, polisi turut mengamankan beberapa pake sabu siap edar. Sebelum menangkap RR, polisi lebih dulu menangkap pembelinya. Dia juga seorang satpam di sekolah tersebut. \r\n\r\n&quot;Polisi juga menangkap satpam lain di sekolah itu yang selalu pembeli di hari sebelumnya, yang masih menyisakan barang bukti saat ditangkap,&quot; jelasnya.\r\n\r\n&quot;Dari hasil penyelidikan, diketahui pelaku sudah hampir setahun melakukan aksinya dan menjual kepada para pemakai narkoba yang dikenal dekat, di antaranya rekan seprofesinya di sekolah tersebut,&quot; tandasnya.', 'berita-1541-9BTM-1254.jpg', '2023-10-10', '2023-10-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `profile_name` varchar(100) DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(225) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `update_at` varchar(50) DEFAULT NULL,
  `update_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `username`, `profile_name`, `description`, `email`, `image`, `update_at`, `update_by`) VALUES
(2, 'abngpetrick', 'Yohannes Petrick Sianturi', 'merupakan seorang web developer yang berasal dari kota tangerang, indonesia.\r\n\r\nbeliau aktif bekerja pada bidang product digital &amp; jasa.\r\n\r\npernah menempuh pendidikan pada SMKN 5 Kota Tangerang, dan saat ini sedang aktif dalam perkuliahan di Institut Teknologi dan Bisnis Bina Sarana Global, mengambil keahlian Teknik Informatika.\r\n\r\nselain web developer, juga gemar sekali dengan melakukan desain ui/ux, dan membuat rancangan2 lainnya.', 'yohannes.patrick03@gmail.com', 'profile-2820-7T9f-5033.jpg', '2023-10-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `testimonial_id` int NOT NULL,
  `customer_name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `description` varchar(225) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `update_at` varchar(50) DEFAULT NULL,
  `update_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`testimonial_id`, `customer_name`, `description`, `image`, `update_at`, `update_by`) VALUES
(2, 'Pradita Aldi Firmansyah', 'Menurut gue ini showroom terbaik di Tangerang, disini kita bisa beli motor cash /kredit dan service motor, pelayanan terbaik , pegawainya ramah.disini kita bisa service sekalian ngerjain tugas kampus karna tempat nya yg nyama', 'testi-4554-PBOK-5428.png', '2023-10-10', 3),
(3, 'ilhamdi', 'The best sih pelayanan buat servicenya dan waktu ambil motor d sini juga sales baik sertakomunikatif, Ruang Tunggu juga enak  ada banyak pilihan cemilam biar nga gabut nungguin bisa sambil ngemil sama ngeteh,.', 'testi-9357-zNFk-9654.png', '2023-10-10', 3),
(4, 'Nani Chen', 'Motor saya motor lama, sepertinya disini ga terlalu lengkap karena yg datang kebanyakan motornya baru semua.\r\nJd barang saya bnyk yg kosong. Saran mending booking dl sblm dtg krna rame.', 'testi-6847-Zb3T-4365.png', '2023-10-10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `level` enum('Admin','Staff') CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `registered` date NOT NULL,
  `status` enum('Active','Suspended') CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL,
  `uplink` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fullname`, `username`, `email`, `password`, `level`, `registered`, `status`, `uplink`) VALUES
(1, 'Yohannes P. S.', 'staff', 'staff@yohannespetrick.my.id', '1253208465b1efa876f982d8a9e73eef', 'Staff', '2023-10-10', 'Active', 'Website'),
(3, 'Yohannes Petrick Sianturi', 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '2023-10-10', 'Active', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`about_id`),
  ADD KEY `FK_updateby_about` (`update_by`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`),
  ADD KEY `FK_updateby_banner` (`update_by`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `FK_updateby_category` (`update_by`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `FK_updateby_contact` (`update_by`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`),
  ADD KEY `FK_updateby_gallery` (`update_by`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `FK_updateby_news` (`update_by`),
  ADD KEY `FK_categoryid_news` (`category_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`news_id`),
  ADD KEY `FK_updateby_news` (`update_by`),
  ADD KEY `FK_categoryid_news` (`category_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `FK_updateby_profile` (`update_by`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`testimonial_id`) USING BTREE,
  ADD KEY `FK_updateby_testimonial` (`update_by`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `about_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `news_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `testimonial_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
