<?php echo form_open('produk/edit'); ?>
<?php echo form_hidden('id', $data_produk[0]->id); ?>
<h1>EDIT PRODUK</h1>
<table>
    <tr><td>ID</td><td><?php echo form_input('', $data_produk[0]->id, "disabled"); ?></td></tr>
    <tr><td>NAMA</td><td><?php echo form_input('nama_produk', $data_produk[0]->nama_produk); ?></td></tr>
    <tr><td>TIPE PRODUK</td><td><?php echo form_input('tipe_produk', $data_produk[0]->tipe_produk); ?></td></tr>
    <tr><td>HARGA</td><td><?php echo form_input('harga', $data_produk[0]->harga); ?></td></tr>
    <tr><td>STOK</td><td><?php echo form_input('stok', $data_produk[0]->stok); ?></td></tr>
    <tr><td colspan="2">
            <?php echo form_submit('submit', 'Simpan'); ?>
            <?php echo anchor('produk', 'Kembali'); ?></td></tr>
</table>
<?php
echo form_close();
?>