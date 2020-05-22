<?php
class Tipe_kamar_model extends CI_Model
{
    public function tambah()
    {
        $foto_kamar = $_FILES['foto_kamar'];
        $id_hotel = $this->input->post('id_hotel');
        if ($foto_kamar = '') {
        } else {
            $config['upload_path'] = './template/images';
            $config['allowed_types'] = 'jpg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto_kamar')) {
                $this->session->set_flashdata('danger', 'belum mengisi foto_kamar');
                redirect('operator/tipe_kamar/tambah/' . $id_hotel);
            } else {
                $foto_kamar = $this->upload->data('file_name');
            }
        }
        $data = [
            'tipe_kamar' => $this->input->post('tipe_kamar'),
            'harga_kamar' => $this->input->post('harga_kamar'),
            'keterangan' => $this->input->post('keterangan'),
            'foto_kamar' => $foto_kamar,
            'id_hotel' => $id_hotel
        ];
        $this->db->insert('tipe_kamar', $data);
    }

    public function hapus($id_tipe_kamar)
    {
        $cek_foto = $this->db->get_where('tipe_kamar', ['id_tipe_kamar' => $id_tipe_kamar])->row_array();
        $id_hotel = $cek_foto['id_hotel'];
        $cek_foto_lama = $cek_foto['foto_kamar'];
        $lokasi = FCPATH . '/template/images/' . $cek_foto_lama;
        unlink($lokasi);
        $this->db->where('id_tipe_kamar', $id_tipe_kamar);
        $this->db->delete('tipe_kamar');
        $this->session->set_flashdata('sukses', 'Data dihapus');
        redirect('operator/tipe_kamar/index/' . $id_hotel);
    }

    public function cek_tipe_kamar($id_tipe_kamar)
    {
        return $this->db->get_where('tipe_kamar', ['id_tipe_kamar' => $id_tipe_kamar])->row_array();
    }

    public function edit()
    {
        $id_tipe_kamar = $this->input->post('id_tipe_kamar');
        // foto_kamar
        $foto_kamar = $_FILES['foto_kamar'];
        if ($foto_kamar = '') {
        } else {
            $config['upload_path'] = './template/images';
            $config['allowed_types'] = 'jpg|png|gif';

            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('foto_kamar')) {
                $id_hotel = $this->input->post('id_hotel');
                $data = [
                    'tipe_kamar' => $this->input->post('tipe_kamar'),
                    'harga_kamar' => $this->input->post('harga_kamar'),
                    'keterangan' => $this->input->post('keterangan')
                ];
                $this->db->where('id_tipe_kamar', $id_tipe_kamar);
                $this->db->update('tipe_kamar', $data);
            } else {
                $foto_kamar = $this->upload->data('file_name');
                $cek_foto = $this->db->get_where('tipe_kamar', ['id_tipe_kamar' => $id_tipe_kamar])->row_array();
                $cek_foto_lama = $cek_foto['foto_kamar'];
                $lokasi = FCPATH . '/template/images/' . $cek_foto_lama;
                unlink($lokasi);
                $data = [
                    'tipe_kamar' => $this->input->post('tipe_kamar'),
                    'harga_kamar' => $this->input->post('harga_kamar'),
                    'keterangan' => $this->input->post('keterangan'),
                    'foto_kamar' => $foto_kamar
                ];
                $this->db->where('id_tipe_kamar', $id_tipe_kamar);
                $this->db->update('tipe_kamar', $data);
            }
        }
    }
}
