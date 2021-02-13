<main>
    <div class="container">
        <div class="grid">
            <div class="col-2 title">Identifiant</div>
            <div class="col-2 title">Marque</div>
            <div class="col-2 title">Modèle</div>
            <div class="col-2 title">Couleur</div>
            <div class="col-2 title">Immatriculation</div>
            <div class="col-2 title">Modification</div>
            <div class="col-2 title">Suppression</div>

            <?php foreach ($objects as $car): ?>
                <div class="col-2"><?= $car->id_vehicule ?></div>
                <div class="col-2"><?= $car->marque ?></div>
                <div class="col-2"><?= $car->modele ?></div>
                <div class="col-2"><?= $car->couleur ?></div>
                <div class="col-2"><?= $car->immatriculation ?></div>
                <div class="col-2">
                    <a href="<?= $router->get('vehicule.edit', ['id' => $car->id_vehicule]) ?>">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </div>
                <div class="col-2">
                    <a href="<?= $router->get('vehicule.delete', ['id' => $car->id_vehicule]) ?>"
                       onclick="return confirm('Souhaitez-vous vraiment supprimer ce véhicule ?')">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form">
            <?php
            echo $form->addLabel('Marque *', 'brand')
                ->addInput('brand', 'marque')
                ->addLabel('Modèle *', 'model')
                ->addInput('model', 'modele')
                ->addLabel('Couleur *', 'color')
                ->addInput('color', 'couleur')
                ->addLabel('Immatriculation *', 'immatriculation')
                ->addInput('immatriculation', 'immatriculation')
                ->addSubmit('register', $submitTitle)
            ?>
        </div>
    </div>
</main>
