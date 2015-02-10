<?php 
$notify=new Notify;
$yonetici = new Yonetici;
$result =  $yonetici->getNameAvatar($data->user_id);
$avatar = $result[1];
$name = $result[0];
?>
<li class="notlist">
        
        <div>
            <span class="pull-left" >
            <img src="<?php echo $avatar;?>" alt="User Avatar" class="img-polaroid img-thumbnail chat-img" />
            <strong><?php echo  $name;?></strong>
            </span>
            
            <span class="pull-right text-muted">
                <em><?php $date=strtotime($data->date);   
                  echo $this->zaman($date);?></em>
            </span>
        </div>
        <span ><?php echo '<a href="/ProjectNew/tables/'.
                $data->table_type.'">'.strtoupper($data->table_type).'</a> tablosunda '
         .strtoupper($notify->activity_desc($data->activity_type)).' işlemini gerçekleştirdi...';?></span>
       
</li>
<li class="divider"></li>
<style display="block"></style>