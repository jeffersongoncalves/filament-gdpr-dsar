<?php

return [
    'resource' => [
        'label' => 'Məlumat subyektinin sorğusu',
        'plural_label' => 'Məlumat subyektlərinin sorğuları',
    ],

    'fields' => [
        'type' => 'Hüquq',
        'status' => 'Status',
        'requester_name' => 'Sorğu edən',
        'requester_email' => 'Sorğu edənin e-poçtu',
        'details' => 'Təfərrüatlar',
        'response' => 'Cavab',
        'reason' => 'Səbəb',
        'extension_reason' => 'Sorğunun niyə əlavə vaxta ehtiyacı var',
        'subject' => 'Məlumat subyekti',
        'subject_type' => 'Subyekt modeli',
        'subject_id' => 'Subyekt ID',
        'verified' => 'Təsdiqlənib',
        'due_at' => 'Son tarix',
        'verified_at' => 'Təsdiqlənmə',
        'completed_at' => 'Bağlanma',
        'created_at' => 'Alınma',
    ],

    'type' => [
        'access' => 'Giriş (maddə 15)',
        'rectification' => 'Düzəliş (maddə 16)',
        'erasure' => 'Silinmə (maddə 17)',
        'restriction' => 'Məhdudlaşdırma (maddə 18)',
        'portability' => 'Daşınma (maddə 20)',
        'objection' => 'Etiraz (maddə 21)',
        'automated_decision' => 'Avtomatlaşdırılmış qərar (maddə 22)',
    ],

    'status' => [
        'pending' => 'Gözləyir',
        'completed' => 'Tamamlandı',
        'rejected' => 'Rədd edildi',
    ],

    'filters' => [
        'overdue' => 'Gecikmiş',
    ],

    'actions' => [
        'verify' => [
            'label' => 'Kimliyi təsdiqlə',
            'description' => 'Sorğu edənin kim olduğunu təsdiqləyin və sorğunu onun qeydinə bağlayın. Bundan əvvəl heç nə ixrac edilmir və silinmir.',
            'not_found' => 'Bu məlumat subyekti üçün qeyd tapılmadı.',
            'success' => 'Kimlik təsdiqləndi.',
        ],
        'fulfil' => [
            'label' => 'İcra et',
            'description' => [
                'access' => 'Məlumat subyektinin bütün elan edilmiş şəxsi məlumatlarını JSON faylına ixrac edir.',
                'portability' => 'Məlumat subyektinin bütün elan edilmiş şəxsi məlumatlarını JSON faylına ixrac edir.',
                'erasure' => 'Subyektin bütün qeydlərini anonimləşdirir. Geri qaytarıla bilməz.',
            ],
            'success' => 'Sorğu icra edildi.',
        ],
        'complete' => [
            'label' => 'Tamamla',
            'description' => 'Bu hüquq əl ilə cavablandırılır: məlumat subyektinə verdiyiniz cavabı qeyd edin.',
            'success' => 'Sorğu tamamlandı.',
        ],
        'reject' => [
            'label' => 'Rədd et',
            'success' => 'Sorğu rədd edildi.',
        ],
        'extend' => [
            'label' => 'İki ay uzat',
            'description' => 'Mürəkkəb və ya çoxsaylı sorğular üçün, bir dəfə, ilk ay ərzində. Subyektə səbəbi bildirin (maddə 12(3)).',
            'success' => 'Müddət uzadıldı.',
        ],
        'download' => [
            'label' => 'İxracı yüklə',
        ],
    ],
];
