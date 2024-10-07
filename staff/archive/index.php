<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">Archive of Production, Harvesting Records, Fertilizers, and Pesticides</h3>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <h4>Production and Harvesting Records</h4>
                <table class="table table-hover table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="20%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Crops</th>
                            <th>Crop Cycle</th>
                            <th>Date Planted</th>
                            <th>Date of Harvest</th>
                            <th>Hectarage</th>
                            <th>Estimated Harvest</th>
                            <th>Location</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $user_id = isset($_SESSION['userdata']['id']) ? $_SESSION['userdata']['id'] : null;
                        $qry = $conn->query("SELECT * FROM `production_harvesting` WHERE `user_id` = {$user_id} AND `delete_flag` = 1 ORDER BY `id` DESC");
                        while ($row = $qry->fetch_assoc()):
                            $harvest_date = $row['date_planted'] . ' to ' . $row['date_harvest'];
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo htmlspecialchars($row['crops']); ?></td>
                                <td><?php echo htmlspecialchars($row['crop_cycle']); ?></td>
                                <td><?php echo date("Y-m-d", strtotime($row['date_planted'])); ?></td>
                                <td><?php echo htmlspecialchars($harvest_date); ?></td>
                                <td><?php echo htmlspecialchars($row['hectarage']); ?></td>
                                <td><?php echo htmlspecialchars($row['harvest_kg']); ?></td>
                                <td><?php echo htmlspecialchars($row['location']); ?></td>
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <!--   <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                       --> <a class="dropdown-item unarchive_btn_product" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-archive text-success"></span> Unarchive</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Inorganic Fertilizers Section -->
                <h4>Inorganic Fertilizers</h4>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Brand</th>
                            <th>Supplier</th>
                            <th>Crops Applied</th>
                            <th>Frequency</th>
                            <th>Expiry Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("SELECT * FROM `inorganic_fertilizers` WHERE `user_id` = {$user_id} AND `delete_flag` = 1 ORDER BY `id` DESC");
                        while ($row = $qry->fetch_assoc()):
                        ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['type']); ?></td>
                                <td><?php echo htmlspecialchars($row['brand']); ?></td>
                                <td><?php echo htmlspecialchars($row['supplier']); ?></td>
                                <td><?php echo htmlspecialchars($row['crops_applied']); ?></td>
                                <td><?php echo htmlspecialchars($row['frequency']); ?></td>
                                <td><?php echo htmlspecialchars($row['expiry_date']); ?></td>
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <!--   <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                       --> <a class="dropdown-item unarchive_btn_inorganic" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-archive text-success"></span> Unarchive</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Organic Fertilizers Section -->
                <h4>Organic Fertilizers</h4>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Brand</th>
                            <th>Supplier</th>
                            <th>Crops Applied</th>
                            <th>Frequency</th>
                            <th>Expiry Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("SELECT * FROM `organic_fertilizers` WHERE `user_id` = {$user_id} AND `delete_flag` = 1 ORDER BY `id` DESC");
                        while ($row = $qry->fetch_assoc()):
                        ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['type']); ?></td>
                                <td><?php echo htmlspecialchars($row['brand']); ?></td>
                                <td><?php echo htmlspecialchars($row['supplier']); ?></td>
                                <td><?php echo htmlspecialchars($row['crops_applied']); ?></td>
                                <td><?php echo htmlspecialchars($row['frequency']); ?></td>
                                <td><?php echo htmlspecialchars($row['expiry_date']); ?></td>
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <!--   <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                       --> <a class="dropdown-item unarchive_btn_organic" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-archive text-success"></span> Unarchive</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

                <!-- Pesticides Section -->
                <h4>Pesticides</h4>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Active Ingredient</th>
                            <th>Brand Name</th>
                            <th>Supplier</th>
                            <th>Crops Applied</th>
                            <th>Target Pest</th>
                            <th>Frequency</th>
                            <th>Expiry Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("SELECT * FROM `pesticides` WHERE `user_id` = {$user_id} AND `delete_flag` = 1 ORDER BY `id` DESC");
                        while ($row = $qry->fetch_assoc()):
                        ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['type']); ?></td>
                                <td><?php echo htmlspecialchars($row['active_ingredient']); ?></td>
                                <td><?php echo htmlspecialchars($row['brand_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['supplier']); ?></td>
                                <td><?php echo htmlspecialchars($row['crops_applied']); ?></td>
                                <td><?php echo htmlspecialchars($row['target_pest']); ?></td>
                                <td><?php echo htmlspecialchars($row['frequency']); ?></td>
                                <td><?php echo htmlspecialchars($row['expiry_date']); ?></td>
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <!--   <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                       --> <a class="dropdown-item unarchive_btn_pesticides" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-archive text-success"></span> Unarchive</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <!-- Sanitizer Section -->
                <h4>Sanitizers</h4>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sanitizer Name</th>
                            <th>Active Ingredient</th>
                            <th>Brand Name</th>
                            <th>Intended Use</th>
                            <th>Frequency</th>
                            <th>Expiry Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = $conn->query("SELECT * FROM `sanitizers` WHERE `user_id` = {$user_id} AND `delete_flag` = 1 ORDER BY `id` DESC");
                        while ($row = $qry->fetch_assoc()):
                        ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['sanitizer_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['active_ingredient']); ?></td>
                                <td><?php echo htmlspecialchars($row['brand_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['intended_use']); ?></td>
                                <td><?php echo htmlspecialchars($row['expiry_date']); ?></td>
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                        Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <!--   <a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                       --> <a class="dropdown-item unarchive_btn_sanitizers" href="javascript:void(0)" data-id="<?php echo $row['id']; ?>"><span class="fa fa-archive text-success"></span> Unarchive</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.table').dataTable({
            columnDefs: [{
                orderable: false,
                targets: [4, 5]
            }],
            order: [0, 'asc']
        });
        $('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')

        $('.unarchive_btn_product').click(function() {
            var id = $(this).attr('data-id');
            console.log(id); // Debug: Check if ID is captured correctly
            if (confirm('Are you sure you want to unarchive this record?')) {
                $.ajax({
                    url: 'archive/unarchive_production_harvesting.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(resp) {
                        console.log(resp); // Debug: Check server response
                        if (resp == 1) {
                            alert_toast("Record unarchived successfully", 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            alert_toast("Failed to unaarchive the record: " + resp, 'error'); // Display error message
                        }
                    }
                });
            }
        });
        $('.unarchive_btn_inorganic').click(function() {
            var id = $(this).attr('data-id');
            console.log(id); // Debug: Check if ID is captured correctly
            if (confirm('Are you sure you want to unarchive this record?')) {
                $.ajax({
                    url: 'archive/unarchive_inorganic.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(resp) {
                        console.log(resp); // Debug: Check server response
                        if (resp == 1) {
                            alert_toast("Record unarchived successfully", 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            alert_toast("Failed to unaarchive the record: " + resp, 'error'); // Display error message
                        }
                    }
                });
            }
        });
        $('.unarchive_btn_organic').click(function() {
            var id = $(this).attr('data-id');
            console.log(id); // Debug: Check if ID is captured correctly
            if (confirm('Are you sure you want to unarchive this record?')) {
                $.ajax({
                    url: 'archive/unarchive_organic.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(resp) {
                        console.log(resp); // Debug: Check server response
                        if (resp == 1) {
                            alert_toast("Record unarchived successfully", 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            alert_toast("Failed to unarchive the record: " + resp, 'error'); // Display error message
                        }
                    }
                });
            }
        });
        $('.unarchive_btn_pesticides').click(function() {
            var id = $(this).attr('data-id');
            console.log(id); // Debug: Check if ID is captured correctly
            if (confirm('Are you sure you want to unarchive this record?')) {
                $.ajax({
                    url: 'archive/unarchive_pesticides.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(resp) {
                        console.log(resp); // Debug: Check server response
                        if (resp == 1) {
                            alert_toast("Record unarchived successfully", 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            alert_toast("Failed to unarchive the record: " + resp, 'error'); // Display error message
                        }
                    }
                });
            }
        });
        $('.unarchive_btn_sanitizers').click(function() {
            var id = $(this).attr('data-id');
            console.log(id); // Debug: Check if ID is captured correctly
            if (confirm('Are you sure you want to unarchive this record?')) {
                $.ajax({
                    url: 'archive/unarchive_sanitizers.php',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    success: function(resp) {
                        console.log(resp); // Debug: Check server response
                        if (resp == 1) {
                            alert_toast("Record unarchived successfully", 'success');
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        } else {
                            alert_toast("Failed to unarchive the record: " + resp, 'error'); // Display error message
                        }
                    }
                });
            }
        });
    });
</script>