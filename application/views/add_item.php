<?php include 'header.php'; ?>
<div align="center" style="padding-bottom: 40px;">
    <h3>ADD ITEM</h3>
    <form id="camp_registration" method="post" action="">
        <table border="0.5">
            <?php if($msg){ ?>
            <tr>
                <td colspan="2" > 
            <div class="<?php if(!$flag){ ?> error-msg <?php }else{ ?> success-msg <?php } ?>">
                        <center><?php echo $msg; ?></center>
                    </div>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td><label class="req"for="category_name">Item Name </label></td>
                <td><input type="text" name="item_name" id="item_name" required></td>
            </tr>
            <tr>
                <td><label for="area">Category Name </label></td>
                <td>
                    <select id="cat_id" name="cat_id">
                        <option value="">Select Category</option>
                        <?php foreach ($category as $a) { ?>
                        <option value="<?php echo $a['cat_id']; ?>" selected><?php echo $a['category_name']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <td><input type="submit" value="Submit" />
				
            </tr>
        </table>
    </form>
    
<table class="list_table" style="border: 1px solid;">
     <tr>
         <th>
            No
         </th>
         <th>
            Itemname
         </th>
         <th>
            Category Name
         </th>
         <th>
            Name
         </th>
     </tr>
     <?php $i = 1; ?>
     <?php foreach ($item_report as $a){ ?>
     <tr>
         <td>
             <?php echo $i++; ?>
         </td>
         <td>
             <?php echo $a['item_name']; ?>
         </td>
         <td>
             <?php echo $a['category_name']; ?>
         </td>
         <td>
             <a href="<?php echo base_url().'supercontrol/show_item/'.$a['item_id'];?>">View</a>
         </td>
         
     </tr>
     <?php } ?>
     
 </table>
</div>
<?php include 'footer.php'; ?>
