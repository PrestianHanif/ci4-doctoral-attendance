<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuestModel;
use App\Models\EventSettingsModel;

class DashboardController extends BaseController
{
    protected GuestModel $guestModel;
    protected EventSettingsModel $settingsModel;

    public function __construct()
    {
        $this->guestModel = new GuestModel();
        $this->settingsModel = new EventSettingsModel();
    }

    public function index()
    {
        $stats = $this->guestModel->getStats();
        $settings = $this->settingsModel->getSettings();

        // 10 tamu terakhir yang hadir
        $recentAttendees = $this->guestModel->where('is_present', 1)
                                            ->orderBy('check_in_time', 'DESC')
                                            ->findAll(8);

        // 5 tamu terundang berikutnya yang belum hadir
        $pendingInvited = $this->guestModel->where('guest_type', 'invited')
                                           ->where('is_present', 0)
                                           ->orderBy('id', 'ASC')
                                           ->findAll(6);

        // Hitung file PDF yang sudah digenerate di public/uploads/pdf
        $pdfDir = FCPATH . 'uploads/pdf';
        $pdfCount = is_dir($pdfDir) ? count(glob($pdfDir . '/*.pdf')) : 0;

        $data = [
            'title'           => 'Dashboard Utama — Sidang Promosi Doktor UII x KOWPI',
            'activeNav'       => 'dashboard',
            'stats'           => $stats,
            'settings'        => $settings,
            'recentAttendees' => $recentAttendees,
            'pendingInvited'  => $pendingInvited,
            'pdfCount'        => $pdfCount,
        ];

        return view('dashboard/index', $data);
    }
}
