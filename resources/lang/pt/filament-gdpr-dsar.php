<?php

return [
    'resource' => [
        'label' => 'Pedido do titular',
        'plural_label' => 'Pedidos dos titulares',
    ],

    'fields' => [
        'type' => 'Direito',
        'status' => 'Estado',
        'requester_name' => 'Requerente',
        'requester_email' => 'E-mail do requerente',
        'details' => 'Detalhes',
        'response' => 'Resposta',
        'reason' => 'Motivo',
        'extension_reason' => 'Porque é que o pedido precisa de mais tempo',
        'subject' => 'Titular',
        'subject_type' => 'Modelo do titular',
        'subject_id' => 'ID do titular',
        'verified' => 'Verificado',
        'due_at' => 'Prazo',
        'verified_at' => 'Verificado em',
        'completed_at' => 'Encerrado em',
        'created_at' => 'Recebido em',
    ],

    'type' => [
        'access' => 'Acesso (art. 15.º)',
        'rectification' => 'Retificação (art. 16.º)',
        'erasure' => 'Apagamento (art. 17.º)',
        'restriction' => 'Limitação (art. 18.º)',
        'portability' => 'Portabilidade (art. 20.º)',
        'objection' => 'Oposição (art. 21.º)',
        'automated_decision' => 'Decisão automatizada (art. 22.º)',
    ],

    'status' => [
        'pending' => 'Pendente',
        'completed' => 'Concluído',
        'rejected' => 'Recusado',
    ],

    'filters' => [
        'overdue' => 'Em atraso',
    ],

    'actions' => [
        'verify' => [
            'label' => 'Verificar identidade',
            'description' => 'Confirme quem é o requerente e associe o pedido ao respetivo registo. Nada é exportado nem eliminado antes disso.',
            'not_found' => 'Nenhum registo encontrado para este titular.',
            'success' => 'Identidade verificada.',
        ],
        'fulfil' => [
            'label' => 'Executar',
            'description' => [
                'access' => 'Exporta todos os dados pessoais declarados do titular para um ficheiro JSON.',
                'portability' => 'Exporta todos os dados pessoais declarados do titular para um ficheiro JSON.',
                'erasure' => 'Anonimiza todos os registos do titular. Não pode ser anulado.',
            ],
            'success' => 'Pedido executado.',
        ],
        'complete' => [
            'label' => 'Concluir',
            'description' => 'Este direito é respondido manualmente: registe a resposta dada ao titular.',
            'success' => 'Pedido concluído.',
        ],
        'reject' => [
            'label' => 'Recusar',
            'success' => 'Pedido recusado.',
        ],
        'extend' => [
            'label' => 'Prorrogar por dois meses',
            'description' => 'Para pedidos complexos ou numerosos, uma vez, no primeiro mês. Informe o titular dos motivos (art. 12.º, n.º 3).',
            'success' => 'Prazo prorrogado.',
        ],
        'download' => [
            'label' => 'Descarregar exportação',
        ],
    ],
];
