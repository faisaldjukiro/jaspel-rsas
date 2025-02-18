<?php
class M_hasil extends CI_Model
{
    // public function getRekap()
    // {
    //     $this->db->select('data_fix_riwayat.nosep, data_fix_riwayat.kasus, data_fix_riwayat.rawat, data_fix_riwayat.nama as nama_pasien, data_fix_riwayat.dokter, data_fix_riwayat.jumlah, data_fix_riwayat.kd_dpjp');
    //     $this->db->select('d.dpjp_utama as index_dpjp_utama, d.dpjp2_dst as index_dpjp2_dst');
    //     $this->db->select('k.dr_spesialis as porsi_dokter');
    //     $this->db->select($this->hitungPorsiDpjp() . ' AS porsi_dpjp');
    //     $this->db->select($this->hitungDokterSpesialis() . ' AS dokter_spesialis_final');
    //     $this->db->select($this->hitungSisaJasa() . ' AS sisa_jasa');
    //     $this->db->select($this->hitungPenunjang() . ' AS penunjang');
    //     $this->db->select($this->hitungJasaOperator() . ' AS jasa_operator');
    //     $this->db->select($this->hitungJasaAnestesi() . ' AS jasa_anestesi');
    //     $this->db->select($this->hitungJasaDpjpUtama() . ' AS jasa_dpjp_utama');
    //     $this->db->select($this->hitungJasaDpjp2Dst() . ' AS jasa_dpjp2_dst');
    //     $this->db->from('data_fix_riwayat');
    //     $this->db->join('index_layanan AS i', 'data_fix_riwayat.kd_dpjp = i.nama', 'left');
    //     $this->db->join('kasus AS k', 'data_fix_riwayat.id_kasus = k.id_kasus', 'left');
    //     $this->db->join('index_dpjp as d', 'data_fix_riwayat.id_dpjp = d.id_dpjp', 'left');
    //     return $this->db->get()->result_array();
    // }

    public function getRekapByNosep($nosep,$jenis_jasa,$bulan)
    {
        $this->db->select('data_fix_riwayat.nosep, data_fix_riwayat.kasus, data_fix_riwayat.rawat, data_fix_riwayat.nama as nama_pasien, data_fix_riwayat.dokter, data_fix_riwayat.jumlah, data_fix_riwayat.kd_dpjp, data_fix_riwayat.bulan,data_fix_riwayat.jenis_jasa');
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
        $this->db->from('data_fix_riwayat');
        $this->db->join('index_layanan AS i', 'data_fix_riwayat.kd_dpjp = i.nama', 'left');
        $this->db->join('kasus AS k', 'data_fix_riwayat.id_kasus = k.id_kasus', 'left');
        $this->db->join('index_dpjp as d', 'data_fix_riwayat.id_dpjp = d.id_dpjp', 'left');
        $this->db->where('data_fix_riwayat.nosep', $nosep);
        $this->db->where('data_fix_riwayat.jenis_jasa',$jenis_jasa);
        $this->db->where('data_fix_riwayat.bulan',$bulan);
        return $this->db->get()->result_array();
    }
    public function getRekapByDokter($kd_peg,$jenis_jasa,$bulan)
    {
        $this->db->select('data_fix_riwayat.nosep, data_fix_riwayat.kasus, data_fix_riwayat.rawat, data_fix_riwayat.nama as nama_pasien, data_fix_riwayat.dokter, data_fix_riwayat.jumlah, data_fix_riwayat.kd_dpjp, data_fix_riwayat.bulan,data_fix_riwayat.jenis_jasa');
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
        $this->db->from('data_fix_riwayat');
        $this->db->join('index_layanan AS i', 'data_fix_riwayat.kd_dpjp = i.nama', 'left');
        $this->db->join('kasus AS k', 'data_fix_riwayat.id_kasus = k.id_kasus', 'left');
        $this->db->join('index_dpjp as d', 'data_fix_riwayat.id_dpjp = d.id_dpjp', 'left');
        $this->db->where('data_fix_riwayat.kd_peg', $kd_peg);
        $this->db->where('data_fix_riwayat.jenis_jasa',$jenis_jasa);
        $this->db->where('data_fix_riwayat.bulan',$bulan);
        return $this->db->get()->result_array();
    }

