<?php
class Pemesanan extends CI_Controller
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
        $kamar = $this->db->get_where('kamar', ['id_hotel' => $id_hotel])->result_array();
        $kamar1 = $this->db->get_where('kamar', ['id_hotel' => $id_hotel])->row_array();
        $this->db->like('id_kamar', $kamar1['id_kamar']);
        foreach ($kamar as $k) {
            $this->db->or_like('id_kamar', $k['id_kamar']);
        }
        $data['pemesanan'] = $this->db->get('pemesanan')->result_array();
        $data['judul'] = 'Pemesanan ' . $cek_hotel['nama_hotel'];
        $data['content'] = 'operator/pemesanan/index';
        $this->load->view('operator/template_operator/wrapper', $data, FALSE);
    }

    public function proses($id_pemesan)
    {
        $pemesan = $this->db->get_where('pemesanan', ['id_pemesan' => $id_pemesan])->row_array();
        $id_kamar = $pemesan['id_kamar'];
        $kamar = $this->db->get_where('kamar', ['id_kamar' => $id_kamar])->row_array();
        $id_hotel = $kamar['id_hotel'];
        $data1 = [
            'status_pemesan' => 1
        ];
        $this->db->where('id_pemesan', $id_pemesan);
        $this->db->update('pemesanan', $data1);
        $data2 = [
            'status_kamar' => 1
        ];
        $this->db->where('id_kamar', $id_kamar);
        $this->db->update('kamar', $data2);
        $this->session->set_flashdata('sukses', 'pemesanan telah diproses');
        redirect('operator/pemesanan/index/' . $id_hotel);
    }

    public function check_in($id_pemesan)
    {
        $pemesan = $this->db->get_where('pemesanan', ['id_pemesan' => $id_pemesan])->row_array();
        $id_kamar = $pemesan['id_kamar'];
        $kamar = $this->db->get_where('kamar', ['id_kamar' => $id_kamar])->row_array();
        $id_hotel = $kamar['id_hotel'];
        $data = [
            'status_pemesan' => 2
        ];
        $this->db->where('id_pemesan', $id_pemesan);
        $this->db->update('pemesanan', $data);
        $this->session->set_flashdata('sukses', 'pemesan telah check in');
        redirect('operator/pemesanan/index/' . $id_hotel);
    }

    public function perpanjang($id_pemesan)
    {
        $pemesan = $this->db->get_where('pemesanan', ['id_pemesan' => $id_pemesan])->row_array();
        $id_kamar = $pemesan['id_kamar'];
        $kamar = $this->db->get_where('kamar', ['id_kamar' => $id_kamar])->row_array();
        $id_hotel = $kamar['id_hotel'];
        $hotel = $this->db->get_where('hotel', ['id_hotel' => $id_hotel])->row_array();
        $data['hotel'] = $hotel;
        $data['username'] = $this->session->userdata('username');
        $data['map'] = $this->googlemaps->create_map();
        $data['pemesan'] = $pemesan;
        $data['kamar'] = $kamar;
        $data['judul'] = 'Pemesanan ' . $hotel['nama_hotel'];
        $this->form_validation->set_rules('id_pemesan', 'ID Pemesan', 'required');
        $this->form_validation->set_rules('check_in', 'Check In', 'required');
        $this->form_validation->set_rules('check_out', 'Check Out', 'required');
        $this->form_validation->set_rules('check_out_baru', 'Check Out Baru', 'required');
        if ($this->form_validation->run() == false) {
            $data['content'] = 'operator/pemesanan/perpanjang';
            $this->load->view('operator/template_operator/wrapper', $data, FALSE);
        } else {
            if ($this->input->post('check_out_baru') > $this->input->post('check_out')) {
                $id_pemesan = $this->input->post('id_pemesan');
                $check_out = $this->input->post('check_out_baru');
                $data = ['check_out' => $check_out];
                $this->db->where('id_pemesan', $id_pemesan);
                $this->db->update('pemesanan', $data);
                $this->session->set_flashdata('sukses', 'pemesanan berhasil diperpanjang');
                redirect('operator/pemesanan/index/' . $id_hotel);
            } else {
                $this->session->set_flashdata('danger', 'check out baru harus lebih besar dari check out lama');
                redirect('operator/pemesanan/perpanjang/' . $id_pemesan);
            }
        }
    }

    public function check_out($id_pemesan)
    {
        $pemesan = $this->db->get_where('pemesanan', ['id_pemesan' => $id_pemesan])->row_array();
        $id_kamar = $pemesan['id_kamar'];
        $kamar = $this->db->get_where('kamar', ['id_kamar' => $id_kamar])->row_array();
        $id_tipe_kamar = $kamar['id_tipe_kamar'];
        $cek_tipe_kamar = $this->db->get_where('tipe_kamar', ['id_tipe_kamar' => $id_tipe_kamar])->row_array();
        $id_hotel = $kamar['id_hotel'];
        $nama_pemesan = $pemesan['nama_pemesan'];
        $no_pemesan = $pemesan['no_pemesan'];
        $alamat_pemesan = $pemesan['alamat_pemesan'];
        $check_in = $pemesan['check_in'];
        $check_out = $pemesan['check_out'];
        $in = new DateTime($pemesan['check_in']);
        $out = new DateTime($pemesan['check_out']);
        $jumlah = $out->diff($in);
        $jumlah_hari = $jumlah->d;
        $no_kamar = $kamar['no_kamar'];
        $tipe_kamar = $cek_tipe_kamar['tipe_kamar'];
        $harga_kamar = $cek_tipe_kamar['harga_kamar'];
        $bayar = $jumlah_hari * $harga_kamar;
        $data = [
            'nama_pemesan' => $nama_pemesan,
            'no_pemesan' => $no_pemesan,
            'alamat_pemesan' => $alamat_pemesan,
            'id_hotel' => $id_hotel,
            'no_kamar' => $no_kamar,
            'tipe_kamar' => $tipe_kamar,
            'harga_kamar' => $harga_kamar,
            'check_in' => $check_in,
            'check_out' => $check_out,
            'bayar' => $bayar
        ];
        $this->db->insert('pemesanan_selesai', $data);
        $data1 = [
            'status_kamar' => 0
        ];
        $this->db->where('id_kamar', $id_kamar);
        $this->db->update('kamar', $data1);
        $this->db->where('id_pemesan', $id_pemesan);
        $this->db->delete('pemesanan');
        $this->session->set_flashdata('sukses', 'pemesanan selesai');
        redirect('operator/pemesanan/index/' . $id_hotel);
    }

    public function pemesanan_selesai($id_hotel)
    {
        if ($id_hotel != $this->session->userdata('id_hotel')) {
            $this->session->set_flashdata('danger', 'Anda bukan operator hotel tersebut');
            redirect('user/home');
        }
        $data['username'] = $this->session->userdata('username');
        $data['map'] = $this->googlemaps->create_map();
        $cek_hotel = $this->db->get_where('hotel', ['id_hotel' => $id_hotel])->row_array();
        $data['hotel'] = $cek_hotel;
        $this->db->order_by('id_pemesanan_selesai', 'DESC');
        $data['pemesanan_selesai'] = $this->db->get_where('pemesanan_selesai', ['id_hotel' => $id_hotel])->result_array();
        $data['judul'] = 'Pemesanan Selesai ' . $cek_hotel['nama_hotel'];
        $data['content'] = 'operator/pemesanan/pemesanan_selesai';
        $this->load->view('operator/template_operator/wrapper', $data, FALSE);
    }

    public function hapus_pemesanan_selesai($id){
        $id_gabung=explode('-', $id);
        $id_hotel=$id_gabung[1];
        $id_pemesanan_selesai=$id_gabung[0];
        $this->db->where('id_pemesanan_selesai',$id_pemesanan_selesai);
        $this->db->delete('pemesanan_selesai');
        $this->session->set_flashdata('sukses', 'Data dihapus');
        redirect('operator/pemesanan/pemesanan_selesai/' . $id_hotel);
    }
}
