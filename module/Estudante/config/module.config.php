<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Estudante\Controller\Estudante' => 'Estudante\Controller\EstudanteController',
        ),
    ),
	    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'estudante' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/estudante[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Estudante\Controller\Estudante',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_path_stack' => array(
            'estudante' => __DIR__ . '/../view',
        ),
    ),
);