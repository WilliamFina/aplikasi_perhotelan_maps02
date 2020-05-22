<?php
class Wisata_model extends CI_Model
{
    public function tampil()
    {
        $this->db->order_by('nama_wisata', 'ASC');
        return $this->db->get('wisata')->result_array();
    }

    public function cek_wisata($id_wisata)
    {
        return $this->db->get_where('wisata', ['id_wisata' => $id_wisata])->row_array();
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
                redirect('admin/wisata/tambah');
            } else {
                $foto = $this->upload->data('file_name');
            }
        }
        $data = [
            'nama_wisata' => $this->input->post('nama_wisata'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'alamat' => $this->input->post('alamat'),
            'foto' => $foto
        ];
        $this->db->insert('wisata', $data);
    }

    public function ubah()
    {
        // foto
        $foto = $_FILES['foto'];
        if ($foto = '') {
        } else {
            $config['upload_path'] = './template/images';
            $config['allowed_types'] = 'jpg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto')) {
                $id_wisata = $this->input->post('id_wisata');
                $data = [
                    'nama_wisata' => $this->input->post('nama_wisata'),
                    'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude'),
                    'alamat' => $this->input->post('alamat')
                ];
                $this->db->where('id_wisata', $id_wisata);
                $this->db->update('wisata', $data);
            } else {
                $id_wisata = $this->input->post('id_wisata');
                $foto = $this->upload->data('file_name');
                $cek_foto = $this->db->get_where('wisata', ['id_wisata' => $id_wisata])->row_array();
                $cek_foto_lama = $cek_foto['foto'];
                $lokasi = FCPATH . '/template/images/' . $cek_foto_lama;
                unlink($lokasi);
                $data = [
                    'nama_wisata' => $this->input->post('nama_wisata'),
                    'latitude' => $this->input->post('latitude'),
                    'longitude' => $this->input->post('longitude'),
                    'alamat' => $this->input->post('alamat'),
                    'foto' => $foto
                ];
                $this->db->where('id_wisata', $id_wisata);
                $this->db->update('wisata', $data);
            }
        }
    }

    public function hapus($id_wisata)
    {
        $cek_foto = $this->db->get_where('wisata', ['id_wisata' => $id_wisata])->row_array();
        $cek_foto_lama = $cek_foto['foto'];
        $lokasi = FCPATH . '/template/images/' . $cek_foto_lama;
        unlink($lokasi);
        $this->db->where('id_wisata', $id_wisata);
        $this->db->delete('wisata');
    }
}
