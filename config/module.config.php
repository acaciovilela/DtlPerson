<?php

namespace DtlPerson;

use DtlPerson\Form\View\Helper;
use DtlPerson\Controller;
use Laminas\Router\Http\Segment;
use Laminas\Router\Http\Literal;

return [
    'controllers' => [
        'factories' => [
            Controller\OfficeController::class => Controller\Factory\OfficeControllerFactory::class,
            Controller\OccupationController::class => Controller\Factory\OccupationControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'dtl-admin' => [
                'child_routes' => [
                    'dtl-office' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/office[/:page]',
                            'constraints' => [
                                'page' => '[0-9]*'
                            ],
                            'defaults' => [
                                'controller' => Controller\OfficeController::class,
                                'action' => 'index',
                                'page' => 1,
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'add' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/add',
                                    'defaults' => [
                                        'action' => 'add',
                                    ],
                                ],
                            ],
                            'edit' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/edit/:id',
                                    'constraints' => [
                                        'id' => '[0-9]*',
                                    ],
                                    'defaults' => [
                                        'action' => 'edit',
                                    ],
                                ],
                            ],
                            'delete' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/delete/:id',
                                    'constraints' => [
                                        'id' => '[0-9]*',
                                    ],
                                    'defaults' => [
                                        'action' => 'delete',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'dtl-occupation' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/occupation[/:page]',
                            'constraints' => [
                                'page' => '[0-9]*'
                            ],
                            'defaults' => [
                                'controller' => Controller\OccupationController::class,
                                'action' => 'index',
                                'page' => 1,
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'add' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/add',
                                    'defaults' => [
                                        'action' => 'add',
                                    ],
                                ],
                            ],
                            'edit' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/edit/:id',
                                    'constraints' => [
                                        'id' => '[0-9]*',
                                    ],
                                    'defaults' => [
                                        'action' => 'edit',
                                    ],
                                ],
                            ],
                            'delete' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '/delete/:id',
                                    'constraints' => [
                                        'id' => '[0-9]*',
                                    ],
                                    'defaults' => [
                                        'action' => 'delete',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Dashboard',
                'route' => 'dtl-admin',
                'pages' => [
                    [
                        'label' => 'Cargos',
                        'route' => 'dtl-admin/dtl-office'
                    ],
                    [
                        'label' => 'Profissoes',
                        'route' => 'dtl-admin/dtl-occupation'
                    ],
                ],
            ],
        ],
        'admin' => [
            [
                'label' => 'Cargos',
                'route' => 'dtl-admin/dtl-office',
            ],
            [
                'label' => 'Profissoes',
                'route' => 'dtl-admin/dtl-occupation',
            ],
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'personForm' => Helper\PersonForm::class,
            'addressForm' => Helper\AddressForm::class,
            'contactForm' => Helper\ContactForm::class,
            'individualForm' => Helper\IndividualForm::class,
            'legalForm' => Helper\LegalForm::class,
            'professionalForm' => Helper\ProfessionalForm::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'DtlPerson' => __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'],
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ],
            ],
        ],
    ],
];

