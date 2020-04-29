<?php
echo form_open_multipart('penjualan/simpan'); ?>
<h1>TAMBAH DATA</h1>
<table>
    <tr>
        <td>NOMOR TRANSAKSI</td>
        <td><?php echo form_input('nomor_transaksi', $this->session->userdata('s_nomor_transaksi'), "disabled"); ?></td>
    </tr>
    <tr>
        <td>TIPE PRODUK</td>
        <td>
            <select class="form-control" name="id_produk" required>
                <option value="">No Selected</option>
                <?php foreach ($pilih_barang as $row) : ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->nama_produk; ?></option>
                <?php endforeach; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td>Jumlah</td>
        <td><?php echo form_input('jumlah'); ?></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="2">
			<?php echo form_submit('submit', 'Simpan'); ?>
			<?php echo anchor('penjualan', '| Kembali | '); ?>
			<?php echo anchor('produk', 'Produk | '); ?>
		</td>
    </tr>
</table>
<?php
echo form_close();
?>
