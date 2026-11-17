<?php

return [
    'resource' => [
        'label' => 'Solicitação do titular',
        'plural_label' => 'Solicitações dos titulares',
    ],

    'fields' => [
        'type' => 'Direito',
        'status' => 'Status',
        'requester_name' => 'Solicitante',
        'requester_email' => 'E-mail do solicitante',
        'details' => 'Detalhes',
        'response' => 'Resposta',
        'reason' => 'Motivo',
        'extension_reason' => 'Por que o pedido precisa de mais tempo',
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
        'access' => 'Acesso (art. 15)',
        'rectification' => 'Retificação (art. 16)',
        'erasure' => 'Apagamento (art. 17)',
        'restriction' => 'Limitação (art. 18)',
        'portability' => 'Portabilidade (art. 20)',
        'objection' => 'Oposição (art. 21)',
        'automated_decision' => 'Decisão automatizada (art. 22)',
    ],

    'status' => [
        'pending' => 'Pendente',
        'completed' => 'Concluída',
        'rejected' => 'Recusada',
    ],

    'filters' => [
        'overdue' => 'Vencidas',
    ],

    'actions' => [
        'verify' => [
            'label' => 'Verificar identidade',
            'description' => 'Confirme quem é o solicitante e vincule a solicitação ao registro dele. Nada é exportado nem apagado antes disso.',
            'not_found' => 'Nenhum registro encontrado para este titular.',
            'success' => 'Identidade verificada.',
        ],
        'fulfil' => [
            'label' => 'Atender',
            'description' => [
                'access' => 'Exporta todos os dados pessoais declarados do titular para um arquivo JSON.',
                'portability' => 'Exporta todos os dados pessoais declarados do titular para um arquivo JSON.',
                'erasure' => 'Anonimiza todos os registros do titular. Não pode ser desfeito.',
            ],
            'success' => 'Solicitação atendida.',
        ],
        'complete' => [
            'label' => 'Concluir',
            'description' => 'Este direito é respondido manualmente: registre a resposta dada ao titular.',
            'success' => 'Solicitação concluída.',
        ],
        'reject' => [
            'label' => 'Recusar',
            'success' => 'Solicitação recusada.',
        ],
        'extend' => [
            'label' => 'Prorrogar por dois meses',
            'description' => 'Para pedidos complexos ou numerosos, uma vez, dentro do primeiro mês. Informe o titular do motivo (art. 12(3)).',
            'success' => 'Prazo prorrogado.',
        ],
        'download' => [
            'label' => 'Baixar exportação',
        ],
    ],
];
