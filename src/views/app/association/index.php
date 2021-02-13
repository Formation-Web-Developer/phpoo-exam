<main>
    <div class="container">
        <div class="grid">
            <div class="col title">Identifiant</div>
            <div class="col title">Conducteur</div>
            <div class="col title">Vehicule</div>
            <div class="col title">Modification</div>
            <div class="col title">Suppression</div>

            <?php foreach ($objects as $association): ?>
                <div class="col">
                    <?= $association->id_association ?>
                </div>
                <div class="col">
                    <p><?= $association->prenom . ' ' . $association->nom ?></p>
                    <p><?= $association->id_conducteur ?></p>
                </div>
                <div class="col">
                    <p><?= $association->marque . ' ' . $association->modele ?></p>
                    <p><?= $association->id_vehicule ?></p>
                </div>
                <div class="col">
                    <a href="<?= $router->get('association.edit', ['id' => $association->id_association]) ?>">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= $router->get('association.delete', ['id' => $association->id_association]) ?>"
                       onclick="return confirm('Souhaitez-vous vraiment supprimer cette association ?')">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form">
            <?php
            echo $form->addLabel('Conducteur *', 'driver')
                ->addSelect('driver', 'id_conducteur', $drivers)
                ->addLabel('Vehicule *', 'car')
                ->addSelect('car', 'id_vehicule', $cars)
                ->addSubmit('register', $submitTitle)
            ?>
        </div>
    </div>
</main>
