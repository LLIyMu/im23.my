<?php
	
namespace core\base\model;

use core\base\exceptions\DbException;

abstract class BaseModel
{
	
	use BaseModelMethods;
	
	protected $db;
	
	protected function connect(){

        mysqli_report(MYSQLI_REPORT_OFF);

		$this->db = @new \mysqli(HOST, USER, PASS, DB_NAME);
		
		if($this->db->connect_error){
			
			throw new DbException('Ошибка подключения к базе данных: ' .
			$this->db->connect_errno . ' ' . $this->db->connect_error);
			
		}
		
		$this->db->query("SET NAMES UTF8");
	
	}
	
	/**
	 * @param $query
	 * @param $crud $crud = r - SELECT / c - INSERT / u - UPDATE / d - DELETE
	 * @param $return_id
	 * @return array|bool
	 * @throws DbException
	 */
	
	final public function query($query, $crud = 'r', $return_id = false){
	
		$result = $this->db->query($query);
		
		if($this->db->affected_rows === -1){
			throw new DbException('Ошибка в SQL запросе '
			                      . $query . ' - ' . $this->db->errno . ' ' . $this->db->error);
		}
		
		switch($crud){
			
			case 'r':
				
				if($result->num_rows){
					
					$res = [];
					
					for($i = 0; $i < $result->num_rows; $i++){
						$res[] = $result->fetch_assoc();
					}
					return $res;
					
				}
				
				return false;
				
				break;
			
			case 'c':
				
				if($return_id) return $this->db->insert_id;
				return true;
				break;
				
			default:
				return true;
				break;
				
		}
	
	}
	
	/**
	 * @param $table - таблицы базы данных
	 * @param array $set
	 * 'fields' => ['id', 'name']
	 * 'no_concat' => false/true если true то не присоединять имя таблицы к полям и where
	 * 'where' => ['fio' => 'bakieva', 'name' => 'Natalya', 'surname' => 'Bakieva']
	 * 'operand' => ['=', '<>']
	 * 'condition' => ['AND', 'OR']
	 * 'order' => ['fio', 'name']
	 * 'order_direction' =? ['ASC', 'DESC']
	 * 'limit' => '1'
	 * 'join' [
			'table' => 'join_table',
			'fields' => ['id as j_id', 'name as j_name'],
			'type' => 'left',
			'where' => ['name' => 'alex'],
			'operand' => ['='],
			'condition' => ['OR'],
			'on' => ['id', 'parent_id'],
			'group_condition' => 'AND'
			],
		'join_table2' => [
			'table' => 'join_table2',
			'fields' => ['id as j2_id', 'name as j2_name'],
			'type' => 'left',
			'where' => ['name' => 'alex'],
			'operand' => ['='],
			'condition' => ['AND'],
			'on' => [
				'table' => 'teachers',
				'fields' => ['id', 'parent_id']
			]
	],
	 */
	
	final public function get($table, $set =[]){
	
		$fields = $this->createFields($set, $table);
		$order = $this->createOrder($set, $table);
		$paginationWhere = $where = $this->createWhere($set, $table);
		
		if(!$where) $new_where = true;
			else $new_where = false;
			
		$join_arr = $this->createJoin($set, $table, $new_where);
		
		$fields .= $join_arr['fields'];
		$join = $join_arr['join'];
		$where .= $join_arr['where'];
		
		$fields = rtrim($fields, ',');
		
		
		
		$limit = isset($set['limit']) ? 'LIMIT ' . $set['limit']: '';
		
		$this->createPagination($set, $table, $paginationWhere, $limit);
		
		$query = "SELECT $fields FROM $table $join $where $order $limit";
		
		if(!empty($set['return_query']))
			return $query;
		
		$query = trim($query);
		$res = $this->query($query);

        if (isset($set['join_structure']) && $set['join_structure'] && $res){

            $res = $this->joinStructure($res, $table);

        }

        return $res;

	}
	
	protected function createPagination($set, $table, $where, &$limit){
	
		if(!empty($set['pagination'])){
		
			$this->postNumber = isset($set['pagination']['qty']) ? (int)$set['pagination']['qty'] : QTY;
			
			$this->linksNumber = isset($set['pagination']['qty_links']) ? (int)$set['pagination']['qty_links'] : QTY_LINKS;
			
			$this->page = !is_array($set['pagination']) ? (int)$set['pagination'] : (int)($set['pagination']['page'] ?? 1);
			
			if($this->page > 0 && $this->postNumber > 0){
			
				$this->totalCount = $this->getTotalCount($table, $where);
				
				$this->numberPages = (int)ceil($this->totalCount / $this->postNumber);
				
				$limit = 'LIMIT ' . ($this->page - 1) * $this->postNumber . ',' . $this->postNumber;
			
			}
		
		}
		
	}
	
