<?php ob_start(); ?>

<div class="landscape">
    <div class="bg-black">
        <div class="row no-gutters">
            <div class="col-md-6 full-height bg-white">
                <div class="auth-container">
                    <h2><span>Cod</span>'Flix</h2>
                    <h3>Inscription</h3>

                    <form method="post" action="index.php?action=signup" class="custom-form">

                        <div class="form-group">
                            <label for="email">Adresse email</label>
                            <input type="email" name="email" value="" id="email" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm">Confirmez votre mot de passe</label>
                            <input type="password" name="password_confirm" id="password_confirm"
                                   class="form-control" required/>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="submit" name="submit" class="btn btn-block bg-red"/>
                                </div>
                                <div class="col-md-6">
                                    <a href="index.php?action=login" class="btn btn-block bg-blue">Connexion</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <?php
                            if (isset($_POST["submit"])) {
                                $newUser = new User();
                                try {
                                    $newUser->setEmail($_POST["email"]);
                                    $newUser->setPassword($_POST["password"], $_POST["password_confirm"]);
                                    $newUser->createUser();
                                } catch (Exception $e) {
                                    $error_msg = $e->getMessage();
                                }
                            }
                            ?>
                        </div>
                        <span class="error-msg">
              <?= isset($error_msg) ? $error_msg : null; ?>
            </span>
                    </form>
                </div>
            </div>
            <div class="col-md-6 full-height">
                <div class="auth-container">
                    <h1>Bienvenue sur Cod'Flix !</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require(__DIR__ . '/../base.php'); ?>
