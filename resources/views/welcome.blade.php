<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Sistem Promosi Mahasiswa - ITSK RS dr. Soepraoen</title>
  <meta name="description" content="Platform bagi mahasiswa ITSK Soepraoen untuk berpartisipasi aktif dalam promosi kampus. Ajukan proposal kegiatan, dan jadilah duta almamater.">
  <meta name="keywords" content="ITSK Soepraoen, Promosi Kampus, Kegiatan Mahasiswa, Proposal Online">

  <!-- Favicons -->
  <link href="https://bootstrapmade.com/demo/templates/FlexStart/assets/img/favicon.png" rel="icon">
  <link href="https://bootstrapmade.com/demo/templates/FlexStart/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

  <!-- Main CSS File -->
  <link href="https://bootstrapmade.com/demo/templates/FlexStart/assets/css/main.css" rel="stylesheet">

  <!-- Custom CSS for Elegant Design -->
  <style>
    :root {
      --primary-blue: #2563EB;
      --primary-aqua: #22D3EE;
      --primary-glow: #E0F2FE;
      --accent-color: #000080; /* Pink neon */
      --light-color: #FFFFFF;
      --dark-color: #1F2937; /* Abu gelap */
      --base-color: #FFFFFF;
      --font-primary: 'Poppins', sans-serif;
      --font-secondary: 'Roboto', sans-serif;
    }

    body {
      font-family: var(--font-secondary);
      color: var(--dark-color);
      background-color: var(--base-color);
    }

    h1, h2, h3, h4, h5, h6 {
      font-family: var(--font-primary);
      color: var(--dark-color);
    }

    /* Preloader */
    #preloader {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 9999;
      overflow: hidden;
      background: var(--primary-blue);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    #preloader:before {
      content: "";
      position: fixed;
      top: calc(50% - 30px);
      left: calc(50% - 30px);
      border: 6px solid var(--accent-color);
      border-top-color: var(--light-color);
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: animate-preloader 1s linear infinite;
    }
    @keyframes animate-preloader {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Navbar */
    .header {
      background-color: rgba(37, 99, 235, 0.9); /* Solid blue from gradient */
    }
    .navmenu a, .navmenu a:focus {
        color: rgba(255, 255, 255, 0.8);
    }
    .navmenu a:hover, .navmenu .active, .navmenu .active:focus {
        color: var(--light-color);
    }
    .btn-getstarted {
        background: var(--accent-color);
        color: var(--light-color);
        font-weight: 600;
        border: 2px solid var(--accent-color);
    }
    .btn-getstarted:hover {
        background: #4884ecff; /* Slightly darker pink on hover */
        border-color: #094aa4ff;
        color: var(--light-color);
    }

    /* Hero Section */
    #hero {
      width: 100%;
      height: 100vh;
      background: url("{{ asset('image/gedung.jpg') }}") center center;
      background-size: cover;
      position: relative;
    }
    #hero:before {
      content: "";
      background: linear-gradient(45deg, rgba(37, 99, 235, 0.85), rgba(34, 211, 238, 0.85)); /* Gradient Overlay */
      position: absolute;
      bottom: 0;
      top: 0;
      left: 0;
      right: 0;
    }
    #hero h1 {
      color: var(--light-color);
      font-weight: 700;
      font-size: 48px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }
    #hero p {
      color: rgba(255, 255, 255, 0.9);
    }
    #hero .btn-get-started {
      background: var(--accent-color);
      color: var(--light-color);
      font-weight: 600;
      border: 2px solid var(--accent-color);
    }
     #hero .btn-get-started:hover {
        background: #5348ecff;
        border-color: #ec4899;
     }
    #hero .btn-watch-video {
        color: var(--light-color);
    }

    /* Sections */
    .section {
        background-color: var(--light-color);
    }
    .section-title {
        text-align: center;
        padding-bottom: 30px;
    }
    .section-title .pill-title {
        display: inline-block;
        padding: 6px 20px;
        background-color: var(--primary-glow);
        color: var(--primary-blue);
        border-radius: 50px;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 15px;
        text-transform: uppercase;
    }
    .section-title h2 {
        color: var(--dark-color);
        font-weight: 700;
        margin-bottom: 0;
    }

    /* Features Section */
    .features .feature-box {
        border: 1px solid #e5e7eb;
        transition: 0.3s;
        border-radius: 8px;
        background-color: var(--light-color);
        padding: 30px;
        text-align: left;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
    }
    .features .feature-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
    }
    .features .feature-box h3 {
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    .features .feature-box i {
        font-size: 24px;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: var(--primary-glow);
        color: var(--primary-blue);
        border-radius: 50%;
        margin-bottom: 15px;
    }

    /* Services Section Custom Colors */
    .services.section {
        background-color: #F9FAFB; /* Lighter gray for this section */
    }
    .service-item {
        transition: transform 0.3s;
        border-radius: 8px;
        padding: 30px;
        background-color: var(--light-color);
        box-shadow: 0 0 30px rgba(0,0,0,0.08);
    }
    .service-item:hover {
        transform: translateY(-10px);
    }
    .service-item.item-blue { --item-color: #2563EB; }
    .service-item.item-aqua { --item-color: #22D3EE; }
    .service-item.item-pink { --item-color: #F472B6; }
    .service-item .icon { color: var(--item-color); font-size: 3rem; }
    .service-item h3 { color: var(--item-color); font-size: 1.2rem; font-weight: 600; }
    .service-item p { font-size: 0.9rem; }


    /* CTA Section */
    .cta {
        background: linear-gradient(45deg, rgba(37, 99, 235, 0.9), rgba(34, 211, 238, 0.9)), url("{{ asset('image/gedung.jpg') }}") fixed center center;
        background-size: cover;
        padding: 120px 0;
    }
    .cta h3, .cta p {
        color: var(--light-color);
    }
    .cta .cta-btn {
        font-family: var(--font-primary);
        font-weight: 600;
        font-size: 16px;
        letter-spacing: 1px;
        display: inline-block;
        padding: 12px 40px;
        border-radius: 50px;
        transition: 0.5s;
        margin: 10px;
        border: 2px solid var(--accent-color);
        color: var(--light-color);
        background: var(--accent-color);
    }
    .cta .cta-btn:hover {
        background: transparent;
        color: var(--accent-color);
    }
    
    /* Contact Section */
    .contact .info-item {
        background: var(--light-color);
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
        width: 100%;
        margin-bottom: 20px;
    }
    .contact .info-item i {
        font-size: 24px;
        width: 50px;
        height: 50px;
        background: #fde2f3; /* Lighter pink */
        color: var(--accent-color);
        border-radius: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
    }
    .contact .info-item h3 {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
    }
    .contact .php-email-form {
        width: 100%;
        background: var(--light-color);
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
    }
     .contact .php-email-form button[type="submit"] {
        background: var(--accent-color);
        border: 0;
        padding: 10px 30px;
        color: #fff;
        transition: 0.4s;
        border-radius: 50px;
    }
    .contact .php-email-form button[type="submit"]:hover {
        background: #ec4899;
    }


    /* Footer */
    .footer { background: #F9FAFB; }
    .footer .footer-top { background: var(--light-color); }
    .footer .footer-contact p, .footer .footer-links a { color: #555; }
    .footer .footer-links a:hover { color: var(--accent-color); }
    .footer .copyright { background: #F9FAFB; }

  </style>
</head>

<body>

  <!-- ======= Preloader ======= -->
  <div id="preloader"></div>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="/" class="logo d-flex align-items-center me-auto">
        <img src="{{ asset('image/ITSK-oke.png') }}" alt="Logo ITSK Soepraoen">
<h1 class="sitename" style="color: white;">ITSK dr. Soepraoen</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Beranda</a></li>
          <li><a href="#features">Alur Sistem</a></li>
          <li><a href="#prodi">Jenis Kegiatan</a></li>
          <li><a href="#testimonials">Testimoni</a></li>
          <li><a href="#faq">FAQ</a></li>
          <li><a href="#contact">Kontak</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted flex-md-shrink-0" href="{{ url('/student') }}">Login</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" data-aos="fade-up">
                    <h1>Sistem Informasi Promosi Kampus</h1>
                    <p>Platform untuk mahasiswa ITSK Soepraoen berpartisipasi aktif sebagai duta kampus. Ajukan proposal kegiatan promosimu dan jadilah bagian dari kemajuan almamater.</p>
                    <div class="d-flex">
                        <a href="#" class="btn me-3 btn-get-started">Ajukan Proposal</a>
<a href="#features" class="glightbox btn-watch-video d-flex align-items-center c">
  <i class="bi bi-arrow-right-circle" style="color: white;"></i>
  <span>Lihat Alur Sistem</span>
</a>

                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Hero Section -->

    <!-- Features Section -->
    <section id="features" class="features section">
      <div class="container section-title" data-aos="fade-up">
        <p class="pill-title">Alur Sistem</p>
        <h2>Langkah Mudah Berpartisipasi dalam Promosi Kampus</h2>
      </div>
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="feature-box">
              <i class="bi bi-file-earmark-plus"></i>
              <h3>1. Ajukan Proposal</h3>
              <p>Login ke akun mahasiswa Anda dan isi formulir pengajuan proposal kegiatan secara online.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-box">
              <i class="bi bi-clipboard-check"></i>
              <h3>2. Review & Persetujuan</h3>
              <p>Proposal Anda akan ditinjau oleh staf dan pembina terkait. Pantau statusnya secara real-time.</p>
            </div>
          </div>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="feature-box">
              <i class="bi bi-flag"></i>
              <h3>3. Pelaksanaan & Pelaporan</h3>
              <p>Laksanakan kegiatan yang telah disetujui dan unggah laporan pertanggungjawaban di sistem.</p>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Features Section -->

    <!-- Program Studi Section -->
    <section id="prodi" class="services section">
        <div class="container section-title" data-aos="fade-up">
            <p class="pill-title">Jenis Kegiatan Promosi</p>
            <h2>Inspirasi Kegiatan yang Bisa Kamu Ajukan</h2>
        </div>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item item-blue position-relative">
                        <i class="bi bi-building icon"></i>
                        <h3>Kunjungan Sekolah</h3>
                        <p>Memperkenalkan ITSK Soepraoen secara langsung ke siswa-siswi SMA/SMK.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item item-aqua position-relative">
                        <i class="bi bi-calendar4-event icon"></i>
                        <h3>Pameran Pendidikan</h3>
                        <p>Berpartisipasi dalam event pameran kampus untuk menjaring calon mahasiswa.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item item-pink position-relative">
                        <i class="bi bi-mic icon"></i>
                        <h3>Seminar & Workshop</h3>
                        <p>Mengadakan seminar kesehatan atau workshop yang relevan dengan program studi.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item item-aqua position-relative">
                        <i class="bi bi-instagram icon"></i>
                        <h3>Konten Media Sosial</h3>
                        <p>Membuat konten kreatif (video, poster) untuk promosi di platform digital.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-item item-pink position-relative">
                        <i class="bi bi-people icon"></i>
                        <h3>Pengabdian Masyarakat</h3>
                        <p>Kegiatan sosial yang sekaligus memperkenalkan peran kampus kepada masyarakat.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-item item-blue position-relative">
                        <i class="bi bi-lightbulb icon"></i>
                        <h3>Ide Kreatif Lainnya</h3>
                        <p>Punya ide promosi lain? Ajukan proposalmu dan wujudkan bersama kami!</p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Program Studi Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">
      <div class="container section-title" data-aos="fade-up">
        <p class="pill-title">Testimoni Mahasiswa</p>
        <h2>Pengalaman Menggunakan Sistem Promosi</h2>
      </div>
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": { "delay": 5000 },
              "slidesPerView": "auto",
              "pagination": { "el": ".swiper-pagination", "type": "bullets", "clickable": true },
              "breakpoints": {
                "320": { "slidesPerView": 1, "spaceBetween": 40 },
                "1200": { "slidesPerView": 3, "spaceBetween": 20 }
              }
            }
          </script>
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Sistem ini membuat pengajuan proposal jadi sangat mudah dan terorganisir. Tidak ada lagi berkas yang tercecer.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <div class="profile mt-auto">
                  <img src="https://bootstrapmade.com/demo/templates/FlexStart/assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                  <h3>Budi Setiawan</h3>
                  <h4>Mahasiswa S1 Keperawatan</h4>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Saya bisa memantau status proposal saya kapan saja. Fitur notifikasinya sangat membantu agar tidak ketinggalan info.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <div class="profile mt-auto">
                  <img src="https://bootstrapmade.com/demo/templates/FlexStart/assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                  <h3>Siti Aminah</h3>
                  <h4>Mahasiswa S1 Gizi</h4>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Proses dari pengajuan, persetujuan, hingga pelaporan jadi satu alur yang jelas. Sangat efisien!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <div class="profile mt-auto">
                  <img src="https://bootstrapmade.com/demo/templates/FlexStart/assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                  <h3>Joko Susilo</h3>
                  <h4>Mahasiswa D3 Fisioterapi</h4>
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section><!-- /Testimonials Section -->

    <!-- FAQ Section -->
    <section id="faq" class="faq section">
      <div class="container section-title" data-aos="fade-up">
        <p class="pill-title">Frequently Asked Questions</p>
        <h2>Seputar Sistem Promosi Mahasiswa</h2>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="faq-container">
              <div class="faq-item">
                <h3><span class="num">1.</span> Siapa saja yang bisa mengajukan proposal?</h3>
                <div class="faq-content">
                  <p>Seluruh mahasiswa aktif ITSK RS dr. Soepraoen dapat mengajukan proposal, baik secara individu maupun berkelompok (organisasi).</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
              <div class="faq-item">
                <h3><span class="num">2.</span> Berapa lama proses review proposal?</h3>
                <div class="faq-content">
                  <p>Proses review biasanya memakan waktu 3-5 hari kerja, tergantung pada kelengkapan dan kompleksitas proposal yang diajukan.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
             <div class="faq-container">
              <div class="faq-item">
                <h3><span class="num">3.</span> Apakah ada pendanaan untuk kegiatan?</h3>
                <div class="faq-content">
                  <p>Ya, setiap proposal yang disetujui akan mendapatkan dukungan pendanaan dari pihak kemahasiswaan sesuai dengan anggaran yang telah disetujui.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
                 <div class="faq-item">
                <h3><span class="num">4.</span> Bagaimana cara melihat status proposal saya?</h3>
                <div class="faq-content">
                  <p>Anda dapat login ke dashboard mahasiswa untuk melihat status proposal Anda secara real-time, apakah sedang direview, perlu revisi, disetujui, atau ditolak.</p>
                </div>
                <i class="faq-toggle bi bi-chevron-right"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /FAQ Section -->

    <!-- Call to Action Section -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-out">
            <div class="row g-5">
                <div class="col-lg-8 col-md-6 content d-flex flex-column justify-content-center order-last order-md-first">
                    <h3>Punya Ide Promosi yang Brilian?</h3>
                    <p>Jangan ragu untuk mewujudkannya. Sistem kami siap mendukung kreativitas Anda untuk kemajuan bersama. Segera ajukan proposal kegiatanmu!</p>
                </div>
                <div class="col-lg-4 col-md-6 order-first order-md-last d-flex align-items-center">
                    <div class="img">
                        <img src="https://bootstrapmade.com/demo/templates/FlexStart/assets/img/cta.jpg" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
             <div class="text-center mt-4">
                <a class="cta-btn" href="{{ url('/student') }}">Login dan Ajukan Proposal</a>
            </div>
        </div>
    </section><!-- /Call to Action Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">
        <div class="container section-title" data-aos="fade-up">
            <p class="pill-title">Kontak</p>
            <h2>Hubungi Tim Kemahasiswaan</h2>
        </div>
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="row gy-4">
                <div class="col-lg-6">
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                        <i class="bi bi-geo-alt flex-shrink-0"></i>
                        <div>
                        <h3>Alamat</h3>
                        <p>Jl. Jenderal Sudirman No.10, Malang, Jawa Timur</p>
                        </div>
                    </div>
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                        <i class="bi bi-telephone flex-shrink-0"></i>
                        <div>
                        <h3>Telepon</h3>
                        <p>(0341) 123-456</p>
                        </div>
                    </div>
                    <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                        <i class="bi bi-envelope flex-shrink-0"></i>
                        <div>
                        <h3>Email</h3>
                        <p>kemahasiswaan@itsk-soepraoen.ac.id</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="#" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Nama Anda" required="">
                            </div>
                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Email Anda" required="">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subjek" required="">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control" name="message" rows="6" placeholder="Pesan" required=""></textarea>
                            </div>
                            <div class="col-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Pesan Anda telah terkirim. Terima kasih!</div>
                                <button type="submit">Kirim Pesan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer">
    <div class="container footer-top">
        <div class="row gy-4">
            <div class="col-lg-5 col-md-12 footer-about">
                <a href="/" class="logo d-flex align-items-center">
                    <img src="{{ asset('image/ITSK-oke.png') }}" alt="Logo ITSK Soepraoen" style="max-height: 40px; margin-right: 10px;">
                    <span class="sitename">ITSK Soepraoen</span>
                </a>
                <p class="mt-3">Mencetak lulusan yang unggul, profesional, dan berdaya saing global di bidang kesehatan dan teknologi.</p>
                <div class="social-links d-flex mt-4">
                    <a href=""><i class="bi bi-twitter-x"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-6 footer-links">
                <h4>Tautan Penting</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="#hero">Beranda</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#prodi">Jenis Kegiatan</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#faq">FAQ</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="#">Website Utama</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6 footer-links">
                <h4>Portal</h4>
                <ul>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ url('/admin') }}">Login Admin</a></li>
                    <li><i class="bi bi-chevron-right"></i> <a href="{{ url('/student') }}">Login Mahasiswa</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                <h4>Hubungi Kami</h4>
                <p>
                    Jl. S. Supriadi No.22, Sukun, Kec. Sukun, Kota Malang, Jawa Timur Kode Pos: 65147<br><br>
                    <strong>Telepon:</strong> <span>(0341) 123-456</span><br>
                    <strong>Email:</strong> <span>info@itsk-soepraoen.ac.id</span><br>
                </p>
            </div>
        </div>
    </div>
    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">ITSK Soepraoen</strong> <span>All Rights Reserved</span></p>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
  <script src="https://bootstrapmade.com/demo/templates/FlexStart/assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="https://bootstrapmade.com/demo/templates/FlexStart/assets/vendor/php-email-form/validate.js"></script>
  
  <!-- Main JS File -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      "use strict";

      /**
       * Preloader
       */
      const preloader = document.querySelector('#preloader');
      if (preloader) {
        window.addEventListener('load', () => {
          preloader.remove();
        });
      }

      /**
       * Sticky header on scroll
       */
      const selectHeader = document.querySelector('#header');
      if (selectHeader) {
        document.addEventListener('scroll', () => {
          window.scrollY > 100 ? selectHeader.classList.add('sticked') : selectHeader.classList.remove('sticked');
        });
      }

      /**
       * Mobile nav toggle
       */
      const mobileNavToogle = document.querySelector('.mobile-nav-toggle');
      if (mobileNavToogle) {
        mobileNavToogle.addEventListener('click', function(event) {
          event.preventDefault();
          document.querySelector('body').classList.toggle('mobile-nav-active');
          this.classList.toggle('bi-list');
          this.classList.toggle('bi-x');
        });
      }

      /**
       * Hide mobile nav on same-page/hash links
       */
      document.querySelectorAll('#navmenu a').forEach(navmenu => {
        navmenu.addEventListener('click', () => {
          if (document.querySelector('.mobile-nav-active')) {
            document.querySelector('.mobile-nav-active').classList.remove('mobile-nav-active');
            let navbarToggle = document.querySelector('.mobile-nav-toggle');
            navbarToggle.classList.toggle('bi-list');
            navbarToggle.classList.toggle('bi-x');
          }
        });
      });

      /**
       * Toggle mobile nav dropdowns
       */
      const navDropdowns = document.querySelectorAll('.navmenu .dropdown > a');
      navDropdowns.forEach(el => {
        el.addEventListener('click', function(event) {
          if (document.querySelector('.mobile-nav-active')) {
            event.preventDefault();
            this.classList.toggle('active');
            this.nextElementSibling.classList.toggle('dropdown-active');
            let dropDownIndicator = this.querySelector('.toggle-dropdown');
            dropDownIndicator.classList.toggle('bi-chevron-up');
            dropDownIndicator.classList.toggle('bi-chevron-down');
          }
        })
      });

      /**
       * Scroll top button
       */
      const scrollTop = document.querySelector('.scroll-top');
      if (scrollTop) {
        const togglescrollTop = function() {
          window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
        }
        window.addEventListener('load', togglescrollTop);
        document.addEventListener('scroll', togglescrollTop);
        scrollTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
      }

      /**
       * Animation on scroll function and init
       */
      function aos_init() {
        AOS.init({
          duration: 1000,
          easing: 'ease-in-out',
          once: true,
          mirror: false
        });
      }
      window.addEventListener('load', () => {
        aos_init();
      });

      /**
       * Init swiper sliders
       */
      function initSwiper() {
        document.querySelectorAll('.init-swiper').forEach(function(swiperElement) {
          let config = JSON.parse(swiperElement.querySelector('.swiper-config').innerHTML.trim());
          new Swiper(swiperElement, config);
        });
      }
      window.addEventListener('load', initSwiper);

      /**
       * GLightbox
       */
      const glightbox = GLightbox({
        selector: '.glightbox'
      });

      /**
       * Pure Counter
       */
      new PureCounter();

      /**
       * FAQ Toggle
       */
      const faqItems = document.querySelectorAll('.faq-item');
      faqItems.forEach(item => {
          item.addEventListener('click', () => {
              item.classList.toggle('active');
          });
      });

    });
  </script>

</body>
</html>