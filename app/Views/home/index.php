<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- ═══════════════════════════════════════════════
     HERO SECTION
     ═══════════════════════════════════════════════ -->
<section class="hero" id="hero">
    <div class="hero-bg"></div>
    <div class="hero-grid"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>

    <div class="container" style="width:100%;">
        <div class="hero-content">

            <!-- Left: Text -->
            <div data-aos="fade-right" data-aos-delay="100">
                <div class="hero-eyebrow">
                    <span class="dot"></span>
                    Ebook Gratis 100% — Untuk Anda
                </div>

                <h1 class="hero-title">
                    Jangan Sampai Harta Anak Yatim
                    <span class="highlight">Membawa Petaka</span>
                    bagi Anda
                </h1>

                <p class="hero-subtitle">
                    Panduan praktis dan sesuai syariat untuk mengelola harta anak yatim.
                    Lindungi diri Anda dari ancaman memakan harta mereka secara zalim.
                </p>

                <div class="hero-cta">
                    <a href="#download-form" class="btn-primary">
                        <i data-lucide="book-open" style="width:20px;height:20px;"></i>
                        Kirim Ebook ke Email Saya
                    </a>
                    <a href="#bab-ebook" class="btn-ghost">
                        <i data-lucide="list" style="width:18px;height:18px;"></i>
                        Lihat Isi Ebook
                    </a>
                </div>

                <!-- Mini trust strip -->
                <div class="hero-trust-strip" style="display:flex; gap:24px; flex-wrap:wrap; margin-top:40px;">
                    <div style="display:flex; align-items:center; gap:8px; font-size:0.82rem; color:#c9b8b0; font-weight:600;">
                        <i data-lucide="shield-check" style="width:16px;height:16px;color:#d4a847;"></i>
                        100% Gratis
                    </div>
                    <div style="display:flex; align-items:center; gap:8px; font-size:0.82rem; color:#c9b8b0; font-weight:600;">
                        <i data-lucide="lock" style="width:16px;height:16px;color:#d4a847;"></i>
                        Data Aman
                    </div>
                    <div style="display:flex; align-items:center; gap:8px; font-size:0.82rem; color:#c9b8b0; font-weight:600;">
                        <i data-lucide="file-text" style="width:16px;height:16px;color:#d4a847;"></i>
                        Format PDF
                    </div>
                    <div style="display:flex; align-items:center; gap:8px; font-size:0.82rem; color:#c9b8b0; font-weight:600;">
                        <i data-lucide="clock" style="width:16px;height:16px;color:#d4a847;"></i>
                        Instan via Email
                    </div>
                </div>
            </div>

            <!-- Right: Book Mockup -->
            <div class="book-wrapper" data-aos="fade-left" data-aos-delay="200">
                <!-- Float badge 1 -->
                <div class="float-badge float-badge-1">
                    <i data-lucide="star" style="width:14px;height:14px;color:#d4a847;"></i>
                    Fikih Muamalah
                </div>

                <!-- Book glow -->
                <div class="book-glow"></div>

                <!-- Book card -->
                <div class="book-card">
                    <?php
                    $coverFile = 'img/cover-buku.jpeg';
                    if (file_exists(FCPATH . 'img/cover-buku.jpeg')) {
                        $coverFile = 'img/cover-buku.jpeg';
                    } elseif (file_exists(FCPATH . 'img/cover-buku.jpg')) {
                        $coverFile = 'img/cover-buku.jpg';
                    } elseif (file_exists(FCPATH . 'img/cover-buku.png')) {
                        $coverFile = 'img/cover-buku.png';
                    } elseif (file_exists(FCPATH . 'img/cover-buku.webp')) {
                        $coverFile = 'img/cover-buku.webp';
                    }
                    $coverUrl = base_url($coverFile) . '?v=' . (file_exists(FCPATH . $coverFile) ? filemtime(FCPATH . $coverFile) : time());
                    ?>
                    <img src="<?= $coverUrl ?>"
                         alt="Cover Ebook Panduan Fikih Harta Anak Yatim"
                         onerror="this.src='https://placehold.co/560x800/341916/d4a847?text=Panduan+Fikih%0AHarta+Anak+Yatim';">
                    <div class="book-badge">GRATIS</div>
                </div>

                <!-- Float badge 2 -->
                <div class="float-badge float-badge-2">
                    <i data-lucide="users" style="width:14px;height:14px;color:#d4a847;"></i>
                    Wali & Pengurus Yatim
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     TRUST STRIP
     ═══════════════════════════════════════════════ -->
