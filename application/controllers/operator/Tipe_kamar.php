<?php
class Tipe_kamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('googlemaps');
        $this->load->model('Tipe_kamar_model');
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
        $data['tipe_kamar'] = $this->db->get_where('tipe_kamar', ['id_hotel' => $cek_hotel['id_hotel']])->result_array();
        $data['judul'] = 'Tipe Kamar ';
        $data['content'] = 'operator/tipe_kamar/index';
        $this->load->view('operator/template_operator/wrapper', $data, FALSE);
    }

    public function tambah($id_hotel)
    {
        $data['username'] = $this->session->userdata('username');
        $data['map'] = $this->googlemaps->create_map();
        $cek_hotel = $this->db->get_where('hotel', ['id_hotel' => $id_hotel])->row_array();
        $data['hotel'] = $cek_hotel;
        $data['cek_kamar'] = $this->db->get_where('kamar', ['id_hotel' => $cek_hotel['id_hotel']])->result_array();
        $data['judul'] = 'Tambah Tipe Kamar';
        $data['content'] = 'operator/tipe_kamar/tambah';
        $this->validasi();
        if ($this->form_validation->run() == false) {
            $this->load->view('operator/template_operator/wrapper', $data, FALSE);
        } else {
            $this->Tipe_kamar_model->tambah();
            $this->session->set_flashdata('sukses', 'Data ditambahkan');
            redirect('operator/tipe_kamar/index/' . $cek_hotel['id_hotel']);
        }
    }

    public function edit($id_tipe_kamar)
    {
        $data['username'] = $this->session->userdata('username');
        $tipe_kamar = $this->Tipe_kamar_model->cek_tipe_kamar($id_tipe_kamar);
        $data['tipe_kamar'] = $tipe_kamar;
        $data['map'] = $this->googlemaps->create_map();
        $data['judul'] = 'Ubah Tipe Kamar';
        $data['content'] = 'operator/tipe_kamar/edit';
        $data['hotel'] = $this->db->get_where('hotel', ['id_hotel' => $tipe_kamar['id_hotel']])->row_array();
        $this->validasi();
        if ($this->form_validation->run() == false) {
            $this->load->view('operator/template_operator/wrapper', $data, FALSE);
        } else {
            $this->Tipe_kamar_model->edit();
            $this->session->set_flashdata('sukses', 'Data diubah');
            redirect('operator/tipe_kamar/index/' . $tipe_kamar['id_hotel']);
        }
    }


    public function hapus($id_tipe_kamar)
    {
        $this->Tipe_kamar_model->hapus($id_tipe_kamar);
    }

    private function validasi()
    {
        $this->form_validation->set_rules('tipe_kamar', 'Tipe Kamar', 'required');
        $this->form_validation->set_rules('harga_kamar', 'Harga Kamar', 'required|numeric');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');
    }
}
