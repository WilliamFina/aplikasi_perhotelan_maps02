<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('googlemaps');
        $this->load->model('Hotel_model');
        $this->load->model('Wisata_model');
    }

    public function index()
    {
        $config['center'] = '-9.444464, 124.477303';
        $config['zoom'] = 12;
        $this->googlemaps->initialize($config);
        // pemetaan
        $hotel = $this->Hotel_model->tampil();
        foreach ($hotel as $h) {
            $marker = [];
            $marker['position'] = $h['latitude'] . ',' . $h['longitude'];
            $marker['animation'] = "DROP";
            $marker['infowindow_content'] = '<div class="media" style="width:300px;">';
            $marker['infowindow_content'] .= '<div class="media-body">';
            $marker['infowindow_content'] .= '<div class="row">';
            $marker['infowindow_content'] .= '<div class="col-md-7">';
            $marker['infowindow_content'] .= '<a href="' . base_url('user/hotel/index/' . $h['id_hotel']) . '">';
            $marker['infowindow_content'] .= '<h4>' . $h['nama_hotel'] . '</h4>';
            $marker['infowindow_content'] .= '</a>';
            $marker['infowindow_content'] .= '<p>Alamat: ' . $h['alamat'] . '<br>';
            $marker['infowindow_content'] .= 'No Telp: ' . $h['no_telepon'] . '</p>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '<div class="col-md-5">';
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

        $data['map'] = $this->googlemaps->create_map();
        $data['hotel'] = $this->Hotel_model->tampil();
        $data['wisata'] = $this->Wisata_model->tampil();
        $data['judul'] = 'Home User';
        $data['content'] = 'user/index';
        // $this->load->view('user/template_user/wrapper', $data, FALSE);
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
        $this->load->view('user/index2', $data);
    }

    public function map_cari()
    {
        // pemetaan
        if ($this->input->post('submit')) {
            $data['submit'] = 'submit';
            $data['tempat1'] = $this->db->get_where('hotel', ['id_hotel' => $this->input->post('tempat1')])->row_array();
            $data['tempat2'] = $this->db->get_where('wisata', ['id_wisata' => $this->input->post('tempat2')])->row_array();
            if ($this->input->post('tempat1') == 'semua') {
                $this->tempat2();
            } else if ($this->input->post('tempat2') == 'semua') {
                $this->tempat1();
            } else {
                $this->directions();
            }
        } else {
            $data['submit'] = '';
            $this->semua();
        }
        $data['map'] = $this->googlemaps->create_map();
        $data['hotel'] = $this->Hotel_model->tampil();
        $data['wisata'] = $this->Wisata_model->tampil();
        $data['judul'] = 'Map';
        $data['content'] = 'user/map_cari';
        // $this->load->view('user/template_user/wrapper', $data, FALSE);
        $this->load->view('user/map_cari', $data);
    }

    private function semua()
    {
        $config['center'] = '-9.444464, 124.477303';
        $config['zoom'] = 12;
        $this->googlemaps->initialize($config);
        $hotel = $this->Hotel_model->tampil();
        foreach ($hotel as $h) {
            $marker = [];
            $marker['position'] = $h['latitude'] . ',' . $h['longitude'];
            $marker['animation'] = "DROP";
            $marker['infowindow_content'] = '<div class="media" style="width:300px;">';
            $marker['infowindow_content'] .= '<div class="media-body">';
            $marker['infowindow_content'] .= '<div class="row">';
            $marker['infowindow_content'] .= '<div class="col-md-7">';
            $marker['infowindow_content'] .= '<a href="' . base_url('user/hotel/index/' . $h['id_hotel']) . '">';
            $marker['infowindow_content'] .= '<h4>' . $h['nama_hotel'] . '</h4>';
            $marker['infowindow_content'] .= '</a>';
            $marker['infowindow_content'] .= '<p>Alamat: ' . $h['alamat'] . '<br>';
            $marker['infowindow_content'] .= 'No Telp: ' . $h['no_telepon'] . '</p>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '<div class="col-md-5">';
            $marker['infowindow_content'] .= '<img src="' . base_url('template/images/' . $h['foto']) . '" style="position:absolute; width:100px; height:100px;">';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $this->googlemaps->add_marker($marker);
        }
        $wisata = $this->Wisata_model->tampil();
        foreach ($wisata as $w) {
            $marker = [];
            $marker['position'] = $w['latitude'] . ',' . $w['longitude'];
            $marker['animation'] = "DROP";
            $marker['icon'] = base_url('icon/marker2.png');
            $marker['infowindow_content'] = '<div class="media" style="width:300px;">';
            $marker['infowindow_content'] .= '<div class="media-body">';
            $marker['infowindow_content'] .= '<div class="row">';
            $marker['infowindow_content'] .= '<div class="col-md-7">';
            // $marker['infowindow_content'] .= '<a href="' . base_url('user/wisata/index/' . $w['id_wisata']) . '">';
            $marker['infowindow_content'] .= '<h4>' . $w['nama_wisata'] . '</h4>';
            // $marker['infowindow_content'] .= '</a>';
            $marker['infowindow_content'] .= '<p>Alamat: ' . $w['alamat'] . '</p>';
            // $marker['infowindow_content'] .= 'No Telp: ' . $w['no_telepon'] . '</p>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '<div class="col-md-5">';
            $marker['infowindow_content'] .= '<img src="' . base_url('template/images/' . $w['foto']) . '" style="position:absolute; width:100px; height:100px;">';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $marker['infowindow_content'] .= '</div>';
            $this->googlemaps->add_marker($marker);
        }
    }

    private function tempat1()
    {
        $config['center'] = '-9.444464, 124.477303';
        $config['zoom'] = 14;
        $this->googlemaps->initialize($config);
        $tempat1 = $this->db->get_where('hotel', ['id_hotel' => $this->input->post('tempat1')])->row_array();
        $marker = [];
        $marker['position'] = $tempat1['latitude'] . ',' . $tempat1['longitude'];
        $marker['animation'] = "DROP";
        $marker['infowindow_content'] = '<div class="media" style="width:300px;">';
        $marker['infowindow_content'] .= '<div class="media-body">';
        $marker['infowindow_content'] .= '<div class="row">';
        $marker['infowindow_content'] .= '<div class="col-md-7">';
        $marker['infowindow_content'] .= '<a href="' . base_url('user/hotel/index/' . $tempat1['id_hotel']) . '">';
        $marker['infowindow_content'] .= '<h4>' . $tempat1['nama_hotel'] . '</h4>';
        $marker['infowindow_content'] .= '</a>';
        $marker['infowindow_content'] .= '<p>Alamat: ' . $tempat1['alamat'] . '<br>';
        $marker['infowindow_content'] .= 'No Telp: ' . $tempat1['no_telepon'] . '</p>';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '<div class="col-md-5">';
        $marker['infowindow_content'] .= '<img src="' . base_url('template/images/' . $tempat1['foto']) . '" style="position:absolute; width:100px; height:100px;">';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '</div>';
        $this->googlemaps->add_marker($marker);
    }

    private function tempat2()
    {
        $config['center'] = '-9.444464, 124.477303';
        $config['zoom'] = 14;
        $this->googlemaps->initialize($config);
        $tempat2 = $this->db->get_where('wisata', ['id_wisata' => $this->input->post('tempat2')])->row_array();
        $marker = [];
        $marker['position'] = $tempat2['latitude'] . ',' . $tempat2['longitude'];
        $marker['animation'] = "DROP";
        $marker['infowindow_content'] = '<div class="media" style="width:300px;">';
        $marker['infowindow_content'] .= '<div class="media-body">';
        $marker['infowindow_content'] .= '<div class="row">';
        $marker['infowindow_content'] .= '<div class="col-md-7">';
        // $marker['infowindow_content'] .= '<a href="' . base_url('user/wisata/index/' . $tempat2['id_wisata']) . '">';
        $marker['infowindow_content'] .= '<h4>' . $tempat2['nama_wisata'] . '</h4>';
        // $marker['infowindow_content'] .= '</a>';
        $marker['infowindow_content'] .= '<p>Alamat: ' . $tempat2['alamat'] . '</p>';
        // $marker['infowindow_content'] .= 'No Telp: ' . $tempat2['no_telepon'] . '</p>';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '<div class="col-md-5">';
        $marker['infowindow_content'] .= '<img src="' . base_url('template/images/' . $tempat2['foto']) . '" style="position:absolute; width:100px; height:100px;">';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '</div>';
        $marker['infowindow_content'] .= '</div>';
        $this->googlemaps->add_marker($marker);
    }

    private function directions()
    {

        $tempat1 = $this->db->get_where('hotel', ['id_hotel' => $this->input->post('tempat1')])->row_array();
        $tempat2 = $this->db->get_where('wisata', ['id_wisata' => $this->input->post('tempat2')])->row_array();
        // directions
        $config['center'] = '-9.444464, 124.477303';
        $config['zoom'] = 14;
        $config['directions'] = TRUE;
        $config['directionsMode'] = 'DRIVING';
        $config['directionsStart'] = $tempat1['latitude'] . ',' . $tempat1['longitude'];
        $config['directionsEnd'] = $tempat2['latitude'] . ',' . $tempat2['longitude'];
        $config['directionsDivID'] = 'directionsDiv';
        $this->googlemaps->initialize($config);
    }
}
