<?php

return [
    'resource' => [
        'label' => 'Solicitud del titular',
        'plural_label' => 'Solicitudes de los titulares',
    ],

    'fields' => [
        'type' => 'Derecho',
        'status' => 'Estado',
        'requester_name' => 'Solicitante',
        'requester_email' => 'Correo del solicitante',
        'details' => 'Detalles',
        'response' => 'Respuesta',
        'reason' => 'Motivo',
        'extension_reason' => 'Por qué la solicitud necesita más tiempo',
        'subject' => 'Titular',
        'subject_type' => 'Modelo del titular',
        'subject_id' => 'ID del titular',
        'verified' => 'Verificado',
        'due_at' => 'Plazo',
        'verified_at' => 'Verificado el',
        'completed_at' => 'Cerrado el',
        'created_at' => 'Recibido el',
    ],

    'type' => [
        'access' => 'Acceso (art. 15)',
        'rectification' => 'Rectificación (art. 16)',
        'erasure' => 'Supresión (art. 17)',
        'restriction' => 'Limitación (art. 18)',
        'portability' => 'Portabilidad (art. 20)',
        'objection' => 'Oposición (art. 21)',
        'automated_decision' => 'Decisión automatizada (art. 22)',
    ],

    'status' => [
        'pending' => 'Pendiente',
        'completed' => 'Completada',
        'rejected' => 'Rechazada',
    ],

    'filters' => [
        'overdue' => 'Vencidas',
    ],

    'actions' => [
        'verify' => [
            'label' => 'Verificar identidad',
            'description' => 'Confirma quién es el solicitante y vincula la solicitud a su registro. Nada se exporta ni se elimina antes de esto.',
            'not_found' => 'No se encontró ningún registro para este titular.',
            'success' => 'Identidad verificada.',
        ],
        'fulfil' => [
            'label' => 'Atender',
            'description' => [
                'access' => 'Exporta todos los datos personales declarados del titular a un archivo JSON.',
                'portability' => 'Exporta todos los datos personales declarados del titular a un archivo JSON.',
                'erasure' => 'Anonimiza todos los registros del interesado. No se puede deshacer.',
            ],
            'success' => 'Solicitud atendida.',
        ],
        'complete' => [
            'label' => 'Completar',
            'description' => 'Este derecho se responde manualmente: registra la respuesta que diste al titular.',
            'success' => 'Solicitud completada.',
        ],
        'reject' => [
            'label' => 'Rechazar',
            'success' => 'Solicitud rechazada.',
        ],
        'extend' => [
            'label' => 'Prorrogar dos meses',
            'description' => 'Para solicitudes complejas o numerosas, una vez, dentro del primer mes. Informe al interesado del motivo (art. 12(3)).',
            'success' => 'Plazo prorrogado.',
        ],
        'download' => [
            'label' => 'Descargar exportación',
        ],
    ],
];
