<?php
namespace App\Controller;

use App\Model\ConducteurModel;

class ConducteurController extends AbstractController
{
    public function __construct()
    {
        parent::__construct('app.conducteur.index', new ConducteurModel(), [
            'nom' => ['min' => 3, 'max' => 30, 'add' => ['prenom']]
        ]);
    }

    public function index()
    {
        $this->checkValid($values, $errors, function (&$values) {
            $this->model->insert($values);
            $values = [];
        }, 'Ajouter ce conducteur');
    }

    public function edit($id)
    {
        $values = get_object_vars($this->get($id, 'id_conducteur'));
        $this->checkValid($values, $errors, function ($values) use ($id) {
            $this->model->update($id, $values);
            $this->redirect('conducteur');
        }, 'Modifier ce conducteur');
    }

    public function delete($id)
    {
        $this->get($id, 'id_conducteur');
        $this->model->deleteById($id, 'id_conducteur');
        $this->redirect('conducteur');
    }
}
