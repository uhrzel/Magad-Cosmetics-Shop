<style>
    table td,
    table th {
        padding: 3px !important;
    }
</style>
<?php

$user_id = isset($_SESSION['userdata']['id']) ? $_SESSION['userdata']['id'] : null;

$date_start = isset($_GET['date_start']) ? $_GET['date_start'] : date("Y-m-d", strtotime(date("Y-m-d") . " -7 days"));
$date_end = isset($_GET['date_end']) ? $_GET['date_end'] : date("Y-m-d");
?>

<div class="card card-primary card-outline">
    <div class="card-header">
        <h5 class="card-title">Sales Report</h5>
    </div>
    <div class="card-body">
        <form id="filter-form">
            <div class="row align-items-end">
                <div class="form-group col-md-3">
                    <label for="date_start">Date Start</label>
                    <input type="date" class="form-control form-control-sm" name="date_start" value="<?php echo date("Y-m-d", strtotime($date_start)); ?>">
                </div>
                <div class="form-group col-md-3">
                    <label for="date_end">Date End</label>
                    <input type="date" class="form-control form-control-sm" name="date_end" value="<?php echo date("Y-m-d", strtotime($date_end)); ?>">
                </div>
                <div class="form-group col-md-1">
                    <button class="btn btn-flat btn-block btn-primary btn-sm"><i class="fa fa-filter"></i> Filter</button>
                </div>
                <div class="form-group col-md-1">
                    <button class="btn btn-flat btn-block btn-success btn-sm" type="button" id="printBTN"><i class="fa fa-print"></i> Print</button>
                </div>
            </div>
        </form>
        <hr>

        <div id="printable">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Time</th>
                        <th>Product</th>
                        <th>Client</th>
                        <th>Payment Method</th>
                        <th>Price</th>
                        <th>QTY</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $gtotal = 0;

                    // Adjusted SQL query to join relevant tables
                    $qry = $conn->query("SELECT ol.*, p.name, b.name as bname, 
                        concat(c.firstname, ' ', c.lastname) as client_name, 
                        c.email, o.date_created, o.payment_method 
                        FROM sales s 
                        INNER JOIN order_list ol ON s.order_id = ol.order_id 
                        INNER JOIN orders o ON o.id = ol.order_id 
                        INNER JOIN inventory i ON ol.inventory_id = i.id 
                        INNER JOIN products p ON p.id = i.product_id 
                        INNER JOIN clients c ON c.id = o.client_id 
                        INNER JOIN brands b ON p.brand_id = b.id 
                        WHERE p.user_id = '{$user_id}' 
                        AND date(o.date_created) BETWEEN '{$date_start}' AND '{$date_end}' 
                        ORDER BY unix_timestamp(o.date_created) DESC");

                    while ($row = $qry->fetch_assoc()):
                        $gtotal += $row['quantity'] * $row['price'];
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo $row['date_created']; ?></td>
                            <td>
                                <p class="m-0"><?php echo $row['name']; ?></p>
                                <p class="m-0"><small>Brand: <?php echo $row['bname']; ?></small></p>
                            </td>
                            <td>
                                <p class="m-0"><?php echo $row['client_name']; ?></p>
                                <p class="m-0"><small>Email: <?php echo $row['email']; ?></small></p>
                            </td>
                            <td><?php echo strtoupper($row['payment_method']); ?></td>
                            <td class="text-center"><?php echo format_num($row['price']); ?></td>
                            <td class="text-center"><?php echo format_num($row['quantity']); ?></td>
                            <td class="text-right"><?php echo format_num($row['quantity'] * $row['price']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                    <?php if ($qry->num_rows <= 0): ?>
                        <tr>
                            <td class="text-center" colspan="8">No Data...</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7" class="text-center">TOTAL SALES</th>
                        <th class="text-right"><?= format_num($gtotal); ?></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<noscript>
    <style>
        .m-0 {
            margin: 0;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .table {
            border-collapse: collapse;
            width: 100%
        }

        .table tr,
        .table td,
        .table th {
            border: 1px solid gray;
        }
    </style>
</noscript>
<script>
    $(function() {
        $('table th, table td').addClass("px-1 py-2 align-middle")
        $('#filter-form').submit(function(e) {
            e.preventDefault()
            location.href = "./?page=sales&date_start=" + $('[name="date_start"]').val() + "&date_end=" + $('[name="date_end"]').val()
        })

        $('#printBTN').click(function() {
            var head = $('head').clone();
            var rep = $('#printable').clone();
            var ns = $('noscript').clone().html();
            start_loader()
            rep.prepend(ns)
            rep.prepend(head)
            rep.find('#print_header').show()
            var nw = window.document.open('', '_blank', 'width=900,height=600')
            nw.document.write(rep.html())
            nw.document.close()
            setTimeout(function() {
                nw.print()
                setTimeout(function() {
                    nw.close()
                    end_loader()
                }, 200)
            }, 300)
        })
    })
</script>