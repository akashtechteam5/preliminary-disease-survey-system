<?php include 'header.php'; ?>
<form id="camp_registration" method="post" action="">
<div align="center" style="padding-bottom: 40px;">
    <?php if(count($table_data) >0){ ?>
<a href=../../excel/create_excel_show_item/<?php echo $item_id ?>><i class="fa fa-file-excel-o" data-toggle="tooltip" title="create_excel"></i>Create Excel</a>
<?php } ?>
<input type="hidden" value="<?php echo $item_id ?>" name="item_id" id="item_id"></input>
<?php if($msg){ ?>
            <tr>
                <td colspan="2" > 
            <div class="<?php if(!$flag){ ?> error-msg <?php }else{ ?> success-msg <?php } ?>">
                        <center><?php echo $msg; ?></center>
                    </div>
                </td>
            </tr>
            <?php } ?>
<table class="list_table" style="border: 1px solid;">
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
     <?php foreach($table_data as $key => $data) { ?>
     <tr>
         <td>
             <?php echo $data['category_name']; ?>
         </td>
         <td>
             <?php echo $data['item_name']; ?>
         </td>
         <td>
             <?php echo $data['name']; ?>
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
         <td><input type="text" value="0" name="send_<?php echo $data['req_id'] ?>" id="send"></input></td>
         <?php } ?>
     </tr>
     <?php } ?>
</table>
<?php if($_SESSION['user_type']=="level_2"||$_SESSION['user_type']=="level_3") {  ?>
<input type="submit" value="Submit" />
<?php } ?>
</form>
</div>

<?php include 'footer.php'; ?>