    // public function rekapDokter()
    // {
    //     $this->db->select('data_fix_riwayat.dokter');
    //     $this->db->select('SUM(CASE WHEN data_fix_riwayat.kd_dpjp = "LAB" OR data_fix_riwayat.kd_dpjp = "LAB PA" OR data_fix_riwayat.kd_dpjp = "FOTO" OR data_fix_riwayat.kd_dpjp = "USG" OR data_fix_riwayat.kd_dpjp = "RAD KONTRAS" OR data_fix_riwayat.kd_dpjp = "CT - SCAN" OR data_fix_riwayat.kd_dpjp = "MRI" OR data_fix_riwayat.kd_dpjp = "KONSUL" THEN ' . $this->hitungPenunjang() . ' ELSE 0 END) +
    //                 SUM(CASE WHEN data_fix_riwayat.kd_dpjp = "jasa operasi" THEN ' . $this->hitungJasaOperator() . ' ELSE 0 END) +
    //                 SUM(CASE WHEN data_fix_riwayat.kd_dpjp = "jasa anestesi" THEN ' . $this->hitungJasaAnestesi() . ' ELSE 0 END) +
    //                 SUM(CASE WHEN data_fix_riwayat.kd_dpjp = "dpjp_utama" THEN ' . $this->hitungJasaDpjpUtama() . ' ELSE 0 END) +
    //                 SUM(CASE WHEN data_fix_riwayat.kd_dpjp = "dpjp2_dst" THEN ' . $this->hitungJasaDpjp2Dst() . ' ELSE 0 END) AS total_jasa');
    //     $this->db->from('data_fix_riwayat');
    //     $this->db->join('index_layanan AS i', 'data_fix_riwayat.kd_dpjp = i.nama', 'left');
    //     $this->db->join('kasus AS k', 'data_fix_riwayat.id_kasus = k.id_kasus', 'left');
    //     $this->db->join('index_dpjp as d', 'data_fix_riwayat.id_dpjp = d.id_dpjp', 'left');
    //     $this->db->group_by('data_fix_riwayat.dokter');
    //     $this->db->order_by('total_jasa', 'DESC');

    //     return $this->db->get()->result_array();
    // }


    private function hitungDokterSpesialis()
    {
        return '((data_fix_riwayat.jumlah * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100))';
    }
    private function hitungDokterSpesialis2()
    {
        return '((data_fix_riwayat.jumlah_sebelum_dikurangi * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100))';
    }

    private function hitungPenunjang()
    {
        return '((data_fix_riwayat.jumlah * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100) * (COALESCE(i.presentase, 0)/100))';
    }
    private function hitungPenunjang2()
    {
        return '((data_fix_riwayat.jumlah_sebelum_dikurangi * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100) * (COALESCE(i.presentase, 0)/100))';
    }

