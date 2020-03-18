<?php include 'header.php'; ?>
<form id="camp_item_send" method="post" action="">
<div align="center" style="padding-bottom: 40px;">
<?php if(count($table_data) >0){ ?>
<a href=../../excel/create_excel_show_camp/<?php echo $camp_id ?>><i class="fa fa-file-excel-o" data-toggle="tooltip" title="create_excel"></i>Create Excel</a>
<?php } ?>
<table class="list_table" style="border: 1px solid;">
    <?php if($msg){ ?>
    <tr>
        <td colspan="6" > 
    <div class="<?php if(!$flag){ ?> error-msg <?php }else{ ?> success-msg <?php } ?>">
                <center><?php echo $msg; ?></center>
            </div>
        </td>
    </tr>
    <?php } ?>
     <tr>
         <th>
             Categories
         </th>
         <th>
             Item
         </th>
         <th>
             Camp
         </th>
         <th>
             Shortage/Excess
         </th>
         <th>
             Allocated
         </th>
         <?php if($_SESSION['user_type']=="level_2"||$_SESSION['user_type']=="level_3") {  ?>
         <th>
             Send
         </th>
         <?php } ?>
     </tr>
     <?php foreach($table_data as $data) { ?>
     <tr>
         <td>
             <?php echo $data['category_name']; ?>
         </td>
         <td>
             <?php echo $data['item_name']; ?>
         </td>
         <td>
             <?php echo $name; ?>
         </td>
         <td style='text-align:center;vertical-align:middle'>
              <?php if($data['needed'] > 0) { ?>
             
             <font size="3" color="green"><?php echo $data['needed']; ?></font>
                <?php } else if($data['needed'] < 0) { ?>
                <font size="3" color="red"><?php echo $data['needed']; ?></font>
                <?php } else { ?>
                <font size="3" color="black"><?php echo $data['needed']; ?></font>
                 <?php } ?>
         </td>
         <td><?php echo $data['total_offers'] ?></td>
         <?php if($_SESSION['user_type']=="level_2"||$_SESSION['user_type']=="level_3") {  ?>
         <td><input type="text" value="0" name="send_<?php echo $data['req_id'] . '_' . $data['item_id']; ?>" id="send"></input></td>
         <input type="hidden" value="<?php echo $data['item_id'] ?>" name="item_id_<?php echo $data['req_id'] . '_' . $data['item_id']; ?>" id="item_id">
         <?php } ?>
     </tr>
     <?php } ?>
</table>
<?php if($_SESSION['user_type']=="level_2"||$_SESSION['user_type']=="level_3") {  ?>
<input type="submit" value="Submit" />
<?php } ?>
</div>
</form>
<?php include 'footer.php'; ?>