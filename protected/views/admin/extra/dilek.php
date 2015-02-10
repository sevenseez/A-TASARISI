<div id="page-wrapper">
    <div class="row">
         <div class="col-lg-6 " id="sikayet-col">
<?php

 $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => $itemView,
        'summaryText'=>'',
        'emptyText' => 'Yeni Mesaj Bulunamadı.',
        )); ?> 
    
    
        </div></div> 
    </div>
   <div id="replyContent"></div>
