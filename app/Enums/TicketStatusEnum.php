<?php


namespace App\Enums;

enum TicketStatusEnum: int
{

    case OPEN = 1;
    case PROCESSING = 2;
    case CLOSED = 3;

    public function getName(): string
    {
        return match ($this) {
            self::OPEN => 'Aberto',
            self::PROCESSING => 'Em atendimento',
            self::CLOSED => 'Fechado',
            default => 'Status de chamado não encontrado'
        };
    }
}