<div class="trust-strip">
    <div class="container">
        <div class="trust-grid">
            <div class="trust-item">
                <i data-lucide="book" style="width:18px;height:18px;color:#d4a847;"></i>
                46+ Halaman Komprehensif
            </div>
            <div class="trust-item">
                <i data-lucide="check-circle-2" style="width:18px;height:18px;color:#d4a847;"></i>
                7 Bab Utama
            </div>
            <div class="trust-item">
                <i data-lucide="clipboard-list" style="width:18px;height:18px;color:#d4a847;"></i>
                3 Lampiran Praktis
            </div>
            <div class="trust-item">
                <i data-lucide="message-square" style="width:18px;height:18px;color:#d4a847;"></i>
                50+ Poin Penting
            </div>
            <div class="trust-item">
                <i data-lucide="book-marked" style="width:18px;height:18px;color:#d4a847;"></i>
                46 Catatan Kaki
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════
     PAIN POINTS (LIGHT SECTION)
     ═══════════════════════════════════════════════ -->
<section class="section section-light" id="pertanyaan">
    <div class="container">

        <div class="text-center" data-aos="fade-up">
            <div class="section-label label-brand" style="justify-content:center;">
                <i data-lucide="help-circle" style="width:16px;height:16px;"></i>
                Masalah yang Sering Muncul
            </div>
            <h2 class="section-title section-title-light">
                Apakah Anda Sering Ragu<br>Menghadapi <span style="color:var(--brand-600);">Pertanyaan Ini?</span>
            </h2>
            <p class="section-desc desc-light" style="margin:0 auto;">
                Banyak wali anak yatim yang bertanya-tanya tentang hal-hal berikut. Jika Anda salah satunya, ebook ini adalah jawaban yang Anda cari.
            </p>
        </div>

        <div class="pain-grid">
            <?php
            $pain_points = [
                ["icon" => "help-circle", "text" => "Bolehkah saya menggunakan harta anak yatim untuk biaya sekolahnya sendiri?"],
                ["icon" => "percent", "text" => "Apakah harta anak yatim wajib dikeluarkan zakatnya?"],
                ["icon" => "calendar-clock", "text" => "Kapan batas waktu harta anak yatim boleh diserahkan sepenuhnya kepada mereka?"],
                ["icon" => "shuffle", "text" => "Bagaimana jika harta tersebut bercampur dengan harta saya sendiri?"],
                ["icon" => "trending-up", "text" => "Bolehkah saya memutar harta anak yatim untuk modal usaha agar berkembang?"],
                ["icon" => "gift", "text" => "Bagaimana cara membedakan hadiah untuk anak yatim dan harta warisannya?"],
            ];
            foreach ($pain_points as $i => $point):
            ?>
            <div class="pain-card" data-aos="fade-up" data-aos-delay="<?= $i * 60 ?>">
                <div class="pain-icon">
                    <i data-lucide="<?= $point['icon'] ?>" style="width:20px;height:20px;"></i>
                </div>
                <p class="pain-text"><?= $point['text'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="pain-cta-box" data-aos="fade-up" data-aos-delay="200">
            <i data-lucide="alert-triangle" style="width:24px;height:24px;color:var(--brand-500);margin-bottom:12px;"></i>
            <p>Jika ada <strong>satu saja</strong> pertanyaan di atas yang membuat Anda ragu,<br>
            Anda <strong>WAJIB</strong> membaca panduan ini sekarang juga!</p>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════════
     CHAPTERS (DARK SECTION)
     ═══════════════════════════════════════════════ -->
<section class="section section-deep" id="bab-ebook">
    <div class="particles" id="chapters-particles"></div>
    <div class="container" style="position:relative;z-index:1;">

        <div class="text-center" data-aos="fade-up">
            <div class="section-label label-gold" style="justify-content:center;">
                <i data-lucide="layers" style="width:16px;height:16px;"></i>
                Daftar Isi Ebook
            </div>
            <h2 class="section-title section-title-dark">
                Apa Saja yang Akan<br>Anda <span style="color:var(--gold);">Pelajari?</span>
            </h2>
            <p class="section-desc desc-dark" style="margin:0 auto;">
                Ringkasan 7 Bab Utama yang dikemas secara sistematis dengan bahasa mudah dipahami
            </p>
        </div>

        <?php
        $chapters = [
            ["title" => "Siapakah Anak Yatim?", "desc" => "Definisi, batasan usia, dan kedudukan anak yatim dalam hukum Islam berdasarkan dalil-dalil yang shahih."],
            ["title" => "Hak-Hak Anak Yatim", "desc" => "Hak harta, hak pengasuhan, hak pendidikan, dan hak perlindungan anak yatim yang wajib dipenuhi."],
            ["title" => "Pengelolaan Harta Yatim", "desc" => "Cara yang benar dan dibolehkan syariat dalam mengelola, menyimpan, dan mengembangkan harta anak yatim."],
            ["title" => "Larangan-Larangan Keras", "desc" => "Hal-hal yang diharamkan berkaitan dengan harta anak yatim beserta ancaman dan hukumannya di dunia dan akhirat."],
            ["title" => "Zakat Harta Anak Yatim", "desc" => "Hukum mengeluarkan zakat dari harta anak yatim dan siapa yang wajib membayarkannya menurut para ulama."],
            ["title" => "Penyerahan Harta Yatim", "desc" => "Prosedur dan syarat sah penyerahan harta kepada anak yatim yang telah baligh dan cakap hukum."],
            ["title" => "Pertanggungjawaban Wali", "desc" => "Tanggung jawab wali di hadapan Allah, cara melepaskan diri dari pertanggungjawaban, dan tips dokumentasi."],
        ];
        ?>

        <div class="chapters-grid" style="margin-top:56px;">
            <?php foreach ($chapters as $i => $ch): ?>
            <div class="chapter-card" data-aos="fade-up" data-aos-delay="<?= $i * 70 ?>">
                <div class="chapter-num">0<?= $i + 1 ?></div>
                <h3 class="chapter-title"><?= $ch['title'] ?></h3>
                <p class="chapter-desc"><?= $ch['desc'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════════
     FEATURES + AUTHOR (LIGHT SECTION)
     ═══════════════════════════════════════════════ -->
<section class="section section-light">
    <div class="container">
        <div class="features-grid">

            <!-- Left: Features & Stats -->
            <div data-aos="fade-right">
                <div class="section-label label-brand">
                    <i data-lucide="sparkles" style="width:16px;height:16px;"></i>
                    Bukan Sekadar Teori
                </div>
                <h2 class="section-title section-title-light">
                    Dilengkapi <span style="color:var(--brand-600);">3 Lampiran</span><br>Siap Pakai
                </h2>
                <p class="section-desc desc-light" style="margin-bottom:0;">
                    Ebook ini dilengkapi dokumen praktis yang bisa langsung Anda gunakan dalam kehidupan nyata sebagai wali anak yatim.
                </p>

                <div class="feature-list">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i data-lucide="file-text" style="width:22px;height:22px;"></i>
                        </div>
                        <div>
                            <div class="feature-name">Berita Acara Penyerahan Harta</div>
                            <div class="feature-sub">Template siap isi, sah secara hukum dan syariat</div>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i data-lucide="bar-chart-3" style="width:22px;height:22px;"></i>
                        </div>
                        <div>
                            <div class="feature-name">Format Pembukuan Keuangan</div>
                            <div class="feature-sub">Pencatatan harta yang transparan dan akuntabel</div>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i data-lucide="clipboard-check" style="width:22px;height:22px;"></i>
                        </div>
                        <div>
                            <div class="feature-name">Daftar Periksa (Checklist)</div>
                            <div class="feature-sub">Panduan langkah demi langkah untuk wali yatim</div>
                        </div>
                    </div>
                </div>

                <div class="stats-row">
                    <div class="stat-box">
                        <div class="stat-num">46</div>
                        <div class="stat-label">Halaman</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-num">50+</div>
                        <div class="stat-label">Poin Penting</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-num">8</div>
                        <div class="stat-label">Bagan</div>
                    </div>
                    <div class="stat-box">
                        <div class="stat-num">46</div>
                        <div class="stat-label">Catatan Kaki</div>
                    </div>
                </div>
            </div>

            <!-- Right: Author Card -->
            <div data-aos="fade-left" data-aos-delay="100">
                <div class="author-card">
                    <?php $penulisUrl = base_url('img/penulis.png') . '?v=' . (file_exists(FCPATH . 'img/penulis.png') ? filemtime(FCPATH . 'img/penulis.png') : time()); ?>
                    <img src="<?= $penulisUrl ?>"
                         alt="Ustadz Muhammad Abu Rivai, S.H., M.H.,CFP."
                         class="author-avatar"
                         onerror="this.src='https://placehold.co/200x200/341916/d4a847?text=MAR';">
                    <div class="author-name">Ustadz Muhammad Abu Rivai, S.H., M.H.,CFP.</div>
                    <div class="author-title">
                        <i data-lucide="award" style="width:16px;height:16px;"></i>
                        Konsultan Waris & Pengajar Fikih Muamalah
                    </div>
                    <p class="author-bio">
                        Memiliki pengalaman mendalam dalam kajian fikih muamalah dan permasalahan harta waris serta anak yatim. Buku ini disusun berdasarkan rujukan kitab-kitab muktabar dengan bahasa yang mudah dipahami oleh awam sekalipun.
                    </p>
                    <div class="credential-chips">
                        <span class="chip">Fikih Muamalah</span>
                        <span class="chip">Hukum Waris Islam</span>
                        <span class="chip">Perlindungan Anak Yatim</span>
                        <span class="chip">Kitab Muktabar</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     TARGET AUDIENCE (LIGHT)
     ═══════════════════════════════════════════════ -->
<section class="section section-light" style="padding-top:0; background:#faf8f6;">
    <div class="container">

        <div class="text-center" data-aos="fade-up">
            <div class="section-label label-brand" style="justify-content:center;">
                <i data-lucide="users-2" style="width:16px;height:16px;"></i>
                Target Pembaca
            </div>
            <h2 class="section-title section-title-light">
                Untuk Siapa<br><span style="color:var(--brand-600);">Ebook Ini?</span>
            </h2>
        </div>

        <div class="audience-grid" data-aos="fade-up" data-aos-delay="100">

            <div class="audience-card audience-yes">
                <div class="audience-title">
                    <i data-lucide="check-circle-2" style="width:24px;height:24px;color:#16a34a;"></i>
                    Sangat Cocok Untuk:
                </div>
                <ul class="audience-list">
                    <li>
                        <i data-lucide="check" class="list-icon-yes" style="width:18px;height:18px;"></i>
                        Wali anak yatim (paman, kakek, kakak kandung)
                    </li>
                    <li>
                        <i data-lucide="check" class="list-icon-yes" style="width:18px;height:18px;"></i>
                        Ibu yang mengasuh anak yatim sendirian
                    </li>
                    <li>
                        <i data-lucide="check" class="list-icon-yes" style="width:18px;height:18px;"></i>
                        Pengurus yayasan yatim piatu dan panti asuhan
                    </li>
                    <li>
                        <i data-lucide="check" class="list-icon-yes" style="width:18px;height:18px;"></i>
                        Siapapun yang dititipi harta anak yatim
                    </li>
                    <li>
                        <i data-lucide="check" class="list-icon-yes" style="width:18px;height:18px;"></i>
                        Ustadz/ustadzah yang sering ditanya masalah ini
                    </li>
                </ul>
            </div>

            <div class="audience-card audience-no">
                <div class="audience-title">
                    <i data-lucide="x-circle" style="width:24px;height:24px;color:#dc2626;"></i>
                    Tidak Cocok Untuk:
                </div>
                <ul class="audience-list">
                    <li>
                        <i data-lucide="x" class="list-icon-no" style="width:18px;height:18px;"></i>
                        Orang yang mencari panduan investasi saham atau kripto
                    </li>
                    <li>
                        <i data-lucide="x" class="list-icon-no" style="width:18px;height:18px;"></i>
                        Mereka yang tidak berurusan dengan anak yatim sama sekali
                    </li>
                    <li>
                        <i data-lucide="x" class="list-icon-no" style="width:18px;height:18px;"></i>
                        Yang mencari panduan hukum perdata / warisan konvensional
                    </li>
                </ul>
            </div>

        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════════
     FORM SECTION (DARK)
     ═══════════════════════════════════════════════ -->
<section class="form-section" id="download-form">
    <div class="particles"></div>
    <div class="container" style="position:relative;z-index:1;">
        <div class="form-section-grid">

            <!-- Left: Promo -->
            <div class="form-promo" data-aos="fade-right">
                <div class="section-label label-gold">
                    <i data-lucide="download" style="width:16px;height:16px;"></i>
                    Ambil Sekarang — Gratis
                </div>
                <h2>Dapatkan Ebook-nya<br><span style="color:var(--gold);">Sekarang Juga!</span></h2>
                <p>
                    Isi formulir sederhana ini dan kami akan mengirimkan tautan unduhan langsung ke email Anda dalam hitungan detik.
                </p>
                <ul class="value-list">
                    <li>
                        <i data-lucide="zap" style="width:18px;height:18px;"></i>
                        Dikirim instan ke email Anda
                    </li>
                    <li>
                        <i data-lucide="shield-check" style="width:18px;height:18px;"></i>
                        Data Anda 100% aman dan rahasia
                    </li>
                    <li>
                        <i data-lucide="file-down" style="width:18px;height:18px;"></i>
                        Format PDF berkualitas tinggi
                    </li>
                    <li>
                        <i data-lucide="refresh-ccw" style="width:18px;height:18px;"></i>
                        Bisa dibaca ulang kapanpun
                    </li>
                    <li>
                        <i data-lucide="gift" style="width:18px;height:18px;color:var(--gold);"></i>
                        Bonus: 3 Lampiran Template Siap Pakai
                    </li>
                </ul>
            </div>

            <!-- Right: Form Card -->
            <div data-aos="fade-left" data-aos-delay="150">
                <div class="form-card">
                    <div class="form-card-title">Kirim ke Email Saya</div>
                    <div class="form-card-sub">Isi form di bawah — proses hanya 30 detik</div>

                    <form id="leadForm" action="<?= base_url('submit') ?>">
                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label for="nama_lengkap" class="form-label">
                                <i data-lucide="user" style="width:14px;height:14px;display:inline;margin-right:4px;"></i>
                                Nama Lengkap
                            </label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" required
                                   class="form-input"
                                   placeholder="Contoh: Budi Santoso">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i data-lucide="mail" style="width:14px;height:14px;display:inline;margin-right:4px;"></i>
                                Alamat Email Aktif
                            </label>
                            <input type="email" id="email" name="email" required
                                   class="form-input"
                                   placeholder="Contoh: budi@gmail.com">
                        </div>

                        <div class="form-group">
                            <label for="nomor_whatsapp" class="form-label">
                                <i data-lucide="smartphone" style="width:14px;height:14px;display:inline;margin-right:4px;"></i>
                                Nomor WhatsApp Aktif
                            </label>
                            <input type="tel" id="nomor_whatsapp" name="nomor_whatsapp" required pattern="^[0-9]+"
                                   class="form-input"
                                   placeholder="Contoh: 081234567890">
                        </div>

                        <div class="form-group">
                            <label for="rentang_umur" class="form-label">
                                <i data-lucide="clock" style="width:14px;height:14px;display:inline;margin-right:4px;"></i>
                                Rentang Umur
                            </label>
                            <select id="rentang_umur" name="rentang_umur" class="form-input" onchange="handleRentangUmurChange(this)" required>
                                <option value="">— Pilih Rentang Umur —</option>
                                <option value="18-25 th">18 - 25 tahun</option>
                                <option value="26-30 th">26 - 30 tahun</option>
                                <option value="31-35 th">31 - 35 tahun</option>
                                <option value="36-40 th">36 - 40 tahun</option>
                                <option value="41-45 th">41 - 45 tahun</option>
                                <option value="46-50 th">46 - 50 tahun</option>
                                <option value="51-55 th">51 - 55 tahun</option>
                                <option value="Diatas 55 th">Diatas 55 tahun</option>
                                <option value="Lainnya">Lainnya (Ketik sendiri...)</option>
                            </select>
                            <div id="rentangUmurOtherWrap" class="hidden" style="display:none; margin-top:10px;">
                                <input type="text" id="rentang_umur_other" name="rentang_umur_other" class="form-input" placeholder="Ketik rentang umur Anda (misal: 17 tahun / 60 tahun)...">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status_pekerjaan" class="form-label">
                                <i data-lucide="briefcase" style="width:14px;height:14px;display:inline;margin-right:4px;"></i>
                                Status Pekerjaan
                            </label>
                            <select id="status_pekerjaan" name="status_pekerjaan" class="form-input">
                                <option value="">— Pilih Status Pekerjaan —</option>
                                <option value="Karyawan Swasta">Karyawan Swasta</option>
                                <option value="PNS/ASN">PNS / ASN</option>
                                <option value="Wiraswasta">Wiraswasta</option>
                                <option value="Guru/Dosen">Guru / Dosen</option>
                                <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                <option value="Pelajar/Mahasiswa">Pelajar / Mahasiswa</option>
                                <option value="Pensiunan">Pensiunan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="form-checkbox-row">
                            <input id="consent" name="consent" type="checkbox" required>
                            <label for="consent">
                                Saya setuju menerima informasi bermanfaat dan tautan ebook ke email & WhatsApp saya.
                            </label>
                        </div>

                        <button type="submit" id="submitBtn" class="btn-submit">
                            <i data-lucide="send" style="width:20px;height:20px;"></i>
                            <span>Kirim Ebook Sekarang</span>
                        </button>

                        <div class="security-note">
                            <i data-lucide="lock" style="width:12px;height:12px;"></i>
                            Data Anda dijaga kerahasiaannya
                        </div>
                    </form>

                    <div id="successMessage" class="hidden">
                        <i data-lucide="check-circle-2" style="width:48px;height:48px;color:#86efac;margin-bottom:16px;"></i>
                        <h3>Ebook Berhasil Dikirimkan!</h3>
                        <p>Buku panduan digital telah kami kirimkan ke alamat email Anda. Silakan periksa kotak masuk (inbox) atau folder spam/promosi email Anda untuk mengunduh dokumen.</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     FAQ (DARK)
     ═══════════════════════════════════════════════ -->
<section class="section section-dark">
    <div class="container">

        <div class="text-center" data-aos="fade-up">
            <div class="section-label label-gold" style="justify-content:center;">
                <i data-lucide="message-circle-question" style="width:16px;height:16px;"></i>
                FAQ
            </div>
            <h2 class="section-title section-title-dark">
                Pertanyaan yang Sering<br><span style="color:var(--gold);">Diajukan</span>
            </h2>
        </div>

        <div class="faq-list">
            <?php
            $faqs = [
                ["q" => "Apakah ebook ini benar-benar gratis?",
                 "a" => "Ya, 100% gratis. Anda tidak perlu membayar apapun. Ebook ini kami bagikan sebagai bentuk dakwah dan kontribusi sosial kepada masyarakat."],
                ["q" => "Dalam format apa ebook ini dikirim?",
                 "a" => "Ebook akan dikirim dalam format PDF berkualitas tinggi sehingga mudah dibaca di HP, tablet, maupun komputer. Anda juga bisa mencetaknya."],
                ["q" => "Apakah saya bisa berkonsultasi langsung jika ada kasus khusus?",
                 "a" => "Bisa. Kami menyediakan sesi konsultasi private via Zoom bersama Ustadz Muhammad Abu Rivai (berbayar). Silakan lihat informasi di bagian bawah halaman ini."],
                ["q" => "Bolehkah saya membagikan ebook ini ke orang lain?",
                 "a" => "Sangat disarankan! Silakan bagikan manfaat ini seluas-luasnya agar lebih banyak wali anak yatim terselamatkan dari memakan harta mereka secara tidak sah."],
                ["q" => "Berapa lama ebook dikirim ke email saya?",
                 "a" => "Ebook akan dikirimkan secara otomatis dalam hitungan menit setelah Anda mengisi formulir. Jika lebih dari 10 menit belum ada, cek folder Spam Anda."],
            ];
            foreach ($faqs as $i => $faq):
            ?>
            <div class="faq-item" data-aos="fade-up" data-aos-delay="<?= $i * 60 ?>">
                <button class="faq-btn">
                    <span><?= $faq['q'] ?></span>
                    <div class="faq-icon-wrap">
                        <i data-lucide="chevron-down" style="width:16px;height:16px;"></i>
                    </div>
                </button>
                <div class="faq-content">
                    <p><?= $faq['a'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>

<!-- ═══════════════════════════════════════════════
     UPSELL / CTA SECTION
     ═══════════════════════════════════════════════ -->
<section class="upsell-section">
    <div class="container">
        <div class="upsell-inner" data-aos="zoom-in">
            <div class="particles"></div>
            <div class="section-label label-gold" style="justify-content:center; margin-bottom:24px;">
                <i data-lucide="phone" style="width:16px;height:16px;"></i>
                Konsultasi Private
            </div>
            <h2>Butuh Penanganan Kasus Khusus?</h2>
            <p>
                Setiap keluarga memiliki dinamika yang berbeda. Jika Anda memiliki pertanyaan yang sangat spesifik
                tentang harta waris dan anak yatim di keluarga Anda, jadwalkan sesi konsultasi private via Zoom
                bersama <strong style="color:var(--gold-light);">Ustadz Muhammad Abu Rivai</strong>.
            </p>
            <div class="ornament" style="margin-bottom:40px;">
                <div class="ornament-line"></div>
                <div class="ornament-diamond"></div>
                <div class="ornament-line"></div>
            </div>
            <a href="https://wa.me/6281234567890?text=Halo%20Admin,%20saya%20ingin%20info%20konsultasi%20private%20harta%20anak%20yatim"
               target="_blank" class="btn-wa">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width:22px;height:22px;">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.347-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.065 2.876 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                </svg>
                Tanya Admin via WhatsApp
            </a>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════
     DONATION MODAL
     ═══════════════════════════════════════════════ -->
<div id="donationModal" class="modal-overlay hidden">
    <div class="modal-box">

        <!-- Step 1: Confirm Donation -->
        <div class="modal-step modal-step-center" id="donationStep1">
            <div class="modal-icon">
                <i data-lucide="check-circle-2" style="width:36px;height:36px;"></i>
            </div>
            <div class="modal-title">Ebook Berhasil Dikirimkan ke Email Anda</div>
            <p class="modal-notice-text">
                Buku panduan digital telah kami kirimkan ke alamat email:
            </p>
            <div class="modal-email-pill-wrap">
                <div class="modal-email-pill">
                    <i data-lucide="mail" style="width:15px;height:15px;flex-shrink:0;"></i>
                    <span id="registeredEmail">email Anda</span>
                </div>
            </div>
            <p class="modal-instruction-text" style="margin-bottom: 24px;">
                Silakan periksa kotak masuk (inbox) atau folder spam/promosi email Anda untuk mengunduh dokumen.
            </p>

            <div class="modal-separator"></div>

            <div style="font-size: 1.05rem; font-weight: 700; color: #f5d77f; margin-bottom: 8px;">
                Apakah Anda Ingin Berdonasi?
            </div>
            <p class="modal-support-text" style="margin-top: 0; line-height: 1.6;">
                Apakah Anda berkenan menyisihkan sebagian rezeki untuk mendukung program santunan dan edukasi fikih perlindungan hak harta anak-anak yatim?
            </p>
            <div class="modal-btn-group">
                <button type="button" id="btnYesDonate" class="btn-modal-yes">
                    <i data-lucide="heart" style="width:18px;height:18px;flex-shrink:0;"></i>
                    <span>Iya, Salurkan Donasi Sekarang</span>
                </button>
                <button type="button" id="btnNoDonate" class="btn-modal-no">
                    <span>Nanti Saja / Tutup</span>
                </button>
            </div>
        </div>

        <!-- Step 2: Donation Form -->
        <div class="modal-step hidden modal-form" id="donationStep2">
            <button type="button" id="btnBackDonate" class="back-btn">
                <i data-lucide="arrow-left" style="width:16px;height:16px;"></i>
                Kembali
            </button>

            <div class="modal-title" style="text-align:left; font-size:1.4rem;">Formulir Donasi</div>
            <p class="modal-desc" style="text-align:left; margin-bottom:24px;">Jazakallahu khairan atas kepedulian Anda</p>

            <form id="donationForm" action="<?= base_url('submit-donation') ?>">
                <input type="hidden" id="donationLeadId" name="lead_id" value="">

                <div class="form-group">
                    <label class="form-label">Nominal Donasi (Rp)</label>
                    <input type="number" id="donationAmount" name="amount" required min="1000" placeholder="Misal: 50000">
                    <!-- Quick amounts -->
                    <div style="display:flex; gap:8px; margin-top:10px; flex-wrap:wrap;">
                        <?php foreach ([20000, 50000, 100000, 200000] as $amt): ?>
                        <button type="button" class="quick-amount"
                                onclick="document.getElementById('donationAmount').value='<?= $amt ?>'"
                                style="padding:6px 14px; background:rgba(45,31,26,0.5); border:1px solid rgba(212,168,71,0.15); border-radius:8px; color:#9e8a82; font-size:0.8rem; cursor:pointer; font-family:inherit; transition:all 0.2s;">
                            Rp <?= number_format($amt, 0, ',', '.') ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Metode Pembayaran</label>
                    <select id="donationMethod" name="payment_method" required>
                        <option value="">Pilih Metode</option>
                        <option value="BSI">Transfer Bank BSI</option>
                        <option value="QRIS">QRIS</option>
                    </select>
                </div>

                <div id="bankDetails" class="hidden">
                    <p>Silakan transfer ke rekening berikut:</p>
                    <p style="font-weight:700; color:#e8ddd9; margin-top:8px;">Bank Syariah Indonesia (BSI) — 451</p>
                    <p class="bank-num" style="font-size:1.5rem; font-weight:800; color:var(--gold); letter-spacing:2px; margin:12px 0;">4500-4200-95</p>
                    <p style="font-size:0.85rem; color:#9e8a82;">a.n: Komunitas Waris Planning Indonesia</p>
                </div>

                <div id="qrisDetails" class="hidden">
                    <p>Silakan scan kode QRIS berikut:</p>
                    <img src="<?= base_url('img/qris.jpg') ?>" alt="QRIS Donasi"
                         style="width:180px; height:180px; margin:16px auto; display:block; border-radius:12px; cursor:zoom-in; border:1px solid rgba(212,168,71,0.2);"
                         onclick="document.getElementById('imageModal').classList.remove('hidden')"
                         onerror="this.style.display='none';">
                    <p style="font-size:0.8rem; color:#4a3530; text-align:center;">Klik barcode untuk memperbesar</p>
                </div>

                <button type="submit" id="submitDonationBtn" class="btn-submit" style="margin-top:20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width:20px;height:20px;">
                        <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.347-.272.297-1.04 1.016-1.04 2.479 0 1.463 1.065 2.876 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                    </svg>
                    Konfirmasi via WhatsApp
                </button>
            </form>
        </div>

    </div>
</div>

<!-- ═══════════════════════════════════════════════
     FULL SCREEN IMAGE MODAL (QRIS)
     ═══════════════════════════════════════════════ -->
<div id="imageModal" class="hidden img-modal" onclick="this.classList.add('hidden')">
    <button class="img-modal-close" onclick="document.getElementById('imageModal').classList.add('hidden')">
        <i data-lucide="x" style="width:18px;height:18px;"></i>
    </button>
    <div class="img-modal-inner" onclick="event.stopPropagation()">
        <img src="<?= base_url('img/qris.jpg') ?>" alt="QRIS Zoom">
        <p style="text-align:center; color:#4a3530; font-size:0.8rem; margin-top:12px;">Klik di mana saja untuk menutup</p>
    </div>
</div>

<script>
    function handleRentangUmurChange(select) {
        var wrap = document.getElementById('rentangUmurOtherWrap');
        var input = document.getElementById('rentang_umur_other');
        if (!wrap) return;
        var val = select ? select.value : '';
        if (val === 'Lainnya') {
            wrap.classList.remove('hidden');
            wrap.style.setProperty('display', 'block', 'important');
            if (input) {
                input.setAttribute('required', 'required');
                setTimeout(function () { input.focus(); }, 50);
            }
        } else {
            wrap.classList.add('hidden');
            wrap.style.setProperty('display', 'none', 'important');
            if (input) {
                input.removeAttribute('required');
                input.value = '';
            }
        }
    }
    window.handleRentangUmurChange = handleRentangUmurChange;

    document.addEventListener('DOMContentLoaded', function () {
        var sel = document.getElementById('rentang_umur');
        if (sel) {
            sel.addEventListener('change', function () {
                handleRentangUmurChange(this);
            });
            if (sel.value === 'Lainnya') {
                handleRentangUmurChange(sel);
            }
        }
    });
</script>

<?= $this->endSection() ?>
