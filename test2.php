<?php
include_once 'config/api.php';
$api = new Apiwilayah();

$data = $api->getprov();

if (!empty($_POST['provinsi'])) {
  $datakota = $api->getkota($_POST['provinsi']);
  // echo '<pre>';
  // var_dump($datakota);
  // echo '</pre>';
}
if (!empty($_POST['kota'])) {
  $datakecamatan = $api->getkecamatan($_POST['kota']);
  // echo '<pre>';
  // var_dump($datakecamatan);
  // echo '</pre>';
}
if (!empty($_POST['kecamatan'])) {
  $datadesa = $api->getdesa($_POST['kecamatan']);
  // echo '<pre>';
  // var_dump($datadesa);
  // echo '</pre>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="" method="post">
    <select name="provinsi" id="" onchange="this.form.submit()">
      <option value="">-- pilih provinsi --</option>
      <?php foreach ($data as $province => $pro) : ?>
        <option value="<?= $pro['id']; ?>" <?php
                                            if (!empty($_POST['provinsi'])) {
                                              if ($pro['id'] == $_POST['provinsi']) {
                                                echo 'selected';
                                              }
                                            } ?>>
          <?= $pro['name']; ?>
        </option>
      <?php endforeach ?>
    </select>
    <select name="kota" id="" onchange="this.form.submit()">
      <option value="">-- pilih kota --</option>
      <?php foreach ($datakota as $kota => $ko) : ?>
        <option value="<?= $ko['id']; ?>" <?php
                                          if (!empty($_POST['kota'])) {
                                            if ($ko['id'] == $_POST['kota']) {
                                              echo 'selected';
                                            }
                                          } ?>>
          <?= $ko['name']; ?>
        </option>
      <?php endforeach ?>
    </select>
    <select name="kecamatan" id="" onchange="this.form.submit()">
      <option value="">-- pilih kecamatan --</option>
      <?php foreach ($datakecamatan as $kecamatan => $kec) : ?>
        <option value="<?= $kec['id']; ?>" <?php
                                            if (!empty($_POST['kecamatan'])) {
                                              if ($kec['id'] == $_POST['kecamatan']) {
                                                echo 'selected';
                                              }
                                            } ?>>
          <?= $kec['name']; ?>
        </option>
      <?php endforeach ?>
    </select>
    <select name="desa" id="" onchange="this.form.submit()">
      <option value="">-- pilih desa --</option>
      <?php foreach ($datadesa as $desa => $des) : ?>
        <option value="<?= $des['id']; ?>" <?php
                                            if (!empty($_POST['desa'])) {
                                              if ($des['id'] == $_POST['desa']) {
                                                echo 'selected';
                                              }
                                            } ?>>
          <?= $des['name']; ?>
        </option>
      <?php endforeach ?>
    </select>
  </form>

  <?php
  if (!empty($_POST)) {
    echo $_POST['provinsi'] . '-';
    echo $_POST['kota'] . '-';
    echo $_POST['kecamatan'] . '-';
    echo $_POST['desa'];

    echo '<hr>';

    echo $api->getNamaProv($_POST['provinsi']) . '-';
    echo $api->getNamaKota($_POST['kota']) . '-';
    echo $api->getNamaKecamatan($_POST['kecamatan']) . '-';
    echo $api->getNamaDesa($_POST['desa']) . '-';
  }
  ?>


</body>

</html>