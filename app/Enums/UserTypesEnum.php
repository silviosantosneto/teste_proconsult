<?php


namespace App\Enums;

enum UserTypesEnum: int
{

    case COLLABORATOR = 1;
    case CLIENT = 2;

    public function getName(): string
    {
        return match ($this) {
            self::COLLABORATOR => 'Colaborador',
            self::CLIENT => 'Cliente',
            default => 'Tipo de usuário não encontrado'
        };
    }
}
