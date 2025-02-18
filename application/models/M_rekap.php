<?php
class M_rekap extends CI_Model
{
    public function getRekap()
    {
        $this->db->select('data_fix.nosep, data_fix.kasus, data_fix.rawat, data_fix.nama as nama_pasien, data_fix.dokter, data_fix.jumlah, data_fix.kd_dpjp');
        $this->db->select('d.dpjp_utama as index_dpjp_utama, d.dpjp2_dst as index_dpjp2_dst');
        $this->db->select('k.dr_spesialis as porsi_dokter');
        $this->db->select($this->hitungPorsiDpjp() . ' AS porsi_dpjp');
        $this->db->select($this->hitungDokterSpesialis() . ' AS dokter_spesialis_final');
        $this->db->select($this->hitungSisaJasa() . ' AS sisa_jasa');
        $this->db->select($this->hitungPenunjang() . ' AS penunjang');
        $this->db->select($this->hitungJasaOperator() . ' AS jasa_operator');
        $this->db->select($this->hitungJasaAnestesi() . ' AS jasa_anestesi');
        $this->db->select($this->hitungJasaDpjpUtama() . ' AS jasa_dpjp_utama');
        $this->db->select($this->hitungJasaDpjp2Dst() . ' AS jasa_dpjp2_dst');
        $this->db->from('data_fix');
        $this->db->join('index_layanan AS i', 'data_fix.kd_dpjp = i.nama', 'left');
        $this->db->join('kasus AS k', 'data_fix.id_kasus = k.id_kasus', 'left');
        $this->db->join('index_dpjp as d', 'data_fix.id_dpjp = d.id_dpjp', 'left');
        return $this->db->get()->result_array();
    }

    public function getRekapByNosep($nosep)
    {
        $this->db->select('data_fix.nosep, data_fix.kasus, data_fix.rawat, data_fix.nama as nama_pasien, data_fix.dokter, data_fix.jumlah, data_fix.kd_dpjp');
        $this->db->select('k.dr_spesialis as porsi_dokter');
        $this->db->select($this->hitungDokterSpesialis() . ' AS dokter_spesialis_final');
        $this->db->select($this->hitungPenunjang() . ' AS penunjang');
        $this->db->select($this->hitungPenunjang2() . ' AS penunjang2');
        $this->db->select($this->hitungSisaJasa() . ' AS sisa_jasa');
        $this->db->select($this->hitungJasaOperator() . ' AS jasa_operator');
        $this->db->select($this->hitungJasaOperator2() . ' AS jasa_operator2');
        $this->db->select($this->hitungJasaAnestesi() . ' AS jasa_anestesi');
        $this->db->select($this->hitungJasaAnestesi2() . ' AS jasa_anestesi2');
        $this->db->select($this->hitungPorsiDpjp() . ' AS porsi_dpjp');
        $this->db->select('d.dpjp_utama as index_dpjp_utama, d.dpjp2_dst as index_dpjp2_dst');
        $this->db->select($this->hitungJasaDpjpUtama() . ' AS jasa_dpjp_utama');
        $this->db->select($this->hitungJasaDpjpUtama2() . ' AS jasa_dpjp_utama2');
        $this->db->select($this->hitungJasaDpjp2Dst() . ' AS jasa_dpjp2_dst');
        $this->db->select($this->hitungJasaDpjp2Dst2() . ' AS jasa_dpjp2_dst2');
        $this->db->from('data_fix');
        $this->db->join('index_layanan AS i', 'data_fix.kd_dpjp = i.nama', 'left');
        $this->db->join('kasus AS k', 'data_fix.id_kasus = k.id_kasus', 'left');
        $this->db->join('index_dpjp as d', 'data_fix.id_dpjp = d.id_dpjp', 'left');
        $this->db->where('data_fix.nosep', $nosep);
        return $this->db->get()->result_array();
    }
    public function getRekapByDokter($dokter)
    {
        $this->db->select('data_fix.nosep, data_fix.kasus, data_fix.rawat, data_fix.nama as nama_pasien, data_fix.dokter, data_fix.jumlah, data_fix.kd_dpjp');
        $this->db->select($this->hitungDokterSpesialis() . ' AS dokter_spesialis_final');
        $this->db->select($this->hitungPenunjang() . ' AS penunjang');
        $this->db->select($this->hitungPenunjang2() . ' AS penunjang2');
        $this->db->select($this->hitungSisaJasa() . ' AS sisa_jasa');
        $this->db->select($this->hitungJasaOperator() . ' AS jasa_operator');
        $this->db->select($this->hitungJasaOperator2() . ' AS jasa_operator2');
        $this->db->select($this->hitungJasaAnestesi() . ' AS jasa_anestesi');
        $this->db->select($this->hitungJasaAnestesi2() . ' AS jasa_anestesi2');
        $this->db->select($this->hitungPorsiDpjp() . ' AS porsi_dpjp');
        $this->db->select('d.dpjp_utama as index_dpjp_utama, d.dpjp2_dst as index_dpjp2_dst');
        $this->db->select($this->hitungJasaDpjpUtama() . ' AS jasa_dpjp_utama');
        $this->db->select($this->hitungJasaDpjpUtama2() . ' AS jasa_dpjp_utama2');
        $this->db->select($this->hitungJasaDpjp2Dst() . ' AS jasa_dpjp2_dst');
        $this->db->select($this->hitungJasaDpjp2Dst2() . ' AS jasa_dpjp2_dst2');
        
        $this->db->from('data_fix');
        $this->db->join('index_layanan AS i', 'data_fix.kd_dpjp = i.nama', 'left');
        $this->db->join('kasus AS k', 'data_fix.id_kasus = k.id_kasus', 'left');
        $this->db->join('index_dpjp as d', 'data_fix.id_dpjp = d.id_dpjp', 'left');
        $this->db->where('data_fix.dokter', $dokter);
        return $this->db->get()->result_array();
    }

