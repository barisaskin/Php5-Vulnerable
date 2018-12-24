<?php 
session_start();
include("../config.php");
$user= isset($_SESSION["user"])?$_SESSION["user"]:"yok";
if($user!="yok"){
    echo "<script>window.location.href='".Site_url."/admin/index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>W3.CSS Template</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--<link rel="stylesheet" href="<?php echo Site_url;?>/css/w3.css">-->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}</style>
    </head>
    <body class="w3-light-grey">
        <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
            <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
            <a class="w3-bar-item w3-left" href="<?php echo Site_url;?>">Siteye Git</a>
        </div>
        <br><br>
        <div class="w3-main" style="margin-left:200px;margin-top:100px;margin-right:200px;">

            <div class="w3-row-padding w3-margin-bottom">
            
                <form action="login.php" method="post">
                    <div class="w3-container">
                        <label for="uname"><b>Kullanıcı Adı</b></label>
                        <input type="text" placeholder="Kullanıcı Adı" name="kullanici_adi" required class="w3-input w3-block">

                        <label for="psw"><b>Şifre</b></label>
                        <input type="password" placeholder="Şifre" name="sifre" required class="w3-input w3-block">
                        <!--  ' or 1='1   -->

                        <br>
                        <button type="submit" class="w3-button w3-btn w3-green w3-block" name="giris">Giriş Yap</button>
                    </div>
                </form>
                <?php 
                $giris=isset($_POST["giris"])?$_POST["giris"]:"yok";
                if($giris!="yok"){
                    $kullanici_adi=$_POST["kullanici_adi"];
                    $sifre=$_POST["sifre"];
                    if($kullanici_adi && $sifre){
                        $sorgu=mysql_query("select * from admin where kullanici_adi='".$kullanici_adi."' and sifre='".$sifre."'");
                        $toplam=mysql_num_rows($sorgu);
                        if($toplam){
                            $_SESSION["user"] = $kullanici_adi;
                            echo "<script>window.location.href='".Site_url."/admin';</script>";
                        }
                    }
                }               
                ?>
            </div> 
        </div> 
    </body>
</html>