<?php

namespace Pablo\ApiProduct\Entity\Fields;

use Pablo\ApiProduct\Entity\Fields\Enum\FieldsTypeEnum;

/**
 * Class for Field types.
 */
class FieldType
{
    /**
     *  Check exist field type.
     * @param string $field_type
     *  Field type.
     * @return bool
     */
    public static function existFieldType(string $field_type): bool
    {
        $field_types = FieldsTypeEnum::cases();
        $matchingFieldTypesIndex = array_search($field_type, array_column($field_types, "name"));
        if (!$matchingFieldTypesIndex) {
            return false;
        }
        return true;
    }
}
