<?php

namespace Pablo\ApiProduct\Term;

use Pablo\ApiProduct\Entity\EntityBase;
use Pablo\ApiProduct\Entity\Fields\Field;

/**
 * Base class for Terms Taxonomy.
 */
abstract class TermBase extends EntityBase implements TermBundleInterface
{
    #[Field(['name' => 'id', 'type' => 'int'])]
    public $id;

    #[Field(['name' => 'name', 'type' => 'string'])]
    public $name;

    public function getTerms():array
    {
        return $this->db->getTableData($this::TABLE_NAME);
    }

    /**
     * @inheritDoc
     */
    public function label(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function update()
    {
        $query = "UPDATE $this::TABLE_NAME SET
                `name` = $this->name,
            WHERE id = $this->id";

        return $this->db->queryExecute($query);
    }
}
