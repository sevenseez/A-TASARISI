<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Yönetici Paneli</title>


    <?php  
        $baseUrl = Yii::app()->baseUrl; 
       
      ?>
    
    <link rel="stylesheet" href='<?php echo $baseUrl?>/css/admin/admin.css'>
    <link rel="stylesheet" href='<?php echo $baseUrl?>/css/plugins/metisMenu/metisMenu.min.css'>
    <link rel="stylesheet" href='<?php echo $baseUrl?>/css/plugins/timeline.css'>
    <script src="/ProjectNew/js/admin/bildirimInterval.js"></script>
   
    
     <script src="<?php echo $baseUrl;?>/js/plugins/metisMenu/metisMenu.js"></script>
     
     <script src="<?php echo $baseUrl;?>/js/admin/index.js"></script>



</head>

<?php include 'nav.php'; 

echo $content;

?>


</body>

</html>
