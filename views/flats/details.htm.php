<?php
/** @var Flat $flat
 *  @var Lodger[] $lodgers
 */

use GreenHouse\Models\User;

?>
<div class="row">
    <div class="box col-6">
        <div class="box-header">
            <span class="box-title"><?= $flat->name; ?></span>
        </div>
        <form method="POST" action="<?= route('flat.edit', [$flat->id]) ?>">
            <div class="box-content">
                <div class="field">
                    <div class="label">Identifiant de l'appartement</div>
                    <input name="id" class="value" type="text" disabled value="<?= $flat->id; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Nom de l'appartement</div>
                    <input name="name" class="value" type="text" value="<?= $flat->name; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Identifiant de la maison</div>
                    <input name="house_id" class="value" type="text" value="<?= $flat->house_id; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Type d'appartement</div>
                    <input name="type_id" class="value" type="text" value="<?= $flat->flat_type_id; ?>"/>
                </div>
                <div class="field">
                    <div class="label">Niveau de sécurité</div>
                    <input name="security" class="value" type="text" value="<?= $flat->security_level; ?>"/>
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
    <div class="box col-6">
        <div class="box-header">
            <span class="box-title">Habitants</span>
            <div class="box-actions">
                <a class="button" onclick="lodgersModal.show()">Ajouter</a>
            </div>
        </div>
        <div class="box-content">
            <div class="table-wrapper">
                <table class="table <?= empty($lodgers) ? 'empty' : '' ?>">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date d'arrivée</th>
                        <th>Date de départ</th>
                    </tr>
                    <?php foreach ($lodgers as $lodger): ?>
                        <tr>
                            <td><?= (new User($lodger["user_id"]))->lastname?></td>
                            <td><?= (new User($lodger["user_id"]))->firstname?></td>
                            <td><?= $lodger["start_date"]?></td>
                            <td><?= $lodger["end_date"] ? $lodger["end_date"] : "Undefined"?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    let lodgersModal;
    window.addEventListener("load", () => {
        lodgersModal = new Modal({view_url: '<?= route("flat.add-lodger", [$flat->id])?>', title: 'Ajouter un habitant'});
        lodgersModal.build();
    });
</script>
