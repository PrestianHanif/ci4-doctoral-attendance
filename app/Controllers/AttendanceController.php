<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuestModel;
use App\Models\EventSettingsModel;

class AttendanceController extends BaseController
{
    protected GuestModel $guestModel;
    protected EventSettingsModel $settingsModel;

    public function __construct()
    {
        $this->guestModel = new GuestModel();
        $this->settingsModel = new EventSettingsModel();
    }

    /**
     * Meja Absensi Tamu Terundang (Instant Search + Pen Tablet Signature)
     */
    public function index()
    {
        $search = $this->request->getGet('q');
        $code = $this->request->getGet('code');

        $query = $this->guestModel->where('guest_type', 'invited');

        if (!empty($code)) {
            $query = $query->where('guest_code', $code);
        } elseif (!empty($search)) {
            $query = $query->groupStart()
                           ->like('full_name', $search)
                           ->orLike('institution', $search)
                           ->orLike('guest_code', $search)
                           ->orLike('phone', $search)
                           ->groupEnd();
        }

        $guests = $query->orderBy('is_present', 'ASC')
                        ->orderBy('id', 'ASC')
                        ->findAll(120);

        $stats = $this->guestModel->getStats();
        $settings = $this->settingsModel->getSettings();

        $data = [
            'title'     => 'Meja Absensi Digital — Pen Tablet & Layar Sentuh',
            'activeNav' => 'attendance',
            'guests'    => $guests,
            'stats'     => $stats,
            'settings'  => $settings,
            'search'    => $search,
            'code'      => $code,
        ];

        return view('attendance/index', $data);
    }

