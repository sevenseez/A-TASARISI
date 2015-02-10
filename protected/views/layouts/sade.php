<!DOCTYPE html>

<html lang="en">

<head>
	<title> Project A </title>
	
	<meta charset="utf-8">
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
        
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
            <link rel="stylesheet" href="/ProjectNew/css/sadeLayout.css">
     
</head>
<body>
<div id="wrap_main">
    
	

	<?php echo $content; ?>

</div>
<footer class="sadeFooter">
 
   
        <p>>> <a href="/ProjectNew/site">Anasayfa</a></p>
        <p>>> <a href="/ProjectNew/takip">Cihaz Sorgulama</a></p>
        <p>>> <a href="/ProjectNew/site/dilekSikayet">Bize Ulaşın</a></p>
        <p>>> <a href="http://www.kocaeli.edu.tr">KOÜ </a></p>
        <p>>> <a href="http://bilgisayar.kocaeli.edu.tr">Bilgi-İşlem</a></p>
   
</footer>
	
</body>

</html>
