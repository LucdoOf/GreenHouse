<?php
/**
 *  @var Houses[] $houses
 *  @var FlatType[] $flat_types
 */

use GreenHouse\Models\User;

?>
<div class="row">
    <div class="box col-6">
        <div class="box-header">
            <span class="box-title">Ajout d'un appartement</span>
        </div>
        <form method="POST" action="<?= route('flat.create') ?>">
            <div class="box-content">
                <div class="field">
                    <div class="label">Nom de l'appartement</div>
                    <input name="name" class="value" type="text" value=""/>
                </div>
                <div class="field">
                    <div class="label">Type d'appartement</div>
                    <select name="type_id" class="value">
                        <option selected disabled>Sélectionner un type d'appartement</option>
                        <?php foreach ($flat_types as $flat_type): ?>
                            <option value="<?= $flat_type->id; ?>"><?= $flat_type->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="field">
                    <div class="label">Niveau de sécurité</div>
                    <input name="security" class="value" type="text" value=""/>
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
            </div>
            <div class="box-footer">
                <div class="button-group">
                    <a href="<?= route('flats') ?>" class="button">Annuler</a>
                    <button type="submit" class="button cta">Enregistrer</button>
                </div>
            </div>
        </form>
    </div>
</div>




