<div class="modal fade" id="insert_screen">
<div class="modal-dialog" id="insert_dialog">

     <div class="modal-content" id="insert_content"> 
         <a class="close"  data-dismiss="modal">&times;</a>
       <?php $form = $this->beginWidget(
       'booster.widgets.TbActiveForm',
               array(
               'id' => 'form',
               'type'=>'horizontal',
               'action'=>'islemler',
               'enableClientValidation'=>true,
               'clientOptions'=>array(
                       'validateOnSubmit'=>true,
                         'afterValidate' => 'js:function(hasError) { 
                           
                             return confirm("İşleme devam edilsin mi?");
                            
                            }'
                       ),

               )
               );
       
               echo $form->dropDownListGroup($model, 'cihaz_id', array(
                    'wrapperHtmlOptions' => array(
                        'class' => 'col-sm-6',
                    ),
                    'widgetOptions' => array(
                        'data' => Cihazlar::model()->cihazlist,),
                    'labelOptions' => array('label' => 'Cihaz ID/Adı', 'class' => 'col-sm-2'),
                ));
                 include ('islem_form.php');
                    ?>
                      



                    <div class="form-group ">
                        <div class="insert_buttons">
                            <?php
                            echo CHtml::submitButton('Ekle', array('name' => 'InsertButton',
                                'id' => 'insert',
                                'class' => 'btn btn-primary',));
                            ?>
                       <button type="button" data-dismiss="modal" class="btn btn-primary">İptal</button>
                                                    </div>
                                                    <!-- <a id="submit" href="javascript: check_empty()">Send</a> -->
                                                </div> 

                            <?php $this->endWidget(); ?>
     </div>
</div>
</div> 
	