<?php
$baseUrl = Yii::app()->baseUrl;
?>
<link rel="stylesheet" href='<?php echo $baseUrl ?>/css/admin/table.css'>
    <link rel="stylesheet" href="<?php echo $baseUrl ?>/css/admin/details.css">


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><a class="no-link-features" href="islemler">İşlemler</a></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                           <?php echo CHtml::beginForm();?>
                            <div class="table-buttons">
                                
            <?php
                echo CHtml::ajaxButton('Ekle', Yii::app()->createUrl('tables/insert',array('table'=>'Islemler')), 
                                    array(
                                        'type'=>'POST',
                                        'url'=>'js:$(this).attr("href")',                        
                                        'success'=>"js:function (data) { 
                                            $('#insertContent').html(data);
                                            $('#insert_screen').modal('show');
                                            }"           
                                    ),array('class'=>'btn btn-default',));
                
                
                echo CHtml::submitButton('Sil', array('name' => 'DeleteButton',
                                    'id' => 'delete',
                                    'class' => 'btn btn-default',
                                    'confirm' => 'Bu verileri silmek istediğinizden emin misiniz?'));
                                ?>
                                
                                <div style="margin-left:10px;" class="form-group">
                                 Satır Sayısı : 
                                </div>
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

                                <?php
                                $this->widget('booster.widgets.TbGridView', array(
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
                                'class' => 'CCheckBoxColumn', ),
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
                                                    'table'=>"cihazlar",
                                                    'att'=>"cihaz_id"),
                                                    'class'=>'no-link-features forward-table',
                                                ));
                                    },
                                    ),
                                 array('header'=> 'İsteği Yapan',
                                    'name' => 'istek_sahibi'
                                ),
                                array('header'=> 'Sicil No.',
                                    'name' => 'sicil_no'
                                ),
                                array('header' => 'IP Adresi',
                                'name' => 'ip_addr',
                                'value' => function($data){
                                return long2ip($data->ip_addr);},
                                ),
                                 array('header'=> 'Telefon',
                                    'name' => 'istek_telefon'
                                ),
                                array('header'=> 'E-Posta',
                                    'name' => 'istek_email'
                                ),
                                array('header' => 'Birim',
                                      'name' => 'birimAdi',
                                      'value' => '$data->istekBirim->birim_adi'
                                    ),
                                array('header' => 'Başlangıç Tarihi',
                                'name' => 'baslangic',
                                'value' => function ($data){
                                return date('d-m-Y H:i:s',strtotime($data->baslangic));
                                },
                                ),
                                array
                                (
                                'class'=>'CButtonColumn',
                                'htmlOptions' => array('style' => 'width: 80px;'),
                                'template'=>'{details}{edit}',
                                'buttons'=>array (
                                'details' => array
                                (   
                                'label' => '',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("tables/details",array("id"=>$data->islem_no))',
                                'options'=>array( 
                                'title' => 'İşlem Ayrıntıları',
                                'class'=>'fa fa-search',
                                'style' => 'text-decoration:none; margin-left:10px; font-size:18px;',
                                'ajax'=>array(
                                'type'=>'POST',
                                'url'=>'js:$(this).attr("href")',
                                'success' => " function (data) { 
                                $('#detailsContent').html(data);
                                $('#details_screen').modal('show');
                                }"
                                ),
                                ),
                                ),
                                'edit' => array
                                (   
                                'label' => '',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("tables/edit",array("id"=>$data->islem_no,"table"=>"Islemler"))',
                                'options'=>array( 
                                'title' => 'Düzenle',
                                'class'=>'fa fa-pencil',
                                'style' => 'text-decoration:none; margin-left:10px; font-size:18px;',
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
                                        

                                //specify the colums you wanted here
                                )
                                ));
                                ?>

                            </div>
                            <!-- /.table-responsive -->
                            
  <?php echo CHtml::endForm();?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

        </div>
        <!-- /#page-wrapper -->
        
        <div id="insertContent"></div>
        <div id="editContent"></div>
        <div id="detailsContent"></div>
   
        </div>
        <!-- /#wrapper -->


        <script src="<?php echo $baseUrl; ?>/js/admin/cell_edit.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/admin/search.js"></script>


        <style>.deneme {border:none;  
                 background: rgba(54, 25, 25, 0);}</style>
