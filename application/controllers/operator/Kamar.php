<?php
class Kamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('googlemaps');
        $this->load->model('Hotel_model');
        $username = $this->session->userdata('username');
        if ($username == null) {
            $this->session->set_flashdata('danger', 'Anda Belum Login');
            redirect('user/home');
        }
    }
    public function index($id_hotel)
    {
        if ($id_hotel != $this->session->userdata('id_hotel')) {
            $this->session->set_flashdata('danger', 'Anda bukan operator hotel tersebut');
            redirect('user/home');
        }
        $data['username'] = $this->session->userdata('username');
        $data['map'] = $this->googlemaps->create_map();
        $cek_hotel = $this->db->get_where('hotel', ['id_hotel' => $id_hotel])->row_array();
        $data['hotel'] = $cek_hotel;
        $data['cek_kamar'] = $this->db->get_where('kamar', ['id_hotel' => $cek_hotel['id_hotel']])->result_array();
        $data['judul'] = 'Kamar ' . $cek_hotel['nama_hotel'];
        $data['content'] = 'operator/kamar/index';
        $this->load->view('operator/template_operator/wrapper', $data, FALSE);
    }

    public function pilih_tipe_kamar($tangkap)
    {
        $id_cek = explode('-', $tangkap);
        $id_kamar = $id_cek[0];
        $id_tipe_kamar = $id_cek[1];
        $kamar = $this->db->get_where('kamar', ['id_kamar' => $id_kamar])->row_array();
        $id_hotel = $kamar['id_hotel'];
        $data = [
            'id_tipe_kamar' => $id_tipe_kamar
        ];
        $this->db->where('id_kamar', $id_kamar);
        $this->db->update('kamar', $data);
        $this->session->set_flashdata('sukses', 'Tipe Kamar Diubah');
        redirect('operator/kamar/index/' . $id_hotel);
    }
}
