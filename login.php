<?php
$error = getError();
$logged = getLogged();
?>

<div id="learn-press-checkout-login" class="learn-press-form login">

    <?php
    if ($error) {
        echo '<div class="vc_message_box vc_message_box-standard vc_message_box-rounded vc_color-danger">
                <div class="vc_message_box-icon"><i class="fa fa-times"></i>
                </div><p>' . $error . '</p>
              </div>';
    }
    ?>

    <?php if (!$logged) { ?>
        <div id="checkout-form-login">
            <form method="post">
                <input type="hidden" name="form-login" value="1">
                <label for="user_login">
                    <span class="field-label">Email</span>
                    <span class="required">*</span>
                </label>
                <input class="field-input" type="text" name="login"/>
                <label for="user_password">
                    <span class="field-label">Senha</span>
                    <span class="required">*</span>
                </label>
                <input class="field-input" type="password" name="password"/>
                <br><br>
                <button id="learn-press-checkout-login-button">Entrar</button>
            </form>
        </div>
    <?php } else { ?>
        <div id="checkout-form-login">
            Redirecionando...
        </div>
    <?php } ?>
</div>