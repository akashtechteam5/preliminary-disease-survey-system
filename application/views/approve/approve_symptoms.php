<?php include APPPATH.'views/layout/header.php'; ?>
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-default table-responsive ng-scope">
            <div class="panel-body">
                <legend><span class="fieldset-legend">Symptoms Approve</span></legend>
                <div class="table-responsive">
                    <table st-table="rowCollectionBasic" class="table table-bordered table-striped">
                        <thead>
                            <tr class="th">
                                <th>Sl. no</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Date Added</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                <?php foreach ($approve_list as $key => $value) { ?>
                    <tr>
                        <td>
                            <?php echo $i++; ?>
                            <input type='hidden' name='request_id<?php echo $i ?>' value='<?php echo $value['symp_id'] ?>'>
                        </td>
                        <td>
                            <?php echo $value['name']; ?>
                        </td>
                        <td>
                            <?php echo $value['contact_1']; ?>
                        </td>
                         <td>
                            <?php echo $value['address']; ?>
                        </td>
                         <td>
                            <?php echo $value['date']; ?>
                        </td>
                        <td>
                            <a href="edit_symptom/<?php echo $value['id_enc']; ?>">Edit</a>
                        </td>
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
