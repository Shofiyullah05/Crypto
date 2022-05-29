<?php
require 'database.php';
$bring = query("SELECT * from user");
$data = 0;
$data = take($bring);
if ($data == 0)
    echo "<script>location.href='index.php' </script>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Invoice</title>
    <link rel="stylesheet" href="w3_real.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="w3-teal" style="padding-top: 10px;">
        <div class="w3-container">
            <div class="topnav">
                <a href="homepage.php">Home</a>
                <a href="profil.php">Profil</a>
                <a href="halamanbeli.php">Beli</a>
            </div>
        </div>
    </div>

    <div class="center">
        <p class="invoice"><b>No Invoice &nbsp &nbsp &nbsp:</b> 10/px/A/75L/987I/9/F/00A</p>
        <p id="date" class="invoice">Date Invoice : </p>

        <div class="card">
            <div class="card-content">
                <div class="item" style="padding-top: 20px;">
                <center>
                <img id="icon" src="https://indodax.com/v2/logo/png/color/btc.png" style="width: 150px; height: auto;">
                </center>
                </div>
                <h1 id="judul" class="namaCrpto">TKO/BIDR</h1>
                <h5 id="pair">Lord Crypto</h5>
                <h1 class="card-header"><b> Detail Pembelian </b></h1>
                <p id="harga">Beli di Harga : </p>
                <p id="jumlah">Jumlah Unit : </p>
                <p id="total">Total Beli : </p>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script>
        var myData = localStorage['dataDetail'];
        var myAngka = localStorage['dataAngka'];
        var icon = document.querySelector('#icon');
        var d = new Date(); // for now
        d.getHours(); // => 9
        d.getMinutes(); // =>  30
        d.getSeconds(); // => 51

        $('#date').html(`<b>Date Invoice &nbsp: </b> ${d}`)
        $.ajax({
            url: "https://indodax.com/api/summaries",
            success: function(data) {
                $('#judul').html(`${data.tickers[myData].name}`)
                $('#pair').html(`${myData} `)
                $('#harga').html(`Beli di Harga &nbsp: ${data.tickers[myData].buy} `)
                $('#jumlah').html(`Jumlah Unit &nbsp&nbsp: ${myAngka} `)
                $('#total').html(`Total Beli &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: ${myAngka*data.tickers[myData].buy} `)
                
            },
            error: function(err) {
                alert(err)
            }
        })
        $.ajax({
            url : "https://indodax.com/api/pairs",
            success : function(data){
                for(var keyGambar = 0; keyGambar< data.length; keyGambar++){
                    if(myData==data[keyGambar].ticker_id)
                    icon.src = data[keyGambar].url_logo_png
                }
            },
            error : function(err){
                alert("data gambar gagal di ambil")
            }
        })
    </script>
    <script src="script.js"></script>
</body>

</html>
