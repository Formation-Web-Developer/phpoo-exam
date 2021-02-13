<?php
use NeutronStars\Kernel;

Kernel::get()->getRouter()
    ->add('home', [
        'path'       => '/',
        'controller' => 'App\\Controller\\HomeController#home'
    ])
    ->add('404', [
        'path'       => '/404',
        'controller' => 'App\\Controller\\ErrorController#call404'
    ])
    ->add('conducteur', [
        'path'       => '/conducteur',
        'controller' => 'App\\Controller\\ConducteurController#index',
        'children'   => [
            'edit'   => [
                'path'       => '/edit-{id}',
                'controller' => 'App\\Controller\\ConducteurController#edit',
                'params'     => [
                    'id' => '/[0-9]+/'
                ]
            ],
            'delete' => [
                'path'       => '/delete-{id}',
                'controller' => 'App\\Controller\\ConducteurController#delete',
                'params'     => [
                    'id' => '/[0-9]+/'
                ]
            ]
        ]
    ])
    ->add('vehicule', [
        'path'       => '/vehicule',
        'controller' => 'App\\Controller\\VehiculeController#index',
        'children'   => [
            'edit'   => [
                'path'       => '/edit-{id}',
                'controller' => 'App\\Controller\\VehiculeController#edit',
                'params'     => [
                    'id' => '/[0-9]+/'
                ]
            ],
            'delete' => [
                'path'       => '/delete-{id}',
                'controller' => 'App\\Controller\\VehiculeController#delete',
                'params'     => [
                    'id' => '/[0-9]+/'
                ]
            ]
        ]
    ])
    ->add('association', [
        'path'       => '/association',
        'controller' => 'App\\Controller\\AssociationController#index',
        'children'   => [
            'edit'   => [
                'path'       => '/edit-{id}',
                'controller' => 'App\\Controller\\AssociationController#edit',
                'params'     => [
                    'id' => '/[0-9]+/'
                ]
            ],
            'delete' => [
                'path'       => '/delete-{id}',
                'controller' => 'App\\Controller\\AssociationController#delete',
                'params'     => [
                    'id' => '/[0-9]+/'
                ]
            ]
        ]
    ])
    ->add('divers', [
        'path' => '/divers',
        'controller' => 'App\\Controller\\DiversController#index'
    ]);
