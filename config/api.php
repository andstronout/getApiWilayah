<?php
class Apiwilayah
{
  public function getprov()
  {
    // API URL
    $api_url = 'http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json';

    // Get the JSON response from the API
    $response = file_get_contents($api_url);

    // Check if the response is not empty
    if (!empty($response)) {
      // Decode the JSON response into an associative array
      $data = json_decode($response, true);

      $provinces = array_map(function ($province) {
        return array(
          'id' => $province['id'],
          'name' => $province['name']
        );
      }, $data);
    }

    return $provinces;
  }

  public function getkota($idprov)
  {
    $idprov = null;
    if (!empty($_POST)) {
      $idprov = $_POST['provinsi'];

      // API URL
      $kota_url = "http://www.emsifa.com/api-wilayah-indonesia/api/regencies/" . $idprov . ".json";

      // Get the JSON response from the API
      $responsekota = file_get_contents($kota_url);
    }

    // Check if the responsekota is not empty
    if (!empty($responsekota)) {
      // Decode the JSON responsekota into an associative array
      $data = json_decode($responsekota, true);

      // var_dump($data);

      $kota = array_map(function ($kota) {
        return array(
          'id' => $kota['id'],
          'name' => $kota['name']
        );
      }, $data);
    }
    return $kota;
  }
  public function getkecamatan($idkota)
  {
    $idkota = null;
    if (!empty($_POST)) {
      $idkota = $_POST['kota'];

      // API URL
      $kecamatan_url = "http://www.emsifa.com/api-wilayah-indonesia/api/districts/" . $idkota . ".json";

      // Get the JSON response from the API
      $responsekecamatan = file_get_contents($kecamatan_url);
    }

    // Check if the responsekecamatan is not empty
    if (!empty($responsekecamatan)) {
      // Decode the JSON responsekecamatan into an associative array
      $data = json_decode($responsekecamatan, true);

      // var_dump($data);

      $kecamatan = array_map(function ($kecamatan) {
        return array(
          'id' => $kecamatan['id'],
          'name' => $kecamatan['name']
        );
      }, $data);
    }
    return $kecamatan;
  }
  public function getdesa($idkecamatan)
  {
    $idkecamatan = null;
    if (!empty($_POST)) {
      $idkecamatan = $_POST['kecamatan'];

      // API URL
      $desa_url = "http://www.emsifa.com/api-wilayah-indonesia/api/villages/" . $idkecamatan . ".json";

      // Get the JSON response from the API
      $responsedesa = file_get_contents($desa_url);
    }

    // Check if the responsedesa is not empty
    if (!empty($responsedesa)) {
      // Decode the JSON responsedesa into an associative array
      $data = json_decode($responsedesa, true);

      // var_dump($data);

      $desa = array_map(function ($desa) {
        return array(
          'id' => $desa['id'],
          'name' => $desa['name']
        );
      }, $data);
    }
    return $desa;
  }

  public function getNamaProv($idprov)
  {
    // Ambil data provinsi
    $namaprovinsi = $this->getprov();

    // ambil id Provinsi
    $idprov = $_POST['provinsi'];

    // Search for the ID in the data and extract the name
    $province_name = null;
    foreach ($namaprovinsi as $province) {
      if ($province['id'] == $idprov) {
        $province_name = $province['name'];
        break; // Stop the loop once the ID is found
      }
    }

    return $province_name;
  }
  public function getNamaKota($idkota)
  {
    // Ambil data kota
    $datakota = $this->getkota($_POST['provinsi']);

    // ambil id kota
    $idkota = $_POST['kota'];

    // Search for the ID in the data and extract the name
    $kota_name = null;
    foreach ($datakota as $kota) {
      if ($kota['id'] == $idkota) {
        $kota_name = $kota['name'];
        break; // Stop the loop once the ID is found
      }
    }

    return $kota_name;
  }
  public function getNamaKecamatan($idkecamatan)
  {
    // Ambil data kecamatan
    $datakecamatan = $this->getkecamatan($_POST['kota']);

    // ambil id kecamatan
    $idkecamatan = $_POST['kecamatan'];

    // Search for the ID in the data and extract the name
    $kecamatan_name = null;
    foreach ($datakecamatan as $kecamatan) {
      if ($kecamatan['id'] == $idkecamatan) {
        $kecamatan_name = $kecamatan['name'];
        break; // Stop the loop once the ID is found
      }
    }

    return $kecamatan_name;
  }
  public function getNamaDesa($iddesa)
  {
    // Ambil data desa
    $datadesa = $this->getdesa($_POST['kecamatan']);

    // ambil id desa
    $iddesa = $_POST['desa'];

    // Search for the ID in the data and extract the name
    $desa_name = null;
    foreach ($datadesa as $desa) {
      if ($desa['id'] == $iddesa) {
        $desa_name = $desa['name'];
        break; // Stop the loop once the ID is found
      }
    }

    return $desa_name;
  }
}
