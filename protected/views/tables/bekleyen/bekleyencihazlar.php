<?php
$baseUrl = Yii::app()->baseUrl; 
?>
 <link rel="stylesheet" href='<?php echo $baseUrl?>/css/admin/table.css'>

  

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><a class="no-link-features" href="bekleyencihazlar">Onay Bekleyen Cihazlar</a></h1>
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
                                                                        'table'=>"bekleyenislemler",
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
                                                array('header' => 'Cihaz Türü',
                                                    'name' => 'markaTipi',
                                                    'value' => '$data->cihazMarka->marka_tipi'
                                                    ),
                                                array('header' => 'Cihaz Marka',
                                                    'name' => 'markaAdi',
                                                    'value' => '$data->cihazMarka->marka_adi'
                                                    ),                           

                                                array('header' => 'Arıza Nedeni',
                                                    'name' => 'ariza_nedeni'
                                                    ),
                                               
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

	
        <script src="<?php echo $baseUrl;?>/js/admin/cell_edit.js"></script>
	 <script src="<?php echo $baseUrl;?>/js/admin/search.js"></script>
	



