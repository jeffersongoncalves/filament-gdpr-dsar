<?php

return [
    'resource' => [
        'label' => '数据主体请求',
        'plural_label' => '数据主体请求',
    ],

    'fields' => [
        'type' => '权利',
        'status' => '状态',
        'requester_name' => '请求人',
        'requester_email' => '请求人邮箱',
        'details' => '详情',
        'response' => '答复',
        'reason' => '原因',
        'extension_reason' => '请求需要更多时间的原因',
        'subject' => '数据主体',
        'subject_type' => '数据主体模型',
        'subject_id' => '数据主体 ID',
        'verified' => '已验证',
        'due_at' => '截止日期',
        'verified_at' => '验证时间',
        'completed_at' => '关闭时间',
        'created_at' => '接收时间',
    ],

    'type' => [
        'access' => '访问（第15条）',
        'rectification' => '更正（第16条）',
        'erasure' => '删除（第17条）',
        'restriction' => '限制（第18条）',
        'portability' => '可携带（第20条）',
        'objection' => '反对（第21条）',
        'automated_decision' => '自动化决策（第22条）',
    ],

    'status' => [
        'pending' => '待处理',
        'completed' => '已完成',
        'rejected' => '已拒绝',
    ],

    'filters' => [
        'overdue' => '已逾期',
    ],

    'actions' => [
        'verify' => [
            'label' => '验证身份',
            'description' => '确认请求人身份并将请求关联到其记录。在此之前不会导出或删除任何内容。',
            'not_found' => '未找到该数据主体的记录。',
            'success' => '身份已验证。',
        ],
        'fulfil' => [
            'label' => '执行',
            'description' => [
                'access' => '将数据主体所有已声明的个人数据导出为 JSON 文件。',
                'portability' => '将数据主体所有已声明的个人数据导出为 JSON 文件。',
                'erasure' => '匿名化数据主体的所有记录。此操作无法撤销。',
            ],
            'success' => '请求已执行。',
        ],
        'complete' => [
            'label' => '完成',
            'description' => '此权利需人工答复：记录你给数据主体的答复。',
            'success' => '请求已完成。',
        ],
        'reject' => [
            'label' => '拒绝',
            'success' => '请求已拒绝。',
        ],
        'extend' => [
            'label' => '延长两个月',
            'description' => '适用于复杂或大量的请求，仅一次，须在第一个月内。告知数据主体原因（第12(3)条）。',
            'success' => '期限已延长。',
        ],
        'download' => [
            'label' => '下载导出文件',
        ],
    ],
];
