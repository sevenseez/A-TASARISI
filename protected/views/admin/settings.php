<link rel="stylesheet" href="/ProjectNew/css/index/profil.css">

<div class="setting-container">
  <h1 class="page-header">Ayarlar</h1>
  <div class="row">
        <?php $form = $this->beginWidget(
           'booster.widgets.TbActiveForm',
                   array(
                   'id' => 'form',
                   'type'=>'horizontal',
                   'enableClientValidation'=>true,
                   'clientOptions'=>array(
                           'validateOnSubmit'=>true,
                           ),
                   
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                   )
                   );?>
    
    <!-- edit form column -->
    <div class="col-md-6 col-sm-4 col-xs-8 personal-info">
         <div class="alert alert-warning alert-dismissable" id="error" role="alert">
            <button type="button" class="close" data-hide="alert" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Hata!</strong>  <span class="alert-text">İşleminiz gerçekleşmedi.</span>
          </div>
        <div class="alert alert-success alert-dismissable" id="success" role="alert">
            <button type="button" class="close" id="success" data-hide="alert" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Başarılı!</strong> Yaptığın değişiklikler kaydedildi.
         </div>
      <h3>Posta Bilgileri</h3>
        
      <?php 
      echo $form->textFieldGroup($model, 'mailer', array(
            'labelOptions' => array('label' => 'Mailer:', 'class' => 'col-lg-3'),
            'wrapperHtmlOptions' => array('class' => 'col-md-8'),
            ));
      
      
        echo $form->textFieldGroup($model, 'host', array('wrapperHtmlOptions' => array(
                'class' => 'col-md-8',
            ),
            'labelOptions' => array('label' => 'Host:', 'class' => 'col-lg-3'),
            ));

       echo $form->textFieldGroup($model, 'port', array(
            'labelOptions' => array('label' => 'Port:', 'class' => 'col-lg-3'),
            'wrapperHtmlOptions' => array('class' => 'col-md-8'),
            ));
       
         echo $form->textFieldGroup($model, 'smtpsecure', array(
            'labelOptions' => array('label' => 'SMTP Secure:', 'class' => 'col-lg-3'),
            'wrapperHtmlOptions' => array('class' => 'col-md-8'),
            ));
         
          echo $form->textFieldGroup($model, 'smtpauth', array(
            'labelOptions' => array('label' => 'SMTP Auth:', 'class' => 'col-lg-3'),
            'wrapperHtmlOptions' => array('class' => 'col-md-8'),
            ));
       
           echo $form->textFieldGroup($model, 'username', array(
            'labelOptions' => array('label' => 'Kullanıcı Adı:', 'class' => 'col-lg-3'),
            'wrapperHtmlOptions' => array('class' => 'col-md-8'),
            ));
            echo $form->textFieldGroup($model, 'password', array(
            'labelOptions' => array('label' => 'Şifre:', 'class' => 'col-lg-3'),
            'wrapperHtmlOptions' => array('class' => 'col-md-8'),
            ));
      ?>
     
        <div class="form-group">
          <label class="col-md-3 control-label"></label>
          <div class="col-md-8">
            <?php echo CHtml::htmlButton('Kaydet',
                    array('name'=>'DegistirButton','class'=>'btn btn-primary',
                    'onclick'=>'js:send();'));
                ?>
            <span></span>
            <input class="btn btn-default" value="İptal" onclick="js:window.location='/ProjectNew/admin/index'" type="reset">
          </div>
        </div>
    </div>
   <?php $this->endWidget();?>
  </div>
</div>
    
    <script src="/ProjectNew/js/data-hide.js"></script>
    <script type="text/javascript">
// this script for collecting the form data and pass to the controller action and doing the on success validations
function send(){
    var fd = new FormData($("#form")[0]);
$.ajax({
        url: '<?php echo Yii::app()->createUrl("admin/settings"); ?>',
        type: 'POST',
        cache: false,
        data: fd,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (response) {if(response!=='success'){  div_show2('error',response);}
        else {  div_show('success');  setTimeout(function(){location.href="/ProjectNew/admin/settings";}, 200);}
        },
          error: function () {  div_show('error');
        },
}); 
}
</script>