
 <?php 
       $yonetici = new Yonetici;
       $result =  $yonetici->getNameAvatar($data->c_k_id);
       $avatar = $result[1];
       $name = $result[0];
 ?>

<li class="left clearfix">
    <span class="chat-img pull-left">
        <img src="<?php echo $avatar;?>" alt="User Avatar" class="img-circle img-thumbnail chat-img" />
     </span>
    <div class="chat-body clearfix">
        <div class="header">
            <strong class="primary-font" style="margin-left:2px;"><?php echo $name;?></strong> 
            <small class="pull-right text-muted">
                <i class="fa fa-clock-o fa-fw"></i> <?php echo $data->c_date;?>
            </small>
        </div>
        <p>
          <?php echo $data->c_icerik;?>
        </p>
    </div>
</li>
 