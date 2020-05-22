<?php
class Login extends CI_COntroller
{
    public function check()
    {
        if ($this->input->post('username')) {
            if ($this->input->post('password')) {
                if ($this->input->post('hak_akses') == 'admin') {
                    // Jika login sebagai admin
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    $user = $this->db->get_where('login', ['username' => $username])->row_array();
                    if ($user) {
                        if (password_verify($password, $user['password'])) {
                            $data = [
                                'username' => 'admin aplikasi',
                                'hak_akses' => '1'
                            ];
                            $this->session->set_userdata($data);
                            $this->session->set_flashdata('sukses', 'anda berhasil login sebagai admin');
                            redirect('admin/home');
                        } else {
                            $this->session->set_flashdata('danger', 'password salah');
                            redirect('user/home');
                        }
                    } else {
                        $this->session->set_flashdata('danger', 'username tidak ditemukan');
                        redirect('user/home');
                    }
                } else {
                    // Jika Login sebagai operator hotel
                    $username_hotel = $this->input->post('username');
                    $password_hotel = $this->input->post('password');
                    $id_hotel = $this->input->post('hak_akses');
                    $hotel = $this->db->get_where('hotel', ['id_hotel' => $id_hotel])->row_array();
                    if ($username_hotel == $hotel['username_hotel']) {
                        if ($password_hotel == $hotel['password_hotel']) {
                            $data = [
                                'username' => 'Operator ' . $hotel['nama_hotel'],
                                'id_hotel' => $id_hotel,
                                'hak_akses' => '2'
                            ];
                            $this->session->set_userdata($data);
                            $this->session->set_flashdata('sukses', 'anda berhasil login sebagai operator');
                            redirect('operator/home/index/' . $id_hotel);
                        } else {
                            $this->session->set_flashdata('danger', 'password salah');
                            redirect('user/home');
                        }
                    } else {
                        $this->session->set_flashdata('danger', 'username salah');
                        redirect('user/home');
                    }
                }
            } else {
                $this->session->set_flashdata('danger', 'password belum diisi');
                redirect('user/home');
            }
        } else {
            $this->session->set_flashdata('danger', 'username belum diisi');
            redirect('user/home');
        }
    }

    public function insert()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT)
        ];
        $this->db->insert('login', $data);
        $this->session->set_flashdata('sukses', 'Username baru ditambahkan');
        redirect('user/home');
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('hak_akses');
        $this->session->set_flashdata('sukses', 'Anda Berhasil Logout');
        redirect('user/home');
    }
}
