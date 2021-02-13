<main>
    <div class="container">
        <h1>Statistique Divers</h1>

        <section>
            <h2>Nombre de conducteur</h2>
            <p><?= count($drivers) ?></p>
        </section>

        <section>
            <h2>Nombre de véhicule</h2>
            <p><?= count($cars) ?></p>
        </section>

        <section>
            <h2>Nombre d'association</h2>
            <p><?= count($associations) ?></p>
        </section>

        <section>
            <h2>Les vehicules qui n'ont pas de conducteur</h2>
            <div class="grid">
                <div class="col title">Identifiant</div>
                <div class="col title">Marque</div>
                <div class="col title">Modèle</div>
                <div class="col title">Couleur</div>
                <div class="col title">Immatriculation</div>

                <?php foreach ($carWithNotDriver as $car): ?>
                    <div class="col"><?= $car->id_vehicule ?></div>
                    <div class="col"><?= $car->marque ?></div>
                    <div class="col"><?= $car->modele ?></div>
                    <div class="col"><?= $car->couleur ?></div>
                    <div class="col"><?= $car->immatriculation ?></div>
                <?php endforeach; ?>
            </div>
        </section>

        <section>
            <h2>Les Conducteurs n'ayant pas de voiture</h2>
            <div class="grid">
                <div class="col-3 title">Identifiant</div>
                <div class="col-3 title">Prenom</div>
                <div class="col-3 title">Nom</div>

                <?php foreach ($driverWithNotCar as $car): ?>
                    <div class="col-3"><?= $car->id_conducteur ?></div>
                    <div class="col-3"><?= $car->prenom ?></div>
                    <div class="col-3"><?= $car->nom ?></div>
                <?php endforeach; ?>
            </div>
        </section>

        <section>
            <h2>Les vehicules de Philippe Pandre</h2>
            <div class="grid">
                <div class="col title">Identifiant</div>
                <div class="col title">Marque</div>
                <div class="col title">Modèle</div>
                <div class="col title">Couleur</div>
                <div class="col title">Immatriculation</div>

                <?php foreach ($carOfPhilippe as $car): ?>
                    <div class="col"><?= $car->id_vehicule ?></div>
                    <div class="col"><?= $car->marque ?></div>
                    <div class="col"><?= $car->modele ?></div>
                    <div class="col"><?= $car->couleur ?></div>
                    <div class="col"><?= $car->immatriculation ?></div>
                <?php endforeach; ?>
            </div>
        </section>

        <section>
            <h2>Tous les conducteurs (Même ceux qui n'ont pas de correspondance) et tous les véhicules</h2>
            <div class="grid">
                <div class="col-4 title">Modèle</div>
                <div class="col-4 title">Prenom</div>

                <?php foreach ($lastnameDriverAndModelCars as $dc): ?>
                    <div class="col-4"><?= $dc->modele ?? 'NULL' ?></div>
                    <div class="col-4"><?= $dc->prenom ?? 'NULL' ?></div>
                <?php endforeach; ?>
            </div>
        </section>

        <section>
            <h2>Tous les véhicule (Même ceux qui n'ont pas de correspondance) et tous les conducteurs</h2>
            <div class="grid">
                <div class="col-4 title">Modèle</div>
                <div class="col-4 title">Prenom</div>

                <?php foreach ($carsModelAndLastname as $dc): ?>
                    <div class="col-4"><?= $dc->modele ?? 'NULL' ?></div>
                    <div class="col-4"><?= $dc->prenom ?? 'NULL' ?></div>
                <?php endforeach; ?>
            </div>
        </section>


        <section>
            <h2>Tous les conducteurs et tous les véhicules, peut importe leurs correspondances</h2>
            <div class="grid">
                <div class="col-4 title">Modèle</div>
                <div class="col-4 title">Prenom</div>

                <?php foreach ($driversAndCars as $dc): ?>
                    <div class="col-4"><?= $dc->modele ?? 'NULL' ?></div>
                    <div class="col-4"><?= $dc->prenom ?? 'NULL' ?></div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</main>
