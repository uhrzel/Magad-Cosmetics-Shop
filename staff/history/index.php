<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">History</h3>

    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <!--   <table class="table table-hover table-striped">
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

                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table> -->

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


    })
</script>