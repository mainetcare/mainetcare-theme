<?php
global $post;
 $anfrage = new \Mnc\Anfrage();
?>

<div class="mnc-form-anfrage" xmlns="http://www.w3.org/1999/html">
    <form id="Anfrage" action="<?php the_permalink(); ?>" method="post">

        <?php if ( $anfrage->hasErrors() ): ?>
            <div class="mnc-errortext">
                <?= $anfrage->errortext ?>
                <ul>
                    <?php foreach ( $anfrage->errors as $msg ): ?>
                        <li><?= $msg ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

		<?php foreach ( $anfrage->map as $item ): /* @var $item \Mnc\Checkitem */ ?>
            <div class="mnc-checkitem">
                <input type="hidden" name="<?= $item->name ?>" value="">
                <input type="checkbox" id="<?= $item->id ?>"
                       name="<?= $item->name ?>" <?= $item->checked( $anfrage->request ) ? 'checked' : '' ?> value="1">
                <label for="<?= $item->id ?>"><?= $item->label ?></label>
            </div>
		<?php endforeach; ?>
        <div class="mnc-form-input">
            <label for="sonstiges">Nein alles falsch, ich brauche:</label>
            <textarea id="sonstiges" name="sonstiges"><?= $anfrage->getRequest('sonstiges') ?></textarea>
        </div>
        <hr>
        <fieldset class="mnc-kontaktangaben">
            <h3>Kontaktangaben:</h3>
            <div class="mnc-form-input <?= $anfrage->getErrorClass( 'contact_name' ) ?>">
                <label for="contact_name">Name:</label>
                <input type="text" id="contact_name" name="contact_name" value="<?= $anfrage->getRequest('contact_name') ?>"/>
                <span class="mnc-errormsg"><?= $anfrage->getErrorMsg( 'contact_name' ) ?></span>
            </div>
            <div class="mnc-form-input <?= $anfrage->getErrorClass( 'contact_email' ) ?>">
                <label for="contact_email">E-Mail:</label>
                <input type="email" id="contact_email" name="contact_email" value="<?= $anfrage->getRequest('contact_email') ?>"/>
                <span class="mnc-errormsg"><?= $anfrage->getErrorMsg( 'contact_email' ) ?></span>
            </div>
            <div class="mnc-form-input">
                <label for="contact_tel">Telefon: </label>
                <span class="mnc-error"></span>
                <input type="text" id="contact_tel" name="contact_tel" value="<?= $anfrage->getRequest('contact_tel') ?>"/>
                <span class="hlptext">(optional)</span>
            </div>
            <div class="mnc-form-input">
                <label for="contact_web">Ihre derzeitige Website:</label>
                <span class="mnc-error"></span>
                <input type="url" id="contact_web" name="contact_web" value="<?= $anfrage->getRequest('contact_web') ?>"/>
                <span class="hlptext">(optional)</span>
            </div>
            <div class="mnc-checkitem <?= $anfrage->getErrorClass( 'datenschutz' ) ?>">
                <input type="hidden" name="datenschutz" value="">
                <input type="checkbox" id="datenschutz"
                       name="datenschutz" <?= (int) $anfrage->getRequest('datenschutz') == 1 ? 'checked' : '' ?> value="1">
                <label for="datenschutz">Ich akzeptiere die <a href="/datenschutz/" target="_blank">Datenschutzbestimmungen</a>
                    von MaiNetCare.</label>
                    <span class="mnc-errormsg"><?= $anfrage->getErrorMsg( 'datenschutz' ) ?></span>
            </div>
        </fieldset>
        <input type="hidden" name="anfrage_submitted" value="1">
        <p><input type="submit" value="Anfrage senden"></p>
    </form>
</div>