	/**
	 * @param $table - таблица для вставки данных
	 * @param array $set - массив параметров:
	 *          fields => [поле => значение]; если не указан, то обрабатывается $_POST[поле => значение]
	 *                      разрешена передача например NOW() в качестве Mysql функции обычной строкой
	 *          files => [поле => значение]; можно подать массив вида [поле =>[массив значений]]
	 *          except => ['исключение 1', 'исключение 2'] - исключает данные элементы массива из добавления в запрос
	 *          return_id => true|false - возвращать или нет идентификатор вставленной записи
	 * @return mixed
	 */
	
	final public function add($table, $set = []){
	
		$set['fields'] = (is_array($set) && array_key_exists('fields', $set) && !empty($set['fields'])) ? $set['fields'] : $_POST;
		$set['files'] = (is_array($set) && array_key_exists('files', $set) && !empty($set['files'])) ? $set['files'] : false;
		
		if(!$set['fields'] && !$set['files']) return false;
		
		$set['return_id'] = isset($set['return_id']);
        $set['except'] = (is_array($set) && array_key_exists('except', $set) && !empty($set['except'])) ? $set['except'] : false;
		
		$insert_arr = $this->createInsert($set['fields'], $set['files'], $set['except']);
		
        $query = "INSERT INTO $table {$insert_arr['fields']} VALUES {$insert_arr['values']}";
        return $this->query($query, 'c', $set['return_id']);
	
	}
	
	final public function edit($table, $set = []){

        $set['fields'] = (is_array($set) && array_key_exists('fields', $set) && !empty($set['fields'])) ? $set['fields'] : $_POST;
		$set['files'] = (is_array($set) && array_key_exists('files', $set) && !empty($set['files'])) ? $set['files'] : false;
		
		if(!$set['fields'] && !$set['files']) return false;
		
		$set['except'] = (is_array($set) && array_key_exists('except', $set) && !empty($set['except'])) ? $set['except'] : false;
		
		if(!array_key_exists('all_rows', $set)){
		
			if(array_key_exists('where', $set)){
				$where = $this->createWhere($set);
			}else{
				
				$columns = $this->showColumns($table);
				
				if(!$columns) return false;

				$where ='';

                if(isset($columns['id_row'], $set['fields'][$columns['id_row']])) {
                    $where = 'WHERE ' . $columns['id_row'] . '=' . $set['fields'][$columns['id_row']];
                    unset($set['fields'][$columns['id_row']]);
                }

            }
			
		}
		
		$update = $this->createUpdate($set['fields'], $set['files'], $set['except']);
		
		$query = "UPDATE $table SET $update $where";
		
		return $this->query($query, 'u');
	
	}

    /**
     * @param $table - таблицы базы данных
     * @param array $set
     * 'fields' => ['id', 'name']
     * 'no_concat' => false/true если true то не присоединять имя таблицы к полям и where
     * 'where' => ['fio' => 'bakieva', 'name' => 'Natalya', 'surname' => 'Bakieva']
     * 'operand' => ['=', '<>']
     * 'condition' => ['AND', 'OR']
     * 'join' [
            'table' => 'join_table',
            'fields' => ['id as j_id', 'name as j_name'],
            'type' => 'left',
            'where' => ['name' => 'alex'],
            'operand' => ['='],
            'condition' => ['OR'],
            'on' => ['id', 'parent_id'],
            'group_condition' => 'AND'
            ],
            'join_table2' => [
            'table' => 'join_table2',
            'fields' => ['id as j2_id', 'name as j2_name'],
            'type' => 'left',
            'where' => ['name' => 'alex'],
            'operand' => ['='],
            'condition' => ['AND'],
            'on' => [
            'table' => 'teachers',
            'fields' => ['id', 'parent_id']
            ]
        ],
     */

    public function delete($table, $set = []){

        $table = trim($table);

        $where = $this->createWhere($set, $table);

        $columns = $this->showColumns($table);
        if (!$columns) return false;

        if (is_array($set) && array_key_exists('fields', $set) && !empty($set['fields'])){

            if (isset($columns['id_row'])){

                $key = array_search($columns['id_row'], $set['fields']);

                if ($key !== false) {
                    unset($set['fields'][$key]);
                }

            }

            $fields = [];

            foreach ($set['fields'] as $field){

                $fields[$field] = $columns[$field]['Default'];

            }

            $update = $this->createUpdate($fields, false, false);

            $query = "UPDATE $table SET $update $where";

        }else{

            $join_arr = $this->createJoin($set, $table);

            $join = $join_arr['join'];

            $query = 'DELETE ' . $table . ' FROM ' . $table . ' ' . $join . ' ' . $where;

        }

        return $this->query($query,'u' );

    }
	
	public function buildUnion($table, $set){
	
		if(array_key_exists('fields', $set) && $set['fields'] === null) return $this;
		
		if(!array_key_exists('fields', $set) || empty($set['fields'])){
		
			$set['fields'] = [];
			
			$columns = $this->showColumns($table);
			
			unset($columns['id_row'], $columns['multi_id_row']);
			
			foreach($columns as $row => $item)
				$set['fields'][] = $row;
		}
		
		$this->union[$table] = $set;
		
		$this->union[$table]['return_query'] = true;
		
		return $this;
	
	}
	
	public function test(){
		$a=1;
	}

