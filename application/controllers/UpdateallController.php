<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UpdateallController extends CI_Controller
{
    public function eksekusiUpdate()
    {
        $response = [];
        $this->db->trans_start();

        $this->db->query("UPDATE klaim
                        SET rajal_ird = 1
                        WHERE no_fpk LIKE '%RJ%' AND dokter NOT LIKE '%Sp.%'");
        $response[] = ['step' => 1, 'message' => 'Ird Rawat Jalan Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim AS ds
                            SET kasus = CASE
                                WHEN EXISTS (
                                    SELECT 1
                                    FROM (SELECT DISTINCT nosep FROM data_sim WHERE komponen = 'DR.OPERATOR') AS operator
                                    WHERE operator.nosep = ds.nosep
                                ) AND EXISTS (
                                    SELECT 1
                                    FROM (SELECT DISTINCT nosep FROM data_sim WHERE komponen = 'DR.ANESTESI') AS anestesi
                                    WHERE anestesi.nosep = ds.nosep
                                ) THEN 'bedah dengan GA'
                                
                                WHEN EXISTS (
                                    SELECT 1
                                    FROM (SELECT DISTINCT nosep FROM data_sim WHERE komponen = 'DR.OPERATOR') AS operator
                                    WHERE operator.nosep = ds.nosep
                                ) AND NOT EXISTS (
                                    SELECT 1
                                    FROM (SELECT DISTINCT nosep FROM data_sim WHERE komponen = 'DR.ANESTESI') AS anestesi
                                    WHERE anestesi.nosep = ds.nosep
                                ) THEN 'bedah tanpa GA'
                                
                                WHEN NOT EXISTS (
                                    SELECT 1
                                    FROM (SELECT DISTINCT nosep FROM data_sim WHERE komponen IN ('DR.OPERATOR', 'DR.ANESTESI')) AS komponen_data
                                    WHERE komponen_data.nosep = ds.nosep
                                ) THEN 'non bedah'
                                
                                ELSE kasus END");
        $response[] = ['step' => 2, 'message' => 'Kasus Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim
                            SET data_sim.kasus = 'rajal IRD'
                            WHERE data_sim.nosep IN (
                                SELECT klaim.nosep 
                                FROM klaim 
                                WHERE klaim.rajal_ird = 1)");

        $response[] = ['step' => 3, 'message' => 'Kasus IGD Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim
                            SET kd_dpjp = CASE
                                WHEN dokter IN ('dr. METY NITA MOKOGINTA Sp.PK', 
                                                'dr. NURLIANA IBRAHIM Sp.PK M.Kes', 
                                                'LABORATORIUM', 
                                                'dr. St. Rahma, M.Kes, Sp.Pk') 
                                    THEN 'LAB'
                                WHEN dokter = 'dr. TRINNY TUNA M.KesSp.PA' 
                                    THEN 'LAB PA'
                                ELSE kd_dpjp
                            END
                            WHERE layanan = 'LABOLATORIUM'");
        $response[] = ['step' => 4, 'message' => 'Kode dpjp LAB Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim
                            SET kd_dpjp = CASE
                                WHEN layanan = 'RADIOLOGI' AND tindakan LIKE '%foto%' THEN 'FOTO'
                                WHEN layanan = 'RADIOLOGI' AND tindakan LIKE '%scan%' THEN 'CT - SCAN'
                                WHEN layanan = 'RADIOLOGI' AND tindakan LIKE '%usg%' THEN 'USG'
                                WHEN layanan = 'RADIOLOGI' AND tindakan LIKE '%mri%' THEN 'MRI'
                                WHEN layanan = 'RADIOLOGI' AND tindakan LIKE '%kontras%' 
                                    AND tindakan NOT LIKE '%mri%' 
                                    AND tindakan NOT LIKE '%scan%' THEN 'RAD KONTRAS'
                                ELSE kd_dpjp
                            END
                            WHERE layanan = 'RADIOLOGI'");
        $response[] = ['step' => 5, 'message' => 'Kode dpjp RADIOLOGI Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim
                            SET kd_dpjp = 'KONSUL'
                            WHERE tindakan LIKE '%konsul%'");
        $response[] = ['step' => 6, 'message' => 'Kode dpjp KONSUL Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim AS main_table
                            JOIN (
                                SELECT nosep, 
                                    MAX(CASE 
                                        WHEN layanan = 'CVCU [CARDIAC CENTER]' 
                                                AND dokter IN (
                                                    'dr. MUCHTAR NORA ISMAIL SIREGAR Sp.JP.FIHA',
                                                    'dr. MOHAMMAD RIJAL ALAYDRUS Sp.JP',
                                                    'dr. VICKRY H. WAHIDJI Sp.JPK',
                                                    'dr. ABUBAKAR ZUBEIDI Sp.JP'
                                                ) THEN 'intensif'
                                        WHEN layanan IN ('ICU', 'ICU INFEKSIUS') 
                                                AND dokter = 'dr. ROMDON PURWANTO Sp.An-KIC' THEN 'intensif'
                                        WHEN layanan IN ('PICU', 'NICU') 
                                                AND dokter IN (
                                                    'dr. SEFRY M. PANTOW Sp.A',
                                                    'dr. FRISKA HARUN SP.A',
                                                    'dr. MARYANA Sp.A'
                                                ) THEN 'intensif'
                                        ELSE 'biasa'
                                    END) AS ruangan_status
                                FROM data_sim
                                GROUP BY nosep
                            ) AS sub_table ON main_table.nosep = sub_table.nosep
                            SET main_table.ruangan = sub_table.ruangan_status");
        $response[] = ['step' => 7, 'message' => 'Rawat Intensif Dan Biasa Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim
                            SET kd_dpjp = 'dpjp_utama'
                            WHERE EXISTS (
                                SELECT 1
                                FROM klaim
                                WHERE klaim.nosep = data_sim.nosep
                                AND klaim.dokter LIKE CONCAT('%', data_sim.dokter, '%')
                            )
                            AND ruangan != 'intensif'");
        $response[] = ['step' => 8, 'message' => 'Dpjp Utama Like Dari Klaim Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim
                            SET kd_dpjp = CASE
                                WHEN ruangan = 'INTENSIF' 
                                AND layanan = 'CVCU [CARDIAC CENTER]'
                                AND nosep IS NOT NULL 
                                AND dokter IN (
                                    'dr. MUCHTAR NORA ISMAIL SIREGAR Sp.JP.FIHA',
                                    'dr. MOHAMMAD RIJAL ALAYDRUS Sp.JP',
                                    'dr. VICKRY H. WAHIDJI Sp.JPK',
                                    'dr. ABUBAKAR ZUBEIDI Sp.JP'
                                ) THEN 'dpjp_utama'
                                
                                WHEN ruangan = 'INTENSIF' 
                                AND layanan IN ('ICU', 'ICU INFEKSIUS')
                                AND nosep IS NOT NULL 
                                AND dokter = 'dr. ROMDON PURWANTO Sp.An-KIC' THEN 'dpjp_utama'
                                
                                WHEN ruangan = 'INTENSIF' 
                                AND layanan IN ('PICU', 'NICU')
                                AND nosep IS NOT NULL 
                                AND dokter IN (
                                    'dr. SEFRY M. PANTOW Sp.A',
                                    'dr. FRISKA HARUN SP.A',
                                    'dr. MARYANA Sp.A'
                                ) THEN 'dpjp_utama'
                                ELSE kd_dpjp
                            END");
        $response[] = ['step' => 9, 'message' => 'Dpjp Utama Intensif Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim ds
                            JOIN data_dpjp_utama ddu
                            ON ds.nosep = ddu.nosep
                            SET ds.kd_dpjp = 'dpjp_utama'
                            WHERE ds.dokter = ddu.dokter");
        $response[] = ['step' => 10, 'message' => 'Dpjp Utama Setelah Update Intensif Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim
                            SET kd_dpjp = 'dpjp_utama'
                            WHERE kasus = 'bedah tanpa GA'
                            AND ruangan = 'biasa' 
                            AND komponen != 'DR.OPERATOR'
                            AND kd_dpjp NOT IN ('LAB', 'LAB PA', 'FOTO', 'USG', 'RAD KONTRAS', 'CT-SCAN', 'MRI', 'KONSUL');
                            ");

        $response[] = ['step' => 11, 'message' => 'Dpjp Utama Bedah Tanpa GA Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim 
                            SET kd_dpjp = 'dpjp_utama' 
                            WHERE kasus = 'rajal IRD' 
                            AND layanan IN ('IRD', 'IRDA (ANAK)', 'IRDO (OBGYN)')");
        $response[] = ['step' => 12, 'message' => 'Dpjp Utama IRD Rawat Jalan Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim
        SET kd_dpjp = 
            CASE 
                WHEN kasus = 'bedah dengan GA' AND komponen = 'DR.OPERATOR' THEN 'jasa operasi'
                WHEN kasus = 'bedah dengan GA' AND komponen = 'DR.ANESTESI' THEN 'jasa anestesi'
                WHEN kasus = 'bedah tanpa GA' AND komponen = 'DR.OPERATOR' THEN 'jasa operasi'
                ELSE kd_dpjp
            END
        WHERE 
            kasus IN ('bedah dengan GA', 'bedah tanpa GA') 
            AND komponen IN ('DR.OPERATOR', 'DR.ANESTESI')");
        $response[] = ['step' => 13, 'message' => 'Kasus Bedah Berhasil Diperbarui'];
        
        $this->db->query("UPDATE data_sim
                            SET dokter = 'LABORATORIUM'
                            WHERE dokter IN (
                                'dr. METY NITA MOKOGINTA Sp.PK',
                                'dr. NURLIANA IBRAHIM Sp.PK M.Kes',
                                'dr. St. Rahma, M.Kes, Sp.Pk'
                            ) AND layanan = 'LABOLATORIUM'");
        $response[] = ['step' => 14, 'message' => 'Nama Dokter LABORATORIUM Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim
                            SET dokter = 'DR.ANESTESI'
                            WHERE komponen = 'DR.ANESTESI'
                            AND layanan = 'I B S / KAMAR OPERASI'");
        $response[] = ['step' => 15, 'message' => 'Nama Dokter ANESTESI Berhasil Diperbarui'];

        $this->db->query("UPDATE data_sim ds
                            JOIN kasus k ON ds.kasus = k.nama_kasus
                            SET ds.id_kasus = k.id_kasus");
        $response[] = ['step' => 16, 'message' => 'ID Kasus Berhasil Diperbarui'];

        $this->db->query("DELETE FROM data_sim
                            WHERE layanan = 'RADIOLOGI' AND tindakan = 'EXPERTISE DOKTER AHLI'");
        $response[] = ['step' => 17, 'message' => 'Hapus Tindakan EXPERTISE DOKTER AHLI (RADIOLOGI) Berhasil'];

        $this->db->query("UPDATE data_sim
                                SET dokter = 'DOKTER UMUM'
                                WHERE dokter NOT LIKE '%Sp.%' 
                                AND dokter NOT IN ('LABORATORIUM', 'DR.ANESTESI')");
        $response[] = ['step' => 18, 'message' => 'Dokter Umum Berhasil Diperbarui'];
        
        $this->db->query("UPDATE data_sim 
                            SET kd_dpjp = 'dpjp2_dst' 
                            WHERE kd_dpjp IS NULL OR kd_dpjp = '';");
        $response[] = ['step' => 19, 'message' => 'Dpjp2 Dst Berhasil Diperbarui'];

        $this->db->query("INSERT INTO data_fix (nosep, kasus, rawat, nama, dokter, jumlah, kd_dpjp, id_kasus, point_dpjp, jumlah_point_dpjp, jumlah_operator, jumlah_sebelum_dikurangi, kd_peg)
                           SELECT
                                b.nosep,
                                a.kasus,
                                a.ruangan AS rawat,
                                a.nama,
                                a.dokter,
                                b.jumlah,
                                a.kd_dpjp,
                                a.id_kasus,
                                NULL AS point_dpjp,
                                NULL AS jumlah_point_dpjp,
                                NULL AS jumlah_operator,
                                b.jumlah_sebelum_dikurangi,
                                a.kd_peg 
                            FROM
                                data_sim AS a
                                INNER JOIN klaim AS b ON a.nosep = b.nosep
                            GROUP BY
                                b.nosep,
                                a.kasus,
                                a.ruangan,
                                a.nama,
                                a.dokter,
                                b.jumlah,
                                a.kd_dpjp,
                                a.id_kasus,
                                b.jumlah_sebelum_dikurangi,
                                a.kd_peg");

        if ($this->db->affected_rows() > 0) {
            $response[] = ['step' => 20, 'message' => 'Data Untuk Perhitungan Telah Dibuat'];
            } else {
            echo $this->db->error()['message']; 
           }

        
        $this->db->query("UPDATE data_fix
                            SET point_dpjp = CASE 
                                WHEN kd_dpjp = 'dpjp_utama' AND rawat = 'intensif' THEN 3
                                WHEN kd_dpjp = 'dpjp_utama' AND rawat = 'biasa' THEN 2
                                WHEN kd_dpjp = 'dpjp2_dst' THEN 1
                                ELSE 0
                            END");
        $response[] = ['step' => 21, 'message' => 'Point Dpjp Berhasil Diperbarui'];

        $this->db->query("UPDATE data_fix df
                            JOIN (
                                SELECT nosep, COUNT(*) AS total_operator
                                FROM data_fix
                                WHERE kd_dpjp = 'jasa operasi'
                                GROUP BY nosep
                            ) subquery ON df.nosep = subquery.nosep
                            SET df.jumlah_operator = subquery.total_operator");
        $response[] = ['step' => 22, 'message' => 'Jumlah Operator Berhasil Diperbarui'];

        $this->db->query("DELETE FROM data_fix
                            WHERE dokter = 'DOKTER UMUM' 
                            AND nosep IN (SELECT nosep FROM data_rawat_inap)");
        $response[] = ['step' => 23, 'message' => 'Dokter Umum Berhasil Dihapus'];
        
        $this->db->query("UPDATE data_fix df
                                JOIN jumlah_point_dpjp jp ON df.nosep = jp.nosep 
                            SET df.jumlah_point_dpjp = jp.total_point");
        $response[] = ['step' => 24, 'message' => 'Jumlah Point Dpjp Berhasil Diperbarui'];
                                
         // Selesai transaksi
         $this->db->trans_complete();

         if ($this->db->trans_status() === FALSE) {
             echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data!']);
         } else {
             echo json_encode(['status' => 'success', 'steps' => $response]);
         }
    }

    public function clearProses()
    {
        $this->db->trans_start();
        
        $this->db->query("UPDATE klaim SET rajal_ird = NULL");
        $this->db->query("UPDATE data_sim SET ruangan = NULL, kasus = NULL, kd_dpjp = NULL, id_kasus = NULL");
        $this->db->query("DELETE FROM data_fix");
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Proses gagal!',
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'steps' => [
                    ['message' => 'Data klaim telah dibersihkan.'],
                    ['message' => 'Data SIM telah dibersihkan.'],
                    ['message' => 'Data data_fix telah dibersihkan.'],
                ],
            ]);
        }
    }

}