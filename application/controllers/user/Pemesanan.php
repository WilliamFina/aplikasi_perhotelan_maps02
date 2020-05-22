<?php

class Pemesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('googlemaps');
        $this->load->model('Hotel_model');
    }

    public function index($id_kamar)
    {
        $hari=date('Y-m-d');
        $kamar = $this->db->get_where('kamar', ['id_kamar' => $id_kamar])->row_array();
        $id_hotel = $kamar['id_hotel'];
        $data['hotel'] = $this->Hotel_model->cek_hotel($id_hotel);
        $data['kamar'] = $kamar;
        $data['map'] = $this->googlemaps->create_map();
        $data['judul'] = 'Pesan Kamar Hotel';
        $this->load->view('user/hotel/pemesanan', $data);
    }

    public function pemesanan($id_kamar)
    {
        $kamar = $this->db->get_where('kamar', ['id_kamar' => $id_kamar])->row_array();
        $id_hotel = $kamar['id_hotel'];
        $data['hotel'] = $this->Hotel_model->cek_hotel($id_hotel);
        $data['kamar'] = $kamar;
        $data['map'] = $this->googlemaps->create_map();
        $data['judul'] = 'Pesan Kamar Hotel';
        $this->validasi();
        if ($this->form_validation->run() == false) {
            $this->load->view('user/hotel/pemesanan', $data);
        } else {
            $check_in = $this->input->post('check_in');
            $check_out = $this->input->post('check_out');
            $hari=date('Y-m-d');
            if ($check_in >= $check_out) {
                $id_kamar = $this->input->post('id_kamar');
                $this->session->set_flashdata('danger', 'Gagal diproses! Tanggal Check Out harus lebih besar dari tanggal Check In');
                redirect('user/pemesanan/index/' . $id_kamar);
            } else if($check_in <= $hari){
                $id_kamar = $this->input->post('id_kamar');
                $this->session->set_flashdata('danger', 'Gagal diproses! Tanggal check_in tidak bisa lebih kecil dari tanggal pemesanan');
                redirect('user/pemesanan/index/' . $id_kamar);
            } else  {
                $data = [
                    'id_kamar' => $this->input->post('id_kamar'),
                    'check_in' => $this->input->post('check_in'),
                    'check_out' => $this->input->post('check_out'),
                    'nama_pemesan' => $this->input->post('nama_pemesan'),
                    'no_pemesan' => $this->input->post('no_pemesan'),
                    'alamat_pemesan' => $this->input->post('alamat_pemesan'),
                    'status_pemesan' => 0
                ];
                $this->db->insert('pemesanan', $data);
                $this->session->set_flashdata('sukses', 'Pemesanan sedang diproses');
                redirect('user/hotel/index/' . $id_hotel);
            }
        }
    }

    public function cetak(){
        $this->db->order_by('id_pemesan','DESC');
        $pemesanan =$this->db->get('pemesanan')->row_array();
        $this->db->where('id_kamar',$pemesanan['id_kamar']);
        $kamar = $this->db->get('kamar')->row_array();
        $hotel= $this->db->get_where('hotel',['id_hotel'=>$kamar['id_hotel']])->row_array();
        $data['pemesanan']=$pemesanan;
        $data['kamar']=$kamar;
        $data['hotel']=$hotel;

        $this->load->library('mypdf');
        $this->mypdf->generate('user/hotel/cetak', $data);
    }

    private function validasi()
    {
        $this->form_validation->set_rules('check_in', 'Check In', 'required');
        $this->form_validation->set_rules('check_out', 'Check Out', 'required');
        $this->form_validation->set_rules('nama_pemesan', 'Nama lengkap', 'required');
        $this->form_validation->set_rules('no_pemesan', 'No Telepon', 'required|numeric');
        $this->form_validation->set_rules('alamat_pemesan', 'Alamat', 'required');
    }
}
