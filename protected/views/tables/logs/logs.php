<?php
$baseUrl = Yii::app()->baseUrl;
?>
<link rel="stylesheet" href='<?php echo $baseUrl ?>/css/admin/table.css'>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><a class="no-link-features" href="logs">Loglar</a></h1>
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
                                 <div style="margin-left:10px;" class="form-group">
                               Satır Sayısı : 
                             </div>
                            
                                <div class="form-group">
                            <?php
                            
                            $pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']); 

                            echo CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),
                                    array(
                                        'class'=>'form-control','id'=>'per_page','table'=>'logs',
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
                                array('header'=>'Olay', 
                                        'name'=>'action',
                                        'value' => function($data) {
                                        return Notify::model()->activity_desc($data->action);
                                        }),
                                    
                                array('header'=>'Açıklama', 
                                        'value'=>function($data){
                                    
                                        $description =  Yii::app()->user->real_name($data->userid).' '.$data->model
                                                .' tablosundaki '
                                                .' [' . $data->idModel .']'
                                                .' numaralı veride işlem yaptı.';
                                        return $description;
                                        }
                                    
                                    ),
                                array('header'=>'Değişim',
                                    'name'=>'field',
                                    ),
                                array(
                                    'header'=>'Tablo',
                                    'type'=>'raw',
                                    'name'=>'model',
                                    'htmlOptions' => array('max-width:100px;'),
                                    'value'=>function($data){
                                        if($data->model=='Dilek') {$link='admin/dilek';}
                                        else $link= 'tables/'.$data->model;
                                        return CHtml::link($data->model,
                                                array($link),
                                                array('class'=>'no-link-features')
                                               );
                                    },
                                    ),
                                array(
                                    'header'=>'Veri ID',
                                    'name' => 'idModel',
                                    'type'=>'raw',
                                    'value'=>function($data){
                                        return CHtml::link($data->idModel,
                                                array('tables/generalFocusRow'),
                                                array(
                                                    'type'=>'POST',
                                                    'submit'=>array('tables/generalFocusRow'),
                                                    'params'=>array(
                                                    'id'=>$data->idModel,
                                                    'table'=>$data->model),
                                                    'class'=>'no-link-features forward-table',
                                                ));
                                    },
                                    ),
                                 array('header'=> 'Tarih',
                                        'name'=>'creationdate',
                                      'value' => function ($data){
                                        return date('d-m-Y H:i:s',strtotime($data->creationdate));
                                        },),
                                   array(
                                    'header'=>'Yönetici ID',
                                    'name' => 'userid',
                                    'type'=>'raw',
                                    'value'=>function($data){
                                         if($data->userid=='0') { return '<p class="mstrk">Müşteri</p>';}
                                         else
                                        return CHtml::link(Yii::app()->user->real_name($data->userid),
                                                array('tables/generalFocusRow'),
                                                array(
                                                    'type'=>'POST',
                                                    'submit'=>array('tables/generalFocusRow'),
                                                    'params'=>array(
                                                    'id'=>$data->userid,
                                                    'table'=>'Yonetici'),
                                                    'class'=>'no-link-features forward-table',
                                                ));
                                    },
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


        <script src="<?php echo $baseUrl; ?>/js/admin/cell_edit.js"></script>
        <script src="<?php echo $baseUrl; ?>/js/admin/search.js"></script>
   
