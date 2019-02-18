

<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$response = getResponse();
$categories = getCategories();
?>

<div class="row">
    <?php if (!isset($response["success"])) { ?>
        <div class="col-md-12 heading">
            <p>Se mantenha atualizado de eventos e oportunidades!</p>
            <form method="post" class="wpcf7-form" novalidate="novalidate">
                <input type="hidden" name="form-newsletter" value="1">

                <?php if (isset($response["error"])) { ?>
                    <span class="error"><?= $response["error"] ?></span>
                <?php } ?>
                <label for="person_name">Nome<span class="required">*</span></label>
                <input required type="text" name="person_name" id="person_name">

                <label for="person_email">Email<span class="required">*</span></label>
                <input required type="email" name="person_email" id="person_email">

                <label for="category_id">Eventos que te interessam<span class="required">*</span></label>
                <div class="checkbox_div">
                    <?php foreach ($categories as $category) { ?>
                        <div class="inline_checkbox">
                            <input class="checkbox" name="category[]" id="category_<?= $category->id ?>"
                                   type="checkbox" value=<?= $category->id ?>>
                            <span><?= $category->title ?></span>
                        </div>
                    <?php } ?>
                </div>

                <button type="submit" class="wpcf7-form-control wpcf7-submit">Registrar para newsletter</button>
            </form>
        </div>
    <?php } else if ($response['success'] === true) { ?>
        <h2 class="success">Excelente! Te manteremos informado por email a partir de agora.</h2>
    <?php } ?>
</div>