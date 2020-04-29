<?php
Class Produk extends CI_Controller {
    var $api = "";
    function __construct() {
        parent::__construct();
        $this->api = "http://localhost/rest-server/index.php";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
    }
    // menampilkan data produk
    function index() {
		$data['data_produk'] = json_decode($this->curl->simple_get($this->api . '/produk'));
        $this->load->view('produk/v_list', $data);
    }
    // simpan data produk
    function simpan() {
        if (isset($_POST['submit'])) {
            $data = array(
                'nama_produk' => $this->input->post('nama_produk'),
                'tipe_produk' => $this->input->post('tipe_produk'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'));
            $insert = $this->curl->simple_post($this->api . '/produk', $data, array(CURLOPT_BUFFERSIZE => 10));
            if ($insert) {
                $this->session->set_flashdata('info', 'data berhasil disimpan.');
            } else {
                $this->session->set_flashdata('info', 'data gagal disimpan.');
            }
            redirect('produk');
        } else {
            $this->load->view('produk/v_form');
        }
    }
    // edit data produk
    function edit() {
        if (isset($_POST['submit'])) {
            $data = array(
                'id' => $this->input->post('id'),
                'nama_produk' => $this->input->post('nama_produk'),
                'tipe_produk' => $this->input->post('tipe_produk'),
                'harga' => $this->input->post('harga'),
                'stok' => $this->input->post('stok'));
            $update = $this->curl->simple_put($this->api . '/produk', $data, array(CURLOPT_BUFFERSIZE => 10));
           
            if ($update) {
                $this->session->set_flashdata('info', 'Data Berhasil diubah');
            } else {
                $this->session->set_flashdata('info', 'Data Gagal diubah');
            }
            redirect('produk');
        } else {
            $params = array('id' => $this->uri->segment(3));
            $data['data_produk'] = json_decode($this->curl->simple_get($this->api . '/produk', $params));
            $this->load->view('produk/v_edit', $data);
        }
    }
    // hapus data produk berdasarkan id
    function delete($id) {
        if (empty($id)) {
            redirect('produk');
        } else {
            $delete = $this->curl->simple_delete($this->api . '/produk', array('id' => $id), array(CURLOPT_BUFFERSIZE => 10));
            if ($delete) {
                $this->session->set_flashdata('info', 'Data Berhasil dihapus');
            } else {
                $this->session->set_flashdata('info', 'Data Gagal dihapus');
            }
            redirect('produk');
        }
    }
}
