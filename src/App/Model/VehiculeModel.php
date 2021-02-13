<?php
namespace App\Model;

use NeutronStars\Database\QueryBuilder;
use NeutronStars\Model\Model;

class VehiculeModel extends Model
{
    public function __construct()
    {
        parent::__construct('vehicule');
    }

    public function insert($values): void
    {
        $this->createQuery()
            ->insertInto('marque,modele,couleur,immatriculation', '?,?,?,?')
            ->setParameters([$values['marque'], $values['modele'],$values['couleur'], $values['immatriculation']])
            ->execute();
    }

    public function update($id, $values): void
    {
        $this->createQuery()
            ->update('marque=?,modele=?,couleur=?,immatriculation=?')
            ->where('id_vehicule=?')
            ->setParameters([$values['marque'], $values['modele'],$values['couleur'], $values['immatriculation'], $id])
            ->execute();
    }

    public function getCarsWithDriver(Model $model, bool $withDriver): array
    {
        $query = (new QueryBuilder($model->getTable().' a'))
            ->select('id_vehicule');
        return $this->createQuery('v')
            ->select('*')
            ->where('v.id_vehicule '.(!$withDriver ? 'NOT ' : '').'IN (' . $query->build() . ')')
            ->getResults();
    }

    public function getCarsByDriver(ConducteurModel $conducteurModel, AssociationModel $associationModel, $driver): array
    {
        return $conducteurModel->createQuery('c')
            ->select('v.*')
            ->leftJoin($associationModel->getTable().' a', 'a.id_conducteur=?')
            ->leftJoin($this->getTable().' v', 'v.id_vehicule=a.id_vehicule')
            ->where('c.id_conducteur=?')
            ->setParameters([$driver, $driver])
            ->getResults();
    }

    public function getVehiculeModeleAndLastname(ConducteurModel $conducteurModel, AssociationModel $associationModel)
    {
        return $this->createQuery('v')
            ->select('c.prenom', 'v.modele')
            ->leftJoin($associationModel->getTable().' a', 'a.id_vehicule=v.id_vehicule')
            ->leftJoin($conducteurModel->getTable().' c', 'c.id_conducteur=a.id_conducteur')
            ->getResults();
    }
}
