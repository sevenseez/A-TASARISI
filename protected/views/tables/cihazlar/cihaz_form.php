<?php

echo $form->textFieldGroup($model, 'cihaz_adi', array(
    'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
    'labelOptions' => array('label' => 'Adı', 'class' => 'col-sm-2')
));

echo $form->textFieldGroup($model, 'cihaz_serino', array(
    'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
    'labelOptions' => array('label' => 'Seri No.', 'class' => 'col-sm-2')
));

echo $form->dropDownListGroup($model, 'cihaz_durum', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-6',
    ),
    'widgetOptions' => array(
        'htmlOptions' => array('prompt' => 'Seçiniz...'),
        'data' => $model->durum),
    'labelOptions' => array('label' => 'Durum', 'class' => 'col-sm-2'),
));


echo $form->textAreaGroup(
                        $model,'ariza_nedeni',
                        array(
                       'labelOptions' => array('label' => 'Arıza Nedeni','class'=>'col-sm-2'),
                        'widgetOptions' => array(
                        'htmlOptions' => array('rows' => 3),
                        ),
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
                        )
                                            );
echo $form->textAreaGroup(
                        $model,'yonetici_notu',
                        array(
                       'labelOptions' => array('label' => 'Yönetici Notu','class'=>'col-sm-2'),
                        'widgetOptions' => array(
                        'htmlOptions' => array('rows' => 3),
                        ),
                        'wrapperHtmlOptions' => array('class' => 'col-sm-6'),
                        )
                                            );

echo $form->dropDownListGroup($model, 'cihaz_marka', array(
    'wrapperHtmlOptions' => array(
        'class' => 'col-sm-6',
    ),
    'widgetOptions' => array(
        'data' => Markalar::model()->markalist),
    'labelOptions' => array('label' => 'Markası', 'class' => 'col-sm-2'),
));
?>