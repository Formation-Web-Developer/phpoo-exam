<?php
namespace App\Controller;

use App\Model\AssociationModel;
use App\Model\ConducteurModel;
use App\Model\VehiculeModel;
use NeutronStars\Controller\Controller;

class DiversController extends Controller
{
    public function index()
    {
        $conducteurModel = new ConducteurModel();
        $vehiculeModel = new VehiculeModel();
        $associationModel = new AssociationModel();

        $philippe = $conducteurModel->getDriverIdByFullName('Pandre', 'Philippe');
        $carOfPhilippe = [];
        if($philippe != null){
            $carOfPhilippe = $vehiculeModel->getCarsByDriver($conducteurModel, $associationModel, $philippe->id);
        }

        $this->render('app.divers.index', [
            'drivers' => $conducteurModel->all(),
            'cars'    => $vehiculeModel->all(),
            'associations' => $associationModel->all(),

            'carWithNotDriver' => $vehiculeModel->getCarsWithDriver($associationModel, false),

            'driverWithNotCar' => $conducteurModel->getAllWithCar($associationModel, false),

            'carOfPhilippe' => $carOfPhilippe,

            'lastnameDriverAndModelCars' => $conducteurModel->getLastnameAndVehiculeModele($vehiculeModel, $associationModel),
            'carsModelAndLastname' => $vehiculeModel->getVehiculeModeleAndLastname($conducteurModel, $associationModel),

            'driversAndCars' => $conducteurModel->getAllDriversAndCars()
        ]);
    }
}
