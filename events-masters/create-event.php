<?php
/**
 * Create Event form template
 *
 * @link       https://github.com/maxjf1
 * @since      1.0.7
 *
 * @package    Events_Masters
 * @subpackage Events_Masters/templates
 *
 * @var WP_Post[] $organizers
 * @var WP_Term[] $categories
 * @var WP_Term[] $types
 * @var WP_Post[] $places
 */

EM::get_template_part( 'form-input-template', 'create-event' );
$organizers = get_posts( 'post_type=organizer&numberposts=-1' );
$categories = get_terms( array( 'taxonomy' => 'event_category', 'hide_empty' => false ) );
$types      = get_terms( array( 'taxonomy' => 'event_type', 'hide_empty' => false ) );
$places     = get_posts( 'post_type=place&numberposts=-1' );

wp_enqueue_script( 'vue-tags-input' );
/* @var $tags WP_Term[] */
$tags        = get_terms( array( 'taxonomy' => 'event_tag', 'hide_empty' => false ) );
$tags_titles = array();
foreach ( $tags as $tag ) {
	$tags_titles[] = $tag->name;
}

?>
<div class="events-masters em-create-event" id="em-create-event" v-cloak>
	<?php EM::get_template_part( 'ajax-loader', 'checkout' ) ?>
	<?php EM::get_template_part( 'form-errors', 'checkout' ) ?>

    <form v-if="!success" class="em-create-event-form" id="create-event-form" method="post"
          @submit.prevent="registerEvent">

        <em-input v-model="event.title" :error="error" name="title" required
                  label="<?php _e( "Título do Evento", "events-masters" ) ?>"
        ></em-input>

        <em-input :error="error" name="organizerId" required
                  label="<?php _e( "Organizador", "events-masters" ) ?>">
            <select v-model="event.organizerId" slot="input" name="organizerId" id="organizerId" required>
                <option hidden :value="undefined"><?php _e( "Selecione...", "events-masters" ) ?></option>
                <option value="new"><?php _e( "Novo Organizador", "events-masters" ) ?></option>
                <optgroup label="<?php _e( "Organizadores", "events-masters" ) ?>">
					<?php foreach ( $organizers as $organizer ): ?>
                        <option value="<?php echo $organizer->_external_id ?>"><?php echo $organizer->post_title ?></option>
					<?php endforeach ?>
                </optgroup>
            </select>
        </em-input>

        <fieldset id="create-event-new-organizer" v-if="'new' === event.organizerId">
            <legend><?php _e( "Novo Organizador", "events-masters" ) ?></legend>

            <em-input v-model="event.organizer_title" :error="error" name="organizer_title" required
                      label="<?php _e( "Título do Organizador", "events-masters" ) ?>"
            ></em-input>

            <em-input v-model="event.organizer_email" :error="error" name="organizer_email"
                      required type="email"
                      label="<?php _e( "Email do Organizador", "events-masters" ) ?>"
            ></em-input>
        </fieldset>

        <em-input :error="error" name="categoryId" required
                  label="<?php _e( "Categoria", "events-masters" ) ?>">
            <select v-model="event.categoryId" slot="input" name="categoryId" id="categoryId" required>
                <option :value="undefined" hidden><?php _e( "Selecione...", "events-masters" ) ?></option>
				<?php foreach ( $categories as $category ): ?>
                    <option value="<?php echo get_term_meta( $category->term_id, '_external_id', true ) ?>">
						<?php echo $category->name ?>
                    </option>
				<?php endforeach ?>
            </select>
        </em-input>

        <em-input :error="error" name="typeId" required
                  label="<?php _e( "Tipo do Evento", "events-masters" ) ?>">
            <select v-model="event.typeId" slot="input" name="typeId" id="typeId" required>
                <option :value="undefined" hidden><?php _e( "Selecione...", "events-masters" ) ?></option>
				<?php foreach ( $types as $type ): ?>
                    <option value="<?php echo get_term_meta( $type->term_id, '_external_id', true ) ?>">
						<?php echo $type->name ?>
                    </option>
				<?php endforeach ?>
            </select>
        </em-input>


        <em-input :error="error" name="description" required
                  label="<?php _e( "Descrição do Evento", "events-masters" ) ?>">
            <textarea slot="input" v-model="event.description"
                      name="description" id="description" cols="30" rows="10" required></textarea>
        </em-input>

        <fieldset id="create-event-date">
            <legend><?php _e( "Data do Evento", "events-masters" ) ?></legend>

            <em-input v-model="event.starts_at" :error="error" name="starts_at"
                      required type="datetime-local" min="<?php echo date( 'Y-m-d\Th\:m', time() ) ?>"
                      label="<?php _e( "Inicia em", "events-masters" ) ?>"
            ></em-input>

            <em-input v-model="event.finish_at" :error="error" name="finish_at"
                      required type="datetime-local" :min="event.starts_at"
                      label="<?php _e( "Finaliza em", "events-masters" ) ?>"
            ></em-input>
        </fieldset>

        <em-input :error="error" name="tags" required
                  label="<?php _e( "Tags (separadas por vírgula)", "events-masters" ) ?>"
                  placeholder="<?php _e( "EX: Matemática, História", "events-masters" ) ?>"
        >
			<?php
			$prop = array();
			foreach ( $tags_titles as $i => $tag ) {
				$prop[] = "{$tag}: '{$tag}'";
			}
			$prop = '{' . implode( ',', $prop ) . '}';
			?>
            <tags-input slot="input"
                        placeholder="<?php _e("Adicione uma Tag", "events-masters") ?>"
                        :add-tags-on-comma="true"
                        @input="event.tags = $event.join(',')"
                        :existing-tags="<?php echo $prop ?>"
                        :typeahead="true"
                        name="tags" element-id="tags" required></tags-input>
        </em-input>

        <em-input :error="error" name="subscription_fee" required
                  label="<?php _e( "Valor da Inscrição", "events-masters" ) ?>">
            <template slot="input">
                <ul class="em-input-list em-radio-list">
                    <li>
                        <input v-model="event.subscription_fee" type="radio" name="subscription_fee"
                               id="subscription_fee_FREE" value="FREE">
                        <label for="subscription_fee_FREE"><?php _e( "Gratuíto", "events-masters" ) ?></label>
                    </li>
                    <li>
                        <input v-model="event.subscription_fee" type="radio" name="subscription_fee"
                               id="subscription_fee_PAID" value="PAID">
                        <label for="subscription_fee_PAID"><?php _e( "Pago", "events-masters" ) ?></label>
                    </li>
                </ul>
            </template>
        </em-input>

        <em-input v-model="event.subscription_value" v-if="'PAID' === event.subscription_fee" :error="error"
                  name="subscription_value"
                  required type="number" step="0.01" min="0"
                  label="<?php _e( "Valor da inscrição", "events-masters" ) ?>"></em-input>


        <em-input :error="error" name="local" required
                  label="<?php _e( "Tipo de evento", "events-masters" ) ?>">
            <select v-model="event.local" slot="input" name="local" id="local" required>
                <option :value="undefined" hidden><?php _e( "Selecione...", "events-masters" ) ?></option>
                <option value="PRESENTIAL"><?php _e( "Presencial", "events-masters" ) ?></option>
                <option value="SEMI_PRESENTIAL"><?php _e( "Semi Presencial", "events-masters" ) ?></option>
                <option value="ONLINE"><?php _e( "Online", "events-masters" ) ?></option>
            </select>
        </em-input>

        <em-input :error="error" v-if="event.local !== 'ONLINE'" name="placeId" required
                  label="<?php _e( "Local", "events-masters" ) ?>">
            <select v-model="event.placeId" slot="input" name="placeId" id="placeId" required>
                <option :value="undefined" hidden><?php _e( "Selecione...", "events-masters" ) ?></option>
                <option value="new"><?php _e( "Novo Local", "events-masters" ) ?></option>
                <optgroup label="<?php _e( "Locais", "events-masters" ) ?>">
					<?php foreach ( $places as $place ): ?>
                        <option value="<?php echo $place->_external_id ?>"><?php echo $place->post_title ?></option>
					<?php endforeach ?>
                </optgroup>
            </select>
        </em-input>

        <fieldset id="create-event-new-organizer" v-if="'new' === event.placeId">
            <legend><?php _e( "Novo Local", "events-masters" ) ?></legend>

            <em-input v-model="event.place_title" :error="error" name="place_title" required
                      label="<?php _e( "Nome", "events-masters" ) ?>"
            ></em-input>

            <em-input v-model="event.place_address" :error="error" name="place_address" required
                      label="<?php _e( "Endereço", "events-masters" ) ?>"
                      placeholder="<?php _e( "Ex.: Rua Da Vitória 189, Bairro Centro", "events-masters" ) ?>"
            ></em-input>

            <em-input v-model="event.place_city" :error="error" name="place_city" required
                      label="<?php _e( "Cidade", "events-masters" ) ?>"
            ></em-input>

            <em-input v-model="event.place_phone" :error="error" name="place_phone"
                      required type="tel" v-mask="masks.phone"
                      label="<?php _e( "Telefone", "events-masters" ) ?>"
                      placeholder="<?php _e( "Ex.: (00) 0000-00000", "events-masters" ) ?>"
            ></em-input>
        </fieldset>

        <em-input v-model="event.external_link" :error="error" name="external_link"
                  type="url"
                  label="<?php _e( "Website do evento", "events-masters" ) ?>"
        ></em-input>

        <p>
            <button type="submit" class="btn btn-primary"><?php _e( "Registrar Evento", "events-masters" ) ?></button>
        </p>
    </form>
    <section v-else>
        <h3><?php _e( "Evento recebido!", "events-masters" ) ?></h3>
        <p><?php _e( "Seu evento será aprovado e liberado em seguida.", "events-masters" ) ?></p>
    </section>
</div>
