<main>
    <div class="container">
        <div class="grid">
            <div class="col title">Identifiant</div>
            <div class="col title">Prénom</div>
            <div class="col title">Nom</div>
            <div class="col title">Modification</div>
            <div class="col title">Suppression</div>

            <?php foreach ($objects as $driver): ?>
                <div class="col"><?= $driver->id_conducteur ?></div>
                <div class="col"><?= $driver->prenom ?></div>
                <div class="col"><?= $driver->nom ?></div>
                <div class="col">
                    <a href="<?= $router->get('conducteur.edit', ['id' => $driver->id_conducteur]) ?>">
                        <i class="fas fa-pencil-alt"></i>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= $router->get('conducteur.delete', ['id' => $driver->id_conducteur]) ?>"
                       onclick="return confirm('Souhaitez-vous vraiment supprimer ce conducteur ?')">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="form">
            <?php
              echo $form->addLabel('Nom *', 'name')
                        ->addInput('name', 'nom')
                        ->addLabel('Prénom *', 'lastname')
                        ->addInput('lastname', 'prenom')
                        ->addSubmit('register', $submitTitle)
            ?>
        </div>
    </div>
</main>
