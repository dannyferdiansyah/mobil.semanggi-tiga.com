<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_aplikasi() {
        $query = $this->db->get('aplikasi');
        return $query->row();
    }

    public function create_aplikasi($nama, $ikon, $favicon) {
        $data = array(
            'nama_aplikasi' => $nama,
            'ikon' => $ikon,
            'favicon'   => $favicon,
        );
        return $this->db->insert('aplikasi', $data);
    }

    public function get_klien() {
        $this->db->order_by('klien', 'asc');
        $query = $this->db->get('klien');
        return $query;
    }

    public function create_klien($data) {
        return $this->db->insert('klien', $data);
    }

    public function edit_klien($id,$data) {
        $this->db->where('id_klien', $id);
        return $this->db->update('klien', $data);
    }

    public function delete_klien($id) {
        $this->db->where('id_klien', $id);
        return $this->db->delete('klien');
    }

    public function get_lokasi() {
        $this->db->select('lokasi.*, klien.klien as klien1, klien.id_klien');
        $this->db->from('lokasi');
        $this->db->join('klien', 'lokasi.klien = klien.id_klien', 'left'); // Adjust 'left' join as needed
        $this->db->order_by('nama', 'asc');
        $query = $this->db->get();
        return $query;
    }

    public function create_lokasi($data){
        return $this->db->insert('lokasi', $data);
    }

    public function edit_lokasi($id,$data) {
        $this->db->where('id_lokasi', $id);
        return $this->db->update('lokasi', $data);
    }

    public function delete_lokasi($id) {
        $this->db->where('id_lokasi', $id);
        return $this->db->delete('lokasi');
    }

    public function get_penempatan() {
        $this->db->select('penempatan.*, klien.klien as klien1, klien.id_klien, lokasi.id_lokasi, lokasi.nama');
        $this->db->from('penempatan');
        $this->db->join('klien', 'penempatan.klien = klien.id_klien', 'left');
        $this->db->join('lokasi', 'penempatan.lokasi = lokasi.id_lokasi', 'left');  // Adjust 'left' join as needed
        $query = $this->db->get();
        return $query;
    }

    public function create_penempatan($data){
        return $this->db->insert('penempatan', $data);
    }

    public function edit_penempatan($id,$data) {
        $this->db->where('id_penempatan', $id);
        return $this->db->update('penempatan', $data);
    }

    public function delete_penempatan($id) {
        $this->db->where('id_penempatan', $id);
        return $this->db->delete('penempatan');
    }

    public function create_user($data){
        return $this->db->insert('users', $data);
    }

    public function create_pergantian($data, $data1){
        $this->db->insert('pergantian', $data);
        return $this->db->insert('tad_pergantian', $data1);
    }

    public function edit_tagihan($data, $id){
        return $this->db->update('invoice', $data, ['id_invoice'=>$id]);
    }

    public function get_pergantian() {
        $query = $this->db->get('pergantian');
        return $query;
    }

    public function get_laptagihan() {
        $this->db->select('invoice.*, klien.klien as klien1, klien.id_klien');
        $this->db->from('invoice');
        $this->db->join('klien', 'invoice.klien = klien.id_klien', 'left');
        $this->db->order_by('id_invoice','desc');
        $query = $this->db->get();
        return $query;
    }

    public function get_pengurangan() {
        $query = $this->db->get('pengurangan');
        return $query;
    }

    public function update_tagihan1($data, $id){
        return $this->db->update('invoice', $data, ['id_invoice'=>$id]);
    }


    public function update_tagihan2($data, $data1, $id){
        $this->db->update('invoice', $data, ['id_invoice' => $id]);
        return $this->db->insert('timeline_pembayaran', $data1);
    }


    public function update_tagihan3($data, $data1, $id){
        $this->db->update('invoice', $data, ['id_invoice' => $id]);
        return $this->db->insert('timeline_pembayaran', $data1);
    }

    public function delete_user($id){
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

}
