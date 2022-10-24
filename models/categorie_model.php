<?php
class categorie_model extends main_model
{
    public function getRecord($id = null, $fields = '*', $options = null)
    {
        $conditions = '';
        if (isset($options['conditions'])) {
            $conditions .= ' and ' . $options['conditions'];
        }
        if ($id == null) {
            $id = $this->con->insert_id;
        }
        $query = "SELECT $fields FROM `categories` as p LEFT JOIN `products` as c ON p.id=c.categorie_id where p.id='$id'" . $conditions ;
        $result = mysqli_query($this->con, $query);
        if ($result) {
            //$record = mysqli_fetch_array($result);
            //$record = mysqli_fetch_row($result);
            $record = mysqli_fetch_assoc($result);
        } else {
            $record = false;
        }
        return $record;
    }
    public function delRecord($id = null, $conditions = null)
    {
        // if ($conditions) {
        //     $conditions = ' and ' . $conditions;
        // }
        // $query = " DELETE FROM `products` WHERE categorie_id='$id' ;" . "DELETE FROM `$this->table` WHERE id='$id'" . $conditions . ";";
        $query = "DELETE FROM `$this->table` WHERE " . $conditions;
        echo $query;
        return mysqli_query($this->con, $query);
    }
    public function addRecord($datas)
    {
        $fields = $values = $fields2 = $values2 = '';
        $i = 0;
        $j = 0;
        foreach ($datas as $k => $v) {
            if ($k == 'name' || $k == 'path') {
                if ($j) {
                    $fields .= ',';
                    $values .= ',';
                }
                $fields .= $k;
                $values .= "'" . $v . "'";
                $j++;
            } else {
                if ($i) {
                    $fields2 .= ',';
                    $values2 .= ',';
                }
                $fields2 .= $k;
                $values2 .= "'" . $v . "'";
                $i++;
            }
        }
        $query = "INSERT INTO categories ($fields) VALUES ($values)";
        mysqli_query($this->con, $query);
        $last_id = $this->con->insert_id;
        $query1 = "UPDATE $this->table SET `path`='" . $datas['path'] . "." . $last_id . "'WHERE id='$last_id'";
        mysqli_query($this->con, $query1);
        // $query2 = "INSERT INTO products (categorie_id$fields2) VALUES ($last_id$values2)";
        // echo $query2;
        // mysqli_query($this->con, $query2);
        $query3 = "SELECT * FROM $this->table where id='$last_id'";
        return $this->getrecord($last_id);
    }

    public function moveRecord($id)
    {
        $query = "UPDATE $this->table SET path='" . $id['parent'] . $id['id'] . "' WHERE id=" . $id['id'] . ";";
        if (isset($id['children'])) {
            foreach ($id['children'] as $v) {
                $query .= "UPDATE $this->table SET path='" . $id['parent'] . $v['0'] . "' WHERE id=" . $v['1'] . ";";
            }
        }
        return mysqli_multi_query($this->con, $query);
    }

    public function editRecord($id, $datas)
    {
        $setDatas = '';
        $i = 0;
        $setDatas1 = '';
        $j = 0;
        foreach ($datas as $k => $v) {
            if ($k == 'name' || $k == 'path') {
                if ($j) {
                    $setDatas1 .= ',';
                }
                $setDatas1 .= $k . "='" . $v . "'";
                $j++;
            }
            if (gettype($id) == 'double') {
                $setDatas .= ',';
            }

            $setDatas .= $k . "='" . $v . "'";
            $i++;
        }
        if ($id == 'NaN') {
            $query1 = 'SELECT max(id) as `id` FROM ' . $this->table . ";";
            $id = mysqli_fetch_assoc(mysqli_query($this->con, $query1));
        }
        $results = (gettype($id) == 'array') ? $id['id'] : $id;
        $query = "UPDATE $this->table SET $setDatas1 WHERE id='" . $results . "';UPDATE products SET $setDatas WHERE categorie_id='" . $results . "';";

        //$result = mysqli_query($this->con,$query) or die("MySQL error: " . mysqli_error($this->con) . "<hr>\nQuery: $query");
        return mysqli_multi_query($this->con, $query);
    }
    //protected $table = 'students';
    /*
protected function __construct() {
parent::__construct();

}
 */
}
