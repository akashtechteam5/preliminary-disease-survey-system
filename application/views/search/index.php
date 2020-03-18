<?php  include  VIEWPATH.'/header.php'; ?>
<div align="center" style="padding-bottom: 40px;">
    <h3>Search user</h3>
    <form id="mobile_no" method="post" action="">
            <?php if($msg){ ?>
            <tr>
                <td colspan="2" > 
            <div class="<?php if(!$flag){ ?> error-msg <?php }else{ ?> success-msg <?php } ?>">
                        <center><?php echo $msg; ?></center>
                    </div>
                </td>
            </tr>
            <?php } ?>

            

            
                    <section>
                    	<p>MOBILE NO</p>
                        <input type="text" name="mobile_no" value="" />
                        </section>
                    
 
                    
             <input type="submit" value="Submit" />
    </form>  
</div>
<?php include VIEWPATH.'/footer.php'; ?>
