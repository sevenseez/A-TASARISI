<li class="item-list">
    <div class="timeline-badge"><i class="fa fa-save"></i>
    </div>
    <div class="timeline-panel">
                        <div class="timeline-heading">
                          <h4 class="timeline-title"><?php $sender = Yii::app()->user->real_name($data['user_id']);
                         echo $sender ?></h4> </div>
                    <div class="timeline-body newsfeed">
<?php 

$userID = $data['user_id'];
$start = $data['id']-1;
$numberRows = $data['numberRows'];
$subject = Yii::app()->user->id;
$act = $_GET['activity_type'];
$notify = new Notify;


$sql = "select * from (select * from notify  WHERE user_id='$userID' AND id>'$start' AND is_read='0' "
        . "AND subject_id='$subject' "
        . "LIMIT $numberRows)as t WHERE activity_type='$act' GROUP BY table_type DESC";

$news = $notify->findAllBySql($sql);

$criteria = new CDbCriteria;
$n_criteria = new CDbCriteria;

   foreach ($news as $item) {
       echo '<ul><a class="nf_span" href="'.BaseUrl.'/tables/'.$item->table_type.'">'.$item->table_type.'</a> tablosunda ';
             
        $sql2 = "select * from (select * from notify  WHERE user_id='$userID' AND id>'$start' AND is_read='0' "
        . "AND subject_id='$subject' "
        . "LIMIT $numberRows) as t WHERE activity_type='$act' AND table_type='$item->table_type' GROUP BY data_id DESC";
        
            $nf = $notify->findAllBySql($sql2);
           
            foreach ($nf as $ditem) {
                if ($ditem->data_id!='')
               echo '<li>'; echo CHtml::link($ditem->data_id.' '.$ditem->fields.' ',array('tables/generalFocusRow'),
                        array('submit'=>array('tables/generalFocusRow'),
                              'params'=>array('id'=>$ditem->data_id,'table'=>$item->table_type),
                               'class'=>'no-link-features'
                            )).' '; echo ';</li>';
                
            }echo 'numaralı satır(lar)ı </ul>';
   }if ($news) echo 'için '.$notify->activity_desc($act).' işlem(ler)ini gerçekleştirdi.';

?>
           </div>
     </div>
    </li>

 