    public function rekapDokter()
    {
        $this->db->select('data_fix.dokter');
        $this->db->select('SUM(CASE WHEN data_fix.kd_dpjp = "LAB" OR data_fix.kd_dpjp = "LAB PA" OR data_fix.kd_dpjp = "FOTO" OR data_fix.kd_dpjp = "USG" OR data_fix.kd_dpjp = "RAD KONTRAS" OR data_fix.kd_dpjp = "CT - SCAN" OR data_fix.kd_dpjp = "MRI" OR data_fix.kd_dpjp = "KONSUL" THEN ' . $this->hitungPenunjang() . ' ELSE 0 END) +
                    SUM(CASE WHEN data_fix.kd_dpjp = "jasa operasi" THEN ' . $this->hitungJasaOperator() . ' ELSE 0 END) +
                    SUM(CASE WHEN data_fix.kd_dpjp = "jasa anestesi" THEN ' . $this->hitungJasaAnestesi() . ' ELSE 0 END) +
                    SUM(CASE WHEN data_fix.kd_dpjp = "dpjp_utama" THEN ' . $this->hitungJasaDpjpUtama() . ' ELSE 0 END) +
                    SUM(CASE WHEN data_fix.kd_dpjp = "dpjp2_dst" THEN ' . $this->hitungJasaDpjp2Dst() . ' ELSE 0 END) AS total_jasa');
        $this->db->select('SUM(CASE WHEN data_fix.kd_dpjp = "LAB" OR data_fix.kd_dpjp = "LAB PA" OR data_fix.kd_dpjp = "FOTO" OR data_fix.kd_dpjp = "USG" OR data_fix.kd_dpjp = "RAD KONTRAS" OR data_fix.kd_dpjp = "CT - SCAN" OR data_fix.kd_dpjp = "MRI" OR data_fix.kd_dpjp = "KONSUL" THEN ' . $this->hitungPenunjang2() . ' ELSE 0 END) +
                    SUM(CASE WHEN data_fix.kd_dpjp = "jasa operasi" THEN ' . $this->hitungJasaOperator2() . ' ELSE 0 END) +
                    SUM(CASE WHEN data_fix.kd_dpjp = "jasa anestesi" THEN ' . $this->hitungJasaAnestesi2() . ' ELSE 0 END) +
                    SUM(CASE WHEN data_fix.kd_dpjp = "dpjp_utama" THEN ' . $this->hitungJasaDpjpUtama2() . ' ELSE 0 END) +
                    SUM(CASE WHEN data_fix.kd_dpjp = "dpjp2_dst" THEN ' . $this->hitungJasaDpjp2Dst2() . ' ELSE 0 END) AS jasa_belum_dikurangi');
        $this->db->from('data_fix');
        $this->db->join('index_layanan AS i', 'data_fix.kd_dpjp = i.nama', 'left');
        $this->db->join('kasus AS k', 'data_fix.id_kasus = k.id_kasus', 'left');
        $this->db->join('index_dpjp as d', 'data_fix.id_dpjp = d.id_dpjp', 'left');
        $role = $this->session->userdata('role');
        $username = $this->session->userdata('username');

        if ($role == 2) {
            if ($username == "PEG029") {
                $this->db->where_in('data_fix.kd_peg', ['PEG029', 'PEGANES']);
            } elseif ($username == "PEG1602") {
                $this->db->where('data_fix.kd_peg', 'PEGANES');
            } elseif ($username == "PEG088") {
                $this->db->where('data_fix.kd_peg', 'PEGANES');
            } elseif ($username == "PEG154") {
                $this->db->where('data_fix.kd_peg', 'PEGANES');
            } elseif ($username == "PEG1802") {
                $this->db->where('data_fix.kd_peg', 'PEGLAB');
            } elseif ($username == "PEG037") {
                $this->db->where('data_fix.kd_peg', 'PEGLAB');
            } elseif ($username == "PEG045") {
                $this->db->where('data_fix.kd_peg', 'PEGLAB');
            } else {
                $this->db->where('data_fix.kd_peg', $username);
            }
        }
        $this->db->group_by('data_fix.dokter');
        $this->db->order_by('total_jasa', 'DESC');

        return $this->db->get()->result_array();
        }


    private function hitungDokterSpesialis()
    {
        return '((data_fix.jumlah * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100))';
    }

    private function hitungPenunjang()
    {
        return '((data_fix.jumlah * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100) * (COALESCE(i.presentase, 0)/100))';
    }
    private function hitungPenunjang2()
    {
        return '((data_fix.jumlah_sebelum_dikurangi * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100) * (COALESCE(i.presentase, 0)/100))';
    }

    private function hitungSisaJasa()
    {
        return '((data_fix.jumlah * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100) 
                 - 
                 (SELECT SUM((data_fix.jumlah * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100) * (COALESCE(i.presentase, 0)/100)) 
                  FROM data_fix AS df 
                  LEFT JOIN index_layanan AS i ON df.kd_dpjp = i.nama 
                  LEFT JOIN kasus AS k ON df.id_kasus = k.id_kasus 
                  WHERE df.nosep = data_fix.nosep))';
    }
    private function hitungSisaJasa2()
    {
        return '((data_fix.jumlah_sebelum_dikurangi * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100) 
                 - 
                 (SELECT SUM((data_fix.jumlah_sebelum_dikurangi * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100) * (COALESCE(i.presentase, 0)/100)) 
                  FROM data_fix AS df 
                  LEFT JOIN index_layanan AS i ON df.kd_dpjp = i.nama 
                  LEFT JOIN kasus AS k ON df.id_kasus = k.id_kasus 
                  WHERE df.nosep = data_fix.nosep))';
    }

