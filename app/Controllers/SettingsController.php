<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EventSettingsModel;

class SettingsController extends BaseController
{
    protected EventSettingsModel $settingsModel;

    public function __construct()
    {
        $this->settingsModel = new EventSettingsModel();
    }

    public function index()
    {
        $settings = $this->settingsModel->getSettings();

        $data = [
            'title'     => 'Pengaturan Acara Sidang Promosi Doktor',
            'activeNav' => 'settings',
            'settings'  => $settings,
        ];

        return view('settings/index', $data);
    }

    public function update()
    {
        $settings = $this->settingsModel->getSettings();
        $id = $settings['id'];

        $data = [
            'candidate_name'     => trim($this->request->getPost('candidate_name') ?? 'Muhammad Abu Rivai, S.H., M.H.'),
            'candidate_nim'      => trim($this->request->getPost('candidate_nim') ?? '21933020 (HI)'),
            'dissertation_title' => trim($this->request->getPost('dissertation_title') ?? ''),
            'event_day_date'     => trim($this->request->getPost('event_day_date') ?? 'Selasa, 20 Oktober 2026'),
            'event_hijri_date'   => trim($this->request->getPost('event_hijri_date') ?? 'Selasa, 9 Jumadil Awal 1448 H'),
            'event_time'         => str_replace(['?', '–'], '-', trim($this->request->getPost('event_time') ?? '09.00 - 11.00 WIB')),
            'event_room'         => trim($this->request->getPost('event_room') ?? ''),
            'signatory_title'    => trim($this->request->getPost('signatory_title') ?? 'Dekan FIAI UII'),
            'signatory_name'     => trim($this->request->getPost('signatory_name') ?? 'Dr. Drs. Asmuni, M.A.'),
            'is_event_completed' => (int)($this->request->getPost('is_event_completed') ?? 1),
        ];

        $this->settingsModel->update($id, $data);

        return redirect()->to('/pengaturan')->with('success', 'Konfigurasi acara berhasil disimpan dan diperbarui!');
    }
}
