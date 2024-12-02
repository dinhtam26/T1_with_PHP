<?php

namespace Libs;

use PDO;
use PDOException;
use Libs\QueryBuilder;

class Model
{
    use QueryBuilder;

    protected $conn;
    protected $host     = DB_HOST;
    protected $dbname   = DB_DATABASE;
    protected $username = DB_USER;
    protected $password = DB_PASSWORD;
    protected $tablename;
    protected $primaryKey = 'id';
    protected $db;
    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }



    protected function setTable($tableName)
    {
        $this->tablename = $tableName;
    }

    public static function create($dataInsert)
    {

        $model = new static;
        try {
            $data = $model->handleDataInsert($dataInsert);

            $sql = "INSERT INTO $model->tablename (" . $data['cols'] . ") VALUE (" . $data['values'] . ")";
            $stmt = $model->conn->prepare($sql);
            $stmt->execute();
            return $model->lastInsertId();
        } catch (\Throwable $e) {
            echo $sql . "Error: " . $e->getMessage();
        }
    }

    public static function createMany($dataInsert)
    {
        $model = new static;
        try {
            if (!empty($dataInsert)) {
                foreach ($dataInsert as  $value) {
                    $data = $model->handleDataInsert($value);
                    $sql =  "INSERT INTO $model->tablename (" . $data['cols'] . ") VALUE (" . $data['values'] . ")";
                    $stmt = $model->conn->prepare($sql);
                    $stmt->execute();
                }
            }
        } catch (\Throwable $th) {
            echo "Lỗi không thêm được";
        }
    }

    private function handleDataInsert($dataInsert)
    {
        $cols = "";
        $values = "";
        if (!empty($dataInsert)) {
            foreach ($dataInsert as $key => $value) {
                $cols .= ", `$key`";
                $values .= ", '$value'";
            }
            $result['cols'] = substr($cols, 2);
            $result['values'] = substr($values, 2);
        }
        return $result;
    }

    private function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }


    public static function update($dataUpdate, $uniqueColumn)
    {
        $model = new static;
        try {
            $data = $model->handleDataUpdate($dataUpdate);
            $sql = "UPDATE `$model->tablename` SET $data WHERE `$model->primaryKey` =:$model->primaryKey";
            $stmt = $model->conn->prepare($sql);
            $stmt->execute([$model->primaryKey => $uniqueColumn]);
        } catch (\Throwable $e) {
            echo $sql . "Error: " . $e->getMessage();
        }
    }

    private function handleDataUpdate($dataUpdate)
    {
        $result = "";
        if (!empty($dataUpdate)) {
            foreach ($dataUpdate as $key => $value) {
                $result .= ", `$key` =  '$value'";
            }
            $result = substr($result, 2);
        }
        return $result;
    }

    public static function updateOrCreate($dataInsert, $uniqueColumn)
    {
        $model = new static;
        $checkQuery = "SELECT COUNT(`*`) FROM `$model->tablename` WHERE $uniqueColumn = :$uniqueColumn"; // :$uniqueColum được gọi là placeholder trong PDO
        $stmt = $model->conn->prepare($checkQuery);
        $stmt->execute([$uniqueColumn => $dataInsert[$uniqueColumn]]);  // Thực thi sql và gán giá trị cho placeholder
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $model::update($model->tablename, $dataInsert, $uniqueColumn);
        } else {
            $model::create($model->tablename, $dataInsert);
        }
    }

    public static function delete($uniqueColumn)
    {
        $model = new static;
        $sql = " DELETE FROM `$model->tablename` WHERE `$model->primaryKey` = :$model->primaryKey";
        $stmt = $model->conn->prepare($sql);
        return $stmt->execute([$model->primaryKey => $uniqueColumn]);
    }

    // $columns = ['user_catalogue_id' => 1, 'permission' => 2]
    public static function deleteMultiWhere($columns = [])
    {
        $model = new static;
        $sql = " DELETE FROM `$model->tablename` WHERE";
        $where = "";
        foreach ($columns as $key => $value) {
            $where .= " AND `$key` = '$value'";
        }
        $where = substr($where, 4);
        $sql = $sql . $where;

        $stmt = $model->conn->prepare($sql);
        return $stmt->execute();
    }

    public static function all()
    {
        $model = new static;
        $sql = "SELECT * FROM `$model->tablename`";
        $stmt = $model->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll((PDO::FETCH_CLASS));
    }

    public static function find($id, $columns = ['*'])
    {
        $model = new static;
        $column = "";
        foreach ($columns as $key => $value) {
            $column .= ", $value";
        }
        $column = substr($column, 2);
        $sql = "SELECT $column  FROM `$model->tablename` WHERE $model->primaryKey=:$model->primaryKey";
        $stmt  = $model->conn->prepare($sql);
        $stmt->execute([$model->primaryKey => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
