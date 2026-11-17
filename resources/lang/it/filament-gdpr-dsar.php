<?php

return [
    'resource' => [
        'label' => 'Richiesta dell\'interessato',
        'plural_label' => 'Richieste degli interessati',
    ],

    'fields' => [
        'type' => 'Diritto',
        'status' => 'Stato',
        'requester_name' => 'Richiedente',
        'requester_email' => 'Email del richiedente',
        'details' => 'Dettagli',
        'response' => 'Risposta',
        'reason' => 'Motivo',
        'extension_reason' => 'Perché la richiesta richiede più tempo',
        'subject' => 'Interessato',
        'subject_type' => 'Modello dell\'interessato',
        'subject_id' => 'ID dell\'interessato',
        'verified' => 'Verificato',
        'due_at' => 'Scadenza',
        'verified_at' => 'Verificato il',
        'completed_at' => 'Chiuso il',
        'created_at' => 'Ricevuto il',
    ],

    'type' => [
        'access' => 'Accesso (art. 15)',
        'rectification' => 'Rettifica (art. 16)',
        'erasure' => 'Cancellazione (art. 17)',
        'restriction' => 'Limitazione (art. 18)',
        'portability' => 'Portabilità (art. 20)',
        'objection' => 'Opposizione (art. 21)',
        'automated_decision' => 'Decisione automatizzata (art. 22)',
    ],

    'status' => [
        'pending' => 'In attesa',
        'completed' => 'Completata',
        'rejected' => 'Respinta',
    ],

    'filters' => [
        'overdue' => 'Scadute',
    ],

    'actions' => [
        'verify' => [
            'label' => 'Verifica identità',
            'description' => 'Conferma chi è il richiedente e collega la richiesta al suo record. Nulla viene esportato o cancellato prima.',
            'not_found' => 'Nessun record trovato per questo interessato.',
            'success' => 'Identità verificata.',
        ],
        'fulfil' => [
            'label' => 'Evadi',
            'description' => [
                'access' => 'Esporta tutti i dati personali dichiarati dell\'interessato in un file JSON.',
                'portability' => 'Esporta tutti i dati personali dichiarati dell\'interessato in un file JSON.',
                'erasure' => 'Anonimizza tutti i record dell\'interessato. Non si può annullare.',
            ],
            'success' => 'Richiesta evasa.',
        ],
        'complete' => [
            'label' => 'Completa',
            'description' => 'A questo diritto si risponde manualmente: registra la risposta data all\'interessato.',
            'success' => 'Richiesta completata.',
        ],
        'reject' => [
            'label' => 'Respingi',
            'success' => 'Richiesta respinta.',
        ],
        'extend' => [
            'label' => 'Proroga di due mesi',
            'description' => 'Per richieste complesse o numerose, una sola volta, entro il primo mese. Comunica i motivi all\'interessato (art. 12(3)).',
            'success' => 'Termine prorogato.',
        ],
        'download' => [
            'label' => 'Scarica esportazione',
        ],
    ],
];
