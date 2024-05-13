<div class="container">
    <h2>Profile Overview</h2>

    <div class="row" style="padding-top: 2%; padding-bottom: 2%">
        <label class="col-sm-1 control-label">Username</label>
        <div class="col-sm-11">
            <span id="username"><?= $username ?></span>
        </div>
    </div>

    <div class="row" style="padding-top: 2%; padding-bottom: 2%">
        <label class="col-sm-1 control-label">First Name</label>
        <div class="col-sm-11">
            <span id="first-name"><?= $firstName ?></span>
            <a id="change-first-name-link" style="margin-left: 10px" href="#">Change</a>
        </div>
    </div>

    <div class="row" style="padding-top: 2%; padding-bottom: 2%">
        <label class="col-sm-1 control-label">Second Name</label>
        <div class="col-sm-11">
            <span id="second-name"><?= $secondName ?></span>
            <a id="change-second-name-link" style="margin-left: 10px" href="#">Change</a>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-1 control-label">Password</label>
        <div class="col-sm-11">
            ************
            <a id="change-password-link" style="margin-left: 10px" href="#">Change</a>
        </div>
    </div>
</div>


<div class="modal" id="change-first-name-modal" tabindex="-1" role="dialog" aria-labelledby="change-first-name-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="change-first-name-modal-label">Change First Name</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" id="change-first-name"></input>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-first-name-change-btn">Confirm</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="change-second-name-modal" tabindex="-1" role="dialog" aria-labelledby="change-second-name-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="change-second-name-modal-label">Change Second Name</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control" id="change-second-name"></input>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-second-name-change-btn">Confirm</button>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="change-password-modal" tabindex="-1" role="dialog" aria-labelledby="change-password-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="change-password-modal-label">Change Password</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="current-password" class="control-label">Current Password:</label>
                        <input type="password" class="form-control" id="current-password">
                    </div>
                    <div class="form-group">
                        <label for="new-password" class="control-label">New Password:</label>
                        <input type="password" class="form-control" id="new-password">
                    </div>
                    <div class="form-group">
                        <label for="confirm-password" class="control-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm-password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-password-change-btn">Confirm</button>
            </div>
        </div>
    </div>
</div>


<script>
    $('#save-first-name-change-btn').click(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>index.php/authentication/changefirstname",
            data: {
                firstName: $('#change-first-name').val()
            },
            success: function(response) {
                $('#change-first-name-modal').modal('hide');
                $('#first-name').text(response.firstName);
            },
            error: function(response) {
                console.log(response);
            },
            complete: function() {
                window.location.reload();
            }
        });
    });

    $('#save-second-name-change-btn').click(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>index.php/authentication/changesecondname",
            data: {
                secondName: $('#change-second-name').val()
            },
            success: function(response) {
                $('#change-second-name-modal').modal('hide');
                $('#second-name').text(response.secondName);
            },
            error: function(response) {
                console.log(response);
            },
            complete: function() {
                window.location.reload();
            }
        });
    });

    $('#save-password-change-btn').click(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>index.php/authentication/changepassword",
            data: {
                oldPassword: $('#current-password').val(),
                newPassword: $('#new-password').val()
            },
            success: function(response) {
                $('#change-password-modal').modal('hide');
                window.location.href = '<?= base_url() ?>index.php/authentication/signin';
            },
            error: function(response) {
                console.log(response);
            },
            complete: function() {
                window.location.reload();
            }
        });
    });

    $('#change-first-name-link').click(function(e) {
        e.preventDefault();
        $('#change-first-name').val($('#first-name').text());

        $('#change-first-name-modal').modal('show');
    });

    $('#change-second-name-link').click(function(e) {
        e.preventDefault();
        $('#change-second-name').val($('#second-name').text());
        $('#change-second-name-modal').modal('show');
    });

    $('#change-password-link').on('click', function(e) {
        e.preventDefault();
        $('#change-password-modal').modal('show');
    });

    $('[data-dismiss="modal"]').click(function() {
        $('.modal').modal('hide');
    });
</script>