<?php
class Penjualan extends CI_Controller
{
	var $api = "";
	function __construct()
	{
		parent::__construct();
		$this->api = "http://localhost/rest-server/index.php";
		$this->load->library('session');
		$this->load->library('curl');
		$this->load->helper('form');
		$this->load->helper('url');
	}
	function index()
	{
		$params = array('nomor_transaksi' => $this->session->userdata('s_nomor_transaksi'));
		$data['data_penjualan'] = json_decode($this->curl->simple_get($this->api . '/penjualan', $params));
		//print_r(	$data['data_penjualan'] );
		$this->load->view('penjualan/v_list', $data);
	}

	function transaksi_baru()
	{
		$this->session->set_userdata('s_nomor_transaksi', "");
		if ($this->session->userdata('s_nomor_transaksi') == "") {
			$nomor = json_decode($this->curl->simple_post($this->api . '/penjualan/nomor_transaksi'));
			$this->session->set_userdata('s_nomor_transaksi', $nomor->nomor_transaksi);
		}
		redirect('penjualan/index', 'refresh');
	}

	function tambah_barang()
	{
		if ($this->session->userdata('s_nomor_transaksi') != "") {
			$data['pilih_barang'] = json_decode($this->curl->simple_get($this->api . '/penjualan/pilihbarang'));
			$this->load->view('penjualan/v_form', $data);
		}
	}

	public function simpan()
	{
		if (isset($_POST['submit'])) {
			$nomor_transaksi = $this->session->userdata('s_nomor_transaksi');
			$params = array('id' =>  $this->input->post('id_produk'));
			$apis = $this->api . '/produk';
			$produk = json_decode($this->curl->simple_get($apis, $params));
			
			$data = array(
				'nomor_transaksi' => $nomor_transaksi,
				'id_produk' => $this->input->post('id_produk'),
				'jumlah' => $this->input->post('jumlah'),
				'harga' => $produk[0]->harga,
				'subtotal' => $this->input->post('jumlah') * $produk[0]->harga,
			);

		
			$insert = $this->curl->simple_post($this->api . '/penjualan/simpan_penjualan', $data, array(CURLOPT_BUFFERSIZE => 10));
			if ($insert) {
				$this->session->set_flashdata('info', 'data berhasil disimpan.');
			} else {
				$this->session->set_flashdata('info', 'data gagal disimpan.');
			}
			redirect('penjualan');
		} else {
			$this->load->view('produk/v_form');
		}
	}
}