    private function hitungSisaJasa()
    {
        return '((data_fix_riwayat.jumlah * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100) 
                 - 
                 (SELECT SUM((data_fix_riwayat.jumlah * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100) * (COALESCE(i.presentase, 0)/100)) 
                  FROM data_fix_riwayat AS df 
                  LEFT JOIN index_layanan AS i ON df.kd_dpjp = i.nama 
                  LEFT JOIN kasus AS k ON df.id_kasus = k.id_kasus 
                  WHERE df.nosep = data_fix_riwayat.nosep))';
    }
    private function hitungSisaJasa2()
    {
        return '((data_fix_riwayat.jumlah_sebelum_dikurangi * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100) 
                 - 
                 (SELECT SUM((data_fix_riwayat.jumlah_sebelum_dikurangi * 0.45) * (k.spesialis_paramedis/100) * (k.dr_spesialis/100) * (COALESCE(i.presentase, 0)/100)) 
                  FROM data_fix_riwayat AS df 
                  LEFT JOIN index_layanan AS i ON df.kd_dpjp = i.nama 
                  LEFT JOIN kasus AS k ON df.id_kasus = k.id_kasus 
                  WHERE df.nosep = data_fix_riwayat.nosep))';
    }

    private function hitungJasaOperator()
    {
        return '(CASE 
        WHEN data_fix_riwayat.kasus = "bedah tanpa GA" 
             AND data_fix_riwayat.rawat = "biasa" 
             AND data_fix_riwayat.kd_dpjp = "jasa operasi"
        THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_biasa/100, 0))

        WHEN data_fix_riwayat.kasus = "bedah tanpa GA" 
             AND data_fix_riwayat.rawat = "intensif" 
             AND data_fix_riwayat.kd_dpjp = "jasa operasi"
        THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_intensif/100, 0))
        
        WHEN data_fix_riwayat.kasus = "bedah dengan GA" 
             AND data_fix_riwayat.rawat = "biasa" 
             AND data_fix_riwayat.kd_dpjp = "jasa operasi"
        THEN (
            CASE 
                WHEN data_fix_riwayat.kd_dpjp = "jasa operasi" AND data_fix_riwayat.rawat = "biasa" THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_biasa/100, 0) * 
                    CASE 
                        WHEN data_fix_riwayat.jumlah_operator = 1 THEN (2/3)
                        WHEN data_fix_riwayat.jumlah_operator = 2 THEN (2/5)
                        WHEN data_fix_riwayat.jumlah_operator = 3 THEN (2/7)
                        ELSE 0
                    END)
                ELSE 0
            END
        )
        WHEN data_fix_riwayat.kasus = "bedah dengan GA" 
             AND data_fix_riwayat.rawat = "intensif" 
             AND data_fix_riwayat.kd_dpjp = "jasa operasi"
        THEN (
            CASE 
                WHEN data_fix_riwayat.kd_dpjp = "jasa operasi" AND data_fix_riwayat.rawat = "intensif" THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_intensif/100, 0) * 
                    CASE 
                        WHEN data_fix_riwayat.jumlah_operator = 1 THEN (2/3)
                        WHEN data_fix_riwayat.jumlah_operator = 2 THEN (2/5)
                        WHEN data_fix_riwayat.jumlah_operator = 3 THEN (2/7)
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
        WHEN data_fix_riwayat.kasus = "bedah tanpa GA" 
             AND data_fix_riwayat.rawat = "biasa" 
             AND data_fix_riwayat.kd_dpjp = "jasa operasi"
        THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_biasa/100, 0))

        WHEN data_fix_riwayat.kasus = "bedah tanpa GA" 
             AND data_fix_riwayat.rawat = "intensif" 
             AND data_fix_riwayat.kd_dpjp = "jasa operasi"
        THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_intensif/100, 0))
        
        WHEN data_fix_riwayat.kasus = "bedah dengan GA" 
             AND data_fix_riwayat.rawat = "biasa" 
             AND data_fix_riwayat.kd_dpjp = "jasa operasi"
        THEN (
            CASE 
                WHEN data_fix_riwayat.kd_dpjp = "jasa operasi" AND data_fix_riwayat.rawat = "biasa" THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_biasa/100, 0) * 
                    CASE 
                        WHEN data_fix_riwayat.jumlah_operator = 1 THEN (2/3)
                        WHEN data_fix_riwayat.jumlah_operator = 2 THEN (2/5)
                        WHEN data_fix_riwayat.jumlah_operator = 3 THEN (2/7)
                        ELSE 0
                    END)
                ELSE 0
            END
        )
        WHEN data_fix_riwayat.kasus = "bedah dengan GA" 
             AND data_fix_riwayat.rawat = "intensif" 
             AND data_fix_riwayat.kd_dpjp = "jasa operasi"
        THEN (
            CASE 
                WHEN data_fix_riwayat.kd_dpjp = "jasa operasi" AND data_fix_riwayat.rawat = "intensif" THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_intensif/100, 0) * 
                    CASE 
                        WHEN data_fix_riwayat.jumlah_operator = 1 THEN (2/3)
                        WHEN data_fix_riwayat.jumlah_operator = 2 THEN (2/5)
                        WHEN data_fix_riwayat.jumlah_operator = 3 THEN (2/7)
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
        WHEN data_fix_riwayat.kasus = "bedah tanpa GA" 
             AND data_fix_riwayat.rawat = "biasa" 
             AND data_fix_riwayat.kd_dpjp = "jasa anestesi"
        THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_biasa/100, 0))

        WHEN data_fix_riwayat.kasus = "bedah tanpa GA" 
             AND data_fix_riwayat.rawat = "intensif" 
             AND data_fix_riwayat.kd_dpjp = "jasa anestesi"
        THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_intensif/100, 0))
        
        WHEN data_fix_riwayat.kasus = "bedah dengan GA" 
             AND data_fix_riwayat.rawat = "biasa" 
             AND data_fix_riwayat.kd_dpjp = "jasa anestesi"
        THEN (
            CASE 
                WHEN data_fix_riwayat.kd_dpjp = "jasa anestesi" AND data_fix_riwayat.rawat = "biasa" THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_biasa/100, 0) * 
                    CASE 
                        WHEN data_fix_riwayat.jumlah_operator = 1 THEN (1/3)
                        WHEN data_fix_riwayat.jumlah_operator = 2 THEN (1/5)
                        WHEN data_fix_riwayat.jumlah_operator = 3 THEN (1/7)
                        ELSE 0
                    END)
                ELSE 0
            END
        )
        WHEN data_fix_riwayat.kasus = "bedah dengan GA" 
             AND data_fix_riwayat.rawat = "intensif" 
             AND data_fix_riwayat.kd_dpjp = "jasa anestesi"
        THEN (
            CASE 
                WHEN data_fix_riwayat.kd_dpjp = "jasa anestesi" AND data_fix_riwayat.rawat = "intensif" THEN (' . $this->hitungSisaJasa() . ' * COALESCE(k.ok_intensif/100, 0) * 
                    CASE 
                        WHEN data_fix_riwayat.jumlah_operator = 1 THEN (1/3)
                        WHEN data_fix_riwayat.jumlah_operator = 2 THEN (1/5)
                        WHEN data_fix_riwayat.jumlah_operator = 3 THEN (1/7)
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
        WHEN data_fix_riwayat.kasus = "bedah tanpa GA" 
             AND data_fix_riwayat.rawat = "biasa" 
             AND data_fix_riwayat.kd_dpjp = "jasa anestesi"
        THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_biasa/100, 0))

        WHEN data_fix_riwayat.kasus = "bedah tanpa GA" 
             AND data_fix_riwayat.rawat = "intensif" 
             AND data_fix_riwayat.kd_dpjp = "jasa anestesi"
        THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_intensif/100, 0))
        
        WHEN data_fix_riwayat.kasus = "bedah dengan GA" 
             AND data_fix_riwayat.rawat = "biasa" 
             AND data_fix_riwayat.kd_dpjp = "jasa anestesi"
        THEN (
            CASE 
                WHEN data_fix_riwayat.kd_dpjp = "jasa anestesi" AND data_fix_riwayat.rawat = "biasa" THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_biasa/100, 0) * 
                    CASE 
                        WHEN data_fix_riwayat.jumlah_operator = 1 THEN (1/3)
                        WHEN data_fix_riwayat.jumlah_operator = 2 THEN (1/5)
                        WHEN data_fix_riwayat.jumlah_operator = 3 THEN (1/7)
                        ELSE 0
                    END)
                ELSE 0
            END
        )
        WHEN data_fix_riwayat.kasus = "bedah dengan GA" 
             AND data_fix_riwayat.rawat = "intensif" 
             AND data_fix_riwayat.kd_dpjp = "jasa anestesi"
        THEN (
            CASE 
                WHEN data_fix_riwayat.kd_dpjp = "jasa anestesi" AND data_fix_riwayat.rawat = "intensif" THEN (' . $this->hitungSisaJasa2() . ' * COALESCE(k.ok_intensif/100, 0) * 
                    CASE 
                        WHEN data_fix_riwayat.jumlah_operator = 1 THEN (1/3)
                        WHEN data_fix_riwayat.jumlah_operator = 2 THEN (1/5)
                        WHEN data_fix_riwayat.jumlah_operator = 3 THEN (1/7)
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
            WHEN data_fix_riwayat.kasus IN ("bedah dengan GA", "bedah tanpa GA") AND data_fix_riwayat.rawat = "intensif" 
            THEN (100 - 30)
            WHEN data_fix_riwayat.kasus IN ("bedah dengan GA", "bedah tanpa GA") AND data_fix_riwayat.rawat = "biasa" 
            THEN (100 - 70)
            ELSE 100 END)';
    }

    private function hitungJasaDpjpUtama()
    {
        return '(
            CASE 
                WHEN data_fix_riwayat.kd_dpjp = "dpjp_utama" 
                THEN ' . $this->hitungSisaJasa() . ' * (' . $this->hitungPorsiDpjp() . ' / 100) * (data_fix_riwayat.point_dpjp / data_fix_riwayat.jumlah_point_dpjp) 
                ELSE 0 
            END
        )';
    }
    private function hitungJasaDpjpUtama2()
    {
        return '(
            CASE 
                WHEN data_fix_riwayat.kd_dpjp = "dpjp_utama" 
                THEN ' . $this->hitungSisaJasa2() . ' * (' . $this->hitungPorsiDpjp() . ' / 100) * (data_fix_riwayat.point_dpjp / data_fix_riwayat.jumlah_point_dpjp) 
                ELSE 0 
            END
        )';
    }


    private function hitungJasaDpjp2Dst()
    {
        return '(
            CASE 
                WHEN data_fix_riwayat.kd_dpjp = "dpjp2_dst" 
                THEN ' . $this->hitungSisaJasa() . ' * (' . $this->hitungPorsiDpjp() . ' / 100) * (data_fix_riwayat.point_dpjp / data_fix_riwayat.jumlah_point_dpjp) 
                ELSE 0 
            END
        )';
    }
    private function hitungJasaDpjp2Dst2()
    {
        return '(
            CASE 
                WHEN data_fix_riwayat.kd_dpjp = "dpjp2_dst" 
                THEN ' . $this->hitungSisaJasa2() . ' * (' . $this->hitungPorsiDpjp() . ' / 100) * (data_fix_riwayat.point_dpjp / data_fix_riwayat.jumlah_point_dpjp) 
                ELSE 0 
            END
        )';
    }

    

}