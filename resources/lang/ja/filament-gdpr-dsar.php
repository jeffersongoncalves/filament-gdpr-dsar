<?php

return [
    'resource' => [
        'label' => 'データ主体の請求',
        'plural_label' => 'データ主体の請求',
    ],

    'fields' => [
        'type' => '権利',
        'status' => 'ステータス',
        'requester_name' => '請求者',
        'requester_email' => '請求者のメール',
        'details' => '詳細',
        'response' => '回答',
        'reason' => '理由',
        'extension_reason' => '追加の時間が必要な理由',
        'subject' => 'データ主体',
        'subject_type' => 'データ主体のモデル',
        'subject_id' => 'データ主体のID',
        'verified' => '本人確認済み',
        'due_at' => '期限',
        'verified_at' => '本人確認日時',
        'completed_at' => '完了日時',
        'created_at' => '受付日時',
    ],

    'type' => [
        'access' => 'アクセス（第15条）',
        'rectification' => '訂正（第16条）',
        'erasure' => '消去（第17条）',
        'restriction' => '制限（第18条）',
        'portability' => 'データポータビリティ（第20条）',
        'objection' => '異議（第21条）',
        'automated_decision' => '自動化された決定（第22条）',
    ],

    'status' => [
        'pending' => '保留中',
        'completed' => '完了',
        'rejected' => '却下',
    ],

    'filters' => [
        'overdue' => '期限切れ',
    ],

    'actions' => [
        'verify' => [
            'label' => '本人確認',
            'description' => '請求者が誰かを確認し、請求をその人のレコードに紐付けます。それまでは何もエクスポートも削除もされません。',
            'not_found' => 'このデータ主体のレコードが見つかりません。',
            'success' => '本人確認が完了しました。',
        ],
        'fulfil' => [
            'label' => '対応する',
            'description' => [
                'access' => 'データ主体の申告済み個人データをすべて JSON ファイルにエクスポートします。',
                'portability' => 'データ主体の申告済み個人データをすべて JSON ファイルにエクスポートします。',
                'erasure' => 'データ主体のすべてのレコードを匿名化します。元に戻せません。',
            ],
            'success' => '請求に対応しました。',
        ],
        'complete' => [
            'label' => '完了にする',
            'description' => 'この権利には手動で回答します。データ主体に伝えた回答を記録してください。',
            'success' => '請求を完了しました。',
        ],
        'reject' => [
            'label' => '却下する',
            'success' => '請求を却下しました。',
        ],
        'extend' => [
            'label' => '2か月延長',
            'description' => '複雑または多数の請求の場合、最初の1か月以内に1回のみ。データ主体に理由を伝えてください（第12条第3項）。',
            'success' => '期限を延長しました。',
        ],
        'download' => [
            'label' => 'エクスポートをダウンロード',
        ],
    ],
];