    /**
     * AJAX Check-in Tamu Terundang
     */
    public function checkIn()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid request'])->setStatusCode(400);
        }

        $id = (int)$this->request->getPost('guest_id');
        $guest = $this->guestModel->find($id);

        if (!$guest) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tamu tidak ditemukan!'])->setStatusCode(404);
        }

        $settings = $this->settingsModel->getSettings();
        if (!empty($settings['is_event_completed'])) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Sesi presensi telah resmi ditutup karena sidang promosi doktor telah selesai terlaksana.'
            ])->setStatusCode(403);
        }

        $signatureData = $this->request->getPost('signature_data'); // base64 PNG
        $wishes = trim($this->request->getPost('wishes') ?? '');
        $phone = trim($this->request->getPost('phone') ?? $guest['phone']);

        $sigPath = null;
        if (!empty($signatureData) && strpos($signatureData, 'data:image/png;base64,') === 0) {
            $sigDir = FCPATH . 'uploads/signatures';
            if (!is_dir($sigDir)) {
                mkdir($sigDir, 0777, true);
                @chmod($sigDir, 0755);
            }

            $imgData = base64_decode(str_replace('data:image/png;base64,', '', $signatureData));
            $sigFilename = 'sig_' . $guest['guest_code'] . '_' . time() . '.png';
            $fullPath = $sigDir . '/' . $sigFilename;
            file_put_contents($fullPath, $imgData);
            @chmod($fullPath, 0644);
            $sigPath = 'uploads/signatures/' . $sigFilename;
        }

        $checkInTime = date('Y-m-d H:i:s');

        $this->guestModel->update($id, [
            'is_present'      => 1,
            'check_in_time'   => $checkInTime,
            'signature_image' => $sigPath ?: $guest['signature_image'],
            'wishes'          => !empty($wishes) ? $wishes : $guest['wishes'],
            'phone'           => $phone,
        ]);

        $updatedGuest = $this->guestModel->find($id);
        $stats = $this->guestModel->getStats();

        return $this->response->setJSON([
            'success'       => true,
            'message'       => "Kehadiran [{$guest['full_name']}] berhasil dicatat!",
            'guest'         => $updatedGuest,
            'stats'         => $stats,
            'check_in_time' => date('H:i:s', strtotime($checkInTime)) . ' WIB',
        ]);
    }

    /**
     * Reset / Batalkan Check-in jika keliru klik
     */
    public function undoCheckIn($id)
    {
        $guest = $this->guestModel->find($id);
        if (!$guest) {
            return redirect()->back()->with('error', 'Data tamu tidak ditemukan.');
        }

        $this->guestModel->update($id, [
            'is_present'    => 0,
            'check_in_time' => null,
        ]);

        return redirect()->back()->with('success', "Status kehadiran [{$guest['full_name']}] berhasil direset.");
    }

    /**
     * Home Khusus Tamu Dadakan (Walk-in Guest Form)
     */
    public function walkIn()
    {
        $stats = $this->guestModel->getStats();
        $settings = $this->settingsModel->getSettings();

        // 5 Tamu Walk-in terakhir yang mendaftar hari ini
        $recentWalkIns = $this->guestModel->where('guest_type', 'walk_in')
                                          ->orderBy('id', 'DESC')
                                          ->findAll(5);

        $data = [
            'title'         => 'Registrasi Tamu Baru / Hadir Mandiri — Sidang Promosi Doktor',
            'activeNav'     => 'walk_in',
            'stats'         => $stats,
            'settings'      => $settings,
            'recentWalkIns' => $recentWalkIns,
            'nextCode'      => $this->guestModel->getNextWalkInCode(),
        ];

        return view('attendance/walk_in', $data);
    }

    /**
     * Submit Tamu Dadakan (Walk-in)
     */
    public function submitWalkIn()
    {
        $salutation = trim($this->request->getPost('salutation') ?? 'Bapak/Ibu');
        $fullName = trim($this->request->getPost('full_name') ?? '');
        $institution = trim($this->request->getPost('institution') ?? '');
        $phone = trim($this->request->getPost('phone') ?? '');
        $wishes = trim($this->request->getPost('wishes') ?? '');
        $signatureData = $this->request->getPost('signature_data');

        if (empty($fullName)) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Nama lengkap dan gelar wajib diisi!'])->setStatusCode(422);
            }
            return redirect()->back()->with('error', 'Nama lengkap dan gelar wajib diisi!');
        }

        $settings = $this->settingsModel->getSettings();
        if (!empty($settings['is_event_completed'])) {
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Pendaftaran tamu baru telah resmi ditutup karena sidang promosi doktor telah selesai terlaksana.'
                ])->setStatusCode(403);
            }
            return redirect()->to('/tamu-baru')->with('error', 'Pendaftaran tamu baru telah resmi ditutup karena sidang promosi doktor telah selesai terlaksana.');
        }

        $code = $this->guestModel->getNextWalkInCode();
        $slug = preg_replace('/[^A-Za-z0-9_]/', '_', $code);
        $pdfFilename = "Undangan_Promosi_Doktor_Muhammad_Abu_Rivai_{$slug}.pdf";

        // Simpan tanda tangan jika ada
        $sigPath = null;
        if (!empty($signatureData) && strpos($signatureData, 'data:image/png;base64,') === 0) {
            $sigDir = FCPATH . 'uploads/signatures';
            if (!is_dir($sigDir)) {
                mkdir($sigDir, 0777, true);
                @chmod($sigDir, 0755);
            }

            $imgData = base64_decode(str_replace('data:image/png;base64,', '', $signatureData));
            $sigFilename = 'sig_' . $code . '_' . time() . '.png';
            $fullPath = $sigDir . '/' . $sigFilename;
            file_put_contents($fullPath, $imgData);
            @chmod($fullPath, 0644);
            $sigPath = 'uploads/signatures/' . $sigFilename;
        }

        $checkInTime = date('Y-m-d H:i:s');

        $insertId = $this->guestModel->insert([
            'guest_code'      => $code,
            'salutation'      => $salutation,
            'full_name'       => $fullName,
            'institution'     => $institution,
            'phone'           => $phone,
            'guest_type'      => 'walk_in',
            'pdf_filename'    => $pdfFilename,
            'is_present'      => 1,
            'check_in_time'   => $checkInTime,
            'signature_image' => $sigPath,
            'wishes'          => $wishes,
        ]);

        $newGuest = $this->guestModel->find($insertId);

        // Hitung nomor urut kehadiran keseluruhan
        $orderNumber = $this->guestModel->where('is_present', 1)->countAllResults();

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success'       => true,
                'message'       => "Ahlan wa Sahlan, {$fullName}! Kehadiran Anda telah tercatat.",
                'guest'         => $newGuest,
                'order_number'  => $orderNumber,
                'check_in_time' => date('H:i:s', strtotime($checkInTime)) . ' WIB',
            ]);
        }

        return redirect()->to('/tamu-baru')->with('success_guest', [
            'name'         => $fullName,
            'code'         => $code,
            'institution'  => $institution,
            'order_number' => $orderNumber,
            'time'         => date('H:i:s', strtotime($checkInTime)) . ' WIB',
        ]);
    }

    /**
     * Tampilan Publik Daftar Kehadiran (Live Attendance Board TV / Proyektor)
     */
    public function liveBoard()
    {
        $settings = $this->settingsModel->getSettings();
        $stats = $this->guestModel->getStats();

        // Tamu yang hadir diurutkan berdasarkan waktu kedatangan terbaru di atas
        $presentGuests = $this->guestModel->where('is_present', 1)
                                          ->orderBy('check_in_time', 'DESC')
                                          ->findAll(100);

        $data = [
            'title'         => 'Buku Tamu Digital & Daftar Kehadiran — Sidang Promosi Doktor',
            'activeNav'     => 'live_board',
            'settings'      => $settings,
            'stats'         => $stats,
            'presentGuests' => $presentGuests,
        ];

        return view('attendance/live_board', $data);
    }

    /**
     * Endpoint API JSON untuk Live Polling di TV Board (Auto-refresh tanpa reload)
     */
    public function liveBoardApi()
    {
        $stats = $this->guestModel->getStats();
        $presentGuests = (new GuestModel())->where('is_present', 1)
                                          ->orderBy('check_in_time', 'DESC')
                                          ->findAll(150);

        $formatted = [];
        $totalPresent = count($presentGuests);
        foreach ($presentGuests as $index => $g) {
            $formatted[] = [
                'id'              => $g['id'],
                'order_no'        => $totalPresent - $index,
                'guest_code'      => $g['guest_code'],
                'guest_type'      => $g['guest_type'],
                'salutation'      => $g['salutation'],
                'full_name'       => $g['full_name'],
                'institution'     => $g['institution'] ?: 'Tamu Kehormatan',
                'time_formatted'  => $g['check_in_time'] ? date('H:i:s', strtotime($g['check_in_time'])) . ' WIB' : '-',
                'signature_image' => $g['signature_image'] ? base_url($g['signature_image']) : null,
                'wishes'          => $g['wishes'],
            ];
        }

        return $this->response->setJSON([
            'success'   => true,
            'stats'     => $stats,
            'guests'    => $formatted,
            'timestamp' => date('H:i:s') . ' WIB',
        ]);
    }
}
