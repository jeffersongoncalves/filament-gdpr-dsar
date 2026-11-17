<?php

return [
    'resource' => [
        'label' => 'İlgili kişi başvurusu',
        'plural_label' => 'İlgili kişi başvuruları',
    ],

    'fields' => [
        'type' => 'Hak',
        'status' => 'Durum',
        'requester_name' => 'Başvuran',
        'requester_email' => 'Başvuranın e-postası',
        'details' => 'Ayrıntılar',
        'response' => 'Yanıt',
        'reason' => 'Gerekçe',
        'extension_reason' => 'Talebin neden daha fazla zamana ihtiyacı var',
        'subject' => 'İlgili kişi',
        'subject_type' => 'İlgili kişi modeli',
        'subject_id' => 'İlgili kişi ID',
        'verified' => 'Doğrulandı',
        'due_at' => 'Son tarih',
        'verified_at' => 'Doğrulanma',
        'completed_at' => 'Kapanma',
        'created_at' => 'Alınma',
    ],

    'type' => [
        'access' => 'Erişim (md. 15)',
        'rectification' => 'Düzeltme (md. 16)',
        'erasure' => 'Silme (md. 17)',
        'restriction' => 'Kısıtlama (md. 18)',
        'portability' => 'Taşınabilirlik (md. 20)',
        'objection' => 'İtiraz (md. 21)',
        'automated_decision' => 'Otomatik karar (md. 22)',
    ],

    'status' => [
        'pending' => 'Bekliyor',
        'completed' => 'Tamamlandı',
        'rejected' => 'Reddedildi',
    ],

    'filters' => [
        'overdue' => 'Süresi geçmiş',
    ],

    'actions' => [
        'verify' => [
            'label' => 'Kimliği doğrula',
            'description' => 'Başvuranın kim olduğunu doğrulayın ve başvuruyu kaydına bağlayın. Bundan önce hiçbir şey dışa aktarılmaz veya silinmez.',
            'not_found' => 'Bu ilgili kişi için kayıt bulunamadı.',
            'success' => 'Kimlik doğrulandı.',
        ],
        'fulfil' => [
            'label' => 'Yerine getir',
            'description' => [
                'access' => 'İlgili kişinin beyan edilen tüm kişisel verilerini bir JSON dosyasına aktarır.',
                'portability' => 'İlgili kişinin beyan edilen tüm kişisel verilerini bir JSON dosyasına aktarır.',
                'erasure' => 'İlgili kişinin tüm kayıtlarını anonimleştirir. Geri alınamaz.',
            ],
            'success' => 'Başvuru yerine getirildi.',
        ],
        'complete' => [
            'label' => 'Tamamla',
            'description' => 'Bu hak elle yanıtlanır: ilgili kişiye verdiğiniz yanıtı kaydedin.',
            'success' => 'Başvuru tamamlandı.',
        ],
        'reject' => [
            'label' => 'Reddet',
            'success' => 'Başvuru reddedildi.',
        ],
        'extend' => [
            'label' => 'İki ay uzat',
            'description' => 'Karmaşık veya çok sayıda talep için, bir kez, ilk ay içinde. İlgili kişiye nedenini bildirin (md. 12(3)).',
            'success' => 'Süre uzatıldı.',
        ],
        'download' => [
            'label' => 'Dışa aktarımı indir',
        ],
    ],
];
