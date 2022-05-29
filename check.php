<script>
    var canceler = localStorage['cancel'];
    if(canceler=="true"){
        location.href="halamanbeli.php"
        localStorage.removeItem( 'cancel' );
    }
    else
    {   <?php
        require 'database.php';
        $bring = query("SELECT * from user");
        $data=0;
        $data = take($bring);
        if($data==0)
            echo "<script>location.href='index.php' </script>";
        if( isset($_POST["submit"])){
            $ok = $_POST;
            foreach($ok as $item){
        ?>
            console.log(`<?php echo $item; ?>`)
        <?php
            }
            tambah2($ok,$data);
            }
        ?>
        location.href="detail.php"
        localStorage.removeItem( 'cancel' );
    }
</script>