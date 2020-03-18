<?php include 'header.php'; ?>

<div align="center" style="padding-bottom: 40px;">
    
<p> Total active camp requests : <a href="<?php echo base_url().'supercontrol/active_requests'?>"><?php echo $active_count; ?></a></p>
<p> To be delivered :<a href="<?php echo base_url().'supercontrol/pending_requests'?>"><?php echo $pending_count; ?></a></p>
<p> Total number of camps : <?php echo $camp_count; ?></p>
<p> Missing Item : <a href="<?php echo base_url().'supercontrol/missing_item'?>"><?php echo $missing_count; ?></a></p>

</div>
<?php include 'footer.php'; ?>