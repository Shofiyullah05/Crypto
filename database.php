<?php
    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
    // Koneksikan Gan
    $conn = mysqli_connect("localhost", "root", "", "cryptodata");
    if(!$conn)
        die('gagal konek databasenya :(');

    function query($query){
        global $conn;
        $data = mysqli_query($conn, $query);
        $hasil = array();
        while( $i = mysqli_fetch_assoc($data) ) {
            $hasil[] = $i;
        }
        return $hasil;
    }

    function tambah($tesdata){
        global $conn;
        $var = $tesdata['id'];
        $var1 = $tesdata['username'];
        $var2 = $tesdata['email'];
        $var3 = $tesdata['login'];
        $query = "INSERT INTO user
                VALUES
                ('', '$var1', '$var2', 'true')
            ";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
    function tambah2($okejek, $mail){
        global $conn;
        $var = $okejek['tanggal'];
        $var1 = $okejek['jumlah'];
        $var2 = $okejek['harga'];
        $var3 = $okejek['koin'];
        $var4 = $mail['email'];
        $query = "INSERT INTO riwayat
                VALUES
                ('', '$var', '$var1', '$var2', '$var3', '$var4')
            ";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }
    function hapus($id){
        global $conn;
        mysqli_query($conn, "DELETE FROM user WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    function resetr(){
        global $conn;
        $data = query("SELECT * FROM user");
        foreach ($data as $item) { 
            $vara = $item['id'];
            hapus($vara);
            $var = $item['id'];
            $var1 = $item['username'];
            $var2 = $item['email'];
            $var3 = $item['login'];
            $query = "INSERT INTO user
                VALUES
                ('', '$var1', '$var2', 'Null')
            ";
            mysqli_query($conn, $query);
        }
    }
    function take($data){
        foreach ($data as $item) { 
            if($item['login']=='true'){
                return $item;
            }
        }

        return 0;
    }
    ?> 
