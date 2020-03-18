<?php include 'header.php'; ?>
<div align="center" style="padding-bottom: 40px;">
    <h3>NGO LIST</h3>
    <?php if(count($ngo_report) >0){ ?>
<a href=../excel/create_excel_ngo_report><i class="fa fa-file-excel-o" data-toggle="tooltip" title="create_excel"></i>Create Excel</a>
<?php } ?>
<table class="list_table" style="border: 1px solid;">
     <tr>
         <th>
            No
         </th>
         <th>
            Username
         </th>
         <th>
            Name
         </th>
         <th>
            Landmark
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
     <?php $i = 1; ?>
     <?php foreach ($ngo_report as $a){ ?>
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
         
     </tr>
     <?php } ?>
     
 </table>
</div>
<?php include 'footer.php'; ?>