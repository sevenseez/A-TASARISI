<?php 
$baseUrl = Yii::app()->baseUrl; 
?>
 <link rel="stylesheet" href='<?php echo $baseUrl?>/css/admin/table.css'>
 <link rel="stylesheet" href="<?php echo $baseUrl?>/css/admin/details.css">
  

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><a class="no-link-features" href="bekleyenislemler">Onay Bekleyen İşlemler</a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php echo CHtml::beginForm(); ?>
                                 <div class="table-buttons">
                                     
                                         <div class="form-group">
                                            Satır Sayısı : 
                                          </div>
                                     <div class="form-group">
                                         <?php
                                         $pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);

                                         echo CHtml::dropDownList('pageSize', $pageSize, array(10 => 10, 20 => 20, 30 => 30), array(
                                             'class' => 'form-control', 'id' => 'per_page',
                                                 )
                                         );
                                         ?>

                                     </div>
                                       
                                        <div class=" form-group col-md-4" id="search_box">
                                            <input type="text" class="form-control" id="search_text" placeholder="Arama Yap"/>

                                         </div>
                                    </div>
                            <div class="table-responsive">
                                    
                                     <?php 
                                            $this->widget('booster.widgets.TbGridView', array(
                                            'dataProvider' =>$model,
                                            'id'=>'table_grid',
                                             'pager'=>array(
                                               'header'=>'<div class="pull-right">'
                                            ),
                                            'template'=>"{summary}{items}<br>{pager}",
                                            'type' => 'striped bordered',
                                            'selectableRows' => 2,
                                            'columns' => array(
                                                array( 
                                                    'id' => 'selectedIds',
                                                    'class'=>'CCheckBoxColumn',),
                                                   array(
                                                        'header'=>'Cihaz',
                                                        'name'=>'cihaz_id',
                                                        'type'=>'raw',
                                                        'value'=>function($data){
                                                            return CHtml::link('<i class="fa fa-arrow-left"></i>',
                                                                    array('tables/focusRow'),
                                                                    array(
                                                                        'type'=>'POST',
                                                                        'submit'=>array('tables/focusRow'),
                                                                        'params'=>array(
                                                                        'id'=>$data->cihaz_id,
                                                                        'table'=>"bekleyencihazlar",
                                                                        'att'=>"cihaz_id"),
                                                                        'class'=>'no-link-features forward-table',
                                                                    ));
                                                        },
                                                        ),
                                                array('header' => 'İsteği Yapan',
                                                    'name' => 'istek_sahibi',
                                                    ),
                                                array('header' => 'Sicil Nu.',
                                                    'name' => 'sicil_no',
                                                    ),
                                                array('header' => 'IP Adresi',
                                                      'name' => 'ip_addr',
                                                    'value' => function($data){
                                                        return long2ip($data->ip_addr);},
                                                    ),
                                                 array('header' => 'Telefon',
                                                    'name' => 'istek_telefon'
                                                    ),
                                                array('header' => 'E-Posta',
                                                    'name' => 'istek_email'
                                                    ),
                                                array('header' => 'Birim',
                                                    'name' => 'birimAdi',
                                                    'value' => '$data->istekBirim->birim_adi'
                                                    ),
                                                 array('header' => 'Tarih',
                                                    'name' => 'tarih'
                                                    ),                
                                                array
                                                    (
                                                        'class'=>'CButtonColumn',
                                                        'htmlOptions' => array('style' => 'width: 80px;'),
                                                        'template'=>'{onayla}{reddet}',
                                                    'buttons'=>array (
                                                    'onayla' => array
                                                        (   
                                                            'label' => '',
                                                            'imageUrl'=>false,
                                                            'url'=>'Yii::app()->createUrl("tables/onayVer",array("id"=>$data->islem_no))',
                                                        'options'=>array( 
                                                                'title' => 'Onay Ver',
                                                                'class'=>'fa fa-check',
                                                                'style' => 'text-decoration:none; margin-left:10px; font-size:18px; color:green;',
                                                               
                                                            ),
                                                        ),
                                                        'reddet' => array
                                                        (   
                                                            'label' => '',
                                                            'imageUrl'=>false,
                                                            'url'=>'Yii::app()->createUrl("tables/reddet",array("id"=>$data->islem_no))',
                                                        'options'=>array( 
                                                                'title' => 'Reddet',
                                                                'class'=>'fa fa-times',
                                                                'style' => 'text-decoration:none; margin-left:10px; font-size:18px; color:red;',
                                                                   'ajax'=>array(
                                                                    'type'=>'POST',
                                                                    'url'=>'js:$(this).attr("href")',
                                                                    'success' => " function (data) { 
                                                                    $('#reddetContent').html(data);
                                                                    $('#reply_screen').modal('show');
                                                                    }"
                                                                    ),
                                                             ),
                                                          ),
                                                 )
                                             ),
                                               

                                             //specify the colums you wanted here
                                            ),
                                        ));
                                    ?>
									
                            </div>
                            <!-- /.table-responsive -->
                            <?php echo CHtml::endForm(); ?> 
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
        </div>
        <!-- /#page-wrapper -->
		

    </div>
    <!-- /#wrapper -->
    <div id="reddetContent"></div>
	
        <script src="<?php echo $baseUrl;?>/js/admin/cell_edit.js"></script>
	<script src="<?php echo $baseUrl;?>/js/admin/search.js"></script>
        <script src="<?php echo $baseUrl?>/js/data-hide.js"></script>


        <style>.deneme {border:none;  
                background: rgba(54, 25, 25, 0);}</style>
