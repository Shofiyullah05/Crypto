<?php
  require 'database.php';
  $bring = query("SELECT * from user");
  $data=0;
  $data = take($bring);
  if($data==0)
    echo "<script>location.href='index.php' </script>";

  
?>

<!DOCTYPE html>
<html lang="en">
<title>Home Page</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3_real.css">
<link rel="stylesheet" href="style.css">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body style="margin-bottom: 5cm;">
  <!-- Sidebar -->
  <div class="w3-teal" style="padding-top: 10px;">
    <div class="w3-container">
      <div class="topnav">
          <a  href="homepage.php">Home</a>
          <a  href="profil.php">Profil</a>
          <a class="active">Beli</a>
      </div>
    </div>
  </div>
  <center>
    <div>
      <div class="grid-container" style="text-align: center; width: 50%;" >
        <div class="item" style="padding-top: 40px;">
          <img id="icon" src="https://indodax.com/v2/logo/png/color/btc.png" style="width: 200px; height: auto;">
        </div>
        <div class="item" style="text-align: left;">
          <h1>Tags</h1>
          <button class="button1"><b>Harga Beli</b></button>
          <button class="button1"><b>Harga Jual</b></button>
          <br>
          <button class="button1"><b>Volume Transaksi</b></button>
          <button class="button1"><b>Trade Currency</b></button>
        </div>
      </div>
      <div style="text-align: center; width: 50%;">
        <h1 id="judul">Judul</h1>
   
          <div class="grid-buy">
            <div class="grid-line">
              <table id="passing" style=" width: auto; float: right;" >
                <tr>
                  <th>Pairs</th>
                  <th>Harga</th>
                  <th>Beli</th>
                </tr>
                <tr>
                  <td>a</td>
                  <td>a Beli</td>
                  <td>a Jual</td>
                </tr>
              </table>
            </div>
            <div class="grid-line">
              <div style="float: left; margin-left: 25px;">
                <b>Input</b>
                <input type="number" min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? 
                null : event.charCode >= 48 && event.charCode <= 57" id="angka" style="border-radius: 7px; margin-top: 60px;">
              
                <form style=" display: inline;" method="post" action="check.php">
                <input id="tanggal" type="text" name="tanggal" hidden>
                <input id="jumlah" type="text" name="jumlah" hidden>
                <input id="harga" type="text" name="harga" hidden>
                <input id="koin" type="text" name="koin" hidden>
                <!-- <button type="submit" name="submit">tes</button> -->
                <button id="submit" name="submit" type="submit" onclick="myFunction()" href="detail.php" class="button1" 
                style="background-color: chartreuse;"><b>&nbsp;BELI&nbsp;</b></button>
                </form>
              </div>
            </div>
          </div>
       
        <h3 id="detail" style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. 
          Quo veritatis quas fuga a natus! Harum illum dignissimos ad 
          libero, ex corporis in ratione voluptates cupiditate temporibus 
          sed quidem? Ratione, at.</h3>
      </div>
    </div>
  </center>
  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="script.js"></script>
<script>
  var myData = localStorage['objectToPass'];
  console.log(myData)
  klikTable2(myData)
  var x
  var d = new Date(); // for now
  d.getHours(); // => 9
  d.getMinutes(); // =>  30
  d.getSeconds(); // => 51
  localStorage.setItem( 'dataDetail', myData );
  $('#angka').on('change keyup paste',function(){
    x = $('#angka').val()
    console.log(x)
    localStorage.setItem( 'dataAngka', `${$('#angka').val()}` );
    $.ajax({
        url : "https://indodax.com/api/summaries",
        success:function(data){
          
          $('#tanggal').val(`${d}`)
          $('#jumlah').val(`${x} `)
          $('#harga').val(`${data.tickers[myData].buy}`)
          $('#koin').val(`${data.tickers[myData].name} `)
        },
        error:function(err){
            alert(err)
        }
    })
  })
  
  


</script>
</body>
</html>