<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController extends CI_Controller
{
    public function exportRekapByDokter($dokter)
    {
        $dokter = urldecode($dokter);
        $rekapData = $this->M_rekap->getRekapByDokter($dokter);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Sep');
        $sheet->setCellValue('C1', 'Kasus');
        $sheet->setCellValue('D1', 'Rawat');
        $sheet->setCellValue('E1', 'Nama Pasien');
        $sheet->setCellValue('F1', 'Dokter');
        $sheet->setCellValue('G1', 'Klaim');
        $sheet->setCellValue('H1', 'Kode');
        $sheet->setCellValue('I1', 'Dokter Spesialis');
        $sheet->setCellValue('J1', 'Jasa Diterima');
        $row = 2;
        $no = 1;
        foreach ($rekapData as $data) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $data['nosep']);
            $sheet->setCellValue('C' . $row, $data['kasus']);
            $sheet->setCellValue('D' . $row, $data['rawat']);
            $sheet->setCellValue('E' . $row, $data['nama_pasien']);
            $sheet->setCellValue('F' . $row, $data['dokter']);
            $sheet->setCellValue('G' . $row, $data['jumlah']);
            $sheet->setCellValue('H' . $row, $data['kd_dpjp']);
            $sheet->setCellValue('I' . $row, $data['dokter_spesialis_final']);

            $jasaDiterima = 0;
            if ($data['kd_dpjp'] == 'dpjp_utama') {
                $jasaDiterima = $data['jasa_dpjp_utama'];
            } elseif ($data['kd_dpjp'] == 'dpjp2_dst') {
                $jasaDiterima = $data['jasa_dpjp2_dst'];
            } elseif ($data['kd_dpjp'] == 'jasa operasi') {
                $jasaDiterima = $data['jasa_operator'];
            } elseif ($data['kd_dpjp'] == 'jasa anestesi') {
                $jasaDiterima = $data['jasa_anestesi'];
            } elseif (in_array($data['kd_dpjp'], ['LAB', 'LAB PA', 'FOTO', 'USG', 'RAD KONTRAS', 'CT - SCAN', 'MRI', 'KONSUL'])) {
                $jasaDiterima = $data['penunjang'];
            }

            $sheet->setCellValue('J' . $row, $jasaDiterima);
            $row++;
        }
        $filename = 'Rekap_Dokter_' . str_replace(' ', '_', $dokter) . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
    public function exportJasaPegawai($grup = 'all', $ruangan = 'all')
    {
        $grup = urldecode($grup);
        $ruangan = urldecode($ruangan);
        $grup = str_replace('+', ' ', $grup);
        $ruangan = str_replace('+', ' ', $ruangan);

        $this->db->select('*');
        $this->db->from('simulasi_jasa_finish');
        if ($grup !== 'all' && !empty($grup)) {
            $this->db->where('grup', $grup);
        }
        if ($ruangan !== 'all' && !empty($ruangan)) {
            $this->db->where('ruangan', $ruangan);
        }
        $query = $this->db->get();
        $rekapJasaParamedisFillter = $query->result_array();
        $total_sisa_jasa = array_sum(array_column($rekapJasaParamedisFillter, 'sisa_jasa_pegawai'));

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Group');
        $sheet->setCellValue('C1', 'Nama Pegawai');
        $sheet->setCellValue('D1', 'Ruangan');
        $sheet->setCellValue('E1', 'Jabatan');
        $sheet->setCellValue('F1', 'Pendidikan Formal');
        $sheet->setCellValue('G1', 'Pendidikan Non Formal');
        $sheet->setCellValue('H1', 'Gaji Pokok');
        $sheet->setCellValue('I1', 'Sangsi');
        $sheet->setCellValue('J1', 'Jasa Diterima');

        $row = 2;
        $no = 1;
        foreach ($rekapJasaParamedisFillter as $paramedis) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $paramedis['grup']);
            $sheet->setCellValue('C' . $row, $paramedis['nama_pegawai']);
            $sheet->setCellValue('D' . $row, $paramedis['ruangan']);
            $sheet->setCellValue('E' . $row, $paramedis['jabatan']);
            $sheet->setCellValue('F' . $row, $paramedis['pendidikan_formal']);
            $sheet->setCellValue('G' . $row, $paramedis['pendidikan_non_formal']);
            $sheet->setCellValue('H' . $row, $paramedis['gaji_pokok']);
            $sheet->setCellValue('I' . $row, $paramedis['nama_pengurangan']);
            $sheet->setCellValue('J' . $row, $paramedis['sisa_jasa_pegawai']);
            $row++;
        }

        $sheet->setCellValue('I' . $row, 'TOTAL');
        $sheet->setCellValue('J' . $row, $total_sisa_jasa);

        $filename = 'Jasa_Pegawai_' . date('YmdHis') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

}