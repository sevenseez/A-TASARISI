<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Bildirimler</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="nav nav-change nav-tabs" id="nav-id">
                        <li >
                         <?php echo CHtml::link('İstek',array('admin/bildirim','activity_type'=>'0')); ?>   
                            
                        </li>
                        <li >
                         <?php echo CHtml::link('Güncelleme',array('admin/bildirim','activity_type'=>'1')); ?>  
                        </li>
                         <li >
                         <?php echo CHtml::link('Ekleme',array('admin/bildirim','activity_type'=>'2')); ?>   
                            
                        </li>
                         <li >
                         <?php echo CHtml::link('Silme',array('admin/bildirim','activity_type'=>'3')); ?>   
                            
                        </li>
                         <li >
                         <?php echo CHtml::link('Tümü',array('admin/bildirim')); ?>   
                            
                        </li>
                        
                    </div>
                    <div class="panel panel-default"> 
                    <div class="panel-body">
                              
                                 <?php  
                              
                                $this->widget('zii.widgets.CListView', array(
                                            'dataProvider' => $dataProvider,
                                            'itemsTagName' => 'ul',
                                            'itemsCssClass'=>'timeline',
                                            'itemView' => $itemView,
                                            'summaryText'=>'',
                                            'emptyText' => 'Yeni Mesaj Bulunamadı.',
                                            ));?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
        </div>

    </div>
    <script src="<?php echo BaseUrl;?>/js/admin/change_active.js"> </script>