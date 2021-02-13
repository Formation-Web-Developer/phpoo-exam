<?php
namespace App\Controller;

use App\Model\VehiculeModel;

class VehiculeController extends AbstractController
{
    public function __construct()
    {
        parent::__construct('app.vehicule.index', new VehiculeModel(), [
            'marque' => ['min' => 2, 'max' => 50, 'add' => ['modele', 'couleur', 'immatriculation']]
        ]);
    }

    public function index()
    {
        $this->checkValid($values, $errors, function (&$values) {
            $this->model->insert($values);
            $values = [];
        }, 'Ajouter ce véhicule');
    }

    public function edit($id)
    {
        $values = get_object_vars($this->get($id, 'id_vehicule'));
        $this->checkValid($values, $errors, function ($values) use ($id) {
            $this->model->update($id, $values);
            $this->redirect('vehicule');
        }, 'Modifier ce véhicule');
    }

    public function delete($id)
    {
        $this->get($id, 'id_vehicule');
        $this->model->deleteById($id, 'id_vehicule');
        $this->redirect('vehicule');
    }
}
