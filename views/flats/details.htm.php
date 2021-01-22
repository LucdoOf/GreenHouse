<?php
/** @var Flat $flat
 *  @var Lodger[] $lodgers
 *  @var Houses[] $houses
 *  @var FlatType[] $flat_types
 *  @var Room[] $rooms
 */


use GreenHouse\Models\Flat;
use GreenHouse\Models\FlatType;
use GreenHouse\Models\Room;
use GreenHouse\Models\RoomType;
use GreenHouse\Models\User;

?>
<div class="row">
    <div class="col-12 col-xl-6">
        <div class="row">
            <div class="box col-12 wr">
                <div class="box-header">
                    <span class="box-title"><?= $flat->name; ?></span>
                </div>
                <form method="POST" action="<?= route('flat.edit', [$flat->id]) ?>">
                    <div class="box-content">
                        <div class="field">
                            <div class="label">Identifiant de l'appartement</div>
                            <input name="id" class="value" type="text" disabled value="<?= $flat->id; ?>"disabled/>
                        </div>
                        <div class="field">
                            <div class="label">Nom de l'appartement</div>
                            <input name="name" class="value" type="text" value="<?= $flat->name; ?>"/>
                        </div>
                        <div class="field">
                            <div class="label">Type d'appartement</div>
                            <select name="type_id" class="value">
                                <option disabled>Sélectionner un type d'appartement</option>
                                <?php foreach ($flat_types as $flat_type): ?>
                                    <option <?php if($flat_type->id == $flat->flat_type_id){echo "selected";} ?> value="<?= $flat_type->id; ?>"><?= $flat_type->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="field">
                            <div class="label">Niveau de sécurité</div>
                            <input name="security" class="value" type="text" value="<?= $flat->security_level; ?>"/>
                        </div>
                        <div class="field">
                            <div class="label">Maison</div>
                            <select name="house_id" class="value">
                                <option disabled>Sélectionner une maison</option>
                                <?php foreach ($houses as $house): ?>
                                    <option <?php if($house->id == $flat->house_id){echo "selected";} ?> value="<?= $house->id; ?>"><?= $house->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="button-group">
                            <a href="<?= route('flats') ?>" class="button">Annuler</a>
                            <a onclick="confirm('Confirmer la suppression de l\'appartement ?') ? window.location = '<?= route('flat.delete', [$flat->id]) ?>' : void(0)" class="button red">Supprimer</a>
                            <button type="submit" class="button cta">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-6">
        <div class="row">
            <div class="box col-12 wr">
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
                                    <td><?= $lodger["end_date"] ?? "&mdash;" ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include "rooms.htm.php"; ?>
    </div>
</div>

<script type="text/javascript">
    let lodgersModal;
    window.addEventListener("load", () => {
        lodgersModal = new Modal({view_url: '<?= route("flat.add-lodger", [$flat->id])?>', title: 'Ajouter un habitant'});
        lodgersModal.build();
    });
</script>

