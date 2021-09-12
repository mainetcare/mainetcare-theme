<?php
global $post;
$anfrage = new \Mnc\Anfrage();
if ( $anfrage->isSubmitted() && ! $anfrage->hasErrors() ) {
	$anfrage->sendAsMail();
	$anfrage->redirect( 'anfrage-danke' );
}
?>

<div class="mnc-form-anfrage" xmlns="http://www.w3.org/1999/html">
    <form id="Anfrage" action="<?php the_permalink(); ?>" method="post">
		<?php foreach ( $anfrage->map as $item ): /* @var $item \Mnc\Checkitem */ ?>
            <div class="mnc-checkitem">
                <input type="hidden" name="<?= $item->name ?>" value="">
                <input type="checkbox" id="<?= $item->id ?>"
                       name="<?= $item->name ?>" <?= $item->checked( $anfrage->request ) ? 'checked' : '' ?> value="1">
                <label for="<?= $item->id ?>"><?= $item->label ?></label>
            </div>
		<?php endforeach; ?>
        <div class="mnc-form-input">
            <label for="sonstiges">Sonstiges:</label>
            <textarea id="sonstiges" name="sonstiges"></textarea>
        </div>
        <hr>
        <fieldset class="mnc-kontaktangaben">
            <h3>Kontaktangaben:</h3>
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
            <div class="mnc-form-input <?= $anfrage->getErrorClass( 'name' ) ?>">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name"/>
            </div>
            <div class="mnc-form-input <?= $anfrage->getErrorClass( 'email' ) ?>">
                <label for="email">E-Mail:</label>
                <input type="email" id="email" name="email"/>
            </div>
            <div class="mnc-form-input">
                <label for="tel">Telefon: </label>
                <span class="mnc-error"></span>
                <input type="text" id="tel" name="tel"/>
                <span class="hlptext">(optional)</span>
            </div>
            <div class="mnc-form-input">
                <label for="web">Ihre derzeitige Website:</label>
                <span class="mnc-error"></span>
                <input type="url" id="web" name="web"/>
                <span class="hlptext">(optional)</span>
            </div>
            <div class="mnc-checkitem <?= $anfrage->getErrorClass( 'datenschutz' ) ?>">
                <input type="hidden" name="datenschutz" value="">
                <input type="checkbox" id="datenschutz"
                       name="datenschutz" <?= (int) $anfrage->request['datenschutz'] == 1 ? 'checked' : '' ?> value="1">
                <label for="datenschutz">Ich akzeptiere die <a href="/datenschutz/" target="_blank">Datenschutzbestimmungen</a>
                    von MaiNetCare.</label>
            </div>
        </fieldset>
        <input type="hidden" name="anfrage_submitted" value="1">
        <p><input type="submit" value="Anfrage senden"></p>
    </form>
</div>

