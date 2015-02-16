  <link rel="stylesheet" href="<?php BaseUrl;?>/css/admin/replySikayet.css"/>
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
            'action'=>'reddet/'.$id,
            'id'=>'reddetMsg',
            
                 ) ); 
?>
            

                        <a class="close"  data-dismiss="modal">&times;</a>
                       
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
                        <div class="form-group .btn-reddet">
                            <div class="col-md-12">
                                  <?php echo CHtml::submitButton('Gönder', 
                                                                    array('name' => 'replyButton',
                                                                        'class' =>'btn btn-success btn-reddet',
                                                                    'onClick'=>'return confirm("Mesajınız gönderilsin mi?");'));
                                          
                                  echo CHtml::button('İptal',array('name'=>'iptalButton','class'=>'btn btn-danger',
                                      'data-dismiss'=>'modal'));
                                  ?>
                            </div>
                        </div>
                <?php $this->endWidget();?>
                <?php 
                $this->endWidget();
                ?>
  