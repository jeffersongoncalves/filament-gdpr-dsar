<?php

return [
    'resource' => [
        'label' => 'Żądanie osoby, której dane dotyczą',
        'plural_label' => 'Żądania osób, których dane dotyczą',
    ],

    'fields' => [
        'type' => 'Prawo',
        'status' => 'Status',
        'requester_name' => 'Wnioskodawca',
        'requester_email' => 'E-mail wnioskodawcy',
        'details' => 'Szczegóły',
        'response' => 'Odpowiedź',
        'reason' => 'Powód',
        'extension_reason' => 'Dlaczego żądanie wymaga więcej czasu',
        'subject' => 'Osoba, której dane dotyczą',
        'subject_type' => 'Model osoby',
        'subject_id' => 'ID osoby',
        'verified' => 'Zweryfikowano',
        'due_at' => 'Termin',
        'verified_at' => 'Zweryfikowano dnia',
        'completed_at' => 'Zamknięto',
        'created_at' => 'Otrzymano',
    ],

    'type' => [
        'access' => 'Dostęp (art. 15)',
        'rectification' => 'Sprostowanie (art. 16)',
        'erasure' => 'Usunięcie (art. 17)',
        'restriction' => 'Ograniczenie (art. 18)',
        'portability' => 'Przenoszenie (art. 20)',
        'objection' => 'Sprzeciw (art. 21)',
        'automated_decision' => 'Zautomatyzowana decyzja (art. 22)',
    ],

    'status' => [
        'pending' => 'Oczekujące',
        'completed' => 'Zrealizowane',
        'rejected' => 'Odrzucone',
    ],

    'filters' => [
        'overdue' => 'Po terminie',
    ],

    'actions' => [
        'verify' => [
            'label' => 'Zweryfikuj tożsamość',
            'description' => 'Potwierdź, kim jest wnioskodawca, i powiąż żądanie z jego rekordem. Wcześniej nic nie jest eksportowane ani usuwane.',
            'not_found' => 'Nie znaleziono rekordu tej osoby.',
            'success' => 'Tożsamość zweryfikowana.',
        ],
        'fulfil' => [
            'label' => 'Zrealizuj',
            'description' => [
                'access' => 'Eksportuje wszystkie zadeklarowane dane osobowe osoby do pliku JSON.',
                'portability' => 'Eksportuje wszystkie zadeklarowane dane osobowe osoby do pliku JSON.',
                'erasure' => 'Anonimizuje wszystkie rekordy osoby, której dane dotyczą. Tego nie można cofnąć.',
            ],
            'success' => 'Żądanie zrealizowane.',
        ],
        'complete' => [
            'label' => 'Zakończ',
            'description' => 'Na to prawo odpowiada się ręcznie: zapisz odpowiedź udzieloną osobie.',
            'success' => 'Żądanie zakończone.',
        ],
        'reject' => [
            'label' => 'Odrzuć',
            'success' => 'Żądanie odrzucone.',
        ],
        'extend' => [
            'label' => 'Przedłuż o dwa miesiące',
            'description' => 'W przypadku złożonych lub licznych żądań, jeden raz, w pierwszym miesiącu. Poinformuj osobę o przyczynach (art. 12 ust. 3).',
            'success' => 'Termin przedłużony.',
        ],
        'download' => [
            'label' => 'Pobierz eksport',
        ],
    ],
];
