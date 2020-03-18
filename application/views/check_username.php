<?php include 'header.php'; ?>
<div align="center" style="padding-bottom: 40px;">
<h3>Check Username Exists or Not</h3>
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
                <td><label class="req" for="username">Enter  UserName </label></td>
                <td><input type="text" name="username" id="username" required></td>
            </tr>
            
            <td><input type="submit" value="Submit" />
				
            </tr>
        </table>
    </form>
</div>
<?php include 'footer.php'; ?>