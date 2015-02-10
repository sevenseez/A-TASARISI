
    <?php
            
            $form = $this->beginWidget(
            'booster.widgets.TbActiveForm',
             array(
            'type' => 'horizontal' , 
            'action'=>'#'));
            ?>  
    <fieldset disabled>
        <div class="form-group">
                <p id="cihaz_span"> Cihazın ;</p>
        </div>           
         <?php
          echo $form->textFieldGroup($data,'cihaz_serino',array('labelOptions'=>array('label'=>'Seri No.')));
          
          echo $form->textFieldGroup($data,'cihaz_adi',array('labelOptions'=>array('label'=>'Adı')));
           
          echo $form->textFieldGroup($data,'cihaz_durum',array('labelOptions'=>array('label'=>'İşlem Durumu'),
              'widgetOptions'=>array('htmlOptions'=>array('value'=>$data->durum[$data['cihaz_durum']]))
              ));
          if($data->yonetici_notu!=null)
        echo $form->textAreaGroup(
                        $data,'yonetici_notu',
                        array(
                       'labelOptions' => array('label' => 'Yönetici Notu','class'=>'col-sm-3'),
                        'widgetOptions' => array(
                        'htmlOptions' => array('rows' => 3),
                        ),
                        'wrapperHtmlOptions' => array('class' => 'col-sm-9'),
                        )
                                            );
         
          echo $form->textFieldGroup($data,'guncelleme',array('labelOptions'=>array('label'=>'Son İşlem Tarihi')));
          
         echo $form->textFieldGroup($data,'doll',array('labelOptions'=>array('label'=>'Türü'),
              'widgetOptions'=>array('htmlOptions'=>array('value'=>$data['cihazMarka']['marka_tipi']))
              ));
         ?>
       
	</fieldset>
<?php	$this->endWidget(); ?>
    
