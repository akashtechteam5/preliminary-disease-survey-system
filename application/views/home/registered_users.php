<?php include APPPATH.'views/layout/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default table-responsive ng-scope">
            <div class="panel-body">
                <legend><span class="fieldset-legend">Registered User Details</span></legend>
                <div class="table-responsive">
                    <table st-table="rowCollectionBasic" class="table table-bordered table-striped">
                        <thead>
                            <tr class="th">
                                <th>#</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i=0;
                                    foreach ($members as $member){
                                $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $member['name']; ?></td>
                                <td><?php echo $member['age']; ?></td>
                                <td><?php echo ucfirst($member['gender']); ?></td>
                                <td><a href="<?php echo BASE_URL.'/home/list_users/'. $member['mobile_no'];?>" class="btn btn-primary">View</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>





<?php include APPPATH.'views/layout/footer.php'; ?>