<?php

namespace Libs;

use PDO;

trait QueryBuilder
{
    public $tableName       = '';
    public $selectColumn    = '';
    public $join            = [];
    public $where           = [];
    public $groupBy         = '';
    public $having          = '';
    public $orderBy         = '';
    public $limit           = '';

    /** Set table */
    public function table($tableName)
    {
        $this->tableName = $tableName;
        return $this;
    }

    /** select */
    public function select($selectColumn)
    {
        $this->selectColumn = is_array($selectColumn) ? implode(', ', $selectColumn) : $selectColumn;
        return $this;
    }

    /** Inner join
     * $relationship: table1.column = table2.column ($this->tableName.id = $table.product_id)
     */
    public function join($table, $relationship)
    {

        $this->joins[] = " INNER JOIN `$table` ON $relationship ";
        return $this;
    }

    /** left join */
    public function leftJoin($table, $relationship)
    {
        $this->joins[] = " LEFT JOIN $table ON $relationship ";
        return $this;
    }

    /** right join */
    public function rightJoin($table, $relationship)
    {
        $this->joins[] = " RIGHT JOIN `$table` ON $relationship ";
        return $this;
    }

    /** where */
    public function where($field, $compare, $value)
    {
        if (!empty($this->where)) {
            $this->where[] = " AND `$field` $compare '$value'";
        } else {
            $this->where[] = " WHERE $field $compare '$value'";
        }
        return $this;
    }

    /** orWhere */
    public function orWhere($field, $compare, $value)
    {
        if (!empty($this->where)) {
            $this->where[] = " OR `$field` $compare '$value'";
        } else {
            $this->where[] = " WHERE `$field` $compare '$value'";
        }
        return $this;
    }

    /** where InIn */
    public function InWhere($field, $compare, $value)
    {
        if (!empty($this->where)) {
            $this->where[] = " AND `$field` $compare $value";
        } else {
            $this->where[] = " WHERE `$field` $compare $value";
        }
        return $this;
    }

    /** group by */
    public function groupBy($column)
    {
        $this->groupBy = " GROUP BY `$column`";
        return $this;
    }

    /** having */
    public function having($field, $compare, $value)
    {
        $this->having = " HAVING `$field` $compare '$value'";
        return $this;
    }

    /** orderBy */
    public function orderBy($column, $type = 'DESC')
    {
        $this->orderBy = " ORDER BY `$column` $type";
        return $this;
    }

    /** limit */
    public function limit($number, $offset = 0)
    {
        $this->limit = " LIMIT $offset, $number";
        return $this;
    }

    /** Get */
    public function get()
    {
        $sqlQuery = "SELECT $this->selectColumn FROM $this->tableName";

        if (!empty($this->joins)) {
            $sqlQuery .= implode(' ', $this->joins);
        }

        if (!empty($this->where)) {
            $sqlQuery .= implode(' ', $this->where);
        }
        // dd($sqlQuery);
        $sqlQuery .= $this->groupBy;
        $sqlQuery .= $this->having;
        $sqlQuery .= $this->orderBy;
        $sqlQuery .= $this->limit;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();



        $this->resetQuery();
        if (!empty($stmt)) {
            return $stmt->fetchAll((PDO::FETCH_CLASS));
        }

        return false;
    }

    /** Get one */
    public function getOne()
    {
        $sqlQuery = "SELECT $this->selectColumn FROM $this->tableName";

        if (!empty($this->joins)) {
            $sqlQuery .= implode(' ', $this->joins);
        }

        if (!empty($this->where)) {
            $sqlQuery .= implode(' ', $this->where);
        }

        // dd($sqlQuery);

        $sqlQuery .= $this->groupBy;
        $sqlQuery .= $this->having;
        $sqlQuery .= $this->orderBy;
        $sqlQuery .= $this->limit;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $this->resetQuery();
        if (!empty($stmt)) {
            return $stmt->fetch((PDO::FETCH_ASSOC));
        }

        return false;
    }

    /** resetQuery */
    public function resetQuery()
    {
        $this->tableName    = '';
        $this->selectColumn = '';
        $this->joins         = [];
        $this->where        = [];
        $this->groupBy      = '';
        $this->having       = '';
        $this->orderBy      = '';
        $this->limit        = '';
    }

    /** how to use
     * 
     */
}
