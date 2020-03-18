<?php include APPPATH.'views/layout/header.php'; ?>
<div class="col-sm-12">
        <a href="<?php echo BASE_URL.'/search/select_member';?>" class="btn btn-primary">Back</a> 
    </div>
<div align="center">
  <p>
      Name : <?php echo $member['name']; ?><br>
      Age : <?php echo $member['age']; ?><br>
      Gender : <?php echo ucfirst($member['gender']); ?>
    </p>
    <hr/>
<!--  <section>
      <a class="btn btn-default" href='<?php echo BASE_URL."/view_details" ?>'>View Details</a>
  </section>-->
  <br/>
  <section>
    <a class="btn btn-default" href='<?php echo BASE_URL."/questionnaire" ?>'>Questionnaire</a>
  </section>
  <br/>
  <section>
    <a class="btn btn-default"  href='<?php echo BASE_URL."/symptoms/add_symptoms" ?>'>Symptoms</a>
  </section>
  <br/>
</div>
<?php include APPPATH.'views/layout/footer.php'; ?>