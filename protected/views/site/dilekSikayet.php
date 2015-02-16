<?php $this->layout="sade";
   ?>


<link rel="stylesheet" href="<?php echo BaseUrl;?>/css/dilekSikayet.css"/>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="well well-sm">
                <?php $form = $this->beginWidget(
                'CActiveForm',
                   array(
                   'id' => 'contactForm',
                   'action'=>'dilekSikayet',
                   'enableClientValidation'=>true,
                   'clientOptions'=>array(
                           'validateOnSubmit'=>true,
                           ),
                    'htmlOptions'=>array(
                      'class'=>'form-horizontal',
                        ),

                   )
                   );?>
                    <fieldset>
                        <legend class="text-center header">Bize Ulaşın</legend>
                                
                        <label id="info"><i class="fa fa-exclamation-circle "></i>
                            <span>E-Posta ve IP adresleriniz sistemde saklanacaktır.</span></label>
                        
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <?php 
                                  $ip = CHttpRequest::getUserHostAddress();
                                echo $form->textField($model,'d_ip_addr',array('class'=>'form-control','value'=>$ip,'readonly'=>true))?>
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <?php echo $form->textField($model,'d_adsoyad',array('class'=>'form-control','placeholder'=>'Ad Soyad'))?>
                               
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <?php echo $form->textField($model,'d_email',array('class'=>'form-control','placeholder'=>'E-Posta'))?>
                           
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <?php echo $form->textField($model,'d_konu',array('class'=>'form-control','placeholder'=>'Konu'))?>
                           
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <?php echo $form->textArea($model,'d_icerik',
                                        array('class'=>'form-control','rows'=>4,
                                            'placeholder'=>'Lütfen mesajınızı yazınız.'))?>
                               
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                  <?php echo CHtml::submitButton('Gönder', 
                                                                    array('name' => 'dilekButton',
                                                                        'class' =>'btn btn-success ',
                                                                    'onClick'=>'return confirm("Mesajınız gönderilsin mi?");'));
                                          ?>
                            </div>
                        </div>
                    </fieldset>
                <?php $this->endWidget();?>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <div class="panel panel-default">
                    <div class="text-center header">İletişim</div>
                    <div class="panel-body text-center">
                        <h4>Adres</h4>
                        <div>
                        Kocaeli Üniversitesi - Bilgi İşlem<br />
                        İzmit / KOCAELİ <br />
                        #(262) 1234 12 34<br />
                        admin@domain.com<br />
                        </div>
                        <hr />
                        <div id="map1" class="map">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="<?php echo BaseUrl;?>/js/contactMap.js"></script>