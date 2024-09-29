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
        foreach ($this->rows as &$row) {
            if ($row['id'] === $id) {
                foreach ($values as $key => $value) {
                    $row[$key] = $value;
                }
                return $row;
            }
        }
        return [];
    }

    public function delete(int $id): void
    {
        for($i=0; $i < count($this->rows); $i++) {
            if ($this->rows[$i]['id'] === $id) {
                unset($this->rows[$i]);
                break;
            }
        }
    }

    public function get(int $id): array
    {
        foreach ($this->rows as $row) {
            if ($row['id'] === $id) {
                return $row;
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

    /**
     * @param array $rows
     */
    public function setRows(array $rows): void
    {
        $this->rows = $rows;
    }
}