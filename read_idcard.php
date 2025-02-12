<?php
include "koneksi.php";

//baca isi tabel tmprfid
$sql = mysqli_query($koneksi, "SELECT * FROM tmprfid");
$data = mysqli_fetch_array($sql);

//baca id_card
$id_card = isset($data['id_card']) ? $data['id_card'] : '';
?>


<div class="mb-3 row">
    <label class="col-sm-3 col-form-label">ID Card</label>
    <div class="col-sm-9">
        <input type="text" name="id_card" id="id_card" class="form-control" placeholder="Tempelkan ID Card" value="<?php echo $id_card; ?>">
    </div>
</div>