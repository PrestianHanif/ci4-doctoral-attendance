<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GuestModel;
use App\Models\EventSettingsModel;
use Mpdf\Mpdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ExportController extends BaseController
{
    protected GuestModel $guestModel;
    protected EventSettingsModel $settingsModel;

    public function __construct()
    {
        $this->guestModel = new GuestModel();
        $this->settingsModel = new EventSettingsModel();
    }

    /**
     * Ekspor Berita Acara & Buku Daftar Hadir Resmi PDF (Lengkap Tanda Tangan)
     */
    public function pdfAttendance()
    {
        $filter = $this->request->getGet('filter') ?? 'present'; // 'present' atau 'all'
        $isOnlyPresent = ($filter === 'present');

        $query = $this->guestModel;
        if ($isOnlyPresent) {
            $guests = $query->where('is_present', 1)
                            ->orderBy('check_in_time', 'ASC')
                            ->findAll();
            $docTitle = 'DAFTAR HADIR & BUKU TAMU SIDANG PROMOSI DOKTOR (REALISASI)';
            $filename = 'Buku_Hadir_Realisasi_Sidang_Doktor_' . date('Ymd_His') . '.pdf';
        } else {
            $guests = $query->orderBy('is_present', 'DESC')
                            ->orderBy('check_in_time', 'ASC')
                            ->orderBy('id', 'ASC')
                            ->findAll();
            $docTitle = 'DAFTAR SELURUH TAMU & PRESENSI SIDANG PROMOSI DOKTOR';
            $filename = 'Buku_Presensi_Lengkap_Sidang_Doktor_' . date('Ymd_His') . '.pdf';
        }

        $settings = $this->settingsModel->getSettings();
        $stats = $this->guestModel->getStats();

        $logoUii = FCPATH . 'assets/img/logo-uii.png';
        $logoKowpi = FCPATH . 'assets/img/logo-kowpi-coklat.png';
        $stempelSvg = FCPATH . 'assets/img/stempel-fiai-uii.svg';
        $ttdSvg = FCPATH . 'assets/img/ttd-dekan.svg';
        $stempelKowpiImg = file_exists(FCPATH . 'assets/img/stempel-kowpi-transparan.png')
            ? FCPATH . 'assets/img/stempel-kowpi-transparan.png'
            : FCPATH . 'assets/img/Stempel KOWPI.png';

        $data = [
            'docTitle'        => $docTitle,
            'guests'          => $guests,
            'settings'        => $settings,
            'stats'           => $stats,
            'isOnlyPresent'   => $isOnlyPresent,
            'logoUii'         => $logoUii,
            'logoKowpi'       => $logoKowpi,
            'stempelSvg'      => $stempelSvg,
            'ttdSvg'          => $ttdSvg,
            'stempelKowpiImg' => $stempelKowpiImg,
        ];

        $html = view('pdf/attendance_book', $data);

        $mpdf = new Mpdf([
            'mode'          => 'utf-8',
            'format'        => 'A4-L', // A4 Landscape untuk keleluasaan kolom dan tanda tangan
            'margin_left'   => 12,
            'margin_right'  => 12,
            'margin_top'    => 12,
            'margin_bottom' => 15,
            'margin_header' => 8,
            'margin_footer' => 8,
            'default_font'  => 'dejavusans',
        ]);

        $mpdf->SetTitle($docTitle);
        $mpdf->SetAuthor('Universitas Islam Indonesia x KOWPI');
        $mpdf->WriteHTML($html);

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="' . $filename . '"')
            ->setBody($mpdf->Output('', 'S'));
    }

    /**
     * Ekspor Rekapitulasi Kehadiran ke Excel (.xlsx) dengan Formatting Rapi
     */
    public function excelAttendance()
    {
        $filter = $this->request->getGet('filter') ?? 'all'; // 'all' atau 'present'
        $isOnlyPresent = ($filter === 'present');

        $query = $this->guestModel;
        if ($isOnlyPresent) {
            $guests = $query->where('is_present', 1)
                            ->orderBy('check_in_time', 'ASC')
                            ->findAll();
            $filename = 'Rekapitulasi_Kehadiran_Tamu_' . date('Ymd_His') . '.xlsx';
        } else {
            $guests = $query->orderBy('guest_type', 'ASC')
                            ->orderBy('id', 'ASC')
                            ->findAll();
            $filename = 'Data_Lengkap_Tamu_Sidang_Doktor_' . date('Ymd_His') . '.xlsx';
        }

        $settings = $this->settingsModel->getSettings();
        $stats = $this->guestModel->getStats();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Daftar Kehadiran');

        // 1. Judul Header Dokumen
        $sheet->setCellValue('A1', 'UNIVERSITAS ISLAM INDONESIA • FAKULTAS ILMU AGAMA ISLAM');
        $sheet->setCellValue('A2', 'REKAPITULASI DAFTAR HADIR SIDANG UJIAN TERBUKA (PROMOSI DOKTOR)');
        $sheet->setCellValue('A3', 'Promovendus: ' . ($settings['candidate_name'] ?? 'Muhammad Abu Rivai, S.H., M.H.') . ' (NIM: ' . ($settings['candidate_nim'] ?? '21933020') . ') | Ruang 03.16 Gedung K.H. A. Wahid Hasyim FIAI UII');
        $sheet->setCellValue('A4', 'Status Cetak: ' . date('d/m/Y H:i:s') . ' WIB | Total Hadir: ' . ($stats['total_present'] ?? 0) . ' dari ' . ($stats['total_registered'] ?? 101) . ' Tamu (' . ($stats['attendance_rate'] ?? 0) . '%)');

        $sheet->mergeCells('A1:J1');
        $sheet->mergeCells('A2:J2');
        $sheet->mergeCells('A3:J3');
        $sheet->mergeCells('A4:J4');

        $sheet->getStyle('A1:A4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle('A1')->getFont()->setSize(10)->setBold(true)->getColor()->setARGB('FF64748B');
        $sheet->getStyle('A2')->getFont()->setSize(13)->setBold(true)->getColor()->setARGB('FF0F2C59');
        $sheet->getStyle('A3')->getFont()->setSize(10)->setItalic(true)->getColor()->setARGB('FF334155');
        $sheet->getStyle('A4')->getFont()->setSize(9)->setBold(true)->getColor()->setARGB('FFC5A059');

        // 2. Header Kolom Tabel (Baris 6)
        $headers = [
            'A6' => 'NO.',
            'B6' => 'WAKTU CHECK-IN',
            'C6' => 'KODE REGISTRASI',
            'D6' => 'NAMA LENGKAP & GELAR',
            'E6' => 'INSTANSI / LEMBAGA',
            'F6' => 'KATEGORI TAMU',
            'G6' => 'STATUS KEHADIRAN',
            'H6' => 'TANDA TANGAN DIGITAL',
            'I6' => 'NO. WHATSAPP',
            'J6' => 'UCAPAN & DOA RESTU'
        ];

        foreach ($headers as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }

        $headerStyle = [
            'font' => [
                'bold'  => true,
                'color' => ['argb' => 'FFFFFFFF'],
                'size'  => 10,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF0F2C59'], // Academic Navy
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color'       => ['argb' => 'FFCBD5E1'],
                ],
            ],
        ];
        $sheet->getStyle('A6:J6')->applyFromArray($headerStyle);
        $sheet->getRowDimension(6)->setRowHeight(28);

        // 3. Isi Data Tamu
        $row = 7;
        foreach ($guests as $idx => $g) {
            $checkInStr = $g['check_in_time'] ? date('H:i:s', strtotime($g['check_in_time'])) . ' WIB' : '-';
            $typeStr = ($g['guest_type'] === 'invited') ? 'Tamu Undangan' : 'Tamu Walk-in';
            $statusStr = $g['is_present'] ? 'Hadir' : 'Belum Hadir';
            
            $sigStatus = '-';
            if (!empty($g['signature_image'])) {
                $sigStatus = 'Ada Tanda Tangan (PNG)';
            } elseif ($g['is_present']) {
                $sigStatus = 'Hadir Digital';
            }

            $sheet->setCellValue('A' . $row, $idx + 1);
            $sheet->setCellValue('B' . $row, $checkInStr);
            $sheet->setCellValue('C' . $row, $g['guest_code']);
            $sheet->setCellValue('D' . $row, $g['full_name']);
            $sheet->setCellValue('E' . $row, $g['institution'] ?: '-');
            $sheet->setCellValue('F' . $row, $typeStr);
            $sheet->setCellValue('G' . $row, $statusStr);
            $sheet->setCellValue('H' . $row, $sigStatus);
            $sheet->setCellValue('I' . $row, $g['phone'] ?: '-');
            $sheet->setCellValue('J' . $row, $g['wishes'] ?: '-');

            // Alignment
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('B' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('F' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('G' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('H' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('I' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            // Highlight baris yang hadir
            if ($g['is_present']) {
                $sheet->getStyle('G' . $row)->getFont()->setBold(true)->getColor()->setARGB('FF15803D');
                $sheet->getStyle('A' . $row . ':J' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFF0FDF4');
            }

            $row++;
        }

        // Borders untuk seluruh tabel data
        $lastRow = $row - 1;
        $sheet->getStyle('A6:J' . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setARGB('FFCBD5E1');

        // Auto width kolom
        foreach (range('A', 'J') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Output Excel
        $writer = new Xlsx($spreadsheet);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }
}
