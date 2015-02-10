     <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Ana Panel</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel nav-change panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" for="0"></div>
                                    <div>Yeni İstek!</div>
                                </div>
                            </div>
                        </div>
                             <?php echo CHtml::link('<div class="panel-footer">'
                                . '<span class="pull-left">Ayrıntılar</span>'
                                .'<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> '
                                . '<div class="clearfix"></div></div>',
                                array('admin/bildirim', 'activity_type'=>'0'));
                             ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel nav-change panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-plus-square fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" for="2"></div>
                                    <div>Yeni Ekleme!</div>
                                </div>
                            </div>
                        </div>
                        <?php echo CHtml::link('<div class="panel-footer">'
                                . '<span class="pull-left">Ayrıntılar</span>'
                                .'<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> '
                                . '<div class="clearfix"></div></div>',
                                array('admin/bildirim', 'activity_type'=>'2'));
                        ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel nav-change panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-refresh fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" for="1"></div>
                                    <div>Yeni Güncelleme!</div>
                                </div>
                            </div>
                        </div>
                         <?php echo CHtml::link('<div class="panel-footer">'
                                . '<span class="pull-left">Ayrıntılar</span>'
                                .'<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> '
                                . '<div class="clearfix"></div></div>',
                                array('admin/bildirim', 'activity_type'=>'1'));
                         ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel nav-change panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-trash-o fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge" for="3"></div>
                                    <div>Yeni Silme!</div>
                                </div>
                            </div>
                        </div>
                            <?php echo CHtml::link('<div class="panel-footer">'
                                . '<span class="pull-left">Ayrıntılar</span>'
                                .'<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span> '
                                . '<div class="clearfix"></div></div>',
                                array('admin/bildirim', 'activity_type'=>'3'));
                            ?>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> İşlem Zaman Çizelgesi
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                                
                                <?php  
                                
                                $this->widget('zii.widgets.CListView', array(
                                            'dataProvider' => $dataProvider,
                                            'itemsTagName' => 'ul',
                                            'itemsCssClass'=>'timeline',
                                            'itemView' => 'application.views.admin.extra.newsfeed',
                                            'summaryText'=>'',
                                            'emptyText' => 'Yeni Mesaj Bulunamadı.',
                                            ));?>
                                
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
               <?php $this->renderPartial('extra/chat',array('dataProvider_chat'=>Chat::model()->search()));?>
                    <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
	</div>
	<!--- wrapper --->
      <script src="/ProjectNew/js/admin/change_active.js"> </script>