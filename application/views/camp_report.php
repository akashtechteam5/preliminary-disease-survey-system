<?php include 'header.php'; ?>
<div align="center" style="padding-bottom: 40px;">
    <h3>CAMP LIST</h3>
    <?php if(count($camp_report) >0){ ?>
    <a href=../excel/create_excel_camp_list><i class="fa fa-file-excel-o" data-toggle="tooltip" title="create_excel"></i>Create Excel</a>
    <?php } ?>
<table class="list_table" style="border: 1px solid;width:90%;">
     <tr>
         <th>
            No
         </th>
         <th>
            Username
         </th>
         <th>
            Camp Name
         </th>
         <th>
            Village
         </th>
         <th>
            State
         </th>
         <th>
            District
         </th>
         <th>
            Pin
         </th>
         <th>
            Mobile 1
         </th>
         <th>
            Mobile 2
         </th>
         <th>
            Mobile 3
         </th>
         <th>
             Date
         </th>
     </tr>
     <?php $i = $page+1; ?>
     <?php foreach ($camp_report as $a){ ?>
     <tr>
         <td>
             <?php echo $i++; ?>
         </td>
         <td>
             <?php echo $a['username']; ?>
         </td>
         <td>
             <?php echo $a['name']; ?>
         </td>
         <td>
             <?php echo $a['landmark']; ?>
         </td>
         <td>
             <?php echo $a['state']; ?>
         </td>
         <td>
             <?php echo $a['district']; ?>
         </td>
         <td>
             <?php echo $a['pin']; ?>
         </td>
         <td>
             <?php echo $a['mobile_number_1']; ?>
         </td>
         <td>
             <?php echo $a['mobile_number_2']; ?>
         </td>
         <td>
             <?php echo $a['mobile_number_3']; ?>
         </td>
         <td>
             <?php echo $a['date']; ?>
         </td>
         <td>
             <?php if($a['request_count'] > 0){ ?>
             <a href="<?php echo base_url().'supercontrol/show_camp/'.$a['id'];?>">View</a>
             <?php } ?>
         </td>
         
     </tr>
     <?php } ?>
     <?php if($link){ ?>
     <tr>
         <td colspan='12'><?php echo $link; ?></td>
     </tr>
      <?php } ?>
     
 </table>
</div>
<?php include 'footer.php'; ?>
