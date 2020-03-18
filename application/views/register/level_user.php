<?php include APPPATH.'views/layout/header.php'; ?>
<div align="center">
<h3>LEVEL USER REGISTRATION</h3>
<form id="user_registration" method="post" action="">
        
        <table border="0.5">
            <?php if(isset($msg) && $msg){ ?>
            <tr>
                <td colspan="2" > 
            <div class="alert <?php if(!$flag){ ?> alert-danger <?php }else{ ?> alert-success <?php } ?>">
                        <center><?php echo $msg; ?></center>
                    </div>
                </td>
            </tr>
            <?php } ?>
            
            <tr>
                <td><label class="req"for="login_id">Login ID</label></td>
                <td><input class="form-control" type="text" name="login_id" id="login_id" value="<?php echo set_value('login_id'); ?>" required>
                <?php echo form_error('login_id'); ?>
                </td>
            </tr>
            <tr>
                <td><label class="req" for="password">Password  </label></td>
                <td><input class="form-control" type="password" name="password" id="password" value="<?php echo set_value('password'); ?>" required></input>
                <?php echo form_error('password'); ?>
                </td>
            </tr>
            <tr>
                <td><label class="req" for="confirm_password">Confirm Password  </label></td>
                <td><input class="form-control" type="password" name="confirm_password" id="confirm_password" value="<?php echo set_value('confirm_password'); ?>" required></input>
                <?php echo form_error('confirm_password'); ?>
                </td>
            </tr>
       
            <tr>
                <td><label for="level">Level  </label></td>
                <td>
                <select class="form-control" id="level" name="level" required>
                    <option value="">Select Level</option>
                    <?php foreach ($levels as $level){?>
                    <option value="<?php echo $level['level_type_id']; ?>" <?php if(set_value('level')==$level['level_type_id']){ ?> selected<?php } ?>><?php echo $level['name']; ?></option>
                    <?php } ?>
                </select>
                    <?php echo form_error('level'); ?>
                </td>
            </tr>
            
            <tr>
                <td><label for="state">State  </label></td>
                <td>
                <select class="form-control" id="state" name="state">
                    <option value="">Select State</option>
                    <?php foreach ($states as $state){?>
                    <option value="<?php echo $state['state_id']; ?>" <?php if(set_value('state')==$state['state_id']){ ?> selected<?php } ?>><?php echo $state['state_name']; ?></option>
                    <?php } ?>
                </select>
                    <?php echo form_error('state'); ?>
                </td>
            </tr>
           
            <tr>
                <td><label for="district">District </label></td>
                <td>
                    <select class="form-control" id="district" name="district">
                        <?php if($validation_failed) { 
                            echo $districts;
                            ?>
                        <?php } else { ?>
                            <option value="">No Data</option>
                        <?php } ?>
                </select>
                    <?php echo form_error('district'); ?>
                </td>
            </tr>
            
            <tr>
                <td><label for="panchayat">Panchayat/Block</label></td>
                <td>
                <select class="form-control" id="panchayat" name="panchayat" >
                    <?php if($validation_failed) { 
                            echo $panchayaths;
                            ?>
                        <?php } else { ?>
                            <option value="">No Data</option>
                        <?php } ?>
                </select>
                    <?php echo form_error('panchayat'); ?>
                </td>
            </tr>
            
            <?php /*?><tr>
                <td><label for="village">Village</label></td>
                <td>
                <select id="village" name="village">
                    <option value="">No Data</option>
                </select>
                </td>
            </tr>
             <tr>
                <td><label for="phc">PHC</label></td>
                <td>
                <select id="phc" name="phc" required>
                    <option value="">No Data</option>
                </select>
                </td>
            </tr>
            <?php */?>
            <tr>
                <td><label for="chc">CHC</label></td>
                <td>
                <select class="form-control" id="chc" name="chc" >
                     <?php if($validation_failed) { 
                            echo $chcs;
                            ?>
                        <?php } else { ?>
                            <option value="">No Data</option>
                        <?php } ?>
                </select>
                    <?php echo form_error('chc'); ?>
                </td>
            </tr>
            
            <tr>
                <td><label class="req" for="mobile_number_1">Alternate Contact 1</label></td>
                <td><input class="form-control" type="text" name="mobile_number_1" id="mobile_number_1" value="<?php echo set_value('mobile_number_1'); ?>">
                <?php echo form_error('mobile_number_1'); ?>
                </td>
            </tr>
            <tr>
                <td><label class="req" for="mobile_number_2">Alternate Contact 2 </label></td>
                <td><input class="form-control" type="text" name="mobile_number_2" id="mobile_number_2" value="<?php echo set_value('mobile_number_2'); ?>">
                <?php echo form_error('mobile_number_2'); ?>
                </td>
            </tr>
            <tr>
                <td><label for="mobile_number_3">Alternate Contact 3 </label></td>
                <td><input class="form-control" type="text" name="mobile_number_3" id="mobile_number_3" value="<?php echo set_value('mobile_number_3'); ?>">
                <?php echo form_error('mobile_number_3'); ?>
                </td>
            </tr>
            <td><input name="submit" type="submit" value="Submit" />
				
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

var base_url = '<?php echo base_url(); ?>';

$( "#state" ).change(function() {
    $('#district').html('<option value="">No Data</option>');
    $('#panchayat').html('<option value="">No Data</option>');
    $('#village').html('<option value="">No Data</option>');
    var state_id = this.value;
    var url = base_url+'register/getDistricts';
  $.ajax({
            type: 'POST',
            url: url, 
            data: {state_id:state_id}
        })
        .done(function(data){
            $('#district').html(data);  
        })
        .fail(function() {
            alert( "Something went wrong!" ); 
        });
});

$( "#district" ).change(function() {
    $('#panchayat').html('<option value="">No Data</option>');
    $('#village').html('<option value="">No Data</option>');
    var district_id = this.value;
    var url = base_url+'register/getPanchayaths';
  $.ajax({
            type: 'POST',
            url: url, 
            data: {district_id:district_id}
        })
        .done(function(data){
            $('#panchayat').html(data);  
        })
        .fail(function() {
            alert( "Something went wrong!" ); 
        });
});

$( "#panchayat" ).change(function() {
    $('#village').html('<option value="">No Data</option>');
    var panchayat_id = this.value;
    var url = base_url+'register/getVillages';
  $.ajax({
            type: 'POST',
            url: url, 
            data: {panchayat_id:panchayat_id}
        })
        .done(function(data){
            $('#village').html(data);  
        })
        .fail(function() {
            alert( "Something went wrong!" ); 
        });
});

$( "#panchayat,#district" ).change(function() {
    $('#chc').html('<option value="">No Data</option>');
    var panchayat_id = $("#panchayat").val();
    var district_id = $("#district").val();
    if( panchayat_id !='' || district_id!=''){

    var url = base_url+'register/getChcs';
  $.ajax({
            type: 'POST',
            url: url, 
            data: {panchayat_id:panchayat_id, district_id:district_id}
        })
        .done(function(data){
            $('#chc').html(data);  
        })
        .fail(function() {
            alert( "Something went wrong!" ); 
        });
    }
});

$("#mobile_number_1,#mobile_number_2,#mobile_number_3").keypress(function (e) {

     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
    }
   });
   
  $("#login_id").keypress(function (e) {

     if(e.which === 32) 
        return false;
   });
   
</script>
<?php include APPPATH.'views/layout/footer.php'; ?>