<?php include 'header.php'; ?>
<div align="center" style="padding-bottom: 40px;">
    <h3>ITEM LIST</h3>
    <?php if(count($item_report) >0){ ?>
    <a href=../excel/create_excel_item_list><i class="fa fa-file-excel-o" data-toggle="tooltip" title="create_excel"></i>Create Excel</a>
    <?php } ?>
<table class="list_table" style="border: 1px solid;">
     <tr>
         <th>
            No
         </th>
         <th>
            Item name
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
             <?php if($a['request_count'] > 0){ ?>
             <a href="<?php echo base_url().'supercontrol/show_item/'.$a['item_id'];?>">View</a>
             <?php } ?>
         </td>
         
     </tr>
     <?php } ?>
     
 </table>
</div>
<?php include 'footer.php'; ?>
