<?php
namespace App\Controller;

use App\Model\AssociationModel;
use App\Model\ConducteurModel;
use App\Model\VehiculeModel;
use App\Service\FormBuilder;
use App\Service\FormValidator;

class AssociationController extends AbstractController
{
    protected array $drivers = [];
    protected array $cars = [];

    public function __construct()
    {
        parent::__construct('app.association.index', new AssociationModel(), []);
        $this->buildSelectValue();
    }

    public function buildSelectValue()
    {
        foreach ((new ConducteurModel())->all() as $driver){
            $this->drivers[$driver->id_conducteur] = $driver->prenom . ' ' . $driver->nom;
        }
        foreach ((new VehiculeModel())->all() as $car){
            $this->cars[$car->id_vehicule] = $car->marque . ' ' . $car->modele;
        }
    }

    public function index()
    {
        $this->checkValid($values, $errors, function (&$values) {
            $this->model->insert($values);
            $values = [];
        }, 'Ajouter cette association');
    }

    public function edit($id)
    {
        $values = get_object_vars($this->get($id, 'id_association'));
        $this->checkValid($values, $errors, function ($values) use ($id) {
            $this->model->update($id, $values);
            $this->redirect('association');
        }, 'Modifier cette association');
    }

    public function delete($id)
    {
        $this->get($id, 'id_association');
        $this->model->deleteById($id, 'id_association');
        $this->redirect('association');
    }

    protected function createFormValidator($filters): FormValidator
    {
        return new FormValidator($_POST, [
            'id_conducteur' => [ 'type' => 'select', 'values' => $this->drivers ],
            'id_vehicule'   => [ 'type' => 'select', 'values' => $this->cars ]
        ]);
    }

    protected function show($submitTitle, $values = [], $errors = [])
    {
        $this->render($this->view, [
            'objects' => $this->model->all(),
            'form'    => new FormBuilder($values, $errors),
            'submitTitle' => $submitTitle,
            'drivers' => [0 => 'Selectionner un conducteur'] + $this->drivers,
            'cars'    => [0 => 'Selectionner un véhicule'] + $this->cars
        ]);
    }
}
