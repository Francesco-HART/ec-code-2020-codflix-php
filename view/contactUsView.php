<?php
ob_start();
?>
    <form method="post">
        <h3>Envoyez nous un message</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="txtName" class="form-control" placeholder="Votre Name *" value=""
                           id="name"/>
                </div>
                <div class="form-group">
                    <input type="text" name="txtEmail" class="form-control" placeholder="Votre Email *" value=""
                           id="email"
                           required/>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btnContact" value="Envoyer Message" id="message"
                           required/>
                </div>
                <?php
                if (isset($_POST["submit"])) {
                    try {
                        if (isset($_POST["message"]) and isset($_POST['email'])) {
                            $email = User::sendEmail($_POST["message"], $_POST['email']);
                        } else {
                            $error_msg = 'vous devez remplir les champs';
                        }
                    } catch (Exception $e) {
                        $error_msg = $e->getMessage();
                    }
                }
                ?>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                <textarea name="txtMsg" class="form-control" placeholder="Votre message*"
                          style="width: 100%; height: 150px;"></textarea>
                </div>
            </div>
        </div>
    </form>
<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>