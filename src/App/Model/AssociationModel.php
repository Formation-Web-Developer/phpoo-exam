<?php
namespace App\Model;

use NeutronStars\Model\Model;

class AssociationModel extends Model
{
    public function __construct()
    {
        parent::__construct('association_vehicule_conducteur');
    }

    public function all(): array
    {
        return $this->createQuery('a')
            ->select('a.id_association', 'c.id_conducteur', 'c.nom', 'c.prenom', 'v.id_vehicule', 'v.marque', 'v.modele')
            ->leftJoin('conducteur c', 'c.id_conducteur=a.id_conducteur')
            ->leftJoin('vehicule v', 'v.id_vehicule=a.id_vehicule')
            ->getResults();
    }

    public function insert($values): void
    {
        $this->createQuery()
            ->insertInto('id_conducteur,id_vehicule', '?,?')
            ->setParameters([$values['id_conducteur'], $values['id_vehicule']])
            ->execute();
    }

    public function update($id, $values): void
    {
        $this->createQuery()
            ->update('id_conducteur=?,id_vehicule=?')
            ->where('id_association=?')
            ->setParameters([$values['id_conducteur'], $values['id_vehicule'], $id])
            ->execute();
    }
}
