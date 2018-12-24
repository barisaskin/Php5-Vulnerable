<?php 
session_start();
include("../config.php");
$user= isset($_SESSION["user"])?$_SESSION["user"]:"yok";
if($user=="yok"){
    echo "<script>window.location.href='".Site_url."/admin/login.php';</script>";
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
        <script src="https://cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
    </head>
    <body class="w3-light-grey">
        <div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
            <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
            <a class="w3-bar-item w3-right" href="<?php echo Site_url;?>/admin?sayfa=cikis">Çıkış Yap</a>
            <a class="w3-bar-item w3-left" href="<?php echo Site_url;?>">Siteye Git</a>
        </div>
        <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
            <div class="w3-container w3-row">
                <div class="w3-col s4">
                    <img src="/w3images/avatar2.png" class="w3-circle w3-margin-right" style="width:46px">
                </div>
                <div class="w3-col s8 w3-bar"><span>Hoşgeldin, <strong><?php echo $user; ?></strong></span></div>
            </div>
            <hr>
            <div class="w3-bar-block">
                <a href="<?php echo Site_url;?>/admin" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-bell fa-fw"></i>  Yazılar</a>
                <a href="<?php echo Site_url;?>/admin?sayfa=kategoriler" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Kategoriler</a>
                <a href="<?php echo Site_url;?>/admin?sayfa=yorumlar" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>  Yorumlar</a>
                <a href="<?php echo Site_url;?>/admin?sayfa=profil" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Profil</a>
                <a href="<?php echo Site_url;?>/admin?sayfa=ayarlar" class="w3-bar-item w3-button w3-padding"><i class="fa fa-cog fa-fw"></i>  Ayarlar</a><br><br>
            </div>
        </nav>
        <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>
        <div class="w3-main" style="margin-left:300px;margin-top:43px;">

            <div class="w3-row-padding w3-margin-bottom">
                <div class="w3-quarter">
                    <div class="w3-container w3-red w3-padding-16">
                        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
                        <div class="w3-right">
                            <h3>
                                <?php echo mysql_num_rows(mysql_query("select * from yazilar")); ?>
                            </h3>
                        </div>
                        <div class="w3-clear"></div>
                        <h4>Yazı</h4>
                    </div>
                </div>
                <div class="w3-quarter">
                    <div class="w3-container w3-blue w3-padding-16">
                        <div class="w3-left"><i class="fa fa-eye w3-xxxlarge"></i></div>
                        <div class="w3-right">
                            <h3>
                                <?php echo mysql_num_rows(mysql_query("select * from kategori")); ?></h3>
                            </div>
                        <div class="w3-clear"></div>
                        <h4>Kategori</h4>
                    </div>
                </div>
                <div class="w3-quarter">
                    <div class="w3-container w3-teal w3-padding-16">
                        <div class="w3-left"><i class="fa fa-share-alt w3-xxxlarge"></i></div>
                        <div class="w3-right">
                            <h3>
                                <?php echo mysql_num_rows(mysql_query("select * from yorumlar")); ?>
                            </h3>
                        </div>
                        <div class="w3-clear"></div>
                        <h4>Yorum</h4>
                    </div>
                </div>
                <div class="w3-quarter">
                    <div class="w3-container w3-orange w3-text-white w3-padding-16">
                        <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
                        <div class="w3-right">
                            <h3>1</h3>
                        </div>
                        <div class="w3-clear"></div>
                        <h4>Admin</h4>
                    </div>
                </div>
            </div>
            <?php 
            $sayfa=isset($_GET["sayfa"])?$_GET["sayfa"]:"";
            if($sayfa=="" or $sayfa=="yazilar"){
            ?>
            <div class="w3-container">
                <table class="w3-table w3-striped w3-bordered w3-border w3-hoverable w3-white">
                <thead><td>#</td><td>Başlık</td><td>Kategori</td><td>İşlemler</td></thead>
                <?php
                    $i=0;
                    $sorgu=mysql_query("select * from yazilar");
                    while($yaz=mysql_fetch_object($sorgu)){
                        $i++;
                        $kategori=mysql_fetch_object(mysql_query("select * from kategori where id = '$yaz->kategori_id'"));
                        echo "<tr>
                                <td>$i</td>
                                <td>$yaz->baslik</td>
                                <td>$kategori->baslik</td>
                                <td><a href='".Site_url."/admin/index.php?sayfa=yazilar_duzenle&id=$yaz->id'><i class='fa fa-edit'></i></a> <a href='".Site_url."/admin/index.php?sayfa=yazilar_sil&id=$yaz->id'><i class='fa fa-remove'></i></a></td>
                            </tr>";
                    }
                ?>
                
                </table>
            </div>
            <?php }else if($sayfa=="yazilar_duzenle"){ 
                $id = $_GET["id"];
                $toplam=mysql_num_rows(mysql_query("select * from yazilar where id='$id'"));
                if($toplam==0){
                    echo "<script>window.location.href='".Site_url."/admin/';</script>";
                }
                $yaz=mysql_fetch_object(mysql_query("select * from yazilar where id='$id'"));
                ?>
                <form action='<?php echo Site_url;?>/admin/index.php?sayfa=yazilar_duzenle&id=<?php echo $id; ?>' method="post">
                    <div class="w3-container">
                        <label><b>Başlık</b></label>
                        <input type="text" placeholder="Başlık" name="baslik" class="w3-input w3-block" required value="<?php echo $yaz->baslik; ?>">

                        <label><b>Url</b></label>
                        <input type="text" placeholder="URL" class="w3-input w3-block" disabled readonly value="<?php echo $yaz->url; ?>">

                        <label><b>İçerik</b></label>
                        <textarea id="editor1" name="icerik"><?php echo $yaz->icerik; ?></textarea>

                        <br>
                        <label><b>Kategori</b></label>
                        <select class="w3-select" name="kategori_id">
                            <?php
                                $sorgu2=mysql_query("select * from kategori");
                                while($yaz2=mysql_fetch_object($sorgu2)){
                                    if($yaz->kategori_id==$yaz2->id){
                                        echo "<option value='$yaz2->id' selected>$yaz2->baslik</option>";
                                    }else{
                                        echo "<option value='$yaz2->id'>$yaz2->baslik</option>";
                                    }
                                }
                            ?>
                        </select>

                        <br><br>
                        <button type="submit" class="w3-button w3-btn w3-green w3-block" name="guncelle">Güncelle</button>
                    </div>
                </form>
                <?php
                    $guncelle=isset($_POST["guncelle"])?$_POST["guncelle"]:"yok";
                    if ($guncelle!="yok") {
                        $baslik=$_POST["baslik"];
                        $url=kucuk(url_duzenle($_POST["baslik"]));
                        $icerik=$_POST["icerik"];
                        $kategori_id=$_POST["kategori_id"];

                        $sorgu=mysql_query("update yazilar set baslik='$baslik', url='$url', icerik='$icerik', kategori_id='$kategori_id' where id='$id'");
                        if($sorgu){
                            echo "<script>window.location.href='".Site_url."/admin/index.php?sayfa=yazilar_duzenle&id=$id';</script>";
                        }
                    }
                ?>
            <?php }else if($sayfa=="yazilar_ekle"){ ?>
                <form action='<?php echo Site_url;?>/admin/index.php?sayfa=yazilar_ekle' method="post">
                    <div class="w3-container">
                        <label><b>Başlık</b></label>
                        <input type="text" placeholder="Başlık" name="baslik" class="w3-input w3-block" required>

                        <label><b>İçerik</b></label>
                        <textarea id="editor1" name="icerik"></textarea>

                        <br>
                        <label><b>Kategori</b></label>
                        <select class="w3-select" name="kategori_id">
                            <?php
                                $sorgu2=mysql_query("select * from kategori");
                                while($yaz2=mysql_fetch_object($sorgu2)){
                                    echo "<option value='$yaz2->id'>$yaz2->baslik</option>";
                                }
                            ?>
                        </select>
                        <br><br>
                        <button type="submit" class="w3-button w3-btn w3-green w3-block" name="ekle">Ekle</button>
                    </div>
                </form>
                <?php
                    $ekle=isset($_POST["ekle"])?$_POST["ekle"]:"yok";
                    if ($ekle!="yok") {
                        $baslik=$_POST["baslik"];
                        $url=kucuk(url_duzenle($_POST["baslik"]));
                        $icerik=$_POST["icerik"];
                        $kategori_id=$_POST["kategori_id"];
                        $sorgu=mysql_query("insert into yazilar (baslik,url,icerik,kategori_id) values('$baslik','$url','$icerik','$kategori_id')");
                        if($sorgu){
                            echo "<script>window.location.href='".Site_url."/admin/index.php?sayfa=yazilar';</script>";
                        }else{
                            echo mysql_error();
                        }
                        
                    }
                ?>
            <?php }else if($sayfa=="yazilar_sil"){ 
                    $id = $_GET["id"];
                    $toplam=mysql_num_rows(mysql_query("select * from yazilar where id='$id'"));
                    if($toplam==0){
                        echo "<script>window.location.href='".Site_url."/admin/';</script>";
                    }
                    $sil=mysql_query("delete from yazilar where id='$id'");
                    if($sil){
                        echo "<script>window.location.href='".Site_url."/admin/index.php?sayfa=yazilar';</script>";
                    }else{
                        echo mysql_error();
                    }
                } ?>
        </div>
        <script>
            var mySidebar = document.getElementById("mySidebar");
            var overlayBg = document.getElementById("myOverlay");
            function w3_open() {
                if (mySidebar.style.display === 'block') {
                    mySidebar.style.display = 'none';
                    overlayBg.style.display = "none";
                } else {
                    mySidebar.style.display = 'block';
                    overlayBg.style.display = "block";
                }
            }
            function w3_close() {
                mySidebar.style.display = "none";
                overlayBg.style.display = "none";
            }
			CKEDITOR.replace( 'editor1' );
		</script>
    </body>
</html>