<?php
//masukkan libary DomPDF
require_once 'vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

//instalasi objek Dompdf
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //ambil data dari form html
    $nama = htmlspecialchars($_POST['nama']);
    $nis = htmlspecialchars($_POST['nis']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $alasan = htmlspecialchars($_POST['alasan']);
    $tgl_mulai = date('d F Y', strtotime($_POST['tgl_mulai']));
    $tgl_selesai = date(' d F Y', strtotime($_POST['tgl_selesai']));
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $tgl_sekarang = date('d F Y');

//template halaman pdf
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat</title>
    <style>y
        body{
            font-family: "Times New Roman";
            font-size: 12pt;
            margin: 20px;
        }
        .kop{
            font-family: "century gothic";
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .kop h2{
           margin: 0;
           font-size: 16pt;
           text-transform: uppercase;
        }
        .kop p{
           margin: 2px;
           fony-size: 10pt;
        }
        .title{
        text-align: center;
        font-weight: bold;
        text-decoration: underline;
        margin-bottom: 25px;
        }
        .content{
            line-height: 1.6;
            text-align: justify;
        }
        .table-data{
            margin: 15px 0 15px 30px;
            width: 100%;
        }
        .table-data td{
            padding: 4px 0;
            vertical-align: top;
        }
        .ttd-container{
            width: 100%;
            margin-top: 50px;
        }
        .ttd-box{
            float: right;
            width: 200px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="kop">
       <h2>SMK TEXMACO SEMARANG</h2>
       <p>Jl. Raya Mangkang kulon  telp (024) 223-8889</p>
    </div>

    <div class="title">SURAT IZIN MENINGGALKAN KELAS</div>
    <div class="content">
        <p>Yang bertanda tangan dibawah ini</p>
        <table class="table-data">
            <tr>
              <td width="130">Nama</td>
              <td width="15">:</td>
              <td><b>' .$nama . '</b></td>
            </tr>
            <tr>
              <td width="130"> NIS</td>
              <td width="15">:</td>
              <td>' .$nis . '</td>
            </tr>
            <tr>
              <td>Kelas</td>
              <td>:</td>
              <td>' .$kelas .'</td>
            </tr>
        </table>

        <p>Bermaksud untuk mengajukan izin meninggalkan kelas, 
                 pada tanggal <b>' .$tgl_mulai .'</b>
                 sampai tanggal <b>' .$tgl_selesai .'</b>
                 dikarenakan <b>' .$alasan .'</b>
        </p>
        '.($keterangan ?  '<p>Detail  Keterangan: '
        . $keterangan .'</p>' : '').'
        <p>Demikian surat pengajuan izin ini saya buat.
        Atas perhatian dan pengertian Bapak/Ibu,
        saya ucapkan terima kasih.
        </p>
    </div>

    <div class="ttd-container">
        <div class="ttd-box">
            <p>Semarang, '.$tgl_sekarang .'<br>Hormat Saya,</br>
            <br><br><br>
            <p><b>('. $nama .')</b></p>
        </div>
    </div>
</body>
</html>

';

    //3. Konfigurasi dan inisialisasi Dompdf
    $options = new Options();
    $options->set('isRemoteEnabled', true); //Mmeungkinkan load gambar jika ada
    $dompdf = new Dompdf($options);

    // 4. Render HTML ke PDF
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'potrait');
    $dompdf->render();

    // 5. Stream PDF ke Browser
    $dompdf->stream("Surat_Izin_" . str_replace(' ','_', $nama) . ".pdf", ["Attachment" => false]);
}
?>