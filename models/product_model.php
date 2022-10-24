<?php
class product_model extends main_model
{
    protected $related = [
        'model' => 'categorie',
        'table' => 'categories',
        'type' => 'belongs_to',
    ];
    public function getAllRecords($fields='*', $options=null) {
		$conditions = '';
		if(isset($options['conditions'])) {
			$conditions .= ' where '.$options['conditions'];
		}
		$query = "SELECT ".$this->table.".".$fields.",categories.name as category FROM ".$this->table.$conditions. " Left JOIN categories ON ".$this->table.".categorie_id = categories.id";
		$result = mysqli_query($this->con,$query);
		return $result;
	}
}