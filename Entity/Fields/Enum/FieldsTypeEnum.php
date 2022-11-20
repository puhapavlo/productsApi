<?php

namespace Pablo\ApiProduct\Entity\Fields\Enum;

enum FieldsTypeEnum
{
    case string;
    case password;
    case char;
    case blob;
    case bool;
    case float;
    case double;
    case date;
    case datetime;
    case timestamp;
    case time;
    case year;
    case current_time;

    public function fieldType(): string
    {
        return match ($this) {
            FieldsTypeEnum::string, FieldsTypeEnum::password => 'VARCHAR',
            FieldsTypeEnum::char => 'CHAR',
            FieldsTypeEnum::blob => 'BLOB',
            FieldsTypeEnum::bool => 'BOOLEAN',
            FieldsTypeEnum::float => 'FLOAT',
            FieldsTypeEnum::double => 'DOUBLE',
            FieldsTypeEnum::date => 'DATE',
            FieldsTypeEnum::datetime, FieldsTypeEnum::current_time => 'DATETIME',
            FieldsTypeEnum::timestamp => 'TIMESTAMP',
            FieldsTypeEnum::time => 'TIME',
            FieldsTypeEnum::year => 'YEAR',
        };
    }
}
