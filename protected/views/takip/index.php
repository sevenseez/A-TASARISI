<?php $this->layout='sade'; ?>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/takip.css">
<div class="jumbotron takip-box open">
  <h1>Arıza Takip Sorgulama</h1>
  <h4>Sorgu başlatmak için alttaki kutuya sicil numaranızı ya da size e-posta ile gönderilen kayit numarasını yazarak ara tuşuna basınız.</h4>
  
<form role="form" class="form-inline"  id="takip_form">
   <div class="col-lg-4">
       <div>
        <label for="search_box" class="col-xs-5 col-sm-5 control-label" id="search_label"> Numaranız </label>
       </div>
        <div class="input-group">
                <input type="text" class="form-control col-xs-6 col-sm-6" name="search_box" maxLength="11" id="search_box" placeholder="Arama Yapınız." ></input>

            <span class="input-group-btn" >
            <?php echo CHtml::ajaxSubmitButton('Ara',Yii::app()->createUrl('takip/search'), 
                    array(
                  'type'=>'POST',
                  'url'=>'js:$(this).attr("href")',
                  'success' => " function (data) { 
                                $('#takipContent').hide();
                                $('#takipContent').html(data).fadeIn();
                                
                    }",
                'error' =>" function () { 
                $('#takipContent').html('<p class=no-data>Sicil numarası kayıtlı değil...</p>');
                $('#takipContent').hide().fadeIn();
                }"
                ),array('class'=>'btn btn-default')
                  
               );


                ?>
                </span>
            </div>
    
            <div class="toggle open">
            <span class="glyphicon glyphicon-chevron-up tog toggle-close"></span>
            </div>
   </div>
	</form>
	</div>
	<div class="toggle open">
            <span class="glyphicon glyphicon-chevron-down tog toggle-open"></span>		
	</div>
    
    <div id="takipContent" class="result-form"></div>

	
			
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/toggle_move.js"></script>