<?php include 'header.php'; ?>
<div align="center" style="padding-bottom: 40px;">
    <h3>Missing Item</h3>
   <!-- <?php if(count($camp_report) >0){ ?>
    <a href=../excel/create_excel_camp_list><i class="fa fa-file-excel-o" data-toggle="tooltip" title="create_excel"></i>Create Excel</a>
    <?php } ?>-->
<table class="list_table" style="border: 1px solid;width:90%;">
     <tr>
         <th>
            No
         </th>
         <th>
            Item Name
         </th>
         <th>
            Camp Name
         </th>
         <th>
            Allocated
         </th>
         <th>
            Received
         </th>
         <th>
            Missing
         </th>
         <th>
             Date
         </th>
     </tr>
     <?php $i = $page+1; ?>
     <?php foreach ($missing_item as $a){ ?>
     <tr>
         <td>
             <?php echo $i++; ?>
         </td>
         <td>
             <?php echo $a['item_name']; ?>
         </td>
         <td>
             <?php echo $a['camp_name']; ?>
         </td>
         <td>
             <?php echo $a['initial_offered']; ?>
         </td>
         <td>
             <?php echo $a['offered']; ?>
         </td>
         <td>
             <?php echo $a['mis']; ?>
         </td>
         <td>
             <?php echo $a['date']; ?>
         </td>
     </tr>
     <?php } ?>
     <?php if($link){ ?>
     <tr>
         <td colspan='7'><?php echo $link; ?></td>
     </tr>
      <?php } ?>
     
 </table>
</div>
<?php include 'footer.php'; ?>
