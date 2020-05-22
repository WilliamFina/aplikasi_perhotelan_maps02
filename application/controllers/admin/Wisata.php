<?php
class Wisata extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('googlemaps');
        $this->load->model('Wisata_model');
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
        $data['judul'] = 'Wisata';
        $data['content'] = 'admin/wisata/index';
        $data['wisata'] = $this->Wisata_model->tampil();
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
        // $marker['icon'] = base_url('icon/marker1.png');
        $marker['position'] = '-9.444464, 124.477303';
        $marker['draggable'] = true;
        $marker['ondragend'] = 'setToForm(event.latLng.lat(),event.latLng.lng())';
        $this->googlemaps->add_marker($marker);

        $data['map'] = $this->googlemaps->create_map();
        $data['judul'] = 'Tambah Wisata';
        $data['content'] = 'admin/wisata/tambah';

        $this->validasi();
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/template_admin/wrapper', $data, FALSE);
        } else {
            $this->Wisata_model->tambah();
            $this->session->set_flashdata('sukses', 'Data ditambahkan');
            redirect('admin/wisata');
        }
    }

    public function ubah($id_wisata)
    {
        $data['username'] = $this->session->userdata('username');
        $data['hak_akses'] = $this->session->userdata('hak_akses');
        // map
        $config['center'] = '-9.444464, 124.477303';
        $config['zoom'] = 14;
        $this->googlemaps->initialize($config);
        // marker
        $posisi = $this->Wisata_model->cek_wisata($id_wisata);
        $pos_lat = $posisi['latitude'];
        $pos_long = $posisi['longitude'];
        $marker['position'] = $pos_lat . ',' . $pos_long;
        $marker['draggable'] = true;
        $marker['ondragend'] = 'setToForm(event.latLng.lat(),event.latLng.lng())';
        $this->googlemaps->add_marker($marker);

        $data['map'] = $this->googlemaps->create_map();
        $data['judul'] = 'Ubah Hotel';
        $data['content'] = 'admin/wisata/edit';
        $data['wisata'] = $this->Wisata_model->cek_wisata($id_wisata);

        $this->validasi();
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/template_admin/wrapper', $data, FALSE);
        } else {
            $this->Wisata_model->ubah();
            $this->session->set_flashdata('sukses', 'Data diubah');
            redirect('admin/wisata');
        }
    }

    public function hapus($id_wisata)
    {
        $this->Wisata_model->hapus($id_wisata);
        $this->session->set_flashdata('sukses', 'Data dihapus');
        redirect('admin/wisata');
    }

    private function validasi()
    {
        $this->form_validation->set_rules('nama_wisata', 'Nama Wisata', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    }
}
