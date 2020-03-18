<?php include APPPATH.'views/layout/header.php'; ?>
<div class="col-sm-12">
        <a href="<?php echo BASE_URL.'/home/list_users/' . $user_name;?>" class="btn btn-primary">Back</a> 
    </div>
<div align="center">
<h3>MEMBER REGISTRATION</h3>
<form id="user_registration" method="post" action="">
    <input type="hidden" name="add_user_name" value="<?php echo $user_name;?>">
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
                <td><label class="req" for="name">Name  </label></td>
                <td><input class="form-control" type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" required>
                <?php echo form_error('name'); ?>
                </td>
            </tr>
            <tr>
                <td><label for="age">Age  </label></td>
                <td><input class="form-control" type="text" name="age" id="age" required maxlength="3" max="150" step="1" value="<?php echo set_value('age'); ?>"/>
                <?php echo form_error('age'); ?>
                </td>
            </tr>
            <tr>
                <td><label for="gender">Gender </label></td>
                <td>
                    <select class="form-control" id="gender" name="gender" required>
                        <option value="" <?php if(set_value('gender')==''){ ?> selected<?php } ?>>Select</option>
                    <option value="male" <?php if(set_value('gender')=='male'){ ?> selected<?php } ?>>Male</option>
                    <option value="female" <?php if(set_value('gender')=='female'){ ?> selected<?php } ?>>Female</option>
                    <option value="other" <?php if(set_value('gender')=='other'){ ?> selected<?php } ?>>Other</option>
                    </select>
                    <?php echo form_error('gender'); ?>
                </td>
            </tr>
            <tr>
            <tr>
                <td><label for="state">State  </label></td>
                <td>
                <select class="form-control" id="state" name="state" required>
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
                    <select class="form-control" id="district" name="district" required>
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
                <select class="form-control" id="panchayat" name="panchayat" required>
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
                    <select class="form-control" id="chc" name="chc" <?php if($is_logged) { ?> required<?php }?>>
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
                <td><label for="address">Address</label></td>
                <td>
                    <textarea class="form-control" id="address" name="address" required><?php echo set_value('address'); ?></textarea>
                    <?php echo form_error('address'); ?>
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
            <tr>
                <td><label for="vulnerability_status">Vulnerable Status</label></td>
                <td>
                    <input type="radio" id="yes" name="vulnerability_status" value="yes" <?php if(set_value('vulnerability_status')=='yes'){ ?> checked<?php } ?> required="" onclick="checkVulnerabilityStatus(this.value)"><label for="yes">Yes</label>
                    &ensp;
                    <input type="radio" id="no" name="vulnerability_status" value="no" <?php if(set_value('vulnerability_status')=='no'){ ?> checked<?php } ?> onclick="checkVulnerabilityStatus(this.value)"><label for="no">No</label>
                    <?php echo form_error('vulnerability_status'); ?>
                </td>
            </tr>            
            <tr>
                <td></td>
                <td>
                    <div id="vulnerability_yes" <?php if(set_value('vulnerability_status')=='' ||set_value('vulnerability_status')=='no' ){ ?> style="display: none"<?php } ?>>
                        <?php foreach ($vulnerability as $a) { ?>
                            <input type="checkbox" id="<?php echo "vulnerability_" . $a['id']; ?>" name="<?php echo "vulnerability_" . $a['id']; ?>" value="1">
                            <label for="vulnerability_yes"> <?php echo " ".$a['name'] . " (<b>" . $a['name_mal'] . "</b>)"; ?></label><br>
                        <?php } ?>
                        
                    </div>
                </td>
            </tr>
            <td><input name="submit" type="submit" value="Submit"/>
				
            </tr>
        </table>
    </form>
</div>
<script>

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

$("#age,#mobile_number_1,#mobile_number_2,#mobile_number_3").keypress(function (e) {

     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
    }
   });
   
function checkVulnerabilityStatus(value = ""){
    if(value == "yes"){
        $("#vulnerability_yes").show();
    }else{
        $("#vulnerability_yes").hide(); 
    }
}

function validate(){
    //onSubmit="return validate()"
    var checked;
    var vulnerability_status = $('input[name="vulnerability_status"]').val();
    if(vulnerability_status == "yes"){
        var vulnerability = document.getElementById("vulnerability_yes");
        var chks = vulnerability.getElementsByTagName("INPUT");

        for (var i = 0; i < chks.length; i++) {
            if (chks[i].checked) {
                checked++;
            }
        }

        if (checked > 0) {
            return true;
        } else {
            //alert("Please select any Vulnerability");
            return true;
        }
    }else{
        return true;
    }
}

</script>
<?php include APPPATH.'views/layout/footer.php'; ?>