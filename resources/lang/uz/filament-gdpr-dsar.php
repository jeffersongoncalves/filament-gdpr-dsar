<?php

return [
    'resource' => [
        'label' => 'Ma\'lumot subyekti so\'rovi',
        'plural_label' => 'Ma\'lumot subyektlari so\'rovlari',
    ],

    'fields' => [
        'type' => 'Huquq',
        'status' => 'Holat',
        'requester_name' => 'So\'rovchi',
        'requester_email' => 'So\'rovchining e-pochtasi',
        'details' => 'Tafsilotlar',
        'response' => 'Javob',
        'reason' => 'Sabab',
        'extension_reason' => 'So\'rovga nima uchun ko\'proq vaqt kerak',
        'subject' => 'Ma\'lumot subyekti',
        'subject_type' => 'Subyekt modeli',
        'subject_id' => 'Subyekt ID',
        'verified' => 'Tasdiqlangan',
        'due_at' => 'Muddat',
        'verified_at' => 'Tasdiqlangan vaqt',
        'completed_at' => 'Yopilgan vaqt',
        'created_at' => 'Qabul qilingan vaqt',
    ],

    'type' => [
        'access' => 'Kirish (15-modda)',
        'rectification' => 'Tuzatish (16-modda)',
        'erasure' => 'O\'chirish (17-modda)',
        'restriction' => 'Cheklash (18-modda)',
        'portability' => 'Ko\'chirish (20-modda)',
        'objection' => 'E\'tiroz (21-modda)',
        'automated_decision' => 'Avtomatlashtirilgan qaror (22-modda)',
    ],

    'status' => [
        'pending' => 'Kutilmoqda',
        'completed' => 'Bajarildi',
        'rejected' => 'Rad etildi',
    ],

    'filters' => [
        'overdue' => 'Muddati o\'tgan',
    ],

    'actions' => [
        'verify' => [
            'label' => 'Shaxsni tasdiqlash',
            'description' => 'So\'rovchi kimligini tasdiqlang va so\'rovni uning yozuviga bog\'lang. Bundan oldin hech narsa eksport qilinmaydi va o\'chirilmaydi.',
            'not_found' => 'Bu ma\'lumot subyekti uchun yozuv topilmadi.',
            'success' => 'Shaxs tasdiqlandi.',
        ],
        'fulfil' => [
            'label' => 'Bajarish',
            'description' => [
                'access' => 'Ma\'lumot subyektining e\'lon qilingan barcha shaxsiy ma\'lumotlarini JSON faylga eksport qiladi.',
                'portability' => 'Ma\'lumot subyektining e\'lon qilingan barcha shaxsiy ma\'lumotlarini JSON faylga eksport qiladi.',
                'erasure' => 'Ma\'lumot subyektining barcha yozuvlarini anonimlashtiradi. Qaytarib bo\'lmaydi.',
            ],
            'success' => 'So\'rov bajarildi.',
        ],
        'complete' => [
            'label' => 'Yakunlash',
            'description' => 'Bu huquqqa qo\'lda javob beriladi: subyektga bergan javobingizni qayd eting.',
            'success' => 'So\'rov yakunlandi.',
        ],
        'reject' => [
            'label' => 'Rad etish',
            'success' => 'So\'rov rad etildi.',
        ],
        'extend' => [
            'label' => 'Ikki oyga uzaytirish',
            'description' => 'Murakkab yoki ko\'p sonli so\'rovlar uchun, bir marta, birinchi oy ichida. Subyektga sababini bildiring (12(3)-modda).',
            'success' => 'Muddat uzaytirildi.',
        ],
        'download' => [
            'label' => 'Eksportni yuklab olish',
        ],
    ],
];
