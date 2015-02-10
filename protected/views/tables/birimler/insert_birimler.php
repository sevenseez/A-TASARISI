	<div class="modal fade" id="insert_screen">
            <div class="modal-dialog" id="insert_dialog">
       
		 <div class="modal-content" id="insert_content"> 
                     <a class="close"  data-dismiss="modal">&times;</a>
                   <?php $form = $this->beginWidget(
                   'booster.widgets.TbActiveForm',
                           array(
                           'id' => 'form',
                           'type'=>'horizontal',
                           'action'=>'birimler',
                           'enableClientValidation'=>true,
                           'clientOptions'=>array(
                                   'validateOnSubmit'=>true,
                                    'afterValidate' => 'js:function(hasError) { 
                           
                                    return confirm("İşleme devam edilsin mi?");

                                   }'
                                   ),

                           )
                           );?>
				
				<?php 
                                
                                  echo $form->textFieldGroup($model,'birim_adi',array(
                                'labelOptions'=>array('label'=>'Birim Adı','class'=>'col-sm-2'),
                                'wrapperHtmlOptions'=>array('class'=>'col-sm-6')
                                    ));
                                  ?>
                                    
					
					
					
					<div class="form-group ">
					<div class="insert_buttons">
                                            <?php echo CHtml::submitButton('Ekle', 
                                                                    array('name' => 'InsertButton',
                                                                        'id'=>'insert',
                                                                        'class' =>'btn btn-primary',
                                                                        ));
                                          ?>
					<button type="button" data-dismiss="modal" class="btn btn-primary">İptal</button>
					</div>
					<!-- <a id="submit" href="javascript: check_empty()">Send</a> -->
					</div> 
					
				<?php $this->endWidget();?>
				</div>
                            </div>
			</div> 
	