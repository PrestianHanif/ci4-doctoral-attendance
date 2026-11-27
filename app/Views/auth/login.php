<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc($title ?? 'Masuk Panel Panitia — Sidang Promosi Doktor') ?></title>
  
  <!-- Tailwind CSS & Google Fonts -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            academic: {
              navy: '#0F2C59',
              navydark: '#07162c',
              gold: '#C5A059',
              goldlight: '#E5C07B',
              cream: '#F8F5EC',
              sand: '#EFE9D9',
            }
          },
          fontFamily: {
            academic: ['"Noto Serif"', 'Georgia', 'serif'],
            sans: ['Inter', 'sans-serif'],
          }
        }
      }
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Serif:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
  
  <!-- SweetAlert2 & Alpine.js -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    body { font-family: 'Inter', sans-serif; }
    .font-academic { font-family: 'Noto Serif', Georgia, serif; }
  </style>
</head>
<body class="h-full bg-academic-navydark text-slate-100 flex flex-col justify-between selection:bg-academic-gold selection:text-academic-navy relative overflow-x-hidden">

  <!-- Ambient Glow Background -->
  <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-96 bg-gradient-to-b from-academic-navy via-academic-navy/30 to-transparent pointer-events-none blur-3xl opacity-60"></div>
  <div class="absolute -top-32 -right-32 w-96 h-96 rounded-full bg-academic-gold/15 pointer-events-none blur-3xl"></div>
  <div class="absolute -bottom-32 -left-32 w-96 h-96 rounded-full bg-blue-600/10 pointer-events-none blur-3xl"></div>

  <!-- Top Header / Brand -->
  <div class="relative z-10 pt-8 sm:pt-12 px-4 text-center">
    <!-- Dual Symmetrical Logos -->
    <div class="inline-flex items-center bg-white px-4 py-2 rounded-2xl shadow-xl border border-academic-gold/50 space-x-3 mb-6 transition hover:scale-[1.02]">
      <img src="<?= base_url('assets/img/logo-uii.png?v=' . time()) ?>" alt="UII" class="h-8 w-auto max-w-[105px] object-contain">
      <div class="h-6 w-[1.5px] bg-academic-gold"></div>
      <img src="<?= base_url('assets/img/logo-kowpi-coklat.png?v=' . time()) ?>" alt="KOWPI" class="h-7 w-auto max-w-[110px] object-contain">
    </div>

    <div class="text-[11px] uppercase tracking-widest text-academic-gold font-bold">
      Fakultas Ilmu Agama Islam &bull; Program Doktor Hukum Islam
    </div>
    <h1 class="text-xl sm:text-2xl font-bold font-academic text-white mt-1">
      Sidang Ujian Terbuka (Promosi Doktor)
    </h1>
    <p class="text-xs text-slate-300 font-serif italic mt-0.5">
      Promovendus: <strong class="text-academic-goldlight">Muhammad Abu Rivai, S.H., M.H.</strong> (NIM: 21933020)
    </p>
  </div>

  <!-- Main Login Card Container -->
  <main class="relative z-10 w-full max-w-md mx-auto px-4 my-6">
    <div class="bg-white rounded-3xl shadow-2xl border-2 border-academic-gold/40 p-6 sm:p-8 text-slate-800"
         x-data="{ showPass: false, isSubmitting: false }">
      
      <div class="text-center pb-5 mb-5 border-b border-slate-100">
        <div class="w-12 h-12 mx-auto rounded-2xl bg-academic-navy text-academic-gold flex items-center justify-center shadow-md mb-3">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
          </svg>
        </div>
        <h2 class="text-lg font-bold font-academic text-academic-navy">Masuk Panel Panitia</h2>
        <p class="text-xs text-slate-500 mt-0.5">Silakan masukkan kredensial untuk mengelola data sidang</p>
      </div>

      <!-- Flash Messages -->
      <?php if (session()->getFlashdata('error')): ?>
        <div class="mb-5 p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs flex items-center space-x-2.5">
          <svg class="w-4 h-4 flex-shrink-0 text-rose-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
          </svg>
          <span><?= session()->getFlashdata('error') ?></span>
        </div>
      <?php endif; ?>

      <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs flex items-center space-x-2.5">
          <svg class="w-4 h-4 flex-shrink-0 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
          <span><?= session()->getFlashdata('success') ?></span>
        </div>
      <?php endif; ?>

      <!-- Login Form -->
      <form action="<?= base_url('login/submit') ?>" method="POST" @submit="isSubmitting = true" class="space-y-4">
        <?= csrf_field() ?>

        <!-- Username Input -->
        <div>
          <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5" for="username">
            Username
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <input type="text" name="username" id="username" required
                   value="<?= old('username') ?>"
                   placeholder="Masukkan username"
                   autocomplete="username"
                   class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 focus:border-academic-navy focus:ring-2 focus:ring-academic-navy/20 text-sm font-medium text-slate-800 transition outline-none">
          </div>
        </div>

        <!-- Password Input -->
        <div>
          <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5" for="password">
            Kata Sandi (Password)
          </label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
              </svg>
            </div>
            <input :type="showPass ? 'text' : 'password'" name="password" id="password" required
                   placeholder="Masukkan kata sandi"
                   autocomplete="current-password"
                   class="w-full pl-10 pr-11 py-2.5 rounded-xl border border-slate-300 focus:border-academic-navy focus:ring-2 focus:ring-academic-navy/20 text-sm font-medium text-slate-800 transition outline-none">
            
            <button type="button" @click="showPass = !showPass"
                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition">
              <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
              </svg>
              <svg x-show="showPass" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
              </svg>
            </button>
          </div>
        </div>

        <!-- Remember Me Checkbox -->
        <div class="flex items-center justify-between pt-1">
          <label class="flex items-center space-x-2 cursor-pointer select-none">
            <input type="checkbox" name="remember" checked
                   class="rounded text-academic-navy focus:ring-academic-navy/30 w-4 h-4 border-slate-300">
            <span class="text-xs text-slate-600 font-medium">Ingat saya di perangkat ini</span>
          </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" :disabled="isSubmitting"
                class="w-full mt-2 py-3 px-4 rounded-xl bg-academic-navy hover:bg-academic-navydark text-white font-bold text-sm tracking-wide shadow-lg shadow-academic-navy/30 hover:shadow-xl transition-all flex items-center justify-center space-x-2 disabled:opacity-75">
          <span x-show="!isSubmitting">Masuk ke Panel Panitia</span>
          <span x-show="isSubmitting" style="display: none;" class="flex items-center space-x-2">
            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Memverifikasi...</span>
          </span>
          <svg x-show="!isSubmitting" class="w-4 h-4 text-academic-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
          </svg>
        </button>
      </form>

    </div>

    <!-- Quick Public Access for Event Operators (No login required) -->
    <div class="mt-6 text-center">
      <div class="text-[11px] uppercase tracking-wider text-slate-400 font-bold mb-2">
        Akses Langsung Hari-H (Tanpa Login):
      </div>
      <div class="flex flex-wrap items-center justify-center gap-2">
        <a href="<?= base_url('daftar-hadir') ?>" target="_blank"
           class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-slate-200 hover:text-white text-xs font-medium border border-white/10 transition">
          <svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
          </svg>
          <span>Layar TV Sidang</span>
        </a>

        <a href="<?= base_url('absensi') ?>"
           class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-slate-200 hover:text-white text-xs font-medium border border-white/10 transition">
          <svg class="w-3.5 h-3.5 text-academic-goldlight" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
          </svg>
          <span>Meja Absensi Tamu</span>
        </a>

        <a href="<?= base_url('tamu-baru') ?>"
           class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-slate-200 hover:text-white text-xs font-medium border border-white/10 transition">
          <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
          </svg>
          <span>Tamu Walk-in</span>
        </a>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="relative z-10 py-4 text-center text-slate-400 text-[11px]">
    &copy; 2026 Sidang Promosi Doktor &bull; FIAI Universitas Islam Indonesia x KOWPI
  </footer>

</body>
</html>
