<section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
    <div class="uk-background-cover uk-height-small header-section"></div>
</section>
<section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
    <div class="uk-container">
        <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-user-friends"></i> <?= $pagetitle; ?></h4>
        <p>To recruit a friend, simply add their account ID on the form and recruit them. The same goes for recruiting you.</p>
        <p>Remember, for the changes to take effect, both must close the game completely and log back in.</p>
        <div class="uk-alert-primary" uk-alert>
            <p>Your account ID is: <?= $id ?></p>
        </div>
        <div class="uk-alert-success" uk-alert>
            <p>Your account has recruited the ID: <?= $recruiter; ?></p>
        </div>
        <?= form_open('', 'id="recruitForm" onsubmit="recruitForm(event)"'); ?>
        <div class="uk-form-controls">
            <div class="uk-inline uk-width-1-1">
                <input class="uk-input" type="number" id="recruit_id" placeholder="ID of the account you want to recruit" required>
                <input type="hidden" class="uk-input" id="account_id" value="<?= $id ?>">
            </div>
        </div>
        <div class="uk-width-1-2@m"></div>
        <div class="uk-margin">
            <div class="uk-form-controls">
                <div class="uk-width-1-4@m">
                    <button class="uk-button uk-button-default uk-width-1-1" type="submit"><i class="fas fa-user-plus"></i> Recruit a friend</button>
                </div>
            </div>
        </div>
        <?= form_close(); ?>
    </div>
</section>
<script>
    function recruitForm(e) {
        e.preventDefault();

        var recruit = $('#recruit_id').val();
        var account = $('#account_id').val();

        if (recruit == '') {
            Swal.fire({
                icon: 'error',
                title: 'The ID cannot be empty',
                text: "You must enter your friend's ID.",
                showConfirmButton: true,
            });
            return false;
        }

        if (recruit == account) {
            Swal.fire({
                icon: 'error',
                title: 'You must choose another ID',
                text: "You can't recruit yourself.",
                showConfirmButton: true,
            });
            return false;
        }

        $.ajax({
            url: "<?= base_url($lang . '/recruit/add'); ?>",
            method: "POST",
            data: {
                recruit,
                account
            },
            dataType: "text",

            beforeSend: function() {
                Swal.fire({
                    icon: 'info',
                    title: 'Checking data...',
                    text: 'Please wait a moment',
                    showConfirmButton: false,
                    timer: 5000
                });
            },

            success: function(response) {
                if (!response) {
                    alert(response);
                }

                if (response == 'accountIDNotFound') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'We have not been able to process your order. Please check the data',
                        showConfirmButton: true,
                    });
                    $('#recruitForm')[0].reset();
                    return false;
                }

                if (response == 'accountIDFound') {
                    Swal.fire({
                        icon: 'success',
                        title: "Correctly recruited",
                        text: "You've recruited a new friend",
                        showConfirmButton: true,
                        timer: 50000
                    });
                    $('#recruitForm')[0].reset();
                    window.location.replace("<?= base_url($lang . '/recruit'); ?>");
                }
            }
        });
    }
</script>
