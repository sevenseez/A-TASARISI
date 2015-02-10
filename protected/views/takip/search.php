<div id="left-result">
           <?php
          
            $form = $this->beginWidget(
            'booster.widgets.TbActiveForm',
             array(
            'id' => 'result_form',
            'type' => 'horizontal' , 
            'action'=>'#'));
            ?>  
		<fieldset disabled>
          <div class="form-group">
                <p id="cihaz_span"> Cihaz Sahibinin ;</p>
        </div>              
        <div class="form-group">

                <label for="isim_text" class="col-xs-2 col-sm-2 control-label" > Adı Soyadı </label>
                <div class="col-xs-2 col-sm-8">
                    <?php 
                        echo $form->textField($model_i,'istek_sahibi',array('class'=>'form-control'));?>

                </div>
                </div>           
                <div class="form-group">
                 <label for="sicil_no" class="col-xs-2 col-sm-2 control-label" >Sicil Nu. </label>
                <div class="col-xs-2 col-sm-8">
                    <?php   
                    echo $form->textField($model_i,'sicil_no',array('class'=>'form-control'));?>

                </div>
        </div>

        <div class="form-group">
                <label for="email" class="col-xs-2 col-sm-2 control-label" > Email </label>
                <div class="col-xs-2 col-sm-8">
                    <?php echo $form->textField($model_i,'istek_email',array('class'=>'form-control'));?>

                </div>
            </div> 
            <div class="form-group">
                <label for="telefon" class="col-xs-2 col-sm-2 control-label" >Telefon </label>
                <div class="col-xs-2 col-sm-8">
                    <?php echo $form->textfield($model_i,'istek_telefon',array('class'=>'form-control'));?>

                </div>
            </div>
             <div class="form-group">
                <label for="birim_text" class="col-xs-2 col-sm-2 control-label" >Birimi </label>
                <div class="col-xs-2 col-sm-8">
                    <?php echo $form->textfield($model_i,'istek_birim',array('class'=>'form-control','value'=>$model_i['istekBirim']['birim_adi']));?>

                </div>
        </div>
                  
         <?php	$this->endWidget();
         
         echo '</div>';
         
         $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => $dataArray,
                        'itemsTagName' => 'ul',
                        'htmlOptions'=>array('id'=>'right-result'),
                        'itemView' => $itemView,
                        'summaryText'=>'',
                        'emptyText' => 'Sonuç Bulunamadı.',
                        ));?>
         
  