<?php
require 'database.php';
resetr();

if (isset($_POST["submit"])) {
    //jika sudah ditekan dijalankan function tambah
    $bool = true;
    $tes = $_POST;
    $data = query("SELECT * FROM user");
    foreach ($data as $item) {
        if ($tes['email'] == $item['email']) {

            $vara = $item['id'];
            hapus($vara);
            tambah($item);
            echo "<script>alert('Selamat Datang Di Lord Crypto');</script>";
            echo "<script>location.href='homepage.php'</script>";
            $bool = false;
        }
    }

    if ($bool) {
        $ler = $tes['email'];
        echo "<script>alert('$ler Akun anda belum terdaftar');</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <title>Login - Lord Crypto</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
</head>

<body>
    <div class="landing">
        <p>Selamat <span>Datang</span></p>
        <p> Di <span>Lord Trading Crypto</span> !</P>
        <!-- <img src="unnamed.jpg" width="150" height="150" align="center" border="5" />
        <img src="go.jfif" width="150" height="150" align="center" border="5" /> -->
        <div class="slideshow-container" style="text-align: center; padding: 20px;">

            <div class="mySlides fade">
                <div class="numbertext"></div>
                <img src="unnamed.jpg" width="160" height="160" align="center" />
                <div class="text"></div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext"></div>
                <img src="logo.png" width="170" height="160" align="center" />
                <div class="text"></div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext"></div>
                <img src="bit.jpg" width="150" height="150" align="center" border="5" />
                <div class="text"></div>
            </div>
            <div style="text-align:center">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>

        </div>
    </div>

    <div id="card">
        <div id="card-content">
            <div id="card-title">
                <img src="unnamed.jpg" width="100" height="100">
                <h2>LOGIN</h2>
                <div class="underline-title">

                </div>
            </div>
            <div class="form">
                <form method="post">
                    <center>
                        <input id="user-email" class="form-content" style="width: 100%" placeholder="Email" type="Email" name="email" autocomplete="on" required />
                        <br>
                        <br>
                        <input id="user-password" class="form-content" style="width: 100%" placeholder="Password" type="Password" name="password" required />
                        <button id="submit-btn" type="submit" name="submit">LOGIN</button>
                        <br> <br>
                        <br>
                        <br>
                        <br>
                        <a href="" onClick="alert('Pakai Akun Google Saja')" id="signup">Belum punya akun?</a>
                    </center>
                </form>

            </div>
        </div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://www.w3schools.com/lib/w3.js"></script>
<script src="script.js"></script>
<script>
    showSlides()
    console.log(globalklik)
    updateDataAPI()
</script>

</html>