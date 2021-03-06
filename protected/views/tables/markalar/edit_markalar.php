﻿	<div class="modal fade" id="edit_screen">
    <div class="modal-dialog" id="edit_dialog">

        <div class="modal-content" id="edit_content"> 
            <a class="close"  data-dismiss="modal">&times;</a>
            <?php
            $form = $this->beginWidget(
                    'booster.widgets.TbActiveForm', array(
                'id' => 'form',
                'type' => 'horizontal',
                 'action'=>'markalar',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'afterValidate' => 'js:function(hasError) { 
                           
                             return confirm("İşleme devam edilsin mi?");
                            
                            }'
                ),
                    )
            );
            ?>



            <?php echo $form->hiddenField($model, 'marka_id', 
                    array('class' => 'form-control', 'type' => "hidden", 'size' => 2, 'maxlength' => 2));
            
            
                echo $form->textFieldGroup($model,'marka_adi',array(
                          'labelOptions'=>array('label'=>'Marka Adı','class'=>'col-sm-2'),
                          'wrapperHtmlOptions'=>array('class'=>'col-sm-6')
                              ));
                
                  echo $form->textFieldGroup($model,'marka_tipi',array(
                                'labelOptions'=>array('label'=>'Marka Türü','class'=>'col-sm-2'),
                                'wrapperHtmlOptions'=>array('class'=>'col-sm-6')
                                    ));
                ?>
           

            <div class="form-group ">
                <div class="edit_buttons">
                    <?php
                    echo CHtml::submitButton('Kaydet', array('name' => 'UpdateButton',
                        'id' => 'update',
                        'class' => 'btn btn-primary',
                        ));
                    ?>
                    <button type="button" data-dismiss="modal" class="btn btn-primary">İptal</button>
                </div>
                <!-- <a id="submit" href="javascript: check_empty()">Send</a> -->
            </div> 

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div> 
