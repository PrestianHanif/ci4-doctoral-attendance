<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="max-w-4xl mx-auto py-2">
  
  <div class="mb-6">
    <h1 class="text-2xl font-bold font-academic text-academic-navy">
      Pengaturan Acara Sidang Promosi Doktor
    </h1>
    <p class="text-xs sm:text-sm text-slate-500 mt-1">
      Konfigurasi dinamis ini secara otomatis disematkan pada seluruh dokumen Undangan PDF 3 halaman dan tajuk halaman sistem.
    </p>
  </div>

  <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="bg-academic-navy text-white px-6 py-4 border-b border-academic-gold/30 flex items-center justify-between">
      <div class="flex items-center space-x-2">
        <svg class="w-5 h-5 text-academic-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        <h2 class="font-bold text-sm">Formulir Konfigurasi Acara</h2>
      </div>
      <span class="text-[10px] text-academic-goldlight uppercase tracking-wider font-semibold">Tersimpan di Database</span>
    </div>

    <form action="<?= base_url('pengaturan/update') ?>" method="POST" class="p-6 sm:p-8 space-y-6">
      
      <!-- Section 1: Promovendus -->
      <div class="border-b border-slate-100 pb-5">
        <h3 class="text-xs font-bold uppercase tracking-wider text-academic-gold mb-4">
          1. Data Promovendus (Calon Doktor)
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div class="sm:col-span-2">
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap Promovendus <span class="text-rose-500">*</span></label>
            <input type="text" name="candidate_name" value="<?= esc($settings['candidate_name'] ?? 'Muhammad Abu Rivai, S.H., M.H.') ?>" required class="w-full text-xs sm:text-sm px-3.5 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-academic-navy">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Induk Mahasiswa (NIM) <span class="text-rose-500">*</span></label>
            <input type="text" name="candidate_nim" value="<?= esc($settings['candidate_nim'] ?? '21933020 (HI)') ?>" required class="w-full text-xs sm:text-sm px-3.5 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-academic-navy">
          </div>
        </div>

        <div class="mt-4">
          <label class="block text-xs font-bold text-slate-700 mb-1">Judul Disertasi <span class="text-rose-500">*</span></label>
          <textarea name="dissertation_title" rows="2" required class="w-full text-xs sm:text-sm px-3.5 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-academic-navy font-serif font-bold text-academic-navy"><?= esc($settings['dissertation_title'] ?? '') ?></textarea>
        </div>
      </div>

      <!-- Section 2: Waktu & Tanggal Acara -->
      <div class="border-b border-slate-100 pb-5">
        <h3 class="text-xs font-bold uppercase tracking-wider text-academic-gold mb-4">
          2. Waktu, Tanggal &amp; Lokasi Sidang
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Hari &amp; Tanggal Masehi</label>
            <input type="text" name="event_day_date" value="<?= esc($settings['event_day_date'] ?? 'Selasa, 20 Oktober 2026') ?>" required class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-academic-navy">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Hari &amp; Tanggal Hijriah</label>
            <input type="text" name="event_hijri_date" value="<?= esc($settings['event_hijri_date'] ?? 'Selasa, 9 Jumadil Awal 1448 H') ?>" required class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-academic-navy">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Waktu Pelaksanaan</label>
            <input type="text" name="event_time" value="<?= esc(str_replace(['?', '–'], '-', $settings['event_time'] ?? '09.00 - 11.00 WIB')) ?>" required class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-academic-navy">
          </div>
        </div>

        <div class="mt-4">
          <label class="block text-xs font-bold text-slate-700 mb-1">Tempat / Ruang Sidang</label>
          <input type="text" name="event_room" value="<?= esc($settings['event_room'] ?? 'Ruang 03.16 Gedung K.H. A. Wahid Hasyim, Kampus Terpadu UII') ?>" required class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-academic-navy">
        </div>
      </div>

      <!-- Section 3: Pejabat Penandatangan Undangan -->
      <div>
        <h3 class="text-xs font-bold uppercase tracking-wider text-academic-gold mb-4">
          3. Pejabat Pengesah Undangan (Halaman 2)
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Jabatan Penandatangan</label>
            <input type="text" name="signatory_title" value="<?= esc($settings['signatory_title'] ?? 'Dekan FIAI UII') ?>" required class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-academic-navy">
          </div>
          <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap &amp; Gelar Penandatangan</label>
            <input type="text" name="signatory_name" value="<?= esc($settings['signatory_name'] ?? 'Dr. Drs. Asmuni, M.A.') ?>" required class="w-full text-xs px-3.5 py-2.5 border border-slate-300 rounded-xl focus:ring-2 focus:ring-academic-navy font-bold">
          </div>
      <!-- Section 4: Status Pelaksanaan Acara & Kunci Absensi -->
      <div class="border-t border-slate-100 pt-5">
        <h3 class="text-xs font-bold uppercase tracking-wider text-academic-gold mb-2">
          4. Status Pelaksanaan Sidang &amp; Kunci Presensi
        </h3>
        <p class="text-xs text-slate-500 mb-4 leading-relaxed">
          Tentukan status pelaksanaan sidang promosi. Jika diset <strong>Telah Selesai</strong>, sistem secara otomatis memasang badge resmi "Alhamdulillah Telah Selesai", mengunci formulir absensi baru, dan mengarsipkan buku tamu digital.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <label class="relative flex items-center p-4 rounded-2xl border-2 cursor-pointer transition select-none <?= !empty($settings['is_event_completed']) ? 'border-emerald-500 bg-emerald-50/40 text-emerald-950 ring-2 ring-emerald-500/20' : 'border-slate-200 hover:border-slate-300' ?>">
            <input type="radio" name="is_event_completed" value="1" <?= !empty($settings['is_event_completed']) ? 'checked' : '' ?> class="sr-only">
            <div class="flex items-center space-x-3.5">
              <div class="w-10 h-10 rounded-xl bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
              </div>
              <div>
                <div class="text-sm font-bold">Acara Telah Selesai</div>
                <div class="text-xs text-slate-500 mt-0.5">Kunci meja absensi &amp; tampilkan status selesai resmi</div>
              </div>
            </div>
          </label>

          <label class="relative flex items-center p-4 rounded-2xl border-2 cursor-pointer transition select-none <?= empty($settings['is_event_completed']) ? 'border-academic-navy bg-blue-50/40 text-slate-900 ring-2 ring-academic-navy/20' : 'border-slate-200 hover:border-slate-300' ?>">
            <input type="radio" name="is_event_completed" value="0" <?= empty($settings['is_event_completed']) ? 'checked' : '' ?> class="sr-only">
            <div class="flex items-center space-x-3.5">
              <div class="w-10 h-10 rounded-xl bg-academic-navy text-white flex items-center justify-center flex-shrink-0 shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              </div>
              <div>
                <div class="text-sm font-bold">Sedang Berlangsung / Aktif</div>
                <div class="text-xs text-slate-500 mt-0.5">Meja absensi &amp; pendaftaran walk-in terbuka</div>
              </div>
            </div>
          </label>
        </div>
      </div>

      <!-- Submit Button -->
      <div class="pt-4 border-t border-slate-100 flex items-center justify-end">
        <button type="submit" class="px-6 py-3 rounded-xl bg-academic-navy hover:bg-academic-dark text-white font-bold text-xs shadow-md transition transform hover:-translate-y-0.5 flex items-center space-x-2">
          <svg class="w-4 h-4 text-academic-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
          <span>Simpan Perubahan Pengaturan</span>
        </button>
      </div>

    </form>

  </div>

</div>

<?= $this->endSection() ?>
