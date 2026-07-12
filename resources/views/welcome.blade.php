<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VitaGuard Health Platform</title>
    
    <!-- Memanggil favicon dari public/images/logo-fav.png -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-fav.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Memanggil file CSS dari public/css/app.css tanpa Vite -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<nav class="nav">
  <div class="nav-inner">
    <a href="#top" class="nav-logo">
      <!-- Memanggil logo utama dari public/images/logo.png -->
      <img src="{{ asset('images/logo.png') }}" alt="Logo VitaGuard">
    </a>
    <div class="nav-actions">
      <!-- Menggunakan route Laravel untuk Register dan Login -->
      <a href="{{ route('register') }}" class="btn btn-ghost">Buat Akun Baru</a>
      <a href="{{ route('login') }}" class="btn btn-solid">Masuk</a>
    </div>
  </div>
</nav>

<header class="hero" id="top">
  <div class="hero-content">
    <div class="hero-mark">
      <!-- Memanggil logo icon dari public/images/logo-fav.png untuk hiasan -->
      <img src="{{ asset('images/logo-fav.png') }}" alt="Lambang VitaGuard">
    </div>
    <h1>VitaGuard Health Platform</h1>
    <p class="hero-tagline">Solusi Kesehatan Terpadu Anda: Informasi, Konsultasi, dan Lebih Banyak Lagi.</p>
  </div>
</header>

<section class="vision">
  <div class="vision-grid">
    <div class="reveal">
      <span class="vision-eyebrow">Visi Kami</span>
      <h2>Platform Layanan Kesehatan Digital untuk Semua</h2>
      <p>VitaGuard hadir untuk menghubungkan setiap orang dengan layanan kesehatan yang terpercaya, kapan pun dan di mana pun dibutuhkan. Kami percaya akses kesehatan yang baik seharusnya sederhana, cepat, dan tanpa hambatan — mulai dari konsultasi dengan dokter, pencarian layanan yang tepat, hingga informasi kesehatan yang benar-benar bisa diandalkan. Satu platform, untuk menjaga Anda dan orang-orang terdekat.</p>
    </div>
  </div>
</section>

<section class="features">
  <div class="section-head reveal">
    <span class="vision-eyebrow">Fitur Unggulan</span>
    <h2>Semua yang Anda butuhkan, dalam satu genggaman</h2>
  </div>
  <div class="feature-grid">
    <div class="feature-card reveal">
      <div class="feature-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 12a8 8 0 1 1 3.2 6.4L4 20l1.3-3.4A7.96 7.96 0 0 1 4 12Z"/>
          <path d="M9 11h6M9 14h4"/>
        </svg>
      </div>
      <h3>Konsultasi Online</h3>
      <p>Ngobrol langsung dengan dokter berlisensi kapan saja, dari mana saja, tanpa perlu antre di klinik.</p>
    </div>

    <div class="feature-card reveal">
      <div class="feature-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="10.5" cy="10.5" r="6.5"/>
          <path d="M15.2 15.2 21 21"/>
          <path d="M8 10.5h5"/>
        </svg>
      </div>
      <h3>Pencarian Dokter</h3>
      <p>Temukan dokter sesuai spesialisasi, lokasi, dan jadwal yang paling cocok untuk kebutuhan Anda.</p>
    </div>

    <div class="feature-card reveal">
      <div class="feature-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 3 4.5 6v6c0 4.6 3.2 7.7 7.5 9 4.3-1.3 7.5-4.4 7.5-9V6L12 3Z"/>
          <path d="m9 12 2 2 4-4"/>
        </svg>
      </div>
      <h3>Informasi Terpercaya</h3>
      <p>Akses artikel dan panduan kesehatan yang ditinjau tenaga medis profesional, bebas informasi menyesatkan.</p>
    </div>

    <div class="feature-card reveal">
      <div class="feature-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <rect x="4" y="5.5" width="16" height="15" rx="2.5"/>
          <path d="M4 10h16M8 3.5v3M16 3.5v3"/>
          <path d="m9.5 14.5 1.7 1.7 3.3-3.4"/>
        </svg>
      </div>
      <h3>Booking Jadwal</h3>
      <p>Atur jadwal kunjungan atau konsultasi dengan sekali ketuk, lengkap dengan pengingat otomatis.</p>
    </div>
  </div>
</section>

<section class="steps">
  <div class="section-head reveal">
    <span class="vision-eyebrow">Alur Sederhana</span>
    <h2>Cara Mudah Mulai Kesehatan Anda</h2>
  </div>

  <div class="steps-row">
    <svg class="steps-thread" viewBox="0 0 1180 40" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,20 C300,-10 380,50 600,20 C820,-10 900,50 1180,20" fill="none" stroke="#8fe3d6" stroke-width="2.5" stroke-dasharray="1 10" stroke-linecap="round"/>
    </svg>

    <div class="step reveal">
      <div class="step-num">1</div>
      <h3>Registrasi</h3>
      <p>Buat akun VitaGuard dalam waktu kurang dari dua menit. Cukup isi data diri dan Anda siap memulai.</p>
    </div>

    <div class="step reveal">
      <div class="step-num">2</div>
      <h3>Cari Layanan / Dokter</h3>
      <p>Jelajahi daftar dokter dan layanan kesehatan yang tersedia, sesuaikan dengan kebutuhan Anda.</p>
    </div>

    <div class="step reveal">
      <div class="step-num">3</div>
      <h3>Konsultasi / Pesan Jadwal</h3>
      <p>Mulai konsultasi online atau pesan jadwal kunjungan langsung dari aplikasi, tanpa ribet.</p>
    </div>
  </div>
</section>



<script>
  // Script untuk efek animasi saat scroll 
  const io = new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
      if(entry.isIntersecting){
        entry.target.classList.add('in-view');
        io.unobserve(entry.target);
      }
    });
  }, {threshold:0.2});

  document.querySelectorAll('.reveal').forEach(el=>io.observe(el));
</script>

</body>
</html>
