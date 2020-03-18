<?php include 'header.php'; ?>
<div align="center" style="padding-bottom: 40px;">
<h3>Add Category</h3>
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
                <td><label class="req"for="category_name">Category Name </label></td>
                <td><input type="text" name="category_name" id="category_name" required></td>
            </tr>
            
            <td><input type="submit" value="Submit" />
				
            </tr>
        </table>
    </form>
<h3>List Category</h3>
<table class="list_table" style="border: 1px solid;">
     <tr>
         <th>
             No
         </th>
         <th>
             Category Name
         </th>
     </tr>
     <?php $i = 1; ?>
     <?php foreach ($category as $a){ ?>
     <tr>
         <td>
             <?php echo $i++; ?>
         </td>
         <td>
             <?php echo $a['category_name']; ?>
         </td>
     </tr>
     <?php } ?>
     
 </table>
</div>
<?php include 'footer.php'; ?>