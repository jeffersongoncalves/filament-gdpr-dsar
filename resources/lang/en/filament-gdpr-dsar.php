<?php

return [
    'resource' => [
        'label' => 'Data subject request',
        'plural_label' => 'Data subject requests',
    ],

    'fields' => [
        'type' => 'Right',
        'status' => 'Status',
        'requester_name' => 'Requester',
        'requester_email' => 'Requester email',
        'details' => 'Details',
        'response' => 'Response',
        'reason' => 'Reason',
        'extension_reason' => 'Why the request needs more time',
        'subject' => 'Data subject',
        'subject_type' => 'Data subject model',
        'subject_id' => 'Data subject ID',
        'verified' => 'Verified',
        'due_at' => 'Due',
        'verified_at' => 'Verified at',
        'completed_at' => 'Closed at',
        'created_at' => 'Received at',
    ],

    'type' => [
        'access' => 'Access (Art. 15)',
        'rectification' => 'Rectification (Art. 16)',
        'erasure' => 'Erasure (Art. 17)',
        'restriction' => 'Restriction (Art. 18)',
        'portability' => 'Portability (Art. 20)',
        'objection' => 'Objection (Art. 21)',
        'automated_decision' => 'Automated decision (Art. 22)',
    ],

    'status' => [
        'pending' => 'Pending',
        'completed' => 'Completed',
        'rejected' => 'Rejected',
    ],

    'filters' => [
        'overdue' => 'Overdue',
    ],

    'actions' => [
        'verify' => [
            'label' => 'Verify identity',
            'description' => 'Confirm who the requester is and link the request to their record. Nothing is exported or erased before this.',
            'not_found' => 'No record found for this data subject.',
            'success' => 'Identity verified.',
        ],
        'fulfil' => [
            'label' => 'Fulfil',
            'description' => [
                'access' => 'Export every declared personal data of the data subject to a JSON file.',
                'portability' => 'Export every declared personal data of the data subject to a JSON file.',
                'erasure' => 'Anonymize every record of the data subject. This cannot be undone.',
            ],
            'success' => 'Request fulfilled.',
        ],
        'complete' => [
            'label' => 'Complete',
            'description' => 'This right is answered by hand: record the answer you gave the data subject.',
            'success' => 'Request completed.',
        ],
        'reject' => [
            'label' => 'Reject',
            'success' => 'Request rejected.',
        ],
        'extend' => [
            'label' => 'Extend by two months',
            'description' => 'For complex or numerous requests, once, within the first month. Tell the data subject why (Art. 12(3)).',
            'success' => 'Deadline extended.',
        ],
        'download' => [
            'label' => 'Download export',
        ],
    ],
];
