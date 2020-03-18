<?php include 'header.php'; ?>

<div align="center" style="padding-bottom: 40px;">
<p> Total number of camps : <?php echo $camp_count; ?></p>
<p> Total number of NGOs : <?php echo $ngo_count; ?></p>



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
     </tr>
     <?php } ?>
</table>
</div>
<?php include 'footer.php'; ?>