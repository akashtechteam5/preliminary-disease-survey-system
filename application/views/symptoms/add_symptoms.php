<?php include APPPATH.'views/layout/header.php'; ?>
<!--<div class="col-sm-12">
        <a href="<?php echo BASE_URL.'/search/select_member';?>" class="btn btn-primary">Back</a> 
    </div>-->
<div style="padding-left: 20px;">
    <center><h3>Symptoms</h3></center>
    <form id="form_symptoms" method="post" action="">
        <div class="<?php if (!$flag) { ?> error-msg <?php } else { ?> success-msg <?php } ?>">
            <center><?php echo $msg; ?></center>
        </div>
        <?php $i = 1; ?>
            <div id="wrapper">
        <?php foreach ($symptoms as $a) { ?>
                <label><?php echo $i++.".".$a['symptom'] . " (<b>" . $a['symptom_mal'] . "</b>)"; ?></label>
                <p>
                    <input type="radio" id="<?php echo "symptom_" . $a['id']; ?>" name="<?php echo "symptom_" . $a['id']; ?>" value='1' <?php if ($a['value']) { ?> checked  <?php } ?>>Yes</input>
                    <input type="radio" id="<?php echo "symptom_" . $a['id']; ?>" name="<?php echo "symptom_" . $a['id']; ?>" value='0' <?php if (!$a['value']) { ?> checked  <?php } ?>>No</input>
                </p>
        <?php } ?>
            </div>
        
            <br>
        <input type="submit" value="Submit" class="btn btn-primary" />
    </form>
</div>
<style>
    body
{
  font-family: "Open Sans";
}
#wrapper
{
  display: inline-block;
  
}
</style>
<?php include APPPATH.'views/layout/footer.php'; ?>