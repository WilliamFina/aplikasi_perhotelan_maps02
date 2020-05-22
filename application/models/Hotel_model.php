<?php

class Hotel_model extends CI_Model
{
    public function tampil()
    {
        $this->db->order_by('nama_hotel', 'ASC');
        return $this->db->get('hotel')->result_array();
    }

    public function tambah()
    {
        $foto = $_FILES['foto'];
        if ($foto = '') {
        } else {
            $config['upload_path'] = './template/images';
            $config['allowed_types'] = 'jpg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('danger', 'belum mengisi foto');
                redirect('admin/hotel/tambah');
            } else {
                $foto = $this->upload->data('file_name');
            }
        }
        $data = [
            'nama_hotel' => $this->input->post('nama_hotel'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'no_telepon' => $this->input->post('no_telepon'),
            'username_hotel' => $this->input->post('username_hotel'),
            'password_hotel' => $this->input->post('password_hotel'),
            'alamat' => $this->input->post('alamat'),
            'jumlah_kamar' => $this->input->post('jumlah_kamar'),
            'foto' => $foto
        ];
        $this->db->insert('hotel', $data);

        //kamar
        $jumlah_kamar = $this->input->post('jumlah_kamar');
        $nama_hotel = $this->input->post('nama_hotel');
        $username_hotel = $this->input->post('username_hotel');
        $this->db->where('nama_hotel', $nama_hotel);
        $this->db->where('username_hotel', $username_hotel);
        $cek_hotel = $this->db->get('hotel')->row_array();
        $id_hotel = $cek_hotel['id_hotel'];
        for ($i = 1; $i <= $jumlah_kamar; $i++) {
            $data1 = [
                'id_hotel' => $id_hotel,
                'no_kamar' => $i
            ];
            $this->db->insert('kamar', $data1);
        }
    }

    public function ubah()
    {
        //kamar
        $id_hotel=$this->input->post('id_hotel');
        $jumlah_kamar = $this->input->post('jumlah_kamar');
        $nama_hotel = $this->input->post('nama_hotel');
        $username_hotel = $this->input->post('username_hotel');
        $this->db->where('id_hotel', $id_hotel);
        $cek_hotel = $this->db->get('hotel')->row_array();
        $cek_jumlah_kamar = $cek_hotel['jumlah_kamar'];
        $id_hotel = $cek_hotel['id_hotel'];

        // cek_kamar
        $this->db->where('status_kamar', '1');
        $this->db->where('id_hotel', $id_hotel);
        $kamar_cek = $this->db->get('kamar')->result_array();
        if ($kamar_cek) {
            $this->session->set_flashdata('danger', 'Tidak bisa diedit karena sudah digunakan');
            redirect('admin/hotel');
        } else {

            if ($cek_jumlah_kamar != $jumlah_kamar) {
                $this->db->where('id_hotel', $id_hotel);
                $this->db->delete('kamar');
                for ($i = 1; $i <= $jumlah_kamar; $i++) {
                    $data1 = [
                        'id_hotel' => $id_hotel,
                        'no_kamar' => $i
                    ];
                    $this->db->insert('kamar', $data1);
                }
            }

            // foto
            $foto = $_FILES['foto'];
            if ($foto = '') {
            } else {
                $config['upload_path'] = './template/images';
                $config['allowed_types'] = 'jpg|png|gif';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('foto')) {
                    $id_hotel = $this->input->post('id_hotel');
                    $data = [
                        'nama_hotel' => $this->input->post('nama_hotel'),
                        'latitude' => $this->input->post('latitude'),
                        'longitude' => $this->input->post('longitude'),
                        'no_telepon' => $this->input->post('no_telepon'),
                        'username_hotel' => $this->input->post('username_hotel'),
                        'password_hotel' => $this->input->post('password_hotel'),
                        'jumlah_kamar' => $this->input->post('jumlah_kamar'),
                        'alamat' => $this->input->post('alamat')
                    ];
                    $this->db->where('id_hotel', $id_hotel);
                    $this->db->update('hotel', $data);
                } else {
                    $id_hotel = $this->input->post('id_hotel');
                    $foto = $this->upload->data('file_name');
                    $cek_foto = $this->db->get_where('hotel', ['id_hotel' => $id_hotel])->row_array();
                    $cek_foto_lama = $cek_foto['foto'];
                    $lokasi = FCPATH . '/template/images/' . $cek_foto_lama;
                    unlink($lokasi);
                    $data = [
                        'nama_hotel' => $this->input->post('nama_hotel'),
                        'latitude' => $this->input->post('latitude'),
                        'longitude' => $this->input->post('longitude'),
                        'no_telepon' => $this->input->post('no_telepon'),
                        'username_hotel' => $this->input->post('username_hotel'),
                        'password_hotel' => $this->input->post('password_hotel'),
                        'alamat' => $this->input->post('alamat'),
                        'jumlah_kamar' => $this->input->post('jumlah_kamar'),
                        'foto' => $foto
                    ];
                    $this->db->where('id_hotel', $id_hotel);
                    $this->db->update('hotel', $data);
                }
            }
        }
    }

    public function hapus($id_hotel)
    {
        $this->db->where('status_kamar', '1');
        $this->db->where('id_hotel', $id_hotel);
        $kamar_cek = $this->db->get('kamar')->result_array();
        // cek Kamar
        if ($kamar_cek) {
            $this->session->set_flashdata('danger', 'Tidak bisa dihapus karena sudah digunakan');
            redirect('admin/hotel');
        } else {
            // hapus foto hotel
            $cek_foto = $this->db->get_where('hotel', ['id_hotel' => $id_hotel])->row_array();
            $cek_foto_lama = $cek_foto['foto'];
            $lokasi = FCPATH . '/template/images/' . $cek_foto_lama;
            unlink($lokasi);
            // hapus foto tipe kamar
            $cek_foto_tipe = $this->db->get_where('tipe_kamar', ['id_hotel' => $id_hotel])->result_array();
            foreach ($cek_foto_tipe as $cf) {
                $cek_foto_lama = $cf['foto_kamar'];
                $lokasi = FCPATH . '/template/images/' . $cek_foto_lama;
                unlink($lokasi);
            }
            // hapus kamar
            $this->db->where('id_hotel', $id_hotel);
            $this->db->delete('kamar');
            // hapus tipe kamar
            $this->db->where('id_hotel', $id_hotel);
            $this->db->delete('tipe_kamar');
            // hapus pemesanan selesai
            $this->db->where('id_hotel', $id_hotel);
            $this->db->delete('pemesanan_selesai');
            // hapus hotel
            $this->db->where('id_hotel', $id_hotel);
            $this->db->delete('hotel');
        }
    }

    public function cek_hotel($id_hotel)
    {
        return $this->db->get_where('hotel', ['id_hotel' => $id_hotel])->row_array();
    }
}
