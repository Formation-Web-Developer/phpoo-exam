<?php
namespace App\Model;

use NeutronStars\Database\QueryBuilder;
use NeutronStars\Kernel;
use NeutronStars\Model\Model;

class ConducteurModel extends Model
{
    public function __construct()
    {
        parent::__construct('conducteur');
    }

    public function insert($values): void
    {
        $this->createQuery()
            ->insertInto('nom,prenom', '?,?')
            ->setParameters([$values['nom'], $values['prenom']])
            ->execute();
    }

    public function update($id, $values): void
    {
        $this->createQuery()
            ->update('nom=?,prenom=?')
            ->where('id_conducteur=?')
            ->setParameters([$values['nom'], $values['prenom'], $id])
            ->execute();
    }

    public function getAllWithCar(Model $model, bool $withCar): array
    {
        $query = (new QueryBuilder($model->getTable().' a'))
            ->select('id_conducteur');
        return $this->createQuery('c')
            ->select('*')
            ->where('c.id_conducteur '.(!$withCar ? 'NOT ' : '').'IN (' . $query->build() . ')')
            ->getResults();
    }

    public function getDriverIdByFullName($name, $lastname): ?Object
    {
        return $this->createQuery()
            ->select('id_conducteur id')
            ->where('nom=? AND prenom=?')
            ->setParameters([$name, $lastname])
            ->getResult();
    }

    public function getLastnameAndVehiculeModele(VehiculeModel $vehiculeModel, AssociationModel $associationModel)
    {
        return $this->createQuery('c')
            ->select('c.prenom', 'v.modele')
            ->leftJoin($associationModel->getTable().' a', 'a.id_conducteur=c.id_conducteur')
            ->leftJoin($vehiculeModel->getTable().' v', 'v.id_vehicule=a.id_vehicule')
            ->getResults();
    }

    public function getAllDriversAndCars()
    {
        return Kernel::get()->getDatabase()->fetchAll(
            'SELECT c.prenom, v.modele FROM conducteur c
               LEFT JOIN association_vehicule_conducteur a ON a.id_conducteur=c.id_conducteur
               LEFT JOIN vehicule v ON v.id_vehicule=a.id_vehicule
             UNION
             SELECT c.prenom, v.modele FROM vehicule v
               LEFT JOIN association_vehicule_conducteur a ON a.id_vehicule=v.id_vehicule
               LEFT JOIN conducteur c ON c.id_conducteur=a.id_conducteur'
        );
    }
}
