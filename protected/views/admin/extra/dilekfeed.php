<div class="panel panel-primary">
    <div class="panel-heading">
        Konu : <?php echo $data->d_konu; ?>
        <div class="pull-right">
        <?php echo CHtml::ajaxLink('Yanıtla', Yii::app()->createUrl('admin/replySikayet'),
                array('type'=>'POST',
                      'data'=> array('id'=>$data->d_id),
                      'success' => "js:function(data){
                       $('#replyContent').html(data);
                       $('#reply_screen').modal('show'); 
            
                      }",
                    
                    )
                ,array('class'=>'no-link-features reply')); ?>
      </div>
    </div>
    <div class="panel-body">
         <?php echo $data->d_icerik; ?> 
        
    </div>
    <div class="panel-footer grey">
        <?php echo $data->d_adsoyad.' - '.$data->d_email.' - '.long2ip($data->d_ip_addr); ?>  
    </div>
</div>

