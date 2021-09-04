<!DOCTYPE html>
<html lang="in">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Invoice</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.min.js" integrity="sha512-XKa9Hemdy1Ui3KSGgJdgMyYlUg1gM+QhL6cnlyTe2qzMCYm4nAZ1PsVerQzTTXzonUR+dmswHqgJPuwCq1MaAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>

body{
font-size:14px;
}
.logo{
width:50px;
}
.table1{
width:60%;
margin:auto;
display:block;
text-align:center;
padding:10px;
}
.padd{
padding:0 15px;
}
.font-weight-bold{
font-size:18px;
}
.searchbox{
width:70%;
margin:10px;
}
</style>
</head>
<body>

<?php
$cari = $_GET['cari'];
$url = "https://bukaolshop.net/api/v1/transaksi/id?";
$query = http_build_query(
  array("nomor_pembayaran"=>$cari)
);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url.$query);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Accept: application/json",
   "Authorization: Bearer T2lhYnpkaWJZL1M5THVRVnJqMGMvbUhwaDFZa3A1clFMcjI4M2pGRFFmUFNGSllCeWt4UWZ5YkdEQStLT1hFak5PK3pNVVBER1hnNEFscEdKTW9SdEE9PQ==",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);


$json = $resp;
$data = json_decode($json);

?>

<div class="searchbox">
<div class="input-group">
<form methode="get" action="invoice.php">
  <input name="cari" type="text" class="form-control rounded" placeholder="Masukkan nomor pesanan" />
  <button type="submit" class="btn btn-outline-primary"><i class="fas fa-search"></i></button>
</form>
</div>
</div>

<table class="table1">
<tr>
<td>
<table class="table2">
<tr>
<td><img src="monitor.png" alt="logo" class="logo"></td>
</tr>
</table>
</td>
<td class="padd">
<table class="table2">
<tr>
<td class="font-weight-bold">EREF STORE</td>
</tr>
<tr>
<td class="font-weight-light">Mudah Cepat Aman</td>
</tr>
</table>
</td>
</tr>
</table>

<table class="table table-striped">
  <tbody>
    <tr>
<td>Nomor Pembayaran</td>
<td>:</td>
<td><?php echo "#".$data->nomor_pembayaran; ?></td>
    </tr>
    <tr>
<td>Produk</td>
<td>:</td>
<td><?php echo $data->data_pesanan[0]->data_produk[0]->nama_barang; ?></td>
    </tr>
    <tr>
<td>Catatan</td>
<td>:</td>
<td><?php echo $data->data_pesanan[0]->data_produk[0]->catatan; ?></td>
    </tr>
    <tr>
<td>SN</td>
<td>:</td>
<td><?php echo $data->data_pesanan[0]->data_produk[0]->nomor_resi; ?></td>
    </tr>
    <tr>
<td>Waktu Pembelian</td>
<td>:</td>
<td><?php echo $data->tanggal_buat; ?></td>
    </tr>
    <tr>
<td>Diskon</td>
<td>:</td>
<td><?php echo $data->potongan; ?></td>
    </tr>
    <tr>
<td>Total Harga</td>
<td>:</td>
<td>
<?php echo number_format($data->data_pesanan[0]->data_produk[0]->total_harga, 0, '', '.'); ?></td>
    </tr>
    <tr>
<td>Status</td>
<td>:</td>
<td class="text-uppercase"><?php echo $data->status_pengiriman; ?></td>
    </tr>
    </tbody>
</table>
<center><button onClick="window.print();" class="btn btn-info">PRINT</button></center>
</body>
</html>
