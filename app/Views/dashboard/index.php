<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Hero Academic Banner -->
<div class="relative overflow-hidden rounded-2xl bg-academic-navy text-white shadow-xl border border-academic-gold/30 mb-8 w-full max-w-full">
  <!-- Decorative Background pattern & gradients -->
  <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#C5A059_1px,transparent_1px)] [background-size:16px_16px]"></div>
  <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full bg-academic-gold/20 blur-3xl pointer-events-none"></div>

  <div class="relative p-4 sm:p-8 md:p-10 w-full max-w-full">
    <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-5 sm:gap-6">
      
      <div class="space-y-2.5 sm:space-y-3 max-w-3xl">
        <?php if (!empty($settings['is_event_completed'])): ?>
          <div class="inline-flex items-center space-x-2 px-3.5 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/40 text-emerald-300 text-xs font-bold tracking-wider uppercase">
            <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            <span>Alhamdulillah &bull; Telah Selesai Terlaksana</span>
          </div>
        <?php else: ?>
          <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-academic-gold/20 border border-academic-gold/40 text-academic-goldlight text-xs font-semibold tracking-wider uppercase">
            <span class="w-2 h-2 rounded-full bg-academic-gold animate-ping"></span>
            <span>Sidang Promosi Doktor Terbuka</span>
          </div>
        <?php endif; ?>

        <h1 class="text-xl sm:text-3xl md:text-4xl font-bold font-academic text-white tracking-wide leading-tight">
          <?= esc($settings['candidate_name'] ?? 'Muhammad Abu Rivai, S.H., M.H.') ?>
          <span class="text-sm sm:text-lg font-normal text-slate-300 block sm:inline sm:ml-2">
            (NIM: <?= esc($settings['candidate_nim'] ?? '21933020') ?>)
          </span>
        </h1>

        <p class="text-xs sm:text-base text-slate-200 font-serif italic border-l-2 border-academic-gold pl-3 py-1">
          &ldquo;<?= esc($settings['dissertation_title'] ?? 'DINAMIKA PERENCANAAN WARIS DALAM MITIGASI SENGKETA PADA MASYARAKAT JAWA MUSLIM') ?>&rdquo;
        </p>

        <div class="flex flex-wrap items-center gap-y-2 gap-x-4 sm:gap-x-6 text-xs sm:text-sm text-slate-300 pt-2">
          <div class="flex items-center space-x-2">
            <svg class="w-4 h-4 text-academic-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span><?= esc($settings['event_day_date'] ?? 'Selasa, 20 Oktober 2026') ?> (<?= esc($settings['event_hijri_date'] ?? '9 Jumadil Awal 1448 H') ?>)</span>
          </div>
          <div class="flex items-center space-x-2">
            <svg class="w-4 h-4 text-academic-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span><?= esc(str_replace(['?', '–'], '-', $settings['event_time'] ?? '09.00 - 11.00 WIB')) ?></span>
          </div>
          <div class="flex items-center space-x-2">
            <svg class="w-4 h-4 text-academic-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <span>Ruang 03.16 Gedung K.H. A. Wahid Hasyim (FIAI UII)</span>
          </div>
        </div>

        <?php if (!empty($settings['is_event_completed'])): ?>
          <div class="pt-2">
            <div class="inline-flex items-center space-x-2 px-3 py-1.5 rounded-lg bg-emerald-950/60 border border-emerald-400/30 text-emerald-200 text-xs">
              <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
              <span>Status: Berita acara presensi sidang telah ditutup &amp; tersimpan permanen.</span>
            </div>
          </div>
        <?php endif; ?>
      </div>

      <!-- Quick Action CTA (Stack on mobile, responsive buttons) -->
      <div class="flex flex-col sm:flex-row lg:flex-col gap-2 w-full lg:w-auto mt-2 lg:mt-0">
        <a href="<?= base_url('absensi') ?>" class="inline-flex items-center justify-center space-x-2 px-4 sm:px-5 py-2.5 rounded-xl bg-academic-gold hover:bg-academic-goldlight text-academic-navy font-bold text-xs shadow-lg transition transform hover:-translate-y-0.5 text-center">
          <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
          <span><?= !empty($settings['is_event_completed']) ? 'Arsip Meja Absensi' : 'Buka Meja Absensi' ?></span>
        </a>
        <a href="<?= base_url('export/pdf-kehadiran?filter=present') ?>" target="_blank" class="inline-flex items-center justify-center space-x-2 px-4 sm:px-5 py-2.5 rounded-xl bg-rose-700 hover:bg-rose-800 text-white font-bold text-xs shadow-md transition transform hover:-translate-y-0.5 text-center">
          <svg class="w-4 h-4 text-rose-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
          <span>Buku Hadir &amp; TTD (PDF)</span>
        </a>
        <a href="<?= base_url('undangan/massal') ?>" class="inline-flex items-center justify-center space-x-2 px-4 sm:px-5 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs border border-white/20 backdrop-blur-sm transition text-center">
          <svg class="w-4 h-4 text-academic-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
          <span>Generate 100 PDF &amp; ZIP</span>
        </a>
      </div>

    </div>
  </div>

  <!-- Real-time Stats Cards -->
  <div class="grid grid-cols-2 md:grid-cols-4 gap-2.5 sm:gap-4 p-3.5 sm:px-8 sm:pb-6 pt-3 sm:pt-0 border-t border-white/10 w-full max-w-full">
    <div class="text-center md:text-left min-w-0">
      <div class="text-[10px] sm:text-[11px] uppercase tracking-wider text-slate-300 truncate">Total Tamu</div>
      <div class="text-xl sm:text-2xl font-bold font-academic text-white"><?= number_format($stats['total']) ?></div>
      <div class="text-[9px] sm:text-[10px] text-academic-goldlight truncate">100 Terundang + <?= $stats['walk_in'] ?> Walk-in</div>
    </div>
    <div class="text-center md:text-left min-w-0">
      <div class="text-[10px] sm:text-[11px] uppercase tracking-wider text-emerald-300 truncate">Sudah Hadir</div>
      <div class="text-xl sm:text-2xl font-bold font-academic text-emerald-400"><?= number_format($stats['present']) ?></div>
      <div class="text-[9px] sm:text-[10px] text-emerald-200 truncate"><?= $stats['present_invited'] ?> Undangan &bull; <?= $stats['present_walk_in'] ?> Walk-in</div>
    </div>
    <div class="text-center md:text-left min-w-0">
      <div class="text-[10px] sm:text-[11px] uppercase tracking-wider text-amber-300 truncate">Belum Hadir</div>
      <div class="text-xl sm:text-2xl font-bold font-academic text-amber-400"><?= number_format($stats['absent']) ?></div>
      <div class="text-[9px] sm:text-[10px] text-slate-300 truncate">Menunggu Kedatangan</div>
    </div>
    <div class="text-center md:text-left min-w-0">
      <div class="text-[10px] sm:text-[11px] uppercase tracking-wider text-sky-300 truncate">% Hadir</div>
      <div class="text-xl sm:text-2xl font-bold font-academic text-sky-400"><?= $stats['percentage'] ?>%</div>
      <div class="w-full bg-white/20 h-1.5 rounded-full mt-1.5 overflow-hidden">
        <div class="bg-sky-400 h-full rounded-full transition-all duration-500" style="width: <?= $stats['percentage'] ?>%;"></div>
      </div>
    </div>
  </div>
