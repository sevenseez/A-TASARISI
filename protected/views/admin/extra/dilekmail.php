   <link rel="stylesheet" href="<?php echo BaseUrl;?>/css/admin/replySikayet.css"/>
 <?php
        
$this->beginWidget(
            'booster.widgets.TbModal',
            array('id' => 'reply_screen',
               )
            ); 
                
  $form = $this->beginWidget(
            'booster.widgets.TbActiveForm',
             array(
            'type' => 'horizontal' ,
            'action'=>'replyMessage'
            
                 ) ); 
?>
            

                        <a class="close"  data-dismiss="modal">&times;</a>
                        <input class="form-control" type="hidden" id="idMsg" name="idMsg" value=<?php echo $id?>>
                         
                       
                      
                        
                      <?php 
                       echo $form->redactorGroup(
                            $model,
                            'doll',
                            array(
                            'labelOptions'=>array('label'=>'','class'=>'col-sm-2'),
                            'widgetOptions' => array(
                            'editorOptions' =>array(
                            'lang'=>'tr',
                            'minHeight'=>'120',
                            'options' => array('plugins' => array('clips', 'fontfamily'),'rows'=>6)
                            ),
                            'htmlOptions'=>array('id'=>'replyMsg','name'=>'replyMsg'),
                            ),
                            )
                            );?>
                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                  <?php echo CHtml::submitButton('Gönder', 
                                                                    array('name' => 'replyButton',
                                                                        'class' =>'btn btn-success btn-dilek',
                                                                    'onClick'=>'return confirm("Mesajınız gönderilsin mi?");'));
                                          ?>
                            </div>
                        </div>
                <?php $this->endWidget();?>
                <?php 
                $this->endWidget();
                ?>
  