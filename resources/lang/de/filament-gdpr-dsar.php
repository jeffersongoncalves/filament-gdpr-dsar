<?php

return [
    'resource' => [
        'label' => 'Betroffenenanfrage',
        'plural_label' => 'Betroffenenanfragen',
    ],

    'fields' => [
        'type' => 'Recht',
        'status' => 'Status',
        'requester_name' => 'Antragsteller',
        'requester_email' => 'E-Mail des Antragstellers',
        'details' => 'Details',
        'response' => 'Antwort',
        'reason' => 'Grund',
        'extension_reason' => 'Warum die Anfrage mehr Zeit braucht',
        'subject' => 'Betroffene Person',
        'subject_type' => 'Modell der betroffenen Person',
        'subject_id' => 'ID der betroffenen Person',
        'verified' => 'Verifiziert',
        'due_at' => 'Fällig',
        'verified_at' => 'Verifiziert am',
        'completed_at' => 'Abgeschlossen am',
        'created_at' => 'Eingegangen am',
    ],

    'type' => [
        'access' => 'Auskunft (Art. 15)',
        'rectification' => 'Berichtigung (Art. 16)',
        'erasure' => 'Löschung (Art. 17)',
        'restriction' => 'Einschränkung (Art. 18)',
        'portability' => 'Datenübertragbarkeit (Art. 20)',
        'objection' => 'Widerspruch (Art. 21)',
        'automated_decision' => 'Automatisierte Entscheidung (Art. 22)',
    ],

    'status' => [
        'pending' => 'Offen',
        'completed' => 'Erledigt',
        'rejected' => 'Abgelehnt',
    ],

    'filters' => [
        'overdue' => 'Überfällig',
    ],

    'actions' => [
        'verify' => [
            'label' => 'Identität prüfen',
            'description' => 'Bestätigen Sie, wer der Antragsteller ist, und verknüpfen Sie die Anfrage mit seinem Datensatz. Vorher wird nichts exportiert oder gelöscht.',
            'not_found' => 'Kein Datensatz für diese betroffene Person gefunden.',
            'success' => 'Identität geprüft.',
        ],
        'fulfil' => [
            'label' => 'Ausführen',
            'description' => [
                'access' => 'Exportiert alle deklarierten personenbezogenen Daten der betroffenen Person in eine JSON-Datei.',
                'portability' => 'Exportiert alle deklarierten personenbezogenen Daten der betroffenen Person in eine JSON-Datei.',
                'erasure' => 'Anonymisiert alle Datensätze der betroffenen Person. Das kann nicht rückgängig gemacht werden.',
            ],
            'success' => 'Anfrage ausgeführt.',
        ],
        'complete' => [
            'label' => 'Abschließen',
            'description' => 'Dieses Recht wird manuell beantwortet: Halten Sie die Antwort fest, die Sie der betroffenen Person gegeben haben.',
            'success' => 'Anfrage abgeschlossen.',
        ],
        'reject' => [
            'label' => 'Ablehnen',
            'success' => 'Anfrage abgelehnt.',
        ],
        'extend' => [
            'label' => 'Um zwei Monate verlängern',
            'description' => 'Bei komplexen oder zahlreichen Anfragen, einmalig, innerhalb des ersten Monats. Teilen Sie der betroffenen Person die Gründe mit (Art. 12 Abs. 3).',
            'success' => 'Frist verlängert.',
        ],
        'download' => [
            'label' => 'Export herunterladen',
        ],
    ],
];
