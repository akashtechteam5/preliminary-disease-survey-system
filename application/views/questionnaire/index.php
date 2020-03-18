<?php include APPPATH.'views/layout/header.php'; ?>

<div align="center" style="padding-bottom: 40px;">
    <h3>Questionnaire</h3>
    <form id="questionnaire" method="post" action="">

            <div align="center">
              <p style="font-size: 30px;">
                  <?php echo $member['name'].","; ?>
                  <?php echo "Age " .$member['age'].","; ?>
                  <?php echo ucfirst($member['gender']); ?>
                </p>
            </div>

            <?php foreach($questions as $q) { ?>             
                    <section>
                        <hr/>
                        <p> <?php echo $q['field_name'] ?> </p>
                        <p><?php if ($q['type'] == "radio") { ?>
                                <?php foreach($q['custom_options'] as $r) { ?>
                                    <input type="radio" name='<?php echo "question_".$q['id'] ?>' value='<?php echo $r['custom_option_id'] ?>' 
                                    <?php if(isset($ans["question_".$q['id']])) {
                                                if ($ans["question_".$q['id']]== $r['custom_option_id']) 
                                                echo "checked"; 
                                            } 
                                    ?>

                                    required/>
                                    <label for='<?php echo "custom_option_".$r['custom_option_id'] ?>'><?php echo $r['custom_option'] ?></label>


                                 <?php } ?>
                             <?php continue; } ?>
                            <?php if ($q['type'] == "text") { ?>
                                    <textarea name='<?php echo "question_".$q['id'] ?>'><?php if(isset($ans["question_".$q['id']])) echo $ans["question_".$q['id']] ?></textarea>
                             <?php continue; } ?>
                             <?php if ($q['type'] == "checkbox") { ?>
                                <?php foreach($q['custom_options'] as $r) { ?>
                                    <input type="checkbox" name='<?php echo "question_".$q['id']."[]" ?>' value='<?php echo $r['custom_option_id'] ?>'
                                    <?php if(isset($ans["question_".$q['id']]))
                                    { 
                                        $checkbox_ans = json_decode($ans["question_".$q['id']]);
                                        if (in_array($r['custom_option_id'], $checkbox_ans)) 
                                        echo "checked"; 
                                    } 
                                ?> />
                                    <label for='<?php echo "custom_option_".$r['custom_option_id'] ?>'><?php echo $r['custom_option']."<br/>".$r['custom_option_mal'] ?></label>
                                 <?php } ?>
                             <?php continue; } ?>
                             <?php if ($q['type'] == "date") { ?>
                                    <input type="date" name='<?php echo "question_".$q['id'] ?>' value='<?php if(isset($ans["question_".$q['id']])) echo $ans["question_".$q['id']] ?>' />
                             <?php continue; } ?>
                        </p>
                    </section>
                    
             <?php } ?>
                  <hr/>  
             <input type="submit" value="Submit" />
    </form>  
</div>
<?php include APPPATH.'views/layout/footer.php'; ?>
