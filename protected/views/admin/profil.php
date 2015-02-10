<link rel="stylesheet" href="/ProjectNew/css/index/profil.css">

<div class="profil-container ">
  <h1 class="page-header">Profili Düzenle</h1>
  <div class="row">
        <?php $form = $this->beginWidget(
           'booster.widgets.TbActiveForm',
                   array(
                   'id' => 'form',
                   'type'=>'horizontal',
                   'action'=>'profil',
                   'enableClientValidation'=>true,
                   'clientOptions'=>array(
                           'validateOnSubmit'=>true,
                           ),
                   
                    'htmlOptions' => array('enctype' => 'multipart/form-data'),
                   )
                   );?>
    <!-- left column -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">
           <?php echo CHtml::image($yonetici->Image,"Your Picture",array("width"=>200,'class'=>'img-circle img-thumbnail','title'=>'Your Picture')); ?>
        <h6>Başka bir fotoğraf yükleyin...</h6>
        <?php echo CHtml::activeFileField($yonetici, 'y_image',array('class'=>'text-center center-block well well-sm')); ?>
      </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-6 col-sm-4 col-xs-8 personal-info">
         <div class="alert alert-warning alert-dismissable" id="error" role="alert">
            <button type="button" class="close" data-hide="alert" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Hata!</strong> İşleminiz gerçekleşmedi.
          </div>
        <div class="alert alert-success alert-dismissable" id="success" role="alert">
            <button type="button" class="close" id="success" data-hide="alert" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Başarılı!</strong> Yaptığın değişiklikler kaydedildi.
         </div>
      <h3>Bilgiler</h3>
        
      <?php 
      echo $form->textFieldGroup($yonetici, 'y_adsoyad', array(
            'labelOptions' => array('label' => 'Ad Soyad:', 'class' => 'col-lg-3'),
            'wrapperHtmlOptions' => array('class' => 'col-md-8'),
            'widgetOptions'=>array('htmlOptions'=>array('disabled'=>true)),
            ));
      
      $birimler = CHtml::listData(Birimler::model()->findAll(),'birim_id','birim_adi');
      
        echo $form->dropDownListGroup($yonetici, 'y_birim', array('wrapperHtmlOptions' => array(
                'class' => 'col-md-8',
            ),
            'widgetOptions' => array(
                'data' => $birimler,),
            'labelOptions' => array('label' => 'Birim:', 'class' => 'col-lg-3'),
            ));

       echo $form->textFieldGroup($yonetici, 'y_email', array(
            'labelOptions' => array('label' => 'E-Posta:', 'class' => 'col-lg-3'),
            'wrapperHtmlOptions' => array('class' => 'col-md-8'),
            ));
       
         echo $form->textFieldGroup($yonetici, 'y_kullanici_adi', array(
            'labelOptions' => array('label' => 'Kullanıcı Adı:', 'class' => 'col-lg-3'),
            'wrapperHtmlOptions' => array('class' => 'col-md-8'),
            'widgetOptions'=>array('htmlOptions'=>array('disabled'=>true)),
            ));
         
          echo $form->PasswordFieldGroup($yonetici, 'y_sifre', array(
            'labelOptions' => array('label' => 'Şifre:', 'class' => 'col-lg-3'),
            'wrapperHtmlOptions' => array('class' => 'col-md-8'),
            ));
       
           echo $form->PasswordFieldGroup($yonetici, 'sifre_tekrar', array(
            'labelOptions' => array('label' => 'Şifre Tekrar:', 'class' => 'col-lg-3'),
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
        url: '<?php echo Yii::app()->createUrl("admin/profil"); ?>',
        type: 'POST',
        cache: false,
        data: fd,
        dataType: "text",
        processData: false,
        contentType: false,
        success: function (response) {if(response==='"error"')  div_show('error');
        else {  div_show('success');  setTimeout(function(){location.href="/ProjectNew/admin/profil";}, 200);}
        },
          error: function () {  div_show('error');
        },
}); 
}
</script>