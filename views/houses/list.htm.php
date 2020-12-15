<?php
/** @var $houses array */
?>

<div class="row">
    <div class="box no-padding col-12">
        <div class="box-content">
            <div class="table-wrapper">
                <table class="table <?= empty($houses) ? 'empty' : '' ?>">
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Adresse</th>
                        <th>Degré d'isolation</th>
                        <th>Classement écologique</th>
                    </tr>
                    <?php foreach ($houses as $house): ?>
                        <tr>
                            <?php foreach ($house as $key => $value): ?>
                                <td><?= $value ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Ci dessous une boite sans taille définie, si on veux changer sa taille il faut utiliser la grille Bootstrap -->
<!-- Avec Bootstrap, chaque élément est divisé en 12 sous éléments, on a juste a indiquer une classe col-* avec * allant de 1 à 12 -->
<!-- L'élément prendra proportionnellement la place par rapport à son parent, ex: col-12 signifie prend toute la place du parent  -->
<!-- col-6 la moitié, col-2 (2/12) de la taille du parent... -->

<div class="row"> <!-- Toutes les box doivent être dans des row (des lignes de box), les rows prennent l'entièreté de la largeur !!! mais pas les box !!! -->
    <div class="box"> <!-- On définit une box avec la classe box -->
        <div class="box-header"> <!-- Optionnellement on peux lui ajouter un box-header, si on veux mettre des boutons ou des liens en haut de la boite, voir la classe box-actions -->
            <span class="box-title">Une boite sans taille définie</span> <!-- Le titre se met dans title -->
            <div class="box-actions"> <!-- La dedans on met ce qu'on veux -->
                <a class="link">Sauvegarder</a>
            </div>
        </div>
        <div class="box-content"> <!-- Ici on met le contenu de la box, le plus souvent un tableau ou une liste de fields, on peut également mettre d'autre box (voir box-content-group) -->
            <?php for($i = 0; $i < 5; $i++): ?>
                <div class="field"> <!-- Un field correspond à une paire clé: valeur -->
                    <div class="label">Clé <?= $i ?></div>
                    <div class="value">Valeur <?= $i ?></div>
                </div>
            <?php endfor; ?>
        </div>
        <div class="box-footer">
            <a class="button">Un boutton</a>
        </div>
    </div>
</div>

<!-- Maintenant observons le comportement de col-*: -->

<div class="row"> <!-- Toutes les box doivent être dans des row (des lignes de box), les rows prennent l'entièreté de la largeur !!! mais pas les box !!! -->
    <?php for($j = 1; $j <= 12; $j++): ?>
        <div class="box col-<?= $j ?>"> <!-- On définit une box avec la classe box -->
            <div class="box-header"> <!-- Optionnellement on peux lui ajouter un box-header, si on veux mettre des boutons ou des liens en haut de la boite, voir la classe box-actions -->
                <span class="box-title">col-<?= $j ?></span> <!-- Le titre se met dans title -->
                <div class="box-actions"> <!-- La dedans on met ce qu'on veux -->
                    <a class="link">Sauvegarder</a>
                </div>
            </div>
            <div class="box-content"> <!-- Ici on met le contenu de la box, le plus souvent un tableau ou une liste de fields, on peut également mettre d'autre box (voir box-content-group) -->
                <?php for($i = 0; $i < 5; $i++): ?>
                    <div class="field"> <!-- Un field correspond à une paire clé: valeur -->
                        <div class="label">Clé <?= $i ?></div>
                        <div class="value">Valeur <?= $i ?></div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    <?php endfor; ?>
</div>

<!-- Bootstrap va automatiquement empiler les éléments, ce n'est PAS DU TOUT ce qu'on veux, ne JAMAIS laisser bootstrap faire ça-->
<!-- Les éléments sont collés, les espaces sont perdus et c'est le désordre -->
<!-- Voici donc ci dessous un exemple propre de ce qu'on peut faire avec bootstrap et de comment on doit s'y prendre: -->

<div class="row"> <!-- Toutes les box doivent être dans des row (des lignes de box), les rows prennent l'entièreté de la largeur !!! mais pas les box !!! -->
    <div class="box col-8"> <!-- On définit une box avec la classe box -->
        <div class="box-header"> <!-- Optionnellement on peux lui ajouter un box-header, si on veux mettre des boutons ou des liens en haut de la boite, voir la classe box-actions -->
            <span class="box-title">Une boite plutôt grosse</span> <!-- Le titre se met dans title -->
            <div class="box-actions"> <!-- La dedans on met ce qu'on veux -->
                <a class="link">Sauvegarder</a>
            </div>
        </div>
        <div class="box-content"> <!-- Ici on met le contenu de la box, le plus souvent un tableau ou une liste de fields, on peut également mettre d'autre box (voir box-content-group) -->
            <?php for($i = 0; $i < 5; $i++): ?>
                <div class="field"> <!-- Un field correspond à une paire clé: valeur -->
                    <div class="label">Clé <?= $i ?></div>
                    <div class="value">Valeur <?= $i ?></div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
    <div class="box col-4"> <!-- On définit une box avec la classe box -->
        <div class="box-header"> <!-- Optionnellement on peux lui ajouter un box-header, si on veux mettre des boutons ou des liens en haut de la boite, voir la classe box-actions -->
            <span class="box-title">Une boite plus petite</span> <!-- Le titre se met dans title -->
            <div class="box-actions"> <!-- La dedans on met ce qu'on veux -->
                <a class="link">Sauvegarder</a>
            </div>
        </div>
        <div class="box-content"> <!-- Ici on met le contenu de la box, le plus souvent un tableau ou une liste de fields, on peut également mettre d'autre box (voir box-content-group) -->
            <?php for($i = 0; $i < 10; $i++): ?>
                <div class="field"> <!-- Un field correspond à une paire clé: valeur -->
                    <div class="label">Clé <?= $i ?></div>
                    <div class="value">Valeur <?= $i ?></div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>

