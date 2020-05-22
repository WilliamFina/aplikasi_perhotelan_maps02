<?php
class Hotel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('googlemaps');
        $this->load->model('Hotel_model');
    }

    public function index($id_hotel)
    {
        $data['map'] = $this->googlemaps->create_map();
        $data['judul'] = 'Hotel';
        $data['hotel'] = $this->Hotel_model->cek_hotel($id_hotel);
        $data['content'] = 'user/hotel/index';
        // $this->load->view('user/template_user/wrapper', $data, FALSE);
        $this->load->view('user/hotel/index2', $data);
    }
}
