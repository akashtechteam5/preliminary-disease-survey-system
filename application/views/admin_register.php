<?php include 'header.php'; ?>
<div align="center">
<h3>ADMIN REGISTRATION</h3>
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
            BEFORE REGISTERING CHECK IF USERNAME ALREADY EXISTS
            <a class="active" href="<?php echo base_url().'supercontrol/admin_check_username'?>">Click Here</a> 
            </tr>
            <tr>
                <td><label class="req"for="username">Admin Username  </label></td>
                <td><input type="text" name="username" id="username" required></td>
            </tr>
            <tr>
                <td><label class="req" for="password">Password  </label></td>
                <td><input type="password" name="password" id="password" required></input></td>
            </tr>
            <tr>
                <td><label class="req" for="confirm_password">Confirm Password  </label></td>
                <td><input type="password" name="confirm_password" id="confirm_password" required></input></td>
            </tr>
            <tr>
            <tr>
                <td><label class="req" for="name">Name  </label></td>
                <td><input type="text" name="name" id="name" required></td>
            </tr>
            <tr>
                <td><label for="landmark">Taluk  </label></td>
                <td><input type="text" name="landmark" id="landmark"></td>
            </tr>
            <tr>
                <td><label for="state">State  </label></td>
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
            <tr>
                <td><label for="district">Admin Level </label></td>
                <td>
                    <select id="user_type" name="user_type" required>
                    <option value="">Select Level</option>
                    <option value="level_1" >Level 1</option>
                    <option value="level_2" >Level 2</option>
                    <option value="level_3" >Level 3</option>
                </select>
                </td>
            </tr>
            <tr>
                <td><label class="req" for="pin">Pin  </label></td>
                <td><input type="text" name="pin" id="pin" required></td>
            </tr>
            <tr>
                <td><label for="area">Area  </label></td>
                <td>
                    <select id="area_id" name="area_id">
                        <option value="">Select Area</option>
                        <?php foreach ($area as $a) { ?>
                        <option value="<?php echo $a['area_id']; ?>" selected><?php echo $a['area_name']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label class="req" for="mobile_number_1">Mobile 1 </label></td>
                <td><input type="text" name="mobile_number_1" id="mobile_number_1" required></td>
            </tr>
            <tr>
                <td><label class="req" for="mobile_number_2">Mobile 2 </label></td>
                <td><input type="text" name="mobile_number_2" id="mobile_number_2" required></td>
            </tr>
            <tr>
                <td><label for="mobile_number_3">Mobile 3 </label></td>
                <td><input type="text" name="mobile_number_3" id="mobile_number_3"></td>
            </tr>
            
            <td><input type="submit" value="Submit" />
				
            </tr>
        </table>
    </form>
</div>
<script>
    var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
<?php include 'footer.php'; ?>