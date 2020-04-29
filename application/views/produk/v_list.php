<font color="orange">
<?php echo $this->session->flashdata('info'); ?>
</font>
<h1>DATA PRODUK</h1>
<table border="1">
    <tr>
        <th>ID</th>
        <th>NAMA</th>
        <th>TIPE PRODUK</th>
        <th>HARGA</th>
        <th>STOK</th>
        <th>AKSI</th>
    </tr>
    <?php
    foreach ($data_produk as $produk) {
        echo "<tr>
              <td>$produk->id</td>
              <td>$produk->nama_produk</td>
              <td>$produk->tipe_produk</td>
              <td>$produk->harga</td>
              <td>$produk->stok</td>
              <td>" . anchor('produk/edit/' . $produk->id, 'Edit') . "
                  " . anchor('produk/delete/' . $produk->id, 'Delete') . "</td>
              </tr>";
    }
    ?>
</table>
<a href=<?=base_url()?>index.php/produk/simpan>+ Tambah data</a>
