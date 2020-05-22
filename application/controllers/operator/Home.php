<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('googlemaps');
        $this->load->model('Hotel_model');
        $username = $this->session->userdata('username');
        $hak = $this->session->userdata('hak_akses');
        if ($username == null) {
            $this->session->set_flashdata('danger', 'Anda Belum Login');
            redirect('user/home');
        }
        if ($hak != 2) {
            $this->session->set_flashdata('danger', 'Anda bukan operator');
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
        $data['judul'] = 'Home Operator';
        $data['content'] = 'operator/hotel/index';
        $hari=date('Y-m-d');
        $pemesanan=$this->db->get_where('pemesanan',['status_pemesan'=>'0'])->result_array();
        if($pemesanan){
            foreach ($pemesanan as $p) {
                if ($p['check_in'] < $hari) {
                    $this->db->where('id_pemesan', $p['id_pemesan']);
                    $this->db->delete('pemesanan');
                }
            }
        }
        $this->load->view('operator/template_operator/wrapper', $data, FALSE);
    }

    public function ganti_password($id_hotel)
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
        $data['judul'] = 'Ganti Password Operator';
        $data['content'] = 'operator/hotel/ganti_password';
        $this->load->view('operator/template_operator/wrapper', $data, FALSE);
    }

    public function ganti_password_aksi($id_hotel)
    {
        $data = [
            'password_hotel' => $this->input->post('password_hotel')
        ];
        $this->db->where('id_hotel', $id_hotel);
        $this->db->update('hotel', $data);
        $this->session->set_flashdata('sukses', 'Password berhasil diganti');
        redirect('operator/home/index/' . $id_hotel);
    }


    public function tentang($id_hotel)
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
        $data['judul'] = 'Tentang Hotel';
        $data['content'] = 'operator/hotel/tentang';
        $this->load->view('operator/template_operator/wrapper', $data, FALSE);
    }

    public function tentang_aksi($id_hotel)
    {
        $data = [
            'tentang' => $this->input->post('tentang')
        ];
        $this->db->where('id_hotel', $id_hotel);
        $this->db->update('hotel', $data);
        $this->session->set_flashdata('sukses', 'Tentang Hotel diganti');
        redirect('operator/home/index/' . $id_hotel);
    }
}
