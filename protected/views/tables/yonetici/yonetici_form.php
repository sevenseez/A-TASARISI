

<?php

echo $form->textFieldGroup($model, 'y_adsoyad', array(
    'labelOptions' => array('label' => 'Adı Soyadı', 'class' => 'col-sm-2'),
    'wrapperHtmlOptions' => array('class' => 'col-sm-6')
));

echo $form->textFieldGroup($model, 'y_email', array(
    'labelOptions' => array('label' => 'E-Posta', 'class' => 'col-sm-2'),
    'wrapperHtmlOptions' => array('class' => 'col-sm-6')
));

$birimler = CHtml::listData(Birimler::model()->findAll(), 'birim_id', 'birim_adi');
echo $form->dropDownListGroup($model, 'y_birim', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-6',
    ),
    'widgetOptions' => array(
        'empty' => 'Seçiniz...',
        'data' => $birimler,),
    'labelOptions' => array('label' => 'Birim', 'class' => 'col-sm-2 control-label'),
));


echo $form->textFieldGroup($model, 'y_kullanici_adi', array(
    'labelOptions' => array('label' => 'Kullanıcı Adı', 'class' => 'col-sm-2'),
    'wrapperHtmlOptions' => array('class' => 'col-sm-6')
));

echo $form->textFieldGroup($model, 'y_sifre', array(
    'labelOptions' => array('label' => 'Şifre', 'class' => 'col-sm-2'),
    'wrapperHtmlOptions' => array('class' => 'col-sm-6')
));

echo $form->dropDownListGroup($model, 'yetki', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-6',
    ),
    'widgetOptions' => array(
        'empty' => 'Seçiniz...',
        'data' => $model->yetkiarray),
    'labelOptions' => array('label' => 'Birim', 'class' => 'col-sm-2 control-label'),
));
?>