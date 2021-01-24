<?php
/** @var User[] $users */
/** @var Flat $flat */

use GreenHouse\Models\Flat;
use GreenHouse\Models\User;
?>
<form method="POST" action="<?= route("flat.add-lodger.post", [$flat->id]) ?>">
    <div class="field">
        <div class="label">Habitant</div>
        <select name="user_id" class="value">
            <option disabled>Sélectionner un habitant</option>
            <?php foreach ($users as $user): ?>
                <option value="<?= $user->id; ?>"><?= $user->firstname; ?> <?= $user->lastname; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="field">
        <div class="label">Date d'entrée</div>
        <div class="value"><input type="date" name="sdate" class="input" placeholder="2020-12-26"></div>
    </div>
    <div class="field">
        <div class="label">Date de sortie (ne rien saisir si non définie)</div>
        <div class="value"><input type="date" name="edate" class="input" placeholder="2021-06-14"></div>
    </div>
    <div class="field">
        <div class="label">Numéro d'habitant</div>
        <div class="value"><input type="number" name="numb" class="input" placeholder="2"></div>
    </div>
    <input type="submit" value="Ajouter" class="button cta"/>
</form>
