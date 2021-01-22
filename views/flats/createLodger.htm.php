<?php
/** @var Flat[] $flats */
/** @var User[] $users */
/** @var Flat $flat */
/** @var Houses[] $houses */
?>
<div class="box col-6">
    <div class="box-header">
        <span class="box-title">Ajout d'un appartement</span>
    </div>
    <form method="POST" action="<?= route('flat.create') ?>">
        <div class="box-content">
            <div class="field">
                <div class="label">Nom</div>
                <input name="name" class="value" type="text" value=""/>
            </div>
            <div class="field">
                <div class="label">Code postal</div>
                <input name="zipcode" class="value" type="text" value=""/>
            </div>
            <div class="field">
                <div class="label">Numéro</div>
                <input name="number" class="value" type="text" value=""/>
            </div>
            <div class="field">
                <div class="label">Rue</div>
                <input name="street" class="value" type="text" value=""/>
            </div>
            <div class="field">
                <div class="label">Maison</div>
                <select name="house_id" class="value">
                    <option selected disabled>Sélectionner une maison</option>
                    <?php foreach ($houses as $house): ?>
                        <option value="<?= $house->id; ?>"><?= $house->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="field">
                <div class="label">Degré d'isolation</div>
                <input name="isolation_degree" class="value" type="text" value=""/>
            </div>
            <div class="field">
                <div class="label">Classement écologique</div>
                <input name="eco_level" class="value" type="text" value=""/>
            </div>
        </div>
        <div class="box-footer">
            <div class="button-group">
                <a href="<?= route('house') ?>" class="button">Annuler</a>
                <button type="submit" class="button cta">Enregistrer</button>
            </div>
        </div>
    </form>
</div>
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
