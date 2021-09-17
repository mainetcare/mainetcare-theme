<?php

?>

<div class="mnc-row">
    <div class="mnc-col"><label>Unternehmen / Organisation[text* mnc-company] </label></div>
    <div class="mnc-col"><label>Name [text* mnc-name]</label></div>
</div>
<div class="mnc-row">
    <div class="mnc-col"><label>E-Mail-Adresse [email* mnc-email]</label></div>
    <div class="mnc-col"><label> Telefon: <small>Die Angabe ist freiwillig</small>[tel mnc-phone]</label></div>
</div>
</div>
[honeypot mi-mobil]
<div class="mnc-row">
    <div class="mnc-col">
        [textarea mnc-message placeholder "Hinweise und Mitteilungen"]
    </div>
</div>
[submit "Senden"]