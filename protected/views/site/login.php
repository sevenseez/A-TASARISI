
<link rel="stylesheet" href="/ProjectNew/css/index/login.css"/>

<?php $this->beginWidget(
    'booster.widgets.TbModal',
    array('id' => 'login_screen',
       )
    ); ?>
    <div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <span id="popup_baslik"><i class="fa fa-users"></i>Yönetici Girişi</span>
    </div>
     
    <div class="modal-body" id="modal_Content">

<?php 

$form = $this->beginWidget(
'booster.widgets.TbActiveForm',
        array(
        'id' => 'form',
        'action'=>'site/login',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
                'validateOnSubmit'=>true,
                ),

        )
        );

echo $form->textFieldGroup($model, 'username',
     array('widgetOptions'=>array('htmlOptions'=>array('placeholder'=>'Kullanıcı Adı',)),
         'prepend' => '<i class="fa fa-user"></i>',
         'labelOptions'=>array('label'=>''),
           ));

echo $form->passwordFieldGroup($model, 'password', 
       array('widgetOptions'=>array('htmlOptions'=>array('placeholder'=>'Şifre',)),
         'prepend' => '<i class="fa fa-key"></i>',
         'labelOptions'=>array('label'=>''),
           ));
echo $form->checkboxGroup($model, 'rememberMe');
$this->widget(
'booster.widgets.TbButton',
array('buttonType'=>'submit','label' => 'Giriş Yap' ,'id' => 'submitit',
            'htmlOptions' => array('class' => 'btn btn-success btn-block')));
 
$this->endWidget();
?>
  
 </div>
     

     
    <?php $this->endWidget(); ?>