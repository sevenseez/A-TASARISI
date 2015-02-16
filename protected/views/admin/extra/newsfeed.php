<?php 
    $yonetici = new Yonetici;
    $result =  $yonetici->getNameAvatar($data['user_id']);
    $avatar = $result[1];
    $name = $result[0]; 
?>
<li class="item-list">
    <div class="timeline-badge">
        <img src="<?php echo $avatar?>" alt="User Avatar" class="img-circle img-thumbnail" />
    </div>
    <div class="timeline-panel">
                        <div class="timeline-heading">
                          <h4 class="timeline-title"><?php echo $name ?></h4> </div>
                    <div class="timeline-body newsfeed">
<?php 
$userID = $data['user_id'];
$start = $data['id']-1;
$numberRows = $data['numberRows'];
$subject = Yii::app()->user->id;
$notify = new Notify;


$sql = "select * from (select * from notify  WHERE user_id='$userID' AND id>'$start' AND is_read='0' "
        . "AND subject_id='$subject' LIMIT $numberRows)as t GROUP BY table_type DESC";

$news = $notify->findAllBySql($sql);

foreach ($news as $item) {
      if($item->table_type=='Dilek') $actionName = 'admin/dilek';
      else $actionName = 'tables/'.$item->table_type;
       echo '<ul><a class="nf_span" href="/'.BaseUrl.'/'.$actionName.'">'.$item->table_type.'</a> tablosunda ';
       
       $sql2 = "select * from (select * from notify  WHERE user_id='$userID' AND id>'$start' AND is_read='0' "
        . "AND subject_id='$subject' AND table_type='$item->table_type' LIMIT $numberRows)as t GROUP BY activity_type DESC";
       
       $feed = $notify->findAllBySql($sql2);
       
       foreach ($feed as $aitem) {
            echo '<li>';
            
            $sql3 = "select * from (select * from notify  WHERE user_id='$userID' AND id>'$start' AND is_read='0' "
            . "AND subject_id='$subject' AND table_type='$item->table_type' AND activity_type='$aitem->activity_type' "
                    . "LIMIT $numberRows)as t GROUP BY data_id DESC";
            
            $nf = $notify->findAllBySql($sql3);
            
            foreach ($nf as $ditem) {
                echo CHtml::link($ditem->data_id.' '.$ditem->fields.' ',array('tables/generalFocusRow'),
                        array('submit'=>array('tables/generalFocusRow'),
                              'params'=>array('id'=>$ditem->data_id,'table'=>$item->table_type),
                               'class'=>'no-link-features'
                            )).' ';
                
            }echo 'numaralı satır(lar)ı için '.Notify::model()->activity_desc($aitem->activity_type).';</li>';
           } 
        echo'</ul>';
   }echo 'işlem(ler)ini gerçekleştirdi.';
   

?>
           </div>
     </div>
    </li>

 


