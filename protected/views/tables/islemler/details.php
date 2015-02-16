
    <?php
        
$this->beginWidget(
            'booster.widgets.TbModal',
            array('id' => 'details_screen',
               )
            ); 
    
        
            $form = $this->beginWidget(
            'booster.widgets.TbActiveForm',
             array(
            'id' => 'details_form',
            'type' => 'horizontal' ,
            
                 ) ); 
           
    ?>                    
					
                <a class="close"  data-dismiss="modal">&times;</a>
                <div id="details_baslik"><i class="fa fa-envelope">

                    </i>İşlem Ayrıntıları</div>

                <br>
                    <div class="alert alert-warning alert-dismissable" id="error" role="alert">
                       <button type="button" class="close" data-hide="alert" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                       <strong>Hata!</strong> Gerçekleştirmeye çalıştığınız işlem başarısız oldu.Lütfen e-posta ayarlarını kontrol ediniz.
                     </div>
                    <div class="alert alert-success alert-dismissable" id="success" role="alert">
                           <button type="button" class="close" id="success"data-hide="alert" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                           <strong>Başarılı!</strong> Cihaz sahibine işlemin tamamlandığını bildiren mail gönderildi.
                    </div>

                <div class="details_box" id="teslim_box">

                        <h4><b>İstek Gönderenin</b> ;</h4>
                        <br>

                        <hr>
                        <fieldset disabled>

                       <div class="form-group">
                        <label  class="col-xs-2 col-sm-2 control-label">Adı/Soyadı</label>
                            <div class="col-sm-4">

                             <input class="form-control"  type="text" value="<?php echo $model1['istek_sahibi']?>">
                            </div>
                          
                        <label  class="col-xs-2 col-sm-2 control-label">Sicil Nu.</label>
                            <div class="col-sm-4">

                             <input class="form-control"  type="text" value="<?php echo $model1['sicil_no']?>">
                            </div>
                          
                        <label  class="col-xs-2 col-sm-2 control-label">Telefon</label>
                            <div class="col-sm-4">
                             <input class="form-control" type="text" value="<?php echo $model1['istek_telefon']?>">
                            </div>

                         <label  class="col-xs-2 col-sm-2 control-label">E-Posta</label>
                            <div class="col-sm-4">
                             <input class="form-control" id="mail_text" type="text" value="<?php echo $model1['istek_email']?>">
                            </div>
                         </div>

                        </fieldset>
                </div>

            <div class="details_box" id="cihaz_box">

                    <h4><b>İşlemdeki Cihazın</b> ;</h4>
                    <br>
                    <hr>
                    <fieldset disabled>
                    <div class="form-group">
                     <label class="control-label col-sm-2">Tipi</label>
                     <div class="col-sm-4">
                      <input type="text" class="form-control" value="<?php echo $model2['cihazMarka']['marka_tipi'];?>">
                    </div>
                        <label class="control-label col-sm-2">Markas&#305;</label>
                       <div class="col-sm-4">
                           <input type="text" class="form-control" value="<?php echo$model2['cihazMarka']['marka_adi'];?>">

                      </div>

                      <label  class="col-xs-2 col-sm-2 control-label">Seri No.</label>
                        <div class="col-sm-4">
                         <input class="form-control" type="text" value="<?php echo $model2['cihaz_serino']?>">
                        </div>


                      <label  class="col-xs-2 col-sm-2 control-label">Arıza Nedeni</label>
                        <div class="col-sm-4">
                            <textarea class="form-control" rows="4" ><?php echo $model2['ariza_nedeni']?></textarea>
                        </div>

                     </div>
                    </fieldset>
            </div>
         <?php 
         
         if (isset($area_val)) $a = $area_val; else $a = '';
         $placeholder = 'Cihazda yapılan onarım işlemlerini ve ayrıntılarını yazarak aşağıdaki buton ile kullanıcıya e-posta ile yollayabilirsiniz.';
            echo $form->redactorGroup(
            $model2,
            'doll',
            array(
            'labelOptions'=>array('label'=>'Yönetici Notu','class'=>'col-sm-2','id'=>'notLabel'),
            'widgetOptions' => array(
            'editorOptions' =>array(
            'lang'=>'tr',
            'minHeight'=>'120',
            'options' => array('plugins' => array('clips', 'fontfamily'),'rows'=>6)
            ),
            'htmlOptions'=>array('value'=>$a,'placeholder'=>$placeholder,'id'=>'area',),
            ),

            )
            );?>
           
            <div class="form-group" id="details_buttons">


            <?php      
            echo CHtml::submitButton('Gönder',array('ajax'=>array(
                        'url'=>Yii::app()->createUrl('tables/mail'),
                        'type'=>'POST',
                        'data'=>array('mail'=>'js:$("#mail_text").val()','area'=>'js:$("#area").val()'),
                        'success' => " function (response) { if(response.indexOf('error')==-1) { $('#success').show();"
                                    . " setTimeout(function(){location.reload();}, 1000); } else $('#error').show();}",
                        'error' => " function (response) { if(response=='error') $('#error').show(); }" ,
                        ),'class'=>'btn btn-success',
                        'confirm' => 'Bu işlemi yapmak istediğinize emin misiniz?',
                        'id' => 'sendpdf'));
           ?>

            </div> 

    <?php $this->endWidget(); 
    $this->endWidget(); ?>

<script src="<?php echo BaseUrl;?>/js/admin/waitajax.js"></script>
<script src="<?php echo BaseUrl;?>/js/data-hide.js"></script>               