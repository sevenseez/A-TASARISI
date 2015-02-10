<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
              
                <a class="navbar-brand" href="index"><?php echo Yii::app()->user->first_name;?></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li><a href="/ProjectNew/tables/islemler" title="İşlemlere Git">
                        <div class="fa-stack">
                        <i class="fa fa-stack-2x fa-base fa-info"></i>
                        </div>
                    </a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <div class="fa-stack" for="">
                             <i class="fa fa-envelope fa-stack-2x fa-base"></i> 
                             <i class="fa fa-bdg fa-stack-1x"><span class="badge" id="all_msg" for="all_msg"></span></i>
                         </div>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                     <?php      $id = Yii::app()->session['id'];
                                $dataProvider=new CActiveDataProvider('Notify', array(
                                        'criteria'=>array(
                                            'limit' => 2,
                                            'condition'=>"subject_id='$id' AND is_read='0'",
                                            'order'=>'date DESC',
                                            'together'=>'true', ),
                                            'pagination'=>false,
                                    ));
                                         $this->widget('zii.widgets.CListView', array(
                                            'dataProvider' => $dataProvider,
                                            'itemView' => 'application.views.admin.extra.notlist',
                                            'summaryText'=>'',
                                            'emptyText' => 'Yeni Mesaj Bulunamadı.',
                                             'htmlOptions' => array('class'=>'navMsg'),
                                            )); 
                                    ?> 
                        <li>
                            <a class="text-center" href="/ProjectNew/admin/bildirim">
                                <strong>Bütün Bildirimleri Oku</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                
              
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <div class="fa-stack ">  <i class="fa fa-user fa-stack-2x fa-base fa-fw"></div></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="/ProjectNew/admin/profil"><i class="fa fa-angle-double-right fa-fw"></i> Profil</a>
                        </li>
                        <li><a href="/ProjectNew/admin/logout"><i class="fa fa-sign-out fa-fw"></i> Çıkış Yap</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    
                        <li>
                            <a  href="index"><i class="fa fa-dashboard fa-fw"></i> Ana Panel</a>
                        </li>
                   
                        <li>
                            <a href="/ProjectNew/admin/bildirim"><i class="fa fa-info-circle fa-fw"></i> Bildirimler</a>
                        </li>
                   
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Veri-Tabanı Yönetimi<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/ProjectNew/tables/birimler">Birimler</a>
                                </li>
                                <li>
                                    <a href="/ProjectNew/tables/cihazlar">Cihazlar</a>
                                </li>
                                <li>
                                    <a href="/ProjectNew/tables/islemler">İşlemler</a>
                                   
                                </li>
                                <li>
                                    <a href="/ProjectNew/tables/markalar"> Markalar</a>
                                </li>
                                <li>
                                    <a href="#">Onay Bekleyenler<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/ProjectNew/tables/bekleyenislemler">İşlemler</a>
                                        </li>
                                        <li>
                                            <a href="/ProjectNew/tables/bekleyencihazlar">Cihazlar</a>
                                        </li>
                                       
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                  <li>
                                    <a href="#">Sonlananlar<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="/ProjectNew/tables/bitenislemler">İşlemler</a>
                                        </li>
                                        <li>
                                            <a href="/ProjectNew/tables/bitencihazlar">Cihazlar</a>
                                        </li>
                                       
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="/ProjectNew/tables/yonetici"><i class="fa fa-group fa-fw"></i> Kullanıcı Yönetimi</a>
                        </li>
                        <li>
                            <a href="/ProjectNew/tables/logs"><i class="fa fa-file fa-fw"></i> Loglar</a>
                        </li>
                        <li>
                            <a href="/ProjectNew/admin/settings"><i class="fa fa-cog fa-fw"></i> Ayarlar</a>
                        </li>
                        <li>
                            <a href="/ProjectNew/admin/dilek"><i class="fa fa-fax fa-fw"></i> Dilek-Şikayet</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
         <script src="/ProjectNew/js/admin/sidemenu_change.js"></script>