    private function hitungJasaOperator()
    {
        return '(CASE 
        WHEN data_fix.kasus = "bedah tanpa GA" 
             AND data_fix.rawat = "biasa" 
             AND data_fix.kd_dpjp = "jasa operasi"
        THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_biasa/100, 0))

        WHEN data_fix.kasus = "bedah tanpa GA" 
             AND data_fix.rawat = "intensif" 
             AND data_fix.kd_dpjp = "jasa operasi"
        THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_intensif/100, 0))
        
        WHEN data_fix.kasus = "bedah dengan GA" 
             AND data_fix.rawat = "biasa" 
             AND data_fix.kd_dpjp = "jasa operasi"
        THEN (
            CASE 
                WHEN data_fix.kd_dpjp = "jasa operasi" AND data_fix.rawat = "biasa" THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_biasa/100, 0) * 
                    CASE 
                        WHEN data_fix.jumlah_operator = 1 THEN (2/3)
                        WHEN data_fix.jumlah_operator = 2 THEN (2/5)
                        WHEN data_fix.jumlah_operator = 3 THEN (2/7)
                        ELSE 0
                    END)
                ELSE 0
            END
        )
        WHEN data_fix.kasus = "bedah dengan GA" 
             AND data_fix.rawat = "intensif" 
             AND data_fix.kd_dpjp = "jasa operasi"
        THEN (
            CASE 
                WHEN data_fix.kd_dpjp = "jasa operasi" AND data_fix.rawat = "intensif" THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_intensif/100, 0) * 
                    CASE 
                        WHEN data_fix.jumlah_operator = 1 THEN (2/3)
                        WHEN data_fix.jumlah_operator = 2 THEN (2/5)
                        WHEN data_fix.jumlah_operator = 3 THEN (2/7)
                        ELSE 0
                    END)
                ELSE 0
            END
        )
        
        ELSE 0 
        END)';
    }
    private function hitungJasaOperator2()
    {
        return '(CASE 
        WHEN data_fix.kasus = "bedah tanpa GA" 
             AND data_fix.rawat = "biasa" 
             AND data_fix.kd_dpjp = "jasa operasi"
        THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_biasa/100, 0))

        WHEN data_fix.kasus = "bedah tanpa GA" 
             AND data_fix.rawat = "intensif" 
             AND data_fix.kd_dpjp = "jasa operasi"
        THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_intensif/100, 0))
        
        WHEN data_fix.kasus = "bedah dengan GA" 
             AND data_fix.rawat = "biasa" 
             AND data_fix.kd_dpjp = "jasa operasi"
        THEN (
            CASE 
                WHEN data_fix.kd_dpjp = "jasa operasi" AND data_fix.rawat = "biasa" THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_biasa/100, 0) * 
                    CASE 
                        WHEN data_fix.jumlah_operator = 1 THEN (2/3)
                        WHEN data_fix.jumlah_operator = 2 THEN (2/5)
                        WHEN data_fix.jumlah_operator = 3 THEN (2/7)
                        ELSE 0
                    END)
                ELSE 0
            END
        )
        WHEN data_fix.kasus = "bedah dengan GA" 
             AND data_fix.rawat = "intensif" 
             AND data_fix.kd_dpjp = "jasa operasi"
        THEN (
            CASE 
                WHEN data_fix.kd_dpjp = "jasa operasi" AND data_fix.rawat = "intensif" THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_intensif/100, 0) * 
                    CASE 
                        WHEN data_fix.jumlah_operator = 1 THEN (2/3)
                        WHEN data_fix.jumlah_operator = 2 THEN (2/5)
                        WHEN data_fix.jumlah_operator = 3 THEN (2/7)
                        ELSE 0
                    END)
                ELSE 0
            END
        )
        
        ELSE 0 
        END)';
    }

    private function hitungJasaAnestesi()
    {
        
        return '(CASE 
        WHEN data_fix.kasus = "bedah tanpa GA" 
             AND data_fix.rawat = "biasa" 
             AND data_fix.kd_dpjp = "jasa anestesi"
        THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_biasa/100, 0))

        WHEN data_fix.kasus = "bedah tanpa GA" 
             AND data_fix.rawat = "intensif" 
             AND data_fix.kd_dpjp = "jasa anestesi"
        THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_intensif/100, 0))
        
        WHEN data_fix.kasus = "bedah dengan GA" 
             AND data_fix.rawat = "biasa" 
             AND data_fix.kd_dpjp = "jasa anestesi"
        THEN (
            CASE 
                WHEN data_fix.kd_dpjp = "jasa anestesi" AND data_fix.rawat = "biasa" THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_biasa/100, 0) * 
                    CASE 
                        WHEN data_fix.jumlah_operator = 1 THEN (1/3)
                        WHEN data_fix.jumlah_operator = 2 THEN (1/5)
                        WHEN data_fix.jumlah_operator = 3 THEN (1/7)
                        ELSE 0
                    END)
                ELSE 0
            END
        )
        WHEN data_fix.kasus = "bedah dengan GA" 
             AND data_fix.rawat = "intensif" 
             AND data_fix.kd_dpjp = "jasa anestesi"
        THEN (
            CASE 
                WHEN data_fix.kd_dpjp = "jasa anestesi" AND data_fix.rawat = "intensif" THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_intensif/100, 0) * 
                    CASE 
                        WHEN data_fix.jumlah_operator = 1 THEN (1/3)
                        WHEN data_fix.jumlah_operator = 2 THEN (1/5)
                        WHEN data_fix.jumlah_operator = 3 THEN (1/7)
                        ELSE 0
                    END)
                ELSE 0
            END
        )
        
        ELSE 0 
        END)';
    }
    private function hitungJasaAnestesi2()
    {
        
        return '(CASE 
        WHEN data_fix.kasus = "bedah tanpa GA" 
             AND data_fix.rawat = "biasa" 
             AND data_fix.kd_dpjp = "jasa anestesi"
        THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_biasa/100, 0))

        WHEN data_fix.kasus = "bedah tanpa GA" 
             AND data_fix.rawat = "intensif" 
             AND data_fix.kd_dpjp = "jasa anestesi"
        THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_intensif/100, 0))
        
        WHEN data_fix.kasus = "bedah dengan GA" 
             AND data_fix.rawat = "biasa" 
             AND data_fix.kd_dpjp = "jasa anestesi"
        THEN (
            CASE 
                WHEN data_fix.kd_dpjp = "jasa anestesi" AND data_fix.rawat = "biasa" THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_biasa/100, 0) * 
                    CASE 
                        WHEN data_fix.jumlah_operator = 1 THEN (1/3)
                        WHEN data_fix.jumlah_operator = 2 THEN (1/5)
                        WHEN data_fix.jumlah_operator = 3 THEN (1/7)
                        ELSE 0
                    END)
                ELSE 0
            END
        )
        WHEN data_fix.kasus = "bedah dengan GA" 
             AND data_fix.rawat = "intensif" 
             AND data_fix.kd_dpjp = "jasa anestesi"
        THEN (
            CASE 
                WHEN data_fix.kd_dpjp = "jasa anestesi" AND data_fix.rawat = "intensif" THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_intensif/100, 0) * 
                    CASE 
                        WHEN data_fix.jumlah_operator = 1 THEN (1/3)
                        WHEN data_fix.jumlah_operator = 2 THEN (1/5)
                        WHEN data_fix.jumlah_operator = 3 THEN (1/7)
                        ELSE 0
                    END)
                ELSE 0
            END
        )
        
        ELSE 0 
        END)';
    }

    private function hitungPorsiDpjp()
    {
        return '(CASE 
            WHEN data_fix.kasus IN ("bedah dengan GA", "bedah tanpa GA") AND data_fix.rawat = "intensif" 
            THEN (100 - 30)
            WHEN data_fix.kasus IN ("bedah dengan GA", "bedah tanpa GA") AND data_fix.rawat = "biasa" 
            THEN (100 - 70)
            ELSE 100 END)';
    }

    private function hitungJasaDpjpUtama()
    {
        return '(
            CASE 
                WHEN data_fix.kd_dpjp = "dpjp_utama" 
                THEN ' . $this->hitungSisaJasa() . ' * (' . $this->hitungPorsiDpjp() . ' / 100) * (data_fix.point_dpjp / data_fix.jumlah_point_dpjp) 
                ELSE 0 
            END
        )';
    }
    private function hitungJasaDpjpUtama2()
    {
        return '(
            CASE 
                WHEN data_fix.kd_dpjp = "dpjp_utama" 
                THEN ' . $this->hitungSisaJasa2() . ' * (' . $this->hitungPorsiDpjp() . ' / 100) * (data_fix.point_dpjp / data_fix.jumlah_point_dpjp) 
                ELSE 0 
            END
        )';
    }

    private function hitungJasaDpjp2Dst()
    {
        return '(
            CASE 
                WHEN data_fix.kd_dpjp = "dpjp2_dst" 
                THEN ' . $this->hitungSisaJasa() . ' * (' . $this->hitungPorsiDpjp() . ' / 100) * (data_fix.point_dpjp / data_fix.jumlah_point_dpjp) 
                ELSE 0 
            END
        )';
    }
    private function hitungJasaDpjp2Dst2()
    {
        return '(
            CASE 
                WHEN data_fix.kd_dpjp = "dpjp2_dst" 
                THEN ' . $this->hitungSisaJasa2() . ' * (' . $this->hitungPorsiDpjp() . ' / 100) * (data_fix.point_dpjp / data_fix.jumlah_point_dpjp) 
                ELSE 0 
            END
        )';
    }

    public function getRekapSemua()
    {
        return $this->db->query("SELECT DISTINCT
                                    a.nosep,
                                    a.kasus,
                                    a.rawat,
                                    a.nama,
                                    a.jumlah,
                                    (a.jumlah * 0.65) AS sarana,
                                    (a.jumlah * 0.45 * b.admin/100) AS admin,
                                    (a.jumlah * 0.45 * b.dr_umum/100) AS dokter_umum,
                                    (a.jumlah * 0.45 * b.spesialis_paramedis/100 * b.paramedis/100) AS paramedis,
                                    (a.jumlah * 0.45 * b.spesialis_paramedis/100 * b.dr_spesialis/100) AS dokter_spesialis
                                    FROM
                                    data_fix AS a
                                    LEFT JOIN kasus AS b ON a.id_kasus = b.id_kasus"
                                )->result_array();
    }

}