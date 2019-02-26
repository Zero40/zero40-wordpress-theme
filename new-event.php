<?php
/**
 * Template Name: Test form
 */
// Whats the right approach?
//$organizers = EventsManager::getActiveOrganizer();

//$places = getPlaces();
//$categories = getCategories();
//$types = getTypes();
//$tags = getTagsTitles();
//$response = getResponse();
get_header()
?>

    <div class='row'>
        <div class='col-md-12'>
            <?php
            // Show all errors
            if (isset($response) && is_array($response)) {
                foreach ($response as $key => $value) {
                    if (substr($key, 0, 5) == 'error') {
                        ?><span class='error'><?= $value ?></span><?php
                    }
                }
            }
            ?>

            <?php if (isset($response['internal_error']) && $response['internal_error'] === true): ?>
                <h2 class='error'>É embaraçoso dizer issoo</h2>
                <p>Ocorreu uma falha no servidor ao incluir o evento e demais dados...</p>
                <p>Mas nossos programadores já foram avisados, e receberam todas as informações, para corrigir a falhar e salvar seu evento como esperado.</p>
                <p>Desculpe-nos por isso. (</p>
            <?php endif; ?>

            <?php if (isset($response['success']) && $response['success'] === true): ?>
                <h2 class='success'>Sucesso!</h2>
                <p><b>O evento será aprovado em breve.</b></p>
                <p>A equipe do Zero40 recebeu seu cadastro de evento e em breve ele será aprovado.</p>
                <p>Você e nossa base de contatos receberão um email avisando do evento, assim que
                    liberarmos.</p>
            <?php endif; ?>

            <?php
            // print_r($_POST);
            ?>

            <?php if (!isset($response['success'])) { ?>
                <form method='post' novalidate='novalidate' action="">
                    <input type='hidden' name='new-event' value='1'>
                    <label for='title'>
                        Título do Evento<span class='required'>*</span>
                    </label>
                    <input required type='text' <?= nameIdValue('title') ?>>
                    <?php if (isset($response['error_title'])) { ?>
                        <span class='error'><?= $response['error_title'] ?></span>
                    <?php } ?>

                    <label for='organizerId'>Organizador<span class='required'>*</span></label>
                    <select required name='organizerId' id='organizerId'
                            onchange='showFormOfNewOrganizer(this.value)'>
                        <option selected disabled='disabled'>Escolha um organizador</option>

                        <?php foreach ($organizers as $organizer) { ?>
                            <option <?= valueSelected('organizerId', $organizer->id) ?>><?= $organizer->title ?></option>
                        <?php } ?>
                        <option disabled style='color: lightgrey;'>──────────────────────────────</option>
                        <option value='new' <?= valueSelected('organizerId', 'new') ?>>Novo organizador ...
                        </option>
                    </select>
                    <div id='newOrganizer' class='sub_form hidden'>
                        <label for='organizer_title'>Título do organizador<span
                                    class='required'>*</span></label>
                        <input type='text' <?= nameIdValue('organizer_title') ?> ><br>
                        <?php showErrorInput('organizer_title'); ?>

                        <label for='organizer_email'>Email do organizador<span
                                    class='required'>*</span></label>
                        <input type='email' <?= nameIdValue('organizer_email') ?> ><br>
                        <?php showErrorInput('organizer_email'); ?>
                    </div>
                    <?php if (isset($response['error_organizer'])) { ?>
                        <span class='error'><?= $response['error_organizer'] ?></span>
                    <?php } ?>

                    <label for='categoryId'>Categoria do Evento<span class='required'>*</span></label>
                    <select required name='categoryId' id='categoryId'>
                        <option selected disabled='disabled'>Escolha uma categoria</option>
                        <?php foreach ($categories as $category) { ?>
                            <option <?= valueSelected('categoryId', $category->id) ?> ><?= $category->title ?></option>
                        <?php } ?>
                    </select><?php if (isset($response['error_category'])) { ?>
                        <span class='error'><?= $response['error_category'] ?></span>
                    <?php } ?>

                    <label for='typeId'>Tipo de Evento<span class='required'>*</span></label>
                    <select required name='typeId' id='typeId'>
                        <option selected disabled='disabled'>Escolha um tipo</option>
                        <?php foreach ($types as $type) { ?>
                            <option <?= valueSelected('typeId', $type->id) ?> ><?= $type->title ?></option>
                        <?php } ?>
                    </select>
                    <?php if (isset($response['error_type'])) { ?>
                        <span class='error'><?= $response['error_type'] ?></span>
                    <?php } ?>


                    <label for='description'>Descrição do Evento<span class='required'>*</span></label>
                    <textarea class='form-control' rows='10' required cols='20' name='description'
                              id='description'><?= $_POST['description'] ?></textarea>
                    <?php if (isset($response['error_description'])) { ?>
                        <span class='error'><?= $response['error_description'] ?></span>
                    <?php } ?>

                    <div class='row'>

                        <div class='col-md-6'>
                            <label for='starts_at'>Inicia em<span class='required'>*</span></label>
                            <input type='text' class='form-control date_time'
                                   placeholder='Ex.: 00/00/0000 00:00' <?= nameIdValue('starts_at') ?> >
                            <?php if (isset($response['error_starts_at'])) { ?>
                                <span class='error'><?= $response['error_starts_at'] ?></span>
                            <?php } ?>
                        </div>
                        <div class='col-md-6'>

                            <label for='finish_at'>Finaliza em<span class='required'>*</span></label>
                            <input type='text' class='form-control date_time'
                                   placeholder='Ex.: 00/00/0000 00:00' <?= nameIdValue('finish_at') ?>>
                            <?php if (isset($response['error_finish_at'])) { ?>
                                <span class='error'><?= $response['error_finish_at'] ?></span>
                            <?php } ?>
                        </div>
                    </div>

                    <label for='tagsId'>Tags<span class='required'>*</span></label>
                    <input placeholder='Escreva algumas tags' <?= nameIdValue('tags', 'evento', true) ?>>
                    <?php if (isset($response['error_tag'])) { ?>
                        <span class='error'><?= $response['error_tag'] ?></span>
                    <?php } ?>


                    <label for='subscription_fee'>Valor da inscrição<span
                                class='required'>*</span></label>
                    <div style='min-height: 30px; vertical-align: middle;'>
                        <input <?= radioNameIdValueChecked('subscription_fee', 'FREE') ?>
                                onchange='showFormOfNewPrice(this.value)'> Gratuito
                        <input <?= radioNameIdValueChecked('subscription_fee', 'PAID') ?>
                                onchange='showFormOfNewPrice(this.value)'> Pago<br>
                    </div>

                    <div id='newPrice' class='sub_form hidden'>
                        <label for='subscription_value'>Valor<span
                                    class='required'>*</span></label>
                        <input type='number' <?= nameIdValue('subscription_value') ?>>
                        <?php if (isset($response['error_subscription_value'])) { ?>
                            <span class='error'><?= $response['error_subscription_value'] ?></span>
                        <?php } ?>
                    </div>


                    <label for='local'>Tipo de evento<span class='required'>*</span></label>
                    <div style='min-height: 30px; vertical-align: middle;'>
                        <input <?= radioNameIdValueChecked('local', 'PRESENTIAL') ?>
                                onchange='showFormOfplace(this.value)'> Presencial
                        <input <?= radioNameIdValueChecked('local', 'SEMI_PRESENTIAL') ?>
                                onchange='showFormOfplace(this.value)'> Semi Presencial
                        <input <?= radioNameIdValueChecked('local', 'ONLINE') ?> onchange='showFormOfplace(this.value)'>
                        Online<br>
                    </div>


                    <label for='placeId'>Local<span class='required'>*</span></label>
                    <select required name='placeId' id='placeId'
                            onchange='showFormOfNewPlace(this.value)'>
                        <option selected disabled='disabled'>Escolha um local</option>

                        <?php foreach ($places as $place) { ?>
                            <option <?= valueSelected('placeId', $place->id) ?> ><?= $place->title ?></option>
                        <?php } ?>
                        <option disabled style='color: lightgrey;'>──────────────────────────────</option>
                        <option <?= valueSelected('placeId', 'new') ?>>Novo local...</option>
                    </select>
                    <?php showErrorInput('placeId'); ?>

                    <div id='newPlace' class='sub_form hidden'>
                        <label for='place_title'>Nome do Local<span class='required'>*</span></label>
                        <input type='text' name='place_title' id='place_title'>
                        <?php showErrorInput('error_place_title'); ?>
                        <label for='place_address'>Endereço<span class='required'>*</span></label>
                        <input type='text' <?= nameIdValue('place_address') ?>
                               placeholder='Ex.: Rua Da Vitória 189, Bairro Centro'>
                        <?php if (isset($response['error_place_address'])) { ?>
                            <span class='error'><?= $response['error_place_address'] ?></span>
                        <?php } ?>
                        <label for='city'>Cidade<span class='required'>*</span></label>
                        <input type='text' <?= nameIdValue('place_city', 'Juiz de Fora') ?>>
                        <?php if (isset($response['error_place_city'])) { ?>
                            <span class='error'><?= $response['error_place_city'] ?></span>
                        <?php } ?>
                        <label for='place_phone'>Telefone</label>
                        <input type='text' <?= nameIdValue('place_phone') ?> class='phone'
                               placeholder='Ex.: (00) 0000-00000 '>
                    </div>

                    <label for='external_link'>Website do evento</label>
                    <input required type='url' <?= nameIdValue('external_link') ?>>
                    <?php showErrorInput('external_link'); ?>

                    <br><br>

                    <input type='submit' value='Registrar Evento' class='btn btn-primary'>
                    <span class='ajax-loader'></span>
                    <div class='wpcf7-response-output wpcf7-display-none'></div>
                </form>
            <?php } ?>
        </div>
    </div>


    <script type='text/javascript'>
        $(document).ready(function () {
            $('.date_time').mask('00/00/0000 00:00:00');

            var maskBehavior = function (val) {
                    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
                },
                options = {
                    onKeyPress: function (val, e, field, options) {
                        field.mask(maskBehavior.apply({}, arguments), options);
                    }
                };

            $('.phone').mask(maskBehavior, options);

            var input = document.getElementById('tags'),
                tagify = new Tagify(input, {
                    delimiters: ',',
                    maxTags: 8,
                    whitelist: <?php echo json_encode($tags); ?> ,
                    dropdown: {
                        enabled: 1, // suggest tags after a single character input
                        classname: 'color-blue',
                        maxItems: 5
                    }
                });

            showFormOfNewOrganizer('<?=$_POST['organizerId']?>');
            showFormOfNewPlace('<?=$_POST['placeId']?>');
            showFormOfNewPrice('<?=$_POST['subscription_fee']?>');
            showFormOfplace('<?=$_POST['local']?>');
        });

        function showFormOfNewOrganizer(value) {
            if (value === 'new') {
                document.getElementById('newOrganizer').classList.remove('hidden');
            } else {
                document.getElementById('newOrganizer').classList.add('hidden');
            }
        }


        function showFormOfNewPlace(value) {
            if (value === 'new') {
                document.getElementById('newPlace').classList.remove('hidden');
            } else {
                document.getElementById('newPlace').classList.add('hidden');
            }
        }

        function showFormOfNewPrice(value) {
            if (value === 'PAID') {
                document.getElementById('newPrice').classList.remove('hidden');
            } else {
                document.getElementById('newPrice').classList.add('hidden');
            }
        }

        function showFormOfplace(value) {
            if (value !== 'ONLINE') {
                document.getElementById('place').classList.remove('hidden');
            } else {
                document.getElementById('place').classList.add('hidden');
            }
        }
    </script>

<?php
get_footer();
function showErrorInput($field)
{
    $response = [];//getResponse();
    if (isset($response[$field])) {
        ?><span class='error'><?= $response[$field] ?></span><?php
    }
    if (isset($response['error_' . $field])) {
        ?><span class='error'><?= $response['error_' . $field] ?></span><?php
    }
}

function nameIdValue($field, $defaultValue = null, $json = false)
{
    $value = isset($_POST[$field]) && $_POST[$field] != null ? $_POST[$field] : $defaultValue;

    if ($json) {
        $value = json_decode(stripslashes($value));
        $value = array_map(function ($i) {
            return $i->value;
        }, $value);
        $value = join(',', $value);
    }

    echo "name='$field' id='$field' value='$value'";
}

function valueSelected($field, $value)
{
    $selected = isset($_POST[$field]) && $_POST[$field] == $value ? "selected" : '';

    echo "value='$value' $selected";
}

function radioNameIdValueChecked($field, $value)
{
    $checked = isset($_POST[$field]) && $_POST[$field] == $value ? "checked='checked'" : '';

    echo "type='radio' name='$field' id='$field' value='$value' $checked";
}