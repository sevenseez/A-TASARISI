 <div class="col-lg-4"  id="chatPanel">
                <div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comments fa-fw"></i>
                            Chat
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" id="chatbox">
                              <?php  
                              
                                $this->widget('zii.widgets.CListView', array(
                                            'dataProvider' => $dataProvider_chat,
                                            'itemsTagName' => 'ul',
                                            'id' => 'chatListView',
                                            'itemsCssClass'=>'chat',
                                            'itemView' => 'application.views.admin.extra.chatfeed',
                                            'summaryText'=>'',
                                            'emptyText' => '',
                                            ));?> 
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            
                            <div class="input-group">
                                <input id="btn-input" type="text" name="chat_text" class="form-control input-sm" placeholder="Mesajınızı giriniz..." />
                                <span class="input-group-btn">
                                    <?php echo CHtml::ajaxSubmitButton('Gönder',Yii::app()->createUrl('admin/chat'),
                                            array(
                                                'type' => 'POST',
                                                'data'=>array('chatEntry'=>'js:$("#btn-input").val()'),
                                                'success'=>" function (data) { 
                                                           $.fn.yiiListView.update('chatListView');
                                                            var str = data.replace(/\"/g, '');
                                                           if(str!='error'){
                                                           var result = $('<div />').append(data).find('#chatPanel').html();
                                                           $('#btn-input').val('');
                                                          } 
                                                          setTimeout(function(){ $('#chatbox').animate({ scrollTop: $('#chatbox')[0].scrollHeight}, 'slow');},1000); 
                                                            }",
                                            ),
                                            array('class'=>'btn btn-warning btn-sm','name'=>'chat_send','id'=>'btn_chat')
                                            ); ?>
                                </span>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                   
                </div>