<?php

namespace Pablo\ApiProduct\Entity;

use Attribute;
use Pablo\ApiProduct\config\Database;
use Pablo\ApiProduct\Entity\EntityAccess\EntityAccessInterface;
use Pablo\ApiProduct\Entity\EntityAccess\EntityAccessManager;
use Pablo\ApiProduct\Entity\Fields\Enum\FieldsTypeEnum;
use Pablo\ApiProduct\Entity\Fields\FieldsManager;

/**
 * Main abstract class for entity.
 */
abstract class EntityBase implements EntityInterface
{
    /**
     * Table name in database for entity.
     */
    const TABLE_NAME = self::TABLE_NAME;

    protected $conn;

    protected Database $db;

    protected FieldsManager $fieldsManager;

    private EntityAccessManager $entityAccessManager;

    public EntityAccessInterface $access;

    public function __construct()
    {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
        $this->fieldsManager = new FieldsManager($this);
        $this->entityAccessManager = new EntityAccessManager($this);
        $this->access = $this->entityAccessManager->getEntityAccessObj();
    }

    public function entityToArray($id): array
    {
        return $this->db->getRowInTable($this::TABLE_NAME, $this->id);
    }

    public function delete()
    {
        return $this->db->deleteRowInTable($this::TABLE_NAME, $this->id);
    }

    public function load($id): EntityInterface
    {
        $fields = $this->fieldsManager->getFields();
        $entity_array = $this->entityToArray($id);
        foreach ($fields as $field) {
            $this->field = $entity_array[0][$field];
        }
        return $this;
    }

    public function create()
    {
        $fields = $this->fieldsManager->getFieldsArray();
        $row = [];
        foreach ($fields as $field) {
            if ($field['type'] == FieldsTypeEnum::string->name &&  $field['name'] != 'id') {
                $this->{$field['name']} = htmlspecialchars(strip_tags($this->{$field['name']}));
            }
            if ($field['type'] == FieldsTypeEnum::password->name) {
                $this->{$field['name']} = htmlspecialchars(strip_tags($this->{$field['name']}));
                $this->{$field['name']} = password_hash($this->{$field['name']}, PASSWORD_BCRYPT);
            }
            if ($field['type'] == FieldsTypeEnum::current_time->name) {
                $this->{$field['name']} = date($field['format']);
            }
            if ($field['name'] == 'id') {
                continue;
            }

            $row[$field['name']] = $this->{$field['name']};
        }
        return $this->db->insertRowToTable($this::TABLE_NAME, $row);
    }

    public function getAllEntiesArray(): array
    {
        return $this->db->getTableData($this::TABLE_NAME);
    }

}