<!-- Les espaces sont propres tout est parfait, lorsqu'on veux afficher en ligne c'est comme ça qu'on fera. Maintenant comme on peut le voir, -->
<!-- Si on veux afficher deux autres boites en dessous, elles apparaitront en dessous de la plus grosse et il y aura un gros espace vide -->
<!-- Pour pallier à ça, on va afficher en colonne de la manière suivante: -->

<div class="row"> <!-- Toutes les box doivent être dans des row (des lignes de box), les rows prennent l'entièreté de la largeur !!! mais pas les box !!! -->
    <div class="col-4">
        <div class="row">
            <div class="box col-12 wr"> <!-- On définit une box avec la classe box -->
                <div class="box-header"> <!-- Optionnellement on peux lui ajouter un box-header, si on veux mettre des boutons ou des liens en haut de la boite, voir la classe box-actions -->
                    <span class="box-title">Une boite plutôt grosse</span> <!-- Le titre se met dans title -->
                    <div class="box-actions"> <!-- La dedans on met ce qu'on veux -->
                        <a class="link">Sauvegarder</a>
                    </div>
                </div>
                <div class="box-content"> <!-- Ici on met le contenu de la box, le plus souvent un tableau ou une liste de fields, on peut également mettre d'autre box (voir box-content-group) -->
                    <?php for($i = 0; $i < 5; $i++): ?>
                        <div class="field"> <!-- Un field correspond à une paire clé: valeur -->
                            <div class="label">Clé <?= $i ?></div>
                            <div class="value">Valeur <?= $i ?></div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="box col-12 wr"> <!-- On définit une box avec la classe box -->
                <div class="box-header"> <!-- Optionnellement on peux lui ajouter un box-header, si on veux mettre des boutons ou des liens en haut de la boite, voir la classe box-actions -->
                    <span class="box-title">Une boite plus petite</span> <!-- Le titre se met dans title -->
                    <div class="box-actions"> <!-- La dedans on met ce qu'on veux -->
                        <a class="link">Sauvegarder</a>
                    </div>
                </div>
                <div class="box-content"> <!-- Ici on met le contenu de la box, le plus souvent un tableau ou une liste de fields, on peut également mettre d'autre box (voir box-content-group) -->
                    <?php for($i = 0; $i < 10; $i++): ?>
                        <div class="field"> <!-- Un field correspond à une paire clé: valeur -->
                            <div class="label">Clé <?= $i ?></div>
                            <div class="value">Valeur <?= $i ?></div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="row">
            <div class="box col-12 wr"> <!-- On définit une box avec la classe box -->
                <div class="box-header"> <!-- Optionnellement on peux lui ajouter un box-header, si on veux mettre des boutons ou des liens en haut de la boite, voir la classe box-actions -->
                    <span class="box-title">Une boite plus petite</span> <!-- Le titre se met dans title -->
                    <div class="box-actions"> <!-- La dedans on met ce qu'on veux -->
                        <a class="link">Sauvegarder</a>
                    </div>
                </div>
                <div class="box-content"> <!-- Ici on met le contenu de la box, le plus souvent un tableau ou une liste de fields, on peut également mettre d'autre box (voir box-content-group) -->
                    <?php for($i = 0; $i < 10; $i++): ?>
                        <div class="field"> <!-- Un field correspond à une paire clé: valeur -->
                            <div class="label">Clé <?= $i ?></div>
                            <div class="value">Valeur <?= $i ?></div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="box col-12 wr"> <!-- On définit une box avec la classe box -->
                <div class="box-header"> <!-- Optionnellement on peux lui ajouter un box-header, si on veux mettre des boutons ou des liens en haut de la boite, voir la classe box-actions -->
                    <span class="box-title">Une boite plus petite</span> <!-- Le titre se met dans title -->
                    <div class="box-actions"> <!-- La dedans on met ce qu'on veux -->
                        <a class="link">Sauvegarder</a>
                    </div>
                </div>
                <div class="box-content"> <!-- Ici on met le contenu de la box, le plus souvent un tableau ou une liste de fields, on peut également mettre d'autre box (voir box-content-group) -->
                    <?php for($i = 0; $i < 10; $i++): ?>
                        <div class="field"> <!-- Un field correspond à une paire clé: valeur -->
                            <div class="label">Clé <?= $i ?></div>
                            <div class="value">Valeur <?= $i ?></div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ici on a du mettre col-12 sur les box puisque du coup leur parent était déjà en col-4 ou col-8, la classe wr sert à préciser -->
<!-- que on ne veux pas de margin (col-* met du margin-left et right à 15 par défaut, si on empile des col ça fait donc trop d'espaces, -->
<!-- essayez sans, vous comprendrez à quoi ça sert -->

<!-- Et voila, c'est tout pour le front du projet, vous devriez savoir tout faire, si vous avez des doutes, -->
<!-- N'hésitez pas à aller inspecter sur https://demo.agile-web.dev (site à moi), il y à plein d'exemples d'utilisations de -->
<!-- Bootstrap et des box -->