</div>

<!-- Main Dashboard Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8 mb-8 w-full max-w-full">
  
  <!-- Left 2 Cols: Recent Attendees & Quick Navigator -->
  <div class="lg:col-span-2 space-y-8">
    
    <!-- Quick Navigator Cards -->
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
      <a href="<?= base_url('tamu') ?>" class="p-4 rounded-xl bg-white border border-slate-200 hover:border-academic-navy hover:shadow-md transition group text-center">
        <div class="w-10 h-10 mx-auto rounded-lg bg-blue-50 text-academic-navy flex items-center justify-center mb-2 group-hover:scale-110 transition">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </div>
        <div class="text-xs font-bold text-slate-800">Daftar 100 Tamu</div>
        <div class="text-[10px] text-slate-500">Impor &amp; Kelola Tamu</div>
      </a>

      <a href="<?= base_url('absensi') ?>" class="p-4 rounded-xl bg-white border border-slate-200 hover:border-academic-navy hover:shadow-md transition group text-center">
        <div class="w-10 h-10 mx-auto rounded-lg bg-amber-50 text-amber-700 flex items-center justify-center mb-2 group-hover:scale-110 transition">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
        </div>
        <div class="text-xs font-bold text-slate-800">Meja Absensi</div>
        <div class="text-[10px] text-slate-500">Pen Tablet &amp; Touch</div>
      </a>

      <a href="<?= base_url('tamu-baru') ?>" class="p-4 rounded-xl bg-white border border-slate-200 hover:border-academic-navy hover:shadow-md transition group text-center">
        <div class="w-10 h-10 mx-auto rounded-lg bg-emerald-50 text-emerald-700 flex items-center justify-center mb-2 group-hover:scale-110 transition">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
        </div>
        <div class="text-xs font-bold text-slate-800">Tamu Walk-in</div>
        <div class="text-[10px] text-slate-500">Registrasi Mandiri</div>
      </a>

      <a href="<?= base_url('daftar-hadir') ?>" target="_blank" class="p-4 rounded-xl bg-white border border-slate-200 hover:border-academic-navy hover:shadow-md transition group text-center">
        <div class="w-10 h-10 mx-auto rounded-lg bg-indigo-50 text-indigo-700 flex items-center justify-center mb-2 group-hover:scale-110 transition">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
        <div class="text-xs font-bold text-slate-800">Live TV Board</div>
        <div class="text-[10px] text-slate-500">Display Depan Sidang</div>
      </a>
    </div>

    <!-- Recent Attendees Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <div>
          <h2 class="text-base font-bold text-academic-navy flex items-center space-x-2">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
            <span>Daftar Tamu yang Baru Hadir</span>
          </h2>
          <p class="text-xs text-slate-500 mt-0.5">Tercatat akurat berdasarkan waktu kedatangan dan tanda tangan digital</p>
        </div>
        <a href="<?= base_url('daftar-hadir') ?>" class="text-xs font-semibold text-academic-navy hover:text-academic-gold transition">
          Lihat Live Board &rarr;
        </a>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead class="bg-slate-50 text-slate-500 uppercase tracking-wider text-[10px] border-b border-slate-100">
            <tr>
              <th class="py-3 px-4">Jam Hadir</th>
              <th class="py-3 px-4">Nama Tamu &amp; Gelar</th>
              <th class="py-3 px-4">Instansi / Asal</th>
              <th class="py-3 px-4">Tipe</th>
              <th class="py-3 px-4 text-center">Tanda Tangan</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <?php if (empty($recentAttendees)): ?>
              <tr>
                <td colspan="5" class="py-8 text-center text-slate-400">
                  <div class="w-12 h-12 mx-auto mb-2 text-slate-300">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                  </div>
                  Belum ada tamu yang check-in saat ini.
                  <div class="mt-2">
                    <a href="<?= base_url('absensi') ?>" class="text-academic-navy font-semibold underline hover:text-academic-gold">
                      Buka Meja Absensi untuk memulai
                    </a>
                  </div>
                </td>
              </tr>
            <?php else: ?>
              <?php foreach ($recentAttendees as $attendee): ?>
                <tr class="hover:bg-slate-50/80 transition">
                  <td class="py-3 px-4 font-mono font-medium text-emerald-700 whitespace-nowrap">
                    <?= date('H:i:s', strtotime($attendee['check_in_time'])) ?> WIB
                  </td>
                  <td class="py-3 px-4">
                    <div class="font-bold text-slate-800 text-sm"><?= esc($attendee['full_name']) ?></div>
                    <div class="text-[11px] text-slate-400 font-mono"><?= esc($attendee['guest_code']) ?></div>
                  </td>
                  <td class="py-3 px-4 text-slate-600">
                    <?= esc($attendee['institution'] ?: 'Tamu Kehormatan') ?>
                  </td>
                  <td class="py-3 px-4">
                    <?php if ($attendee['guest_type'] === 'invited'): ?>
                      <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-blue-50 text-blue-700 border border-blue-200">
                        Undangan
                      </span>
                    <?php else: ?>
                      <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                        Walk-in
                      </span>
                    <?php endif; ?>
                  </td>
                  <td class="py-3 px-4 text-center">
                    <?php if (!empty($attendee['signature_image'])): ?>
                      <img src="<?= base_url($attendee['signature_image']) ?>" alt="TTD" class="h-8 max-w-[80px] mx-auto object-contain border border-slate-200 rounded bg-white p-0.5 shadow-xs">
                    <?php else: ?>
                      <span class="text-slate-300 italic text-[11px]">-</span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <!-- Right 1 Col: PDF Generator Status & Upcoming VIP Guests -->
  <div class="space-y-6">

    <!-- Bulk PDF Status Box -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-bold text-academic-navy uppercase tracking-wider flex items-center space-x-2">
          <svg class="w-4 h-4 text-academic-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
          <span>Status Undangan PDF</span>
        </h3>
        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-academic-gold/20 text-academic-navy">
          <?= $pdfCount ?> / <?= $stats['total'] ?> PDF
        </span>
      </div>

      <p class="text-xs text-slate-500 mb-4 leading-relaxed">
        Setiap tamu memiliki file PDF personal 3 halaman dengan nama lengkap, gelar, dan instansi yang tersinkronisasi otomatis.
      </p>

      <div class="space-y-2 mb-4">
        <div class="flex justify-between text-xs font-semibold text-slate-700">
          <span>Progres File Siap Unduh</span>
          <span><?= $stats['total'] > 0 ? round(($pdfCount / $stats['total']) * 100) : 0 ?>%</span>
        </div>
        <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden">
          <div class="bg-academic-navy h-full rounded-full transition-all duration-500" style="width: <?= $stats['total'] > 0 ? min(100, round(($pdfCount / $stats['total']) * 100)) : 0 ?>%;"></div>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-2 pt-2">
        <a href="<?= base_url('undangan/massal') ?>" class="w-full text-center px-3 py-2.5 rounded-lg bg-academic-navy text-white text-xs font-bold hover:bg-academic-dark transition shadow-sm">
          Kelola PDF Massal
        </a>
        <a href="<?= base_url('undangan/download-zip') ?>" class="w-full text-center px-3 py-2.5 rounded-lg bg-academic-gold hover:bg-academic-goldlight text-academic-navy text-xs font-bold transition shadow-sm">
          Unduh Bundel ZIP
        </a>
      </div>
    </div>

    <!-- Tamu Terundang Belum Hadir -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-sm font-bold text-academic-navy uppercase tracking-wider flex items-center space-x-2">
          <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
          <span>Tamu Terundang Menunggu</span>
        </h3>
        <span class="text-xs text-amber-600 font-bold"><?= $stats['absent'] ?> Belum Hadir</span>
      </div>

      <div class="divide-y divide-slate-100">
        <?php foreach ($pendingInvited as $p): ?>
          <div class="py-2.5 flex items-center justify-between gap-3">
            <div class="min-w-0">
              <div class="text-xs font-bold text-slate-800 truncate"><?= esc($p['full_name']) ?></div>
              <div class="text-[11px] text-slate-400 truncate"><?= esc($p['institution']) ?></div>
            </div>
            <a href="<?= base_url('absensi?code=' . urlencode($p['guest_code'])) ?>" class="px-2 py-1 rounded bg-slate-100 hover:bg-academic-gold hover:text-academic-navy text-[11px] font-semibold text-slate-600 transition whitespace-nowrap">
              Check-in
            </a>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="mt-4 pt-3 border-t border-slate-100 text-center">
        <a href="<?= base_url('tamu?status=absent') ?>" class="text-xs font-bold text-academic-navy hover:text-academic-gold transition">
          Lihat Semua Tamu Belum Hadir &rarr;
        </a>
      </div>
    </div>

  </div>

</div>

<?= $this->endSection() ?>
