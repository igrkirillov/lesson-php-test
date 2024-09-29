<?php

namespace Dao;

class UserTableWrapper implements TableWrapperInterface
{
    private array $rows = array();

    /**
     * @param array|[column => row_value] $values
     */
    public function insert(array $values): void
    {
        $this->rows[] = $values;
    }


    public function update(int $id, array $values): array
    {
        foreach ($this->rows as $row) {
            if ($row['id'] === $id) {
                $this->rows[$row['id']] = $values;
                return $values;
            }
        }
        return [];
    }

    public function delete(int $id): void
    {
        foreach ($this->rows as $row) {
            if ($row['id'] === $id) {
                unset($this->rows[$row['id']]);
                break;
            }
        }
    }

    public function get(): array
    {
        foreach ($this->rows as $row) {
            if ($row['id'] === $id) {
                return $this->rows[$row['id']];
            }
        }
        return [];
    }

    /**
     * @return array
     */
    public function getRows(): array
    {
        return $this->rows;
    }
}