<?php

namespace App\Controllers;

use App\Models\LeadModel;

class Home extends BaseController
{
    public function index(): string
    {
        $visitorModel = new \App\Models\VisitorModel();
        $ip = $this->request->getIPAddress();
        $date = date('Y-m-d');
        
        if (!$visitorModel->where('ip_address', $ip)->where('visit_date', $date)->first()) {
            try {
                $visitorModel->insert([
                    'ip_address' => $ip,
                    'visit_date' => $date
                ]);
            } catch (\Exception $e) {
                // Ignore if race condition
            }
        }

        return view('home/index');
    }

    public function submit()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Forbidden']);
        }

        $rules = [
            'nama_lengkap'     => 'required|min_length[3]|max_length[150]',
            'email'            => 'required|valid_email|max_length[150]',
            'nomor_whatsapp'   => 'required|numeric|max_length[25]',
            'rentang_umur'     => 'permit_empty|max_length[50]',
            'status_pekerjaan' => 'permit_empty|max_length[100]',
            'consent'          => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal. Pastikan form diisi dengan benar.',
                'errors'  => $this->validator->getErrors()
            ]);
        }

        $leadModel = new LeadModel();
        
        $emailClean = strtolower(trim($this->request->getPost('email')));

        $rentangUmur = trim((string)$this->request->getPost('rentang_umur'));
        if ($rentangUmur === 'Lainnya' && $this->request->getPost('rentang_umur_other')) {
            $rentangUmur = trim((string)$this->request->getPost('rentang_umur_other'));
        }
        
        $data = [
            'nama_lengkap'     => esc($this->request->getPost('nama_lengkap')),
            'email'            => $emailClean,
            'nomor_whatsapp'   => esc($this->request->getPost('nomor_whatsapp')),
            'rentang_umur'     => $rentangUmur ?: null,
            'status_pekerjaan' => esc($this->request->getPost('status_pekerjaan')) ?: null,
            'consent_given'    => 1
        ];

        // Cek apakah email sudah terdaftar sebelumnya (Smart Upsert / Anti-Duplikat)
        $existingLead = $leadModel->where('LOWER(email)', $emailClean)->orderBy('id', 'DESC')->first();
        $isExisting = false;

        if ($existingLead) {
            $leadId = $existingLead['id'];
            $isExisting = true;

            // Perbarui data yang ada tanpa menambah baris baru di database
            $updateData = [
                'nama_lengkap'   => $data['nama_lengkap'],
                'nomor_whatsapp' => $data['nomor_whatsapp'],
                'consent_given'  => 1,
                'updated_at'     => date('Y-m-d H:i:s')
            ];
            if (!empty($data['rentang_umur'])) {
                $updateData['rentang_umur'] = $data['rentang_umur'];
            }
            if (!empty($data['status_pekerjaan'])) {
                $updateData['status_pekerjaan'] = $data['status_pekerjaan'];
            }

            $leadModel->update($leadId, $updateData);
        } else {
            $leadId = $leadModel->insert($data);
        }

        if ($leadId) {
            $downloadUrl = base_url('downloads/panduan-fikih-harta-anak-yatim.pdf');
            $pdfPath = FCPATH . 'downloads' . DIRECTORY_SEPARATOR . 'panduan-fikih-harta-anak-yatim.pdf';

            $emailSent = false;

            try {
                $email = \Config\Services::email();

                $email->setTo($data['email']);
                $email->setFrom(config('Email')->fromEmail ?? 'info@kowpi.id', config('Email')->fromName ?? 'Kowpi.id - Panduan Fikih Harta Yatim');
                $email->setSubject('Ebook Gratis: Panduan Fikih Harta Anak Yatim - Kowpi.id');

                $emailViewData = [
                    'nama'        => $data['nama_lengkap'],
                    'downloadUrl' => $downloadUrl
                ];
                $messageBody = view('emails/ebook_notification', $emailViewData);
                $email->setMessage($messageBody);

                if (file_exists($pdfPath)) {
                    $email->attach($pdfPath, 'attachment', 'Panduan-Fikih-Harta-Anak-Yatim.pdf', 'application/pdf');
                }

                $smtpHost = env('email.SMTPHost', config('Email')->SMTPHost);
                if (!empty($smtpHost)) {
                    if ($email->send(false)) {
                        $emailSent = true;
                        log_message('info', 'Ebook email sent successfully to: ' . $data['email']);
                    } else {
                        log_message('warning', 'Email sending failed: ' . $email->printDebugger(['headers']));
                    }
                } else {
                    // Local / development fallback: save copy to writable/emails
                    $emailFolder = WRITEPATH . 'emails' . DIRECTORY_SEPARATOR;
                    if (!is_dir($emailFolder)) {
                        @mkdir($emailFolder, 0777, true);
                    }
                    @file_put_contents($emailFolder . 'ebook_' . date('Ymd_His') . '_' . $leadId . '.html', $messageBody);
                    $emailSent = true;
                    log_message('info', '[Local Mail Dispatch] Ebook HTML generated and saved for: ' . $data['email']);
                }
            } catch (\Throwable $e) {
                log_message('error', 'Email exception: ' . $e->getMessage());
            }

            return $this->response->setJSON([
                'success'      => true,
                'lead_id'      => $leadId,
                'nama'         => $data['nama_lengkap'],
                'email'        => $data['email'],
                'email_sent'   => $emailSent,
                'download_url' => $downloadUrl,
                'is_existing'  => $isExisting,
                'message'      => $isExisting 
                    ? 'Alhamdulillah, data Anda telah diperbarui dan tautan ebook telah dikirimkan ke email Anda.' 
                    : 'Alhamdulillah, data berhasil disimpan dan ebook sedang dikirim ke email Anda.'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal menyimpan data ke database.'
        ]);
    }
    public function submitDonation()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setJSON(['success' => false, 'message' => 'Forbidden']);
        }

        $rules = [
            'lead_id'        => 'required|numeric',
            'amount'         => 'required|numeric|greater_than[0]',
            'payment_method' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Validasi gagal.'
            ]);
        }

        $donationModel = new \App\Models\DonationModel();
        
        $data = [
            'lead_id'        => esc($this->request->getPost('lead_id')),
            'amount'         => esc($this->request->getPost('amount')),
            'payment_method' => esc($this->request->getPost('payment_method')),
            'status'         => 'pending'
        ];

        if ($donationModel->insert($data)) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Niat donasi tercatat.'
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal mencatat donasi.'
        ]);
    }
}
