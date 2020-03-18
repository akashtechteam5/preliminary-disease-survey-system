<?php include APPPATH.'views/layout/header.php'; ?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default table-responsive ng-scope">
            <div class="panel-body">
                <legend><span class="fieldset-legend">User List</span></legend>
                <div class="table-responsive">
                    <table st-table="rowCollectionBasic" class="table table-bordered table-striped">
                        <thead>
                            <tr class="th">
                                <th>#</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Locality</th>
                                <th>Address</th>
                                <th>Contacts</th>
                                <th>Vulnerability</th>
                                <th>Health Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i=0;
                                    foreach ($users as $user){
                                $i++;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $user['name']; ?></td>
                                <td><?php echo $user['age']; ?></td>
                                <td><?php echo ucfirst($user['gender']); ?></td>
                                <td><?php echo "{$user['panchayat_name']},<br>{$user['district_name']},<br>{$user['state_name']}"; ?></td>
                                <td><?php echo $user['address']; ?></td>
                                <td><?php echo $user['contact_1']; echo ($user['contact_2'])?"<br>{$user['contact_2']}":""; echo ($user['contact_3'])?"<br>{$user['contact_3']}":""; ?></td>
                                <td><?php echo ucfirst($user['vulnerability']); ?></td>
                                <td><?php echo $user['health_status']; ?></td>
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