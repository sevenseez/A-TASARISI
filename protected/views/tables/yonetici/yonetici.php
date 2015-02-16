<link rel="stylesheet" href='<?php echo BaseUrl;?>/css/admin/table.css'>

  

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><a class="no-link-features" href="yonetici">Yönetici</a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php echo CHtml::beginForm(); ?>
                            <div class="table-buttons">
             <?php
                echo CHtml::ajaxButton('Ekle', Yii::app()->createUrl('tables/insert',array('table'=>'Yonetici')), 
                                    array(
                                        'type'=>'POST',
                                        'url'=>'js:$(this).attr("href")',                        
                                        'success'=>"js:function (data) { 
                                            $('#insertContent').html(data);
                                            $('#insert_screen').modal('show');
                                            }"           
                                    ),array('class'=>'btn btn-default',));
                
                
                echo CHtml::submitButton('Sil', 
                                            array('name' => 'DeleteButton',
                                                'id'=>'delete',
                                                'class' =>'btn btn-default',
                                            'confirm' => 'Bu verileri silmek istediğinizden emin misiniz?'));
                                            ?>
                                             
                                        
                                        
                                         <div class="form-group">
                                            <?php

                                            $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']); 

                                            echo CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),
                                                    array(
                                                        'class'=>'form-control','id'=>'per_page',
                                                        )
                                                    );
                                                ?>

                                            </div>
                                       
                                        <div class=" form-group col-md-4" id="search_box">
                                            <input type="text" class="form-control" id="search_text" placeholder="Arama Yap"/>

                                         </div>
                                    </div>
                            <div class="table-responsive">
                                
                                     <?php $this->widget('booster.widgets.TbGridView', array(
                                            'dataProvider' => $model,
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
                                                array( 'header' => 'ID',
                                                        'name' => 'y_id',
                                                        'cssClassExpression' => '"identity"',
                                                ),
                                                'y_adsoyad',
                                                'y_email',
                                                 array('header' => 'Birimi',
                                                    'name' => 'birimAdi',
                                                    'value' => '$data->yoneticiBirim->birim_adi'
                                                    ),
                                                'y_kullanici_adi',
                                                'y_sifre',
                                                   
                                                array('header' => 'Yetki',
                                                    'name'=>'yetki',
                                                    'value' => function($data) {
                                                                     return $data->yetkiarray[$data->yetki];
                                                                    },),
                                                // Buton kolonu tanımlaması
                                                 array
                                                    (
                                                        'class'=>'CButtonColumn',
                                                        'htmlOptions' => array('style' => 'width: 80px; margin-left:20px;'),
                                                        'template'=>'{edit}',
                                                    'buttons'=>array (
                                                    'edit' => array
                                                        (   
                                                            'label' => '',
                                                            'imageUrl'=>false,
                                                            'url'=>'Yii::app()->createUrl("tables/edit",array("id"=>$data->y_id,"table"=>"Yonetici"))',
                                                        'options'=>array( 
                                                                'title' => 'Düzenle',
                                                                'class'=>'fa fa-pencil',
                                                                'style' => 'text-decoration:none; margin-left:20px; font-size:20px;',
                                                                'ajax'=>array(
                                                                    'type'=>'POST',
                                                                     'url'=>'js:$(this).attr("href")',
                                                                     'success' => " function (data) { 
                                                                        $('#editContent').html(data);
                                                                        $('#edit_screen').modal('show');
                                                                                }"
                                                                 ),
                                                             ),
                                                            ),
                                                        )
                                                    ),   
                                             // Buton kolon array tanımlaması sonu 
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
        <div id="editContent"></div>
        <div id="insertContent"></div>
    </div>
    <!-- /#wrapper -->

	
        <script src="<?php echo BaseUrl;?>/js/admin/cell_edit.js"></script>
	<script src="<?php echo BaseUrl;?>/admin/search.js"></script>
	




