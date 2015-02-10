
<link rel="stylesheet"  href="/ProjectNew/css/index/istek_screen.css" />
﻿	<?php $this->beginWidget(
            'booster.widgets.TbModal',
            array('id' => 'istek_screen',
               )
            ); 

            $form = $this->beginWidget(
            'booster.widgets.TbActiveForm',
             array(
            'id' => 'istek_form',
            'type' => 'horizontal' , 
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>true,
            'clientOptions'=>array(
            'validateOnSubmit'=>false,
              ),   ) ); 
            ?>                    
	
                            <a class="close"  data-dismiss="modal">&times;</a>
                            
                            <span id="istek_baslik"><i class="fa fa-envelope"></i>Bildirim Formu</span>
                            <div class="alert alert-warning info">
                                <button type="button" class="close" data-hide="info" >
                                    <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                </button>
                                <li>Giriş yaptığınız bütün bilgilerin doğru olduğundan emin olunuz. 
                                    Bütün bilgilerinizin - IP adresiniz dahil - kaydedildiğini unutmayınız.</li>
                                 <li>İşleminiz sona erdiğinde size bir e-posta gönderilecektir. Bu süreçte
                                 işleminizin durumunu cihaz takip-sorgulama bölümünden takip edebilirsiniz.</li>
                                
                            </div>
                            <br>
                            <div class="alert alert-warning" id="error" role="alert">
                                <button type="button" class="close" data-hide="alert" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <strong>Uyarı!</strong> <span class="alert-text"> Oluşan bir hata nedeniyle isteğiniz iletilemedi.</span>
                            </div>
                           
                            <div class="alert alert-success" id="success" role="alert">
                                <button type="button" class="close" data-hide="alert" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <strong>İşlem Başarılı!</strong> İsteğiniz yöneticilere ulaştırıldı.
                            </div>

                            <div class="form_box" id="teslim_box">

                                    <h4><b>İstek Yapanın</b> ;</h4>
                                    <br>

                                    <hr>
                                   
                                     <?php 
                                     $ip = CHttpRequest::getUserHostAddress();
                                     
                                    echo $form->textFieldGroup($model1, 'ip_addr',
                                     array(
                                         'labelOptions' => array('label' => 'IP Adresi','class'=>'col-sm-2'),
                                          'append' => '<i class=" pull-right glyphicon glyphicon-star"></i>',
                                            
                                         	'widgetOptions' => array(
                                                
                                                'htmlOptions' => array('readonly' => true,'value'=>$ip)
                                                )));
                                   
                                     
                                    echo $form->textFieldGroup($model1, 'istek_isim',
                                     array('labelOptions' => array('label' => 'Adı','class'=>'col-sm-2'),
                                           'widgetOptions'=>array('htmlOptions'=>array('placeholder'=>'Ad')),
                                          'append' => '<i class="glyphicon glyphicon-user"></i>'));
                                   
                                      echo $form->textFieldGroup($model1,'istek_soyisim',
                                      array('labelOptions' => array('label' => 'Soyadı','class'=>'col-sm-2'),
                                          'widgetOptions'=>array('htmlOptions'=>array('placeholder'=>'Soyad')),
                                            'append' => '<i class="glyphicon glyphicon-user"></i>'
                                          ));
                                      
                                      echo $form->textFieldGroup($model1,'sicil_no',array(
                                          'labelOptions'=>array('label'=>'Sicil Nu.',
                                              'class'=>'col-sm-2'),
                                          'append' => '<i class="fa fa-credit-card"></i>'));
                                     
                                     echo $form->dropDownListGroup($model1, 'istek_birim', array('wrapperHtmlOptions' => array(
                                                    'class' => 'col-sm-9',
                                                ),
                                                'widgetOptions' => array(
                                                   'htmlOptions'=>array(
                                                     'empty'=>'Seçiniz'),
                                                    'data' => Birimler::model()->birimList),
                                                'labelOptions' => array('label' => 'Birimler', 'class' => 'col-sm-2'),
                                                'append' =>'<i class="glyphicon glyphicon-home"></i>'
                                            ));
                                     
                                     
                                     echo $form->maskedTextFieldGroup($model1, 'istek_telefon', array(
                                            'labelOptions' => array('label' => 'Telefon', 'class' => 'col-sm-2'),
                                            'widgetOptions' => array('mask' => '(599)999-9999'),
                                            'append' => '<i class="glyphicon glyphicon-earphone"></i>'
                                        ));
                   
                                      echo $form->textFieldGroup($model1,'istek_email',
                                      array('class'=>'form-control'
                                           ,'labelOptions' => array('label' => 'E-Posta','class'=>'col-sm-2')
                                           ,'append' => '<i class="glyphicon glyphicon-envelope"></i>'));
                                          
                                    ?>

                            </div>

                            <div class="form_box" id="cihaz_box">

                                    <h4><b>Cihazın</b> ;</h4>
                                    <br>
                                    <hr>
                                    
                                    
                                        
                                    <?php
                                    
                                     echo $form->textFieldGroup($model2,'cihaz_adi',
                                      array('labelOptions' => array('label' => 'Adı','class'=>'col-sm-2'),
                                            'append' => '<i class="glyphicon glyphicon-font"></i>'));
                                     
                                     $tipi = CHtml::listData(Markalar::model()->findAll(),'marka_tipi','marka_tipi');
                                    ?>
                                    
                                      <div class="form-group double-input tipi" >
                                          <label class="col-sm-2 control-label">Tipi<span class="required">*</span></label>
                                             <div class="col-sm-3">
                                             <?php 
                                             echo $form->textField($model2,'diger_tipi',array('class'=>'form-control'
                                                 ,'placeholder'=>'Cihaz Tipi'));
                                             echo $form->error($model2, 'diger_tipi',array('class'=>'left-error help-block error','style'=>'margin-left:-20px;'));

                                              ?>
                                          </div>
                                          <div class="col-sm-4">
                                    <?php
                                    
                                     echo $form->dropDownList($model2, 'doll',$tipi,array(
                                                    'class'=>'form-control',
                                                    'empty'=>'Seçiniz',
                                                      'ajax' => array(
                                                            'type'=>'POST', //request type
                                                            'url'=>CController::createUrl('site/dinamik'), //url to call 
                                                            'update'=>'#'.CHtml::activeId($model2,'cihaz_marka'), 
                                                            ) ,
                                            ));
                                     echo $form->error($model2, 'doll');
                                     ?>
                                          </div>
                                       
                                      </div>  
                                     <div class="form-group double-input marka-input">
                                          <label class="col-sm-2 control-label">Markası<span class="required">*</span></label>
                                    
                                          <div class="col-sm-3">
                                             <?php 
                                             echo $form->textField($model2,'diger_marka',array('class'=>'form-control'
                                                 ,'placeholder'=>'Marka'));
                                             echo $form->error($model2, 'diger_marka',array('class'=>'left-error help-block error'));
                                           
                                              ?>
                                          </div>
                                          
                                                <div class="col-sm-4">
                                    <?php
                                    
                                     echo $form->dropDownList($model2, 'cihaz_marka',array(),array(
                                                    'class'=>'form-control',
                                                    'empty'=>'Seçiniz',
                                            ));
                                     echo $form->error($model2, 'cihaz_marka');
                                     ?>
                                          </div>
                                      </div>    
                                         <?php
                                      
                                      echo $form->textFieldGroup($model2,'cihaz_serino',
                                      array('class'=>'form-control', 'placeholder'=>'1X235DE24F'
                                           ,'labelOptions' => array('label' => 'Seri No.','class'=>'col-sm-2'),
                                          'append' => '<i class="fa fa-credit-card"></i>'
                                          ));
                                          
                                           
                                     echo $form->textAreaGroup(
                                              $model2,'ariza_nedeni',
                                              array(
                                             'labelOptions' => array('label' => 'Arıza Nedeni','class'=>'col-sm-2'),
                                             'append' => '<i class="fa fa-text-height"></i>',
                                              'widgetOptions' => array(
                                              'htmlOptions' => array('rows' => 6  ),
                                              )
                                              )
                                              );
                                     ?>
                            </div>
                            <div class="form-group istek_buttons">

                           
                            <?php
                            echo CHtml::submitButton('Gönder',array('ajax'=>array(
                                        'url'=>Yii::app()->createUrl('site/istek'),
                                        'type'=>'POST',
                                        'dataType'=>'json',
                                      'success' => " function (response) { "
                                            . "if(response!='success') { div_show2('error',response);}"
                                            . " else { div_show('success');} }",
                                      'error' => " function (response) { div_show2('error',response);}" ,
                               
                                        ),'class'=>'btn btn-success',
                                        'id' => 'sendit'));
                           ?>

                            </div> 

                    <?php $this->endWidget(); ?>
               
	  <?php $this->endWidget(); ?>
                            <style> textarea { resize:initial;}
                            
                            
                            </style>
 <script src="/ProjectNew/js/data-hide.js"></script>   
 <style></style>