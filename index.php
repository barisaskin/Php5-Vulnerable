<?php 
session_start();
include("config.php");
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
		<style>body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}</style>
	</head>
	<body class="w3-light-grey">
		<div class="w3-content" style="max-width:1400px">
			<header class="w3-container w3-center w3-padding-32"><h1><b>BLOG</b></h1><p>Welcome to the blog of <span class="w3-tag">unknown</span></p></header>
			<div class="w3-row">
				<div class="w3-col l4">
					<div class="w3-card w3-margin w3-margin-top">
						<form method="post" action="<?php echo Site_url;?>/ara">
							<input type="text" name="ara" class='w3-input w3-block' placeholder="Sayfada Ara">
						</form>
					</div>
					<div class="w3-card w3-margin">
						<div class="w3-container w3-padding"><h4>Kategoriler</h4></div>
						<ul class="w3-ul w3-hoverable w3-white">
							<?php
							$sorgu=mysql_query("select * from kategori order by id desc");
							$toplam = mysql_num_rows(mysql_query("select * from yazilar"));
							while($yaz=mysql_fetch_object($sorgu)){
								echo "<li class='w3-padding-16'>
										<a href='".Site_url."/kategori/$yaz->url'>
											<img src='".Site_url."/images/kategori/$yaz->resim' class='w3-left w3-margin-right' style='width:100px'>
											<span class='w3-large'>$yaz->baslik</span><br>
										</a>
									</li>";
							}
							?>  
						</ul>
					</div> 
					<div class="w3-card w3-margin">
						<div class="w3-container w3-padding"><h4>Son Yazılar</h4></div>
						<ul class="w3-ul w3-hoverable w3-white">
							<?php
							$sorgu=mysql_query("select * from yazilar order by id desc limit 0,4");
							$toplam = mysql_num_rows(mysql_query("select * from yazilar"));
							while($yaz=mysql_fetch_object($sorgu)){								
								$yaz2=mysql_fetch_object(mysql_query("select * from kategori where id='$yaz->kategori_id'"));
								echo "<li class='w3-padding-16'>
										<a href='".Site_url."/yazi/$yaz->url'>
											<img src='".Site_url."/images/kategori/$yaz2->resim' class='w3-left w3-margin-right' style='width:50px'>
											<span class='w3-large'>$yaz->baslik</span><br>
											<span>$yaz->tarih</span>
										</a>
									</li>";
							}
							?>  
						</ul>
					</div> 
					<div class="w3-card w3-margin">
						<div class="w3-container w3-padding"><h4>Etiketler</h4></div>
							<div class="w3-container w3-white">
								<p>
									<span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">London</span>
									<span class="w3-tag w3-light-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">DIY</span>
									<span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Family</span>
									<span class="w3-tag w3-light-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Shopping</span>
									<span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-light-grey w3-small w3-margin-bottom">Games</span>
								</p>
							</div>
						</div>
					</div>
					<div class='w3-col l8'>
					<?php 
						if($url[0]=="" or $url[0]=="anasayfa"){
							$url1=isset($url[1])?$url[1]:"yok";
							if($url1=="yok"){
								$sayfa2=0;
							}else{
								$sayfa=isset($url[2])?$url[2]:0;
								$sayfa2=$sayfa;
								if($sayfa==1)$sayfa2=0;
								if($sayfa>1){
									$sayfa2=$sayfa-1;
								}
							}
							$sayfa2=$sayfa2*$per_page;
							$sorgu=mysql_query("select * from yazilar order by one_cikan desc limit $sayfa2,$per_page");
							$toplam = mysql_num_rows(mysql_query("select * from yazilar"));
							while($yaz=mysql_fetch_object($sorgu)){								
								$yaz2=mysql_fetch_object(mysql_query("select * from kategori where id='$yaz->kategori_id'"));
								$lenght=150;
								$icerik=strip_tags($yaz->icerik);
								if(strlen($icerik)>=$lenght){
									if(preg_match('/(.*?)\s/i',substr($icerik,$lenght),$dizi))$icerik=substr($icerik,0,$lenght+strlen($dizi[0]))."...";  
								}else{
									$icerik.="";
								}
								
								echo "<div class='w3-third w3-container w3-margin-bottom'>
										<a href='".Site_url."/yazi/$yaz->url'><img src='".Site_url."/images/kategori/$yaz2->resim' alt='Norway' style='width:100%' class='w3-hover-opacity'></a>
										<div class='w3-container w3-white'>
											<p><b>$yaz->baslik</b></p>
											<p>$icerik</p>
										</div>
									</div>";
							}
							echo "<div class='w3-container'>";
							for($i=1;$i<ceil($toplam/$per_page)+1;$i++){
								if($sayfa==$i){
									echo "<a href='".Site_url."/anasayfa/sayfa/$i' class='w3-button w3-black w3-disabled w3-padding-large w3-margin-bottom'>$i</a>";
								}else{
									echo "<a href='".Site_url."/anasayfa/sayfa/$i' class='w3-button w3-black w3-padding-large w3-margin-bottom'>$i</a>";
								}
							} 
							echo "</div>";
						}else if($url[0]=="ara"){
							$ara=htmlspecialchars($_POST["ara"]);
							$sorgu=mysql_query("select * from yazilar where baslik like '%$ara%' order by one_cikan desc");
							$toplam = mysql_num_rows(mysql_query("select * from yazilar"));
							while($yaz=mysql_fetch_object($sorgu)){
								$yaz2=mysql_fetch_object(mysql_query("select * from kategori where id='$yaz->kategori_id'"));
								$lenght=150;
								$icerik=strip_tags($yaz->icerik);
								if(strlen($icerik)>=$lenght){
									if(preg_match('/(.*?)\s/i',substr($icerik,$lenght),$dizi))$icerik=substr($icerik,0,$lenght+strlen($dizi[0]))."...";  
								}else{
									$icerik.="";
								}
								
								echo "<div class='w3-third w3-container w3-margin-bottom'>
										<a href='".Site_url."/yazi/$yaz->url'><img src='".Site_url."/images/kategori/$yaz2->resim' alt='Norway' style='width:100%' class='w3-hover-opacity'></a>
										<div class='w3-container w3-white'>
											<p><b>$yaz->baslik</b></p>
											<p>$icerik</p>
										</div>
									</div>";
							}
						}else if($url[0]=="yazi"){
							$yazi=isset($url[1])?$url[1]:"yok";
							if($yazi=="yok"){
								echo "<script>window.location.href='".Site_url."';</script>";
							}
							$sorgu=mysql_query("select * from yazilar where url='$yazi'");
							$toplam=mysql_num_rows($sorgu);
							if($toplam>0){
								$yaz=mysql_fetch_object($sorgu);
								$yaz2=mysql_fetch_object(mysql_query("select * from kategori where id='$yaz->kategori_id'"));
								echo "	<div class='w3-card-4 w3-margin w3-white'>
											<a href='".Site_url."/yazi/$yaz->url'><img src='".Site_url."/images/kategori/$yaz2->resim' style='width:100%'></a>
											<div class='w3-container'>
												<h3><b>$yaz->baslik</b></h3>
												<h5><span class='w3-opacity'>$yaz->tarih</span></h5>
											</div>
											<div class='w3-container'><p>$yaz->icerik</p> </div>
										</div>";
										$sorgu3=mysql_query("select * from yorumlar where yazi_id='$yaz->id'");
										while($yaz3=mysql_fetch_object($sorgu3)){
											echo "
												<div class='w3-card-4 w3-margin w3-white'>
													<p><b>$yaz3->email</b></p>
													<p>$yaz3->yorum</p>
												</div>";
										}
										echo "	<div class='w3-card-4 w3-margin w3-white'>
													<form method='post'>
														<input type='email' name='email' class='w3-input w3-block' required placeholder='Email Adresinizi Giriniz.'>
														<textarea class='w3-input w3-block' name='yorum' required placeholder='Yorumunuzu Giriniz.' style='resize:none;' rows='5'></textarea>
														<input type='submit' class='w3-button w3-btn w3-block w3-green' value='Yorumunuzu Gönderin'>
													</form>
												</div>";

										if(isset($_POST["email"])){
											//$email=$_POST["email"]; // varsayılan değer
											$email=htmlspecialchars($_POST["email"]); // xss ignore
											//$yorum=$_POST["yorum"]; // varsayılan değer
											$yorum=htmlspecialchars($_POST["yorum"]); // xss ignore
											$sorgu=mysql_query("insert into yorumlar (email,yorum,yazi_id) values('$email','$yorum','$yaz->id')");
											if($sorgu){
												echo "<script>alert('Yorum Eklendi')</script>";
											}else{
												echo "<script>alert('Yorum Eklenmedi.".mysql_error()."')</script>";
											}
										}
							}else{
								echo "<script>window.location.href='".Site_url."';</script>";
							}
						}else if($url[0]=="kategori"){
							$url1=isset($url[1])?$url[1]:"yok";
							if($url1=="yok"){
								$where="";
								$sayfa2=0;
							}else{
								$kategori_id=mysql_fetch_object(mysql_query("select * from kategori where url='$url1'"));
								$where=" where kategori_id ='$kategori_id->id'";
								$url2=isset($url[2])?$url[2]:"yok";
								if($url2!="sayfa"){
									$sayfa2=0;
								}else{
									$sayfa=isset($url[3])?$url[3]:0;
									$sayfa2=$sayfa;
									if($sayfa==1)$sayfa2=0;
									if($sayfa>1){
										$sayfa2=$sayfa-1;
									}
								}
								
							} 
							$sayfa2=$sayfa2*$per_page;
							$sorgu=mysql_query("select * from yazilar $where order by one_cikan desc limit $sayfa2,$per_page");
							$toplam = mysql_num_rows(mysql_query("select * from yazilar $where"));
							while($yaz=mysql_fetch_object($sorgu)){
								$yaz2=mysql_fetch_object(mysql_query("select * from kategori where id='$yaz->kategori_id'"));
								$lenght=150;
								$icerik=strip_tags($yaz->icerik);
								if(strlen($icerik)>=$lenght){
									if(preg_match('/(.*?)\s/i',substr($icerik,$lenght),$dizi))$icerik=substr($icerik,0,$lenght+strlen($dizi[0]))."...";  
								}else{
									$icerik.="";
								}
								
								echo "<div class='w3-third w3-container w3-margin-bottom'>
										<a href='".Site_url."/yazi/$yaz->url'><img src='".Site_url."/images/kategori/$yaz2->resim' alt='Norway' style='width:100%' class='w3-hover-opacity'></a>
										<div class='w3-container w3-white'>
											<p><b>$yaz->baslik</b></p>
											<p>$icerik</p>
										</div>
									</div>";
							}
							echo "<div class='w3-container'>";
							for($i=1;$i<ceil($toplam/$per_page)+1;$i++){
								if($sayfa==$i){
									echo "<a href='".Site_url."/kategori/$url1/sayfa/$i' class='w3-button w3-black w3-disabled w3-padding-large w3-margin-bottom'>$i</a>";
								}else{
									echo "<a href='".Site_url."/kategori/$url1/sayfa/$i' class='w3-button w3-black w3-padding-large w3-margin-bottom'>$i</a>";
								}
							} 
							echo "</div>";
						}
						?>
					</div>
				</div>
				<br>
			</div>
		</div>
		<footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top"><p>Powered by w3.css</p></footer>
	</body>
</html>