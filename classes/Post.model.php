<?php

class Post{
	
	public $id=null;
	public $pubdate=null;
	public $title=null;
	public $summary=null;
	public $content=null;

	/* Populate Opbject using constructor */

	public function __construct($data = array() ){

		if( isset($data['id']) ){ $this->id = (int) $data['id']; }
		if( isset($data['pubdate']) ){ $this->pbData = (int) $data['pubdate']; }
		if( isset($data['title']) ){ $this->title = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/","",$data['title']); }
		if( isset($data['summary']) ) {$this->summary = preg_replace("/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/","",$data['summary']); }
		if( isset($data['content']) ){$this->content = $data['content']; }
	}

	/* Method to store Values of modified Data */

	public function storeValues($values){
		$this->__construct($values);
		
		if( isset( $values['pubdate']) ){ 
			$pubdate = explode("-",$values['pubdate']); 
			
			if(count($pubdate) == 3){
				list( $y,$m,$d ) = $pubdate;
				$this->pubdate = mktime(0,0,0,$m,$d,$y);
			}
		}
	}
	
	/* Static method to create new project object */
	
	public static function getById($id){
		$connect = new PDO(DB,DB_USERNAME,DB_PASSWORD);
		$sql = "SELECT *, UNIX_TIMESTAMP(pubdate) AS pubdate FROM posts WHERE id=:id";
		$st = $connect->prepare($sql);
		$st->bindValue(":id",$id,PDO::PARAM_INT );
		$st->execute();
		$row = $st->fetch();
		$connect = null;
		if ($row) return new Project($row);
	}
	
	/* Get all Avalible objects */
	
	public static function getList($numRows = 1000,$order="pubdate DESC"){
		$connect = new PDO(DB,DB_USERNAME,DB_PASSWORD);
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM posts ORDER BY ". mysql_escape_string($order) ." LIMIT :numRows";
		$st = $connect->prepare($sql);
		$st->bindValue(":numRows",$numRows,PDO::PARAM_INT);
		$st->execute();
		$list = array();

		while ($row = $st->fetch()){
			$item = new Project($row);
			$list[] = $item;
			}
		
		$sql = "SELECT FOUND_ROWS() AS totalRows";
		$totalRows = $connect->query($sql)->fetch();
		$connect = null;
		return array("results"=>$list,"totalRows"=>$totalRows);
				
	}
	
	/* Insert current object into SQL */
	
	public function insert(){
		
		/* Check if the project Id is set (Fail if so) */
		if(!is_null($this->id) ) trigger_error("Project::Insert tried to insert a new Project with a current ID set");
		
		/* Insert the project */
		$connect = new PDO(DB,DB_USERNAME,DB_PASSWORD);
		$sql = "INSERT INTO projects (pubdata,title,summary,content) VALUES (FROM_UNIXTIME(:pubdate),:title,:summary,:content)";
		
		$st = $connect->prepare($sql);
		$st->bindValue(":pubdate",$this->pubdate,PDO::PARAM_INT);
		$st->bindValue(":title",$this->title,PDO::PARAM_STR);
		$st->bindValue(":summary",$this->summary,PDO::PARAM_STR);
		$st->bindValue(":content",$this->content,PDO::PARAM_STR);
		$st->execute();
		
		$connect = null;
	}
	
	/* Update an Existing Project */
	
	public function update(){
		
		/* Check if the project ID is set*/
		if( is_null($this->id)) trigger_error("Project::update Tried to update a project that does not exist.");
		
		$connect = new PDO(DB,DB_USERNAME,DB_PASSWORD);
		$sql = "UPDATE project SET pubdate = FROM_UNIXTIME(:pubdate), title=:title, summary=:summary, content=:content WHERE id=:id";
		
		$st = $connect->prepare($sql);
		$st->bindValue(":pubdate",$this->pubdate,PDO::PARAM_INT);
		$st->bindValue(":title",$this->title,PDO::PARAM_STR);
		$st->bindValue(":summary",$this->summary,PDO::PARAM_STR);
		$st->bindValue(":content",$this->content,PDO::PARAM_STR);
		$st->bindValue(":id",$this->id,PDO::PARAM_INT);
		$st->execute();
		
		$connect = null;

	}
	
	public function delete(){
		/* Check if the project Id is set (Fail if so) */
		if(is_null($this->id) ) trigger_error("Project::delete tried to delete a project that does not exist");
		
		$connect = new PDO(DB,DB_USERNAME,DB_PASSWORD);
		$sql = "DELETE FROM projects WHERE id=:id";
		$st = $connect->prepare($sql);
		$st->bindValue(":id",$this->id,PDO::PARAM_INT);
		$st->execute();
		$connect = null;
		
	}

}
