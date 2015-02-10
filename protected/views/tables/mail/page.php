    <style type="text/css">
        
        
       
       
p {  text-align:center; }
p,fieldset,textarea,input {
                           color:black!important;
                           background-color:white!important;
                           
                           
                                }

form {border:2px solid black; border-radius:4px;}
.form-group > div {margin-left:40px; display:inline-block;    margin-bottom:20px;}  
.form-group {float:left;}

        input,p{    
                 font-size:20px;    
                 font-weight:normal;
                 }
        
        label {
            text-align:right;
            margin-right:30px;
            width:100px;
            font-size:15px;
            color:red;               
            font-weight:bold;}

textarea { width:100%; resize: none; height:100%;  overflow:auto;}        
.not-group  { margin-left:100px; }
.not-group > div {margin-bottom:20px; }
.not-group label {margin:-20px -5px 20px 0px;}

        #baslik p { font-size:30px; font-weight:bold;}
        h4 {margin-top:20px;}
        .page_box {margin-bottom:30px;}
            
            
        </style>

<form id="details_form" type="horizontal">
    <div id="baslik"><p>İşlem Ayrıntıları</p></div>
    <br>
    <div class="page_box">
         <h4><b>İstek Gönderenin</b> ;</h4>

        <hr>
            <fieldset disabled>
            <div class="form-group">
                <div>
                    <label>Ad/Soyad</label>
                    <input  type="text" class="form-control" value="<?php echo $model1['istek_sahibi']?>">
                </div>
                <div>
                    <label>Telefon</label>
                    <input type="text"  class="form-control" value="<?php echo $model1['istek_telefon']?>">
                </div>
            </div>
            </fieldset>
    </div>
     <div class="page_box">
         <h4><b>Cihazın</b> ;</h4>

        <hr>
         <?php $marka=Markalar::model()->findByPK($model2->cihaz_marka); $marka_adi = $marka['marka_adi']; $marka_tipi = $marka['marka_tipi']; ?>
            <fieldset disabled>
            <div class="form-group">
                <div>
                <label>Tipi</label>
                <input type="text" class="form-control" value="<?php echo $marka_tipi ?>">
                </div>
                <div>
                    <label>Markas&#305;</label>
                    <input type="text" class="form-control" value="<?php echo $marka_adi ?>">
                </div>
                <div>
                    <label>Seri No.</label>
                    <input class="form-control" type="text" value="<?php echo $model2['cihaz_serino'];?>">
                 </div>
            </div>

                    
      
    </div>
       <div class='not-group' id='not'>
                               <div>
                        <label>Arıza Nedeni</label><div>
                        <textarea readonly wrap="soft"><?php echo $model2[ 'ariza_nedeni'];?></textarea></div>
                    </div>    
        <?php 
        $add_div="   
           <div><label class='control-label'>Yönetici Notu</label><div>
           <textarea readonly wrap='soft'>".$area_val."</textarea></div>
           ";
        if(isset($area_val) && !empty($area_val)) echo $add_div ?>
        </div>
        
</form>
   
 
        
       
         