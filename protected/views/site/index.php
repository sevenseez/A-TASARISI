
<link rel="stylesheet" href="/ProjectNew/css/index/bubble.css"/>
<link rel="stylesheet" href="/ProjectNew/css/index/list.css"/>


<div class="bubble">
	<span class="arrow" id="first"></span>	<span class="arrow2" id="first2"></span>
	<span class="arrow" id="second"></span> <span class="arrow2" id="second2"></span>
	<span class="arrow" id="third"></span>  <span class="arrow2" id="third2"></span>
	<div class="title">
	<div>	<span> KOCAELİ</span> </div>
	<div class="image main_image" > 	<img src="/ProjectNew/images/background.jpg" onmousedown="return false;"/> </div> 
	<div>	<span> ÜNİVERSİTESİ </span>	</div></div>
        <span class="subtitle"> ARIZA TAK&#304;P SİSTEMİ </span>
</div>

<div id="main_list">
		<ul id="the_list">
                    <li id="ariza_istek" onmousedown=<?php Yii::app()->createUrl('site/istek'); echo 'js:content("istek");'?>><i class="fa fa-file-text fa-3x"></i> <p> arıza bildirim formu </p> 
			</li>
		
			<li id="ariza_takip" onmousedown="location.href='/ProjectNew/takip'" ><i class="fa fa-search fa-3x"></i> <p> cihaz takip sorgulama </p>  
								
			</li>
                        <li id="admin_paneli" onmousedown=<?php Yii::app()->createUrl('site/login'); echo 'js:content("login");'?>> <i class="fa fa-wrench fa-3x"></i> <p> yönetici paneli girişi </p> 
									
			</li>
		</ul>
	</div>
<div id="istekContent"></div>
<div id="loginContent"></div>
   



<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/data-hide.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/modalContent.js"></script>
