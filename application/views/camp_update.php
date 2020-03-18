<?php include 'header.php'; ?>
<div align="center">
<h3>CAMP EDIT</h3>
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
                <td><label class="req" for="name">Camp Name  </label></td>
                <td><input type="text" name="name" id="name" value="<?php echo $name; ?>" required></td>
            </tr>
            <tr>
                <td><label for="landmark">Village  </label></td>
                <td><input type="text" name="landmark" id="landmark" value="<?php echo $landmark; ?>"></td>
            </tr>
            <tr>
                <td><label for="state">State </label></td>
                <td>
                <select id="state" name="state">
                    <option value="kerala" selected>Kerala</option>
                </select>
                </td>
            </tr>
           
            <tr>
                <td><label for="district">District </label></td>
                <td>
                    <select id="district" name="district" >
                    <option value="">Select District</option>
                    <option value="thiruvananthapuram" <?php if($district == 'thiruvananthapuram'){ ?> selected <?php } ?>>Thiruvananthapuram</option>
                    <option value="kollam" <?php if($district == 'kollam'){ ?> selected <?php } ?>>Kollam</option>
                    <option value="pathanamthitta" <?php if($district == 'pathanamthitta'){ ?> selected <?php } ?>>Pathanamthitta</option>
                    <option value="alappuzha" <?php if($district == 'alappuzha'){ ?> selected <?php } ?>>Alappuzha</option>
                    <option value="kottayam" <?php if($district == 'kottayam'){ ?> selected <?php } ?>>Kottayam</option>
                    <option value="iduki" <?php if($district == 'iduki'){ ?> selected <?php } ?>>Iduki</option>
                    <option value="ernakulam" <?php if($district == 'ernakulam'){ ?> selected <?php } ?>>Ernakulam</option>
                    <option value="thrissur" <?php if($district == 'thrissur'){ ?> selected <?php } ?>>Thrissur</option>
                    <option value="palakkad" <?php if($district == 'palakkad'){ ?> selected <?php } ?>>Palakkad</option>
                    <option value="malappuram" <?php if($district == 'malappuram'){ ?> selected <?php } ?>>Malappuram</option>
                    <option value="kozhikode" <?php if($district == 'kozhikode'){ ?> selected <?php } ?>>Kozhikode</option>
                    <option value="wayanad" <?php if($district == 'wayanad'){ ?> selected <?php } ?>>Wayanad</option>
                    <option value="kannur" <?php if($district == 'kannur'){ ?> selected <?php } ?>>Kannur</option>
                    <option value="kasaragod" <?php if($district == 'kasaragod'){ ?> selected <?php } ?>>Kasaragod</option>
                </select>
                </td>
            </tr>
            <tr>
                <td><label class="req" for="pin">Pin  </label></td>
                <td><input type="text" name="pin" id="pin" value="<?php echo $pin; ?>" required></td>
            </tr>
            <tr>
                <td><label for="area">Area  </label></td>
                <td>
                    <select id="area_id" name="area_id">
                        <option value="">Select Area</option>
                        <?php foreach ($area as $a) { ?>
                        <option value="<?php echo $a['area_id']; ?>" <?php if($area_select == $a['area_id']){ ?> selected <?php } ?>><?php echo $a['area_name']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label class="req" for="mobile_number_1">Mobile 1 </label></td>
                <td><input type="text" name="mobile_number_1" id="mobile_number_1" value="<?php echo $mobile_number_1; ?>"  required></td>
            </tr>
            <tr>
                <td><label class="req" for="mobile_number_2">Mobile 2 </label></td>
                <td><input type="text" name="mobile_number_2" id="mobile_number_2" value="<?php echo $mobile_number_2; ?>" required></td>
            </tr>
            <tr>
                <td><label for="mobile_number_3">Mobile 3 </label></td>
                <td><input type="text" name="mobile_number_3" id="mobile_number_3" value="<?php echo $mobile_number_3; ?>"></td>
            </tr>
            <tr>
                <td><label for="camp_cat">Camp Category  </label></td>
                <td>
                <select id="camp_cat" name="camp_cat">
                    <option value="normal" <?php if($camp_cat == 'normal'){ ?> selected <?php } ?>>Normal</option>
                    <option value="master" <?php if($camp_cat == 'master'){ ?> selected <?php } ?>>Master</option>
                </select>
                </td>
            </tr>
            <td><input type="submit" value="Submit" />
				
            </tr>
        </table>
    </form>
</div>

<?php include 'footer.php'; ?>