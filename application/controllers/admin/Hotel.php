<?php
class Hotel extends CI_Controller
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
        if ($hak != '1') {
            $this->session->set_flashdata('danger', 'Anda bukan admin');
            redirect('user/home');
        }
    }

    public function index()
    {
        $data['username'] = $this->session->userdata('username');
        $data['hak_akses'] = $this->session->userdata('hak_akses');
        $data['map'] = $this->googlemaps->create_map();
        $data['judul'] = 'Hotel';
        $data['content'] = 'admin/hotel/index';
        $data['hotel'] = $this->Hotel_model->tampil();
        $this->load->view('admin/template_admin/wrapper', $data, FALSE);
    }

    public function tambah()
    {
        $data['username'] = $this->session->userdata('username');
        $data['hak_akses'] = $this->session->userdata('hak_akses');
        // map
        $config['center'] = '-9.444464, 124.477303';
        $config['zoom'] = 14;
        $this->googlemaps->initialize($config);
        // marker
        $marker['position'] = '-9.444464, 124.477303';
        $marker['draggable'] = true;
        $marker['ondragend'] = 'setToForm(event.latLng.lat(),event.latLng.lng())';
        $this->googlemaps->add_marker($marker);

        $data['map'] = $this->googlemaps->create_map();
        $data['judul'] = 'Tambah Hotel';
        $data['content'] = 'admin/hotel/tambah';

        $this->validasi();
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/template_admin/wrapper', $data, FALSE);
        } else {
            $this->Hotel_model->tambah();
            $this->session->set_flashdata('sukses', 'Data ditambahkan');
            redirect('admin/hotel');
        }
    }

    public function ubah($id_hotel)
    {
        $data['username'] = $this->session->userdata('username');
        $data['hak_akses'] = $this->session->userdata('hak_akses');
        // map
        $config['center'] = '-9.444464, 124.477303';
        $config['zoom'] = 14;
        $this->googlemaps->initialize($config);
        // marker
        $posisi = $this->Hotel_model->cek_hotel($id_hotel);
        $pos_lat = $posisi['latitude'];
        $pos_long = $posisi['longitude'];
        $marker['position'] = $pos_lat . ',' . $pos_long;
        $marker['draggable'] = true;
        $marker['ondragend'] = 'setToForm(event.latLng.lat(),event.latLng.lng())';
        $this->googlemaps->add_marker($marker);

        $data['map'] = $this->googlemaps->create_map();
        $data['judul'] = 'Ubah Hotel';
        $data['content'] = 'admin/hotel/edit';
        $data['hotel'] = $this->Hotel_model->cek_hotel($id_hotel);

        $this->validasi();
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/template_admin/wrapper', $data, FALSE);
        } else {
            $this->Hotel_model->ubah();
            $this->session->set_flashdata('sukses', 'Data diubah');
            redirect('admin/hotel');
        }
    }

    public function hapus($id_hotel)
    {
        $this->Hotel_model->hapus($id_hotel);
        $this->session->set_flashdata('sukses', 'Data dihapus');
        redirect('admin/hotel');
    }

    private function validasi()
    {
        $this->form_validation->set_rules('nama_hotel', 'Nama Hotel', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required');
        $this->form_validation->set_rules('username_hotel', 'Username Hotel', 'required');
        $this->form_validation->set_rules('password_hotel', 'Password Hotel', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jumlah_kamar', 'Jumlah kamar', 'required');
    }
}
