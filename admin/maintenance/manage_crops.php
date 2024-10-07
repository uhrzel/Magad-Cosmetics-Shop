<?php
require_once('../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `crops` where id = '{$_GET['id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
?>
<div class="container-fluid">
    <form action="" id="crops-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group">
            <label for="crops_name" class="control-label">Crops Name</label>
            <input type="text" name="crops_name" id="crops_name" class="form-control form-control-sm rounded-0" value="<?php echo isset($crops_name) ? $crops_name : ''; ?>" />
        </div>
        <div class="form-group">
            <label for="crops_description" class="control-label">Crops Description</label>
            <textarea name="crops_description" id="" cols="30" rows="2" class="form-control form-control-sm rounded-0 no-resize"><?php echo isset($crops_description) ? $crops_description : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label for="crops_location" class="control-label">Crops Location</label>
            <textarea name="crops_location" id="" cols="30" rows="2" class="form-control form-control-sm rounded-0 no-resize"><?php echo isset($crops_location) ? $crops_location : ''; ?></textarea>
        </div>

    </form>
</div>
<script>
    $(document).ready(function() {
        $('#crops-form').submit(function(e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_crops",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast("An error occured", 'error');
                    end_loader();
                },
                success: function(resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.reload()
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").animate({
                            scrollTop: _this.closest('.card').offset().top
                        }, "fast");
                        end_loader()
                    } else {
                        alert_toast("An error occured", 'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        })
    })
</script>