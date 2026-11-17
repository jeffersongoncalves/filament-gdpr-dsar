<?php

return [
    'resource' => [
        'label' => 'Demande de la personne concernée',
        'plural_label' => 'Demandes des personnes concernées',
    ],

    'fields' => [
        'type' => 'Droit',
        'status' => 'Statut',
        'requester_name' => 'Demandeur',
        'requester_email' => 'E-mail du demandeur',
        'details' => 'Détails',
        'response' => 'Réponse',
        'reason' => 'Motif',
        'extension_reason' => 'Pourquoi la demande nécessite plus de temps',
        'subject' => 'Personne concernée',
        'subject_type' => 'Modèle de la personne concernée',
        'subject_id' => 'ID de la personne concernée',
        'verified' => 'Vérifié',
        'due_at' => 'Échéance',
        'verified_at' => 'Vérifié le',
        'completed_at' => 'Clôturé le',
        'created_at' => 'Reçu le',
    ],

    'type' => [
        'access' => 'Accès (art. 15)',
        'rectification' => 'Rectification (art. 16)',
        'erasure' => 'Effacement (art. 17)',
        'restriction' => 'Limitation (art. 18)',
        'portability' => 'Portabilité (art. 20)',
        'objection' => 'Opposition (art. 21)',
        'automated_decision' => 'Décision automatisée (art. 22)',
    ],

    'status' => [
        'pending' => 'En attente',
        'completed' => 'Traitée',
        'rejected' => 'Rejetée',
    ],

    'filters' => [
        'overdue' => 'En retard',
    ],

    'actions' => [
        'verify' => [
            'label' => 'Vérifier l\'identité',
            'description' => 'Confirmez qui est le demandeur et liez la demande à son enregistrement. Rien n\'est exporté ni supprimé avant cela.',
            'not_found' => 'Aucun enregistrement trouvé pour cette personne concernée.',
            'success' => 'Identité vérifiée.',
        ],
        'fulfil' => [
            'label' => 'Traiter',
            'description' => [
                'access' => 'Exporte toutes les données personnelles déclarées de la personne concernée dans un fichier JSON.',
                'portability' => 'Exporte toutes les données personnelles déclarées de la personne concernée dans un fichier JSON.',
                'erasure' => 'Anonymise tous les enregistrements de la personne concernée. Action irréversible.',
            ],
            'success' => 'Demande traitée.',
        ],
        'complete' => [
            'label' => 'Clôturer',
            'description' => 'Ce droit est traité manuellement : consignez la réponse donnée à la personne concernée.',
            'success' => 'Demande clôturée.',
        ],
        'reject' => [
            'label' => 'Rejeter',
            'success' => 'Demande rejetée.',
        ],
        'extend' => [
            'label' => 'Prolonger de deux mois',
            'description' => 'Pour les demandes complexes ou nombreuses, une seule fois, dans le premier mois. Informez la personne concernée des motifs (art. 12(3)).',
            'success' => 'Délai prolongé.',
        ],
        'download' => [
            'label' => 'Télécharger l\'export',
        ],
    ],
];
