<?php

echo $form->textFieldGroup($model, 'istek_sahibi', array(
    'labelOptions' => array('label' => 'İsteği Yapan', 'class' => 'col-sm-2'),
    'wrapperHtmlOptions' => array('class' => 'col-sm-6')
));

echo $form->textFieldGroup($model, 'sicil_no', array(
    'labelOptions' => array('label' => 'Sicil Nu.', 'class' => 'col-sm-2'),
    'wrapperHtmlOptions' => array('class' => 'col-sm-6')
));

$action = $this->getAction()->id;

if($action=='insert') {
echo $form->maskedTextFieldGroup($model, 'ip_addr', array(
    'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
    'labelOptions' => array('label' => 'IP Adresi', 'class' => 'col-sm-2'),
    'widgetOptions' => array('mask' => '999.999.999.999'),
));
}
echo $form->maskedTextFieldGroup($model, 'istek_telefon', array(
    'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
    'labelOptions' => array('label' => 'Telefon', 'class' => 'col-sm-2'),
    'widgetOptions' => array('mask' => '(599)999-99-99'),
));

echo $form->textFieldGroup($model, 'istek_email', array(
    'labelOptions' => array('label' => 'E-Posta.', 'class' => 'col-sm-2'),
    'wrapperHtmlOptions' => array('class' => 'col-sm-6')
));


echo $form->dropDownListGroup($model, 'istek_birim', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-6',
    ),
    'widgetOptions' => array(
        'data' => Birimler::model()->birimList),
    'labelOptions' => array('label' => 'Birim', 'class' => 'col-sm-2'),
));
