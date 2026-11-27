<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buku Tamu Digital &bull; Live Attendance Board — Sidang Promosi Doktor</title>
  
  <link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png') ?>">

  <!-- Google Fonts: Noto Serif & Plus Jakarta Sans -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            academic: {
              navy: '#0F2C59',
              dark: '#07152B',
              night: '#040C19',
              gold: '#C5A059',
              goldlight: '#E2CA94',
            }
          },
          fontFamily: {
            serif: ['"Noto Serif"', 'serif'],
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <!-- Alpine.js -->
  <script defer src="<?= base_url('assets/js/alpine.min.js') ?>"></script>

  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background-color: #07152B;
      color: #F8FAFC;
    }
    .font-academic {
      font-family: 'Noto Serif', serif;
    }
    .new-arrival-glow {
      animation: arrivalPulse 2.5s ease-out;
    }
    @keyframes arrivalPulse {
      0% { background-color: rgba(197, 160, 89, 0.4); }
      100% { background-color: transparent; }
    }
  </style>
</head>
<body class="min-h-screen flex flex-col bg-academic-dark text-slate-100 antialiased selection:bg-academic-gold selection:text-academic-navy" x-data="liveBoardApp()">

  <!-- Top Academic Grand Header for Projector / TV -->
  <!-- Top Academic Grand Header for Projector / TV -->
  <header class="bg-academic-night/95 border-b-2 border-academic-gold/50 shadow-2xl sticky top-0 z-50 backdrop-blur-md">
    <div class="max-w-[1700px] mx-auto px-3 sm:px-6 py-3 sm:py-4">
      <div class="flex items-center justify-between gap-3 sm:gap-6">
        
        <!-- Dual Logos & Academic Identity -->
        <div class="flex items-center space-x-2.5 sm:space-x-5 min-w-0 flex-shrink">
          <div class="bg-white px-2.5 py-1 sm:px-3.5 sm:py-1.5 rounded-lg sm:rounded-xl border border-academic-gold/50 shadow-md flex items-center space-x-2 sm:space-x-3 flex-shrink-0">
            <img src="<?= base_url('assets/img/logo-uii.png?v=' . time()) ?>" alt="UII" class="h-6 sm:h-8 w-auto max-w-[80px] sm:max-w-[105px] object-contain flex-shrink-0">
            <div class="h-4 sm:h-6 w-[1.5px] bg-academic-gold flex-shrink-0"></div>
            <img src="<?= base_url('assets/img/logo-kowpi-coklat.png?v=' . time()) ?>" alt="KOWPI" class="h-5 sm:h-7 w-auto max-w-[85px] sm:max-w-[110px] object-contain flex-shrink-0">
          </div>

          <div class="min-w-0">
            <div class="text-[9px] sm:text-[11px] font-bold text-academic-gold tracking-widest uppercase truncate">
              UNIVERSITAS ISLAM INDONESIA &bull; FIAI &bull; KOWPI
            </div>
            <?php if (!empty($settings['is_event_completed'])): ?>
            <h1 class="text-xs sm:text-xl md:text-2xl font-bold font-academic text-white tracking-wide truncate">
              REKAPITULASI RESMI DAFTAR HADIR SIDANG
            </h1>
            <div class="text-[10px] sm:text-xs text-slate-300 font-serif truncate">
              Pelaksanaan Selesai &bull; Promovendus: <strong class="text-academic-goldlight">Muhammad Abu Rivai, S.H., M.H.</strong> (21933020)
            </div>
            <?php else: ?>
            <h1 class="text-xs sm:text-xl md:text-2xl font-bold font-academic text-white tracking-wide truncate">
              DAFTAR HADIR SIDANG UJIAN TERBUKA
            </h1>
            <div class="text-[10px] sm:text-xs text-slate-300 font-serif truncate">
              Promovendus: <strong class="text-academic-goldlight">Muhammad Abu Rivai, S.H., M.H.</strong> (21933020)
            </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Live Sync Status & Fullscreen Button -->
        <div class="flex items-center space-x-2 sm:space-x-4 flex-shrink-0">
          
          <!-- Live Indicator / Completed Archive Badge -->
          <?php if (!empty($settings['is_event_completed'])): ?>
          <div class="flex items-center space-x-1.5 sm:space-x-2 px-2.5 sm:px-3 py-1 sm:py-1.5 rounded-lg bg-emerald-950/90 border border-emerald-500/40 text-emerald-300 text-[10px] sm:text-xs font-bold">
            <span class="w-2 sm:w-2.5 h-2 sm:h-2.5 rounded-full bg-emerald-400"></span>
            <span class="hidden sm:inline">ARSIP RESMI (FINAL)</span>
            <span class="inline sm:hidden">ARSIP FINAL</span>
          </div>
          <?php else: ?>
          <div class="flex items-center space-x-1.5 sm:space-x-2 px-2 sm:px-3 py-1 sm:py-1.5 rounded-lg bg-emerald-950/80 border border-emerald-500/30 text-emerald-300 text-[10px] sm:text-xs font-semibold">
            <span class="w-2 sm:w-2.5 h-2 sm:h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
            <span class="hidden sm:inline">LIVE SYNC</span>
            <span class="inline sm:hidden">LIVE</span>
          </div>
          <?php endif; ?>

          <!-- Digital Clock -->
          <div class="text-right hidden sm:block">
            <div class="text-lg sm:text-xl font-mono font-bold text-white tracking-wider" id="boardClock">--:--:-- WIB</div>
            <div class="text-[10px] text-slate-400 uppercase tracking-wider"><?= esc($settings['event_day_date'] ?? 'Selasa, 20 Oktober 2026') ?></div>
          </div>

          <!-- Fullscreen Toggle -->
          <button @click="toggleFullscreen()" class="p-2 sm:p-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white border border-white/10 transition shadow-sm" title="Toggle Layar Penuh">
            <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
          </button>

          <!-- Back to Dashboard -->
          <a href="<?= base_url() ?>" class="p-2 sm:p-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white border border-white/10 transition shadow-sm" title="Kembali ke Dashboard">
            <svg class="w-4 sm:w-5 h-4 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
          </a>

        </div>

      </div>
    </div>
  </header>

  <!-- Real-time Stats Cards Bar -->
  <div class="bg-academic-navy/70 border-b border-academic-gold/20 py-2.5 sm:py-3">
    <div class="max-w-[1700px] mx-auto px-3 sm:px-6">
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 sm:gap-4">
        
        <div class="bg-white/5 border border-white/10 rounded-xl p-2.5 sm:p-3 flex items-center justify-between">
          <div>
            <div class="text-[9px] sm:text-[10px] uppercase font-bold text-slate-400">Total Tamu Hadir</div>
            <div class="text-xl sm:text-2xl font-bold font-academic text-academic-gold" x-text="stats.present"><?= $stats['present'] ?></div>
          </div>
          <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-academic-gold/20 flex items-center justify-center text-academic-gold font-bold text-sm sm:text-base">
            👥
          </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-2.5 sm:p-3 flex items-center justify-between">
          <div>
            <div class="text-[9px] sm:text-[10px] uppercase font-bold text-slate-400">Tamu Undangan Resmi</div>
            <div class="text-xl sm:text-2xl font-bold font-academic text-sky-400">
              <span x-text="stats.present_invited"><?= $stats['present_invited'] ?></span>
              <span class="text-xs font-normal text-slate-400">/ <span x-text="stats.invited"><?= $stats['invited'] ?></span></span>
            </div>
          </div>
          <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-sky-500/20 flex items-center justify-center text-sky-400 font-bold text-sm sm:text-base">
            📜
          </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-2.5 sm:p-3 flex items-center justify-between">
          <div>
            <div class="text-[9px] sm:text-[10px] uppercase font-bold text-slate-400">Tamu Kehormatan</div>
            <div class="text-xl sm:text-2xl font-bold font-academic text-emerald-400" x-text="stats.present_walk_in"><?= $stats['present_walk_in'] ?></div>
          </div>
          <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center text-emerald-400 font-bold text-sm sm:text-base">
            ✨
          </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-xl p-2.5 sm:p-3 flex items-center justify-between">
          <div>
            <div class="text-[9px] sm:text-[10px] uppercase font-bold text-slate-400">Persentase Hadir</div>
            <div class="text-xl sm:text-2xl font-bold font-academic text-purple-400"><span x-text="stats.percentage"><?= $stats['percentage'] ?></span>%</div>
          </div>
          <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg bg-purple-500/20 flex items-center justify-center text-purple-400 font-bold text-sm sm:text-base">
            📊
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Main Live Table Container -->
  <main class="flex-grow max-w-[1700px] w-full mx-auto px-3 sm:px-6 py-4 sm:py-6">
    <div class="bg-white/5 backdrop-blur-md rounded-2xl border border-academic-gold/30 shadow-2xl overflow-hidden">
      
      <div class="px-4 sm:px-6 py-3.5 sm:py-4 bg-white/5 border-b border-white/10 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
        <div class="flex items-center space-x-2">
          <?php if (!empty($settings['is_event_completed'])): ?>
          <span class="w-2.5 h-2.5 rounded-full bg-emerald-400"></span>
          <h2 class="text-xs sm:text-sm font-bold font-academic uppercase tracking-wider text-academic-gold">
            Daftar Arsip Rekapitulasi Kehadiran Tamu Sidang
          </h2>
          <?php else: ?>
          <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
          <h2 class="text-xs sm:text-sm font-bold font-academic uppercase tracking-wider text-academic-gold">
            Urutan Kehadiran Tamu (Waktu Kedatangan Terkini)
          </h2>
          <?php endif; ?>
        </div>
        <div class="text-[11px] sm:text-xs text-slate-400">
          <?php if (!empty($settings['is_event_completed'])): ?>
          Status Dokumen: <span class="font-semibold text-emerald-300">Final &amp; Sah</span> &bull; Arsip Kehadiran Resmi
          <?php else: ?>
          Otomatis diperbarui secara *real-time* &bull; Terakhir cek: <span x-text="lastUpdated" class="font-mono text-slate-300"></span>
          <?php endif; ?>
        </div>
      </div>

      <div class="overflow-x-auto touch-scroll">
        <table class="w-full text-left text-xs sm:text-sm min-w-[760px]">
          <thead class="bg-academic-night/90 text-slate-400 uppercase tracking-wider text-[11px] border-b border-white/10">
            <tr>
              <th class="py-4 px-4 w-16 text-center">No. Urut</th>
              <th class="py-4 px-4 w-32">Waktu Hadir</th>
              <th class="py-4 px-6">Nama Lengkap &amp; Gelar</th>
              <th class="py-4 px-6">Instansi / Lembaga / Asal</th>
              <th class="py-4 px-4 text-center w-28">Kategori</th>
              <th class="py-4 px-6 text-center w-40">Tanda Tangan</th>
              <th class="py-4 px-6">Ucapan &amp; Doa Restu</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-white/5">
            
            <!-- Live Guests Rendered by Alpine.js -->
            <template x-for="(guest, index) in guests" :key="guest.id">
              <tr class="hover:bg-white/10 transition duration-150" :class="index === 0 ? 'bg-academic-gold/10' : ''">
                
                <!-- Order No -->
                <td class="py-4 px-4 text-center font-mono font-bold text-academic-gold text-base" x-text="'#' + guest.order_no"></td>

                <!-- Time -->
                <td class="py-4 px-4 font-mono font-semibold text-emerald-400 whitespace-nowrap text-xs" x-text="guest.time_formatted"></td>

                <!-- Name -->
                <td class="py-4 px-6">
                  <div class="font-bold text-white text-base font-academic leading-tight" x-text="guest.full_name"></div>
                  <div class="text-[11px] text-academic-goldlight font-serif italic mt-0.5" x-text="guest.salutation"></div>
                </td>

                <!-- Institution -->
                <td class="py-4 px-6 text-slate-300 font-medium" x-text="guest.institution"></td>

                <!-- Category -->
                <td class="py-4 px-4 text-center whitespace-nowrap">
                  <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[10px] font-bold"
                        :class="guest.guest_type === 'invited' ? 'bg-blue-900/60 text-blue-200 border border-blue-400/40' : 'bg-emerald-900/60 text-emerald-200 border border-emerald-400/40'"
                        x-text="guest.guest_type === 'invited' ? 'Undangan' : 'Walk-in'">
                  </span>
                </td>

                <!-- Signature Image -->
                <td class="py-4 px-6 text-center">
                  <template x-if="guest.signature_image">
                    <div class="bg-white/95 rounded-lg p-1 max-w-[120px] min-h-[44px] mx-auto shadow-sm border border-slate-300 flex items-center justify-center">
                      <img :src="guest.signature_image" 
                           alt="TTD" 
                           class="h-9 max-w-full mx-auto object-contain"
                           loading="eager"
                           @error="handleSigError($event, guest.signature_image)">
                      <div class="sig-fallback hidden text-center text-academic-navy">
                        <svg class="w-4 h-4 mx-auto text-emerald-600 mb-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        <span class="text-[9px] font-bold block uppercase tracking-wider text-emerald-700">Tercatat</span>
                      </div>
                    </div>
                  </template>
                  <template x-if="!guest.signature_image">
                    <span class="text-xs text-slate-500 italic">-</span>
                  </template>
                </td>

                <!-- Wishes / Doa -->
                <td class="py-4 px-6 text-slate-300 text-xs italic font-serif">
                  <span x-text="guest.wishes || '—'"></span>
                </td>

              </tr>
            </template>

            <!-- Empty State -->
            <tr x-show="guests.length === 0">
              <td colspan="7" class="py-20 text-center text-slate-400">
                <div class="w-16 h-16 mx-auto mb-3 text-academic-gold opacity-50">
                  <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <div class="text-lg font-academic font-bold text-white">Menunggu Kedatangan Tamu Pertama...</div>
                <div class="text-xs text-slate-400 mt-1">
                  Meja absensi digital di depan Ruang Sidang 03.16 telah aktif.
                </div>
              </td>
            </tr>

          </tbody>
        </table>
      </div>

    </div>
  </main>

  <!-- Live Board Script -->
  <script>
    function liveBoardApp() {
      return {
        guests: [],
        stats: <?= json_encode($stats) ?>,
        lastUpdated: 'Baru saja',
        pollInterval: null,

        init() {
          this.fetchLive();
          // Poll every 6 seconds
          this.pollInterval = setInterval(() => {
            this.fetchLive();
          }, 6000);
        },

        async fetchLive() {
          try {
            const res = await fetch('<?= base_url('daftar-hadir/api') ?>');
            const data = await res.json();
            if (data.success) {
              this.guests = data.guests;
              this.stats = data.stats;
              this.lastUpdated = data.timestamp;
            }
          } catch (e) {
            console.error('Live poll error', e);
          }
        },

        toggleFullscreen() {
          if (!document.fullscreenElement) {
            document.documentElement.requestFullscreen().catch(err => {
              console.log(err);
            });
          } else {
            if (document.exitFullscreen) {
              document.exitFullscreen();
            }
          }
        },

        handleSigError(e, originalSrc) {
          const img = e.target;
          const retryCount = parseInt(img.dataset.retry || '0', 10);
          if (retryCount < 2) {
            img.dataset.retry = retryCount + 1;
            setTimeout(() => {
              const separator = originalSrc.includes('?') ? '&' : '?';
              img.src = originalSrc + separator + 'retry=' + Date.now();
            }, 1200 * (retryCount + 1));
          } else {
            img.style.display = 'none';
            const fallback = img.parentElement ? img.parentElement.querySelector('.sig-fallback') : null;
            if (fallback) {
              fallback.classList.remove('hidden');
            }
          }
        }
      }
    }

    // Top Clock
    function updateClock() {
      const now = new Date();
      const h = String(now.getHours()).padStart(2, '0');
      const m = String(now.getMinutes()).padStart(2, '0');
      const s = String(now.getSeconds()).padStart(2, '0');
      const el = document.getElementById('boardClock');
      if (el) {
        el.innerText = `${h}:${m}:${s} WIB`;
      }
    }
    setInterval(updateClock, 1000);
    updateClock();
  </script>

</body>
</html>
