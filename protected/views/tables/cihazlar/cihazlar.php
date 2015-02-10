<?php
$baseUrl = Yii::app()->baseUrl;
?>
<link rel="stylesheet" href='<?php echo $baseUrl ?>/css/admin/table.css'>



    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><a class="no-link-features" href="cihazlar">Cihazlar</a></h1>
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
                            <?php
                    echo CHtml::ajaxButton('Ekle', Yii::app()->createUrl('tables/insert',array('table'=>'Cihazlar')), 
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
                            $this->widget('booster.widgets.TbExtendedGridView', array(
                                'dataProvider' => $model,
                                'id'=>'table_grid',
                                'pager'=>array(
                                  'header'=>'<div class="pull-right">'
                                ),
                                'template'=>"{summary}{items}<br>{pager}{extendedSummary}",
                                'type' => 'striped bordered',
                                'selectableRows' => 2,
                                'columns' => array(
                                    array(
                                        'id' => 'selectedIds',
                                        'class' => 'CCheckBoxColumn',),
                                    array(
                                    'header'=>'İşlem',
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
                                                    'table'=>"islemler",
                                                    'att'=>"cihaz_id"),
                                                    'class'=>'no-link-features forward-table',
                                                ));
                                    },
                                    ),
                                    array('header' => 'Adı',
                                        'name' => 'cihaz_adi'
                                    ),
                                    array('header' => 'Seri No',
                                        'name' => 'cihaz_serino'
                                    ),
                                    array('header' => 'Durum',
                                           'name'=>'cihaz_durum',
                                        'value' => function($data) {
                                            return $data->durum[$data->cihaz_durum];
                                        },
                                    ),
                                    array('header' => 'Arıza Nedeni',
                                        'name' => 'ariza_nedeni'
                                    ),
                                    'yonetici_notu',
                                    array('header' => 'Cihaz Türü',
                                          'name'=>'markaTipi',
                                        'value' => '$data->cihazMarka->marka_tipi'
                                    ),
                                    array('header' => 'Cihaz Marka',
                                        'name'=>'markaAdi',
                                        'value' => '$data->cihazMarka->marka_adi',
                                    ),
                                    array
                                        (
                                        'class' => 'CButtonColumn',
                                        'template' => '{edit}',
                                        'buttons' => array(
                                            'edit' => array
                                                (
                                                'label' => '',
                                                'imageUrl' => false,
                                                'url' => 'Yii::app()->createUrl("tables/edit",array("id"=>$data->cihaz_id,"table"=>"Cihazlar"))',
                                                'options' => array(
                                                    'title' => 'Düzenle',
                                                    'class' => 'fa fa-pencil',
                                                    'style' => 'text-decoration:none; font-size:20px;',
                                                    'ajax' => array(
                                                        'type' => 'POST',
                                                        'url' => 'js:$(this).attr("href")',
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
                                ),
                                'extendedSummary' => array(
                                'title' => 'İşlem Durumları',
                                'columns' => array(
                                'cihaz_durum' => array(
                                'label' => 'Yüzdeler',
                                'types' => array(
                                'Alınıyor'=>array('label'=>'Alınıyor'),
                                'Beklemede'=>array('label'=>'Beklemede'),
                                'Garantide'=>array('label'=>'Garantide'),
                                'İşlemde'=>array('label'=>'İşlemde'),
                                'Gönderiliyor'=>array('label'=>'Gönderiliyor'),
                                ),
                                'class'=>'TbPercentOfTypeGooglePieOperation',
                               
                                'chartOptions' => array(
                                'barColor' => '#333',
                                'trackColor' => '#999',
                                'lineWidth' => 8 ,
                                'lineCap' => 'square'
                                )
                                )
                                )
                                ),
                                'extendedSummaryOptions' => array(
                                'class' => 'well',
                                'id'=>'thewell',
                                'style' => 'width:520px;height:300px;'
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
 <div id="insertContent"></div>
 <div id="editContent"></div>

</div>
<!-- /#wrapper -->


<script src="<?php echo $baseUrl; ?>/js/admin/cell_edit.js"></script>
<script src="<?php echo $baseUrl; ?>/js/admin/search.js"></script>




