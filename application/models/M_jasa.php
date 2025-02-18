<?php
class M_jasa extends CI_Model
{
    public function getDatakosong()
    {
        $data = $this->db->query("SELECT k.no_fpk, k.nosep, k.nocm, k.nama, k.dokter, k.tgl_masuk, k.tgl_keluar, k.jumlah
        FROM klaim k
        WHERE NOT EXISTS (
        SELECT 1
        FROM data_sim ds
        WHERE k.nosep = ds.nosep)");
        return $data->result_array();
    }
    public function getKasusKosong()
    {
        $data = $this->db->query("SELECT a.nosep, a.tgl_masuk, a.tgl_keluar, a.nama, a.nocm,a.layanan, a.dokter, a.tindakan, a.ruangan, a.kd_dpjp 
                FROM data_sim AS a 
                WHERE a.kasus IS NULL OR a.kasus = ''");
        return $data->result_array();
    }
    public function getPoliklinik()
    {
        $data = $this->db->query("SELECT 
            nosep,
            MAX(nocm) AS nocm,
            MAX(nama) AS nama,
            MAX(dokter) AS dokter,
            MAX(tgl_masuk) AS tgl_masuk,
            MAX(tgl_keluar) AS tgl_keluar
        FROM data_rj
        GROUP BY nosep
        HAVING SUM(CASE WHEN tindakan = 'PEMERIKSAAN DOKTER SPESIALIS RAWAT JALAN' THEN 1 ELSE 0 END) = 0");
        return $data->result_array();
    }
    public function getLayananKosong()
    {
        $data = $this->db->query("SELECT a.nosep, a.tgl_masuk, a.tgl_keluar, a.nama, a.nocm,a.layanan, a.dokter, a.tindakan, a.ruangan, a.kd_dpjp 
                FROM data_sim AS a 
                WHERE a.layanan IS NULL OR a.layanan = ''");
        return $data->result_array();
    }
    public function getDpjpKosong()
    {
        $data = $this->db->query("SELECT nosep,nocm,nama
            FROM data_sim
            GROUP BY nosep,nocm,nama
            HAVING SUM(CASE WHEN kd_dpjp = 'dpjp_utama' THEN 1 ELSE 0 END) = 0");
        return $data->result_array();
    }
    public function getIrd()
    {
        $data = $this->db->query("SELECT 
            nosep,
            MAX(nocm) AS nocm,
            MAX(nama) AS nama,
            MAX(dokter) AS dokter,
            MAX(tgl_masuk) AS tgl_masuk,
            MAX(tgl_keluar) AS tgl_keluar
        FROM data_ird
        GROUP BY nosep
        HAVING SUM(CASE WHEN tindakan = 'PEMERIKSAAN DOKTER UMUM RAWAT DARURAT' THEN 1 ELSE 0 END) = 0");
        return $data->result_array();
    }
    public function get_data_by_nosep_and_dpjp($nosep, $dpjp)
    {
        $this->db->where('nosep', $nosep);
        $this->db->where('kd_dpjp', $dpjp);
        $query = $this->db->get('data_sim');
        return $query->row_array();
    }

    public function insert_data_sim($data)
    {
        return $this->db->insert('data_sim', $data);
    }
}