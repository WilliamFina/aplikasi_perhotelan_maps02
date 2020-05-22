<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('googlemaps');
        $this->load->model('Hotel_model');
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
        $config['center'] = '-9.444464, 124.477303';
        $config['zoom'] = 13;
        $this->googlemaps->initialize($config);
        // map hotel
        $hotel = $this->Hotel_model->tampil();
        foreach ($hotel as $h) {
            $marker = [];
            $marker['position'] = $h['latitude'] . ',' . $h['longitude'];
            $marker['animation'] = "DROP";
            // $marker['icon'] = base_url('icon/marker4.png');
            $marker['infowindow_content'] = '<div class="media" style="width:300px;">';
            $marker['infowindow_content'] .= '<div class="media-body">';
            $marker['infowindow_content'] .= '<div class="row">';
            $marker['infowindow_content'] .= '<div class="col-md-8">';
            $marker['infowindow_content'] .= '<h5>' . $h['nama_hotel'] . '</h5>';
            $marker['infowindow_content'] .= '<p>Alamat:' . $h['alamat'] . '</p>';
            $marker['infowindow_content'] .= '<p>No Telepon:' . $h['no_telepon'] . '</p>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '<div class="col-md-4">';
            $marker['infowindow_content'] .= '<img src="' . base_url('template/images/' . $h['foto']) . '" style="position:absolute; width:100px; height:100px;">';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $this->googlemaps->add_marker($marker);
        }
        // map wisata
        $wisata = $this->Wisata_model->tampil();
        foreach ($wisata as $w) {
            $marker = [];
            $marker['position'] = $w['latitude'] . ',' . $w['longitude'];
            $marker['animation'] = "DROP";
            $marker['icon'] = base_url('icon/marker2.png');
            $marker['infowindow_content'] = '<div class="media" style="width:300px;">';
            $marker['infowindow_content'] .= '<div class="media-body">';
            $marker['infowindow_content'] .= '<div class="row">';
            $marker['infowindow_content'] .= '<div class="col-md-8">';
            $marker['infowindow_content'] .= '<h5>' . $w['nama_wisata'] . '</h5>';
            $marker['infowindow_content'] .= '<p>Alamat:' . $w['alamat'] . '</p>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '<div class="col-md-4">';
            $marker['infowindow_content'] .= '<img src="' . base_url('template/images/' . $w['foto']) . '" style="position:absolute; width:100px; height:100px;">';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $this->googlemaps->add_marker($marker);
        }

        $data['username'] = $this->session->userdata('username');
        $data['hak_akses'] = $this->session->userdata('hak_akses');
        $data['map'] = $this->googlemaps->create_map();
        $data['judul'] = 'Home';
        $data['content'] = 'admin/template_admin/beranda';
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
        $this->load->view('admin/template_admin/wrapper', $data, FALSE);
    }
}
