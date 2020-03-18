<?php include 'header.php'; ?>
<div align="center" style="padding-bottom: 40px;">
<h3>Add Area</h3>
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
                <td><label class="req"for="area_name">Area Name </label></td>
                <td><input type="text" name="area_name" id="area_name" required></td>
            </tr>
            <tr>
                <td><label for="area_code">Area Code </label></td>
                <td><input type="text" name="area_code" id="area_code"></td>
            </tr>
            <tr>
                <td><label for="state">State</label></td>
                <td>
                <select id="state" name="state">
                    <option value="kerala" selected>Kerala</option>
                </select>
                </td>
            </tr>
            <tr>
                <td><label for="district">District</label></td>
                <td>
                    <select id="district" name="district" >
                    <option value="">Select District</option>
                    <option value="thiruvananthapuram" >Thiruvananthapuram</option>
                    <option value="kollam" >Kollam</option>
                    <option value="pathanamthitta" >Pathanamthitta</option>
                    <option value="alappuzha" >Alappuzha</option>
                    <option value="kottayam" >Kottayam</option>
                    <option value="iduki" >Iduki</option>
                    <option value="ernakulam" >Ernakulam</option>
                    <option value="thrissur" >Thrissur</option>
                    <option value="palakkad" >Palakkad</option>
                    <option value="malappuram" >Malappuram</option>
                    <option value="kozhikode">Kozhikode</option>
                    <option value="wayanad" >Wayanad</option>
                    <option value="kannur" >Kannur</option>
                    <option value="kasaragod" >Kasaragod</option>
                </select>
                </td>
            </tr>
            
            <td><input type="submit" value="Submit" />
				
            </tr>
        </table>
    </form>
<h3>List Area</h3>
<table class="list_table" style="border: 1px solid;">
     <tr>
         <th>
             No
         </th>
         <th>
             Area Code
         </th>
         <th>
             Area Name
         </th>
         <th>
             State
         </th>
         <th>
             District
         </th>
     </tr>
     <?php $i = 1; ?>
     <?php foreach ($area as $a){ ?>
     <tr>
         <td>
             <?php echo $i++; ?>
         </td>
         <td>
             <?php echo $a['area_code']; ?>
         </td>
         <td>
             <?php echo $a['area_name']; ?>
         </td>
         <td>
             <?php echo $a['state']; ?>
         </td>
         <td>
             <?php echo $a['district']; ?>
         </td>
         
     </tr>
     <?php } ?>
     
 </table>
</div>
<?php include 'footer.php'; ?>