    public function getUnion($set = []){

        if (!$this->union)
            return false;

        $unionType = ' UNION ' . (!empty($set['type']) ? strtoupper($set['type']) . ' ' : '');

        $maxCount = 0;

        $maxTableCount = '';

        foreach ($this->union as $key => $item){

            $count = count($item['fields']);

            $joinFields = '';

            if (!empty($item['join'])){

                foreach ($item['join'] as $table => $data){

                    if (array_key_exists('fields', $data) && $data['fields']){

                        $count += count($data['fields']);

                        $joinFields = $table;

                    }elseif (!array_key_exists('fields', $data) || (!$joinFields[$data] || $data['fields'] === null)){

                        $columns = $this->showColumns($table);

                        unset($columns['id_row'], $columns['multi_id_row']);

                        $count += count($columns);

                        foreach ($columns as $field => $value)
                            $this->union[$key]['join'][$table]['fields'][] = $field;

                        $joinFields = $table;

                    }

                }

            }else{

                $this->union[$key]['no_concat'] = true;

            }

            if ($count > $maxCount || ($count === $maxCount && $joinFields)){

                $maxCount = $count;

                $maxTableCount = $key;

            }

            $this->union[$key]['lastJoinTable'] = $joinFields;

            $this->union[$key]['countFields'] = $count;

        }

        $query = '';

        if ($maxCount && $maxTableCount){

            $query .= '(' . $this->get($maxTableCount, $this->union[$maxTableCount]) . ')';

            unset($this->union[$maxTableCount]);

        }

        foreach ($this->union as $key => $item){

            if (isset($item['countFields']) && $item['countFields'] < $maxCount){

                for ($i = 0; $i < $maxCount - $item['countFields']; $i++){

                    if ($item['lastJoinTable']){
                        $item['join'][$item['lastJoinTable']]['fields'][] = null;
                    } else{
                        $item['fields'][] = null;
                    }

                }

            }

            $query && $query .= $unionType;

            $query .= '(' . $this->get($key, $item) . ')';

        }

        $order = $this->createOrder($set);

        $limit = !empty($set['limit']) ? 'LIMIT ' . $set['limit'] : '';

        if (method_exists($this, 'createPagination'))
            $this->createPagination($set, "($query)", $limit);

        $query .= " $order $limit";

        $this->union = [];

        return $this->query((trim($query)));

    }
	final public function showColumns($table){

        if (!isset($this->tableRows[$table]) || !$this->tableRows[$table]){

			$checkTable = $this->createTableAlias($table);
			
			if(isset($this->tableRows[$checkTable['table']]) && !empty($this->tableRows[$checkTable['table']])){
			
				return $this->tableRows[$checkTable['alias']] = $this->tableRows[$checkTable['table']];
			
			}
			
            $query = "SHOW COLUMNS FROM {$checkTable['table']}";
            $res = $this->query($query);

            $this->tableRows[$checkTable['table']] = [];

            if($res){
                foreach($res as $row){

                    $this->tableRows[$checkTable['table']][$row['Field']] = $row;

                    if($row['Key'] === 'PRI'){

                        if (!isset($this->tableRows[$checkTable['table']]['id_row'])){

                            $this->tableRows[$checkTable['table']]['id_row'] = $row['Field'];

                        }else{

                            if (!isset($this->tableRows[$checkTable['table']]['multi_id_row'])) $this->tableRows[$checkTable['table']]['multi_id_row'][] = $this->tableRows[$checkTable['table']]['id_row'];

                            $this->tableRows[$checkTable['table']]['multi_id_row'][] = $row['Field'];

                        }

                    }

                }

            }

        }
		
		if(isset($checkTable) && $checkTable['table'] !== $checkTable['alias']){
			
			return $this->tableRows[$checkTable['alias']] = $this->tableRows[$checkTable['table']];
			
		}

		return $this->tableRows[$table];
	}

    final public function showTables(){

        $query = "SHOW TABLES";

        $tables = $this->query($query);

        $table_arr = [];

        if ($tables){

            foreach ($tables as $table){

                $table_arr[] = reset($table);

            }

        }

        return $table_arr;

    }

    public function changeCollation($collation = 'utf8mb4_unicode_ci'){

        foreach ($this->showTables() as $table){

            $columns = $this->showColumns($table);

                foreach ($columns as $field){
                    if(is_array($field) && !empty($field['Collation']) && $field['Collation'] !== $collation){

                        $null = !isset($field['Null']) || strtoupper($field['Null']) === 'YES' ? "NULL" : "NOT NULL";
                        $default = $null !== "NULL" ? '' : 'DEFAULT ' . (!isset($field['Default']) ? "NULL" : (is_string($field['Default']) ? "'" . $field['Default'] . "'" : $field['Default']));

                        $sql = "ALTER TABLE $table
                                    CHANGE {$field['Field']} {$field['Field']} {$field['Type']} CHARACTER SET utf8mb4 
                                        COLLATE $collation $null $default";

                        $this->query($sql, 'u');

                }

            }

        }

    }
	
}