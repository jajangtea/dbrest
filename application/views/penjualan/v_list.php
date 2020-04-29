<font color="orange">
	<?php echo $this->session->flashdata('info'); ?>
</font>
<h1>DATA PRODUK</h1>
NOMOR TRANSAKSI :
<?= $this->session->userdata('s_nomor_transaksi'); ?>
<br>


<table border="1">
	<tr>
		<th>ID</th>
		<th>NAMA</th>
		<th>TIPE PRODUK</th>
		<th>HARGA</th>
		<th>SUBTOTAL</th>
		<th>AKSI</th>
	</tr>
	<?php

	if (count($data_penjualan) > 0) {
		$i = 1;
		foreach ($data_penjualan as $produk) {
			echo "<tr>
                  <td>" . $i++ . "</td>
                  <td>$produk->nama_produk</td>
                  <td>$produk->tipe_produk</td>
                  <td>$produk->harga</td>
                  <td>$produk->subtotal</td>
				  <td>" . anchor('produk/delete/' . $produk->id, 'Delete') . "</td>
                  </tr>";
		}
	} else {
		echo "<tr><td colspan='7'>Data tidak ditemukan</td> </tr>";
	}
	?>
</table>

<a href=<?= base_url() ?>index.php/penjualan/transaksi_baru><button>Transaksi Baru</button></a> 
<a href=<?= base_url() ?>index.php/penjualan/tambah_barang><button>Tambah Barang</button></a>
