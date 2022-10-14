<?php
require_once "Database.php";

class User extends Database{
    protected $tableName = "usertable";
    
    //function to add users
    
    public function add($data){
        if(!empty($data)){
            $fileds=$placholders=[];
            foreach($data as $field =>$value){
                $fileds[]=$field;
                $placholders[]= ":{$field}";
            }
        }
        
        // $sql ="INSERT INTO {$this->tableName} (pname, email, phone) VALUES (:pname, :email, :phone);"
        $sql ="INSERT INTO {$this->tableName} (". implode(',',$fileds).") VALUES (". implode(',',$placholders).")";
        
        $stmt=$this->conn->prepare($sql);
        try{
            $this->conn->beginTransaction();
            $stmt->execute($data);
            $lastInsertedId=$this->conn->lastInsertId();
            $this->conn->commit();
            return $lastInsertedId;
            
        }catch(PDOException $e){
            echo "Error:".$e->getMessage();
            $this->conn->rollback();
        }
    }
    
    //function to get rows
    
    public function getRows($start=0,$limit=4){
        $sql="SELECT * FROM {$this->tableName} ORDER BY id DESC LIMIT {$start},{$limit}";
            $stmt=$this->conn->prepare($sql);
            $stmt->execute();
            if($stmt->rowCount()>0){
                $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $results=[];
            }
        return $results;
    }
    
    
    //function to get single row
    
    public function getRow($field, $value){
        $sql="SELECT * FROM {$this->tableName} WHERE {$field}=:{$field}";
        
         $stmt=$this->conn->prepare($sql);
            $stmt->execute([":{$field}" => $value]);
            if($stmt->rowCount() > 0){
                $result=$stmt->fetch(PDO::FETCH_ASSOC);
            }else{
                $result=[];
            }
        return $result;
    }
    
    
    //function to count number of rows
    
    public function getCount(){
        $sql="SELECT count(*) as pcount FROM {$this->tableName}";
        
         $stmt=$this->conn->prepare($sql);
         $stmt->execute();  
         $result=$stmt->fetch(PDO::FETCH_ASSOC);
           
         return $result['pcount'];
    }
    
    
    //function to upload photo
    
    public function uploadPhoto($file){
        if(!empty($file)){
            $fileTempPath= $file['tmp_name'];
            $fileName= $file['name'];
            $fileSize= $file['size'];
            $fileType= $file['type'];
            //$fileError= $file["error"];

            $fileNameCmps=explode('.',$fileName);
            $fileExtension=strtolower(end($fileNameCmps));
            $newFileName=md5(time().$fileName) . '.' .$fileExtension;
            $allowedExtn=["png", "jpg", "jpeg"];
            
            if(in_array($fileExtension,$allowedExtn)){
                $uploadFileDir=getcwd().'/uploads/';
                $destFilePath=$uploadFileDir . $newFileName;
                if(move_uploaded_file($fileTempPath, $destFilePath)){
                    return $newFileName;
                }
            }
        }
    }
    
    
    //function to update
    public function update($data, $id){
        if(!empty($data)){
            $fields="";
            $x=1;
            $fieldsCount=count($data);
            foreach($data as $field=>$value){
                $fields .="{$field}=:{$field}";
                if($x<$fieldsCount){
                    $fields.=", ";
                }
                $x++;
            }
            
        }
        $sql="UPDATE {$this->tableName} SET {$fields} WHERE id=:id";
        $stmt= $this->conn->prepare($sql);
        try{
            $this->conn->beginTransaction();
            $data['id']=$id;
            $stmt->execute($data);
            $this->conn->commit();
            
        }catch(PDOException $e){
            echo "Error:".$e->getMessage();
            $this->conn->rollback();
    }
    }
    //function to delete
    
    public function deleteRow($id){
        $sql ="DELETE FROM {$this->tableName} WHERE id=:id";
        $stmt= $this->conn->prepare($sql);
        try{
            $stmt->execute([':id' => $id]);
            if($stmt->rowCount() > 0){
                return true;
            }
            
        } catch (PDOException $e){
               echo "Error:".$e->getMessage();
               return false;
    }
    }
    
    //function to search
    public function searchUser($searchText, $start=0, $limit=4){
        $sql="SELECT * FROM {$this->tableName} WHERE name LIKE :search ORDER BY id DESC LIMIT {$start},{$limit}";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute([':search' => "{$searchText}%"]);
        if($stmt->rowCount() > 0){
            $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $results=[];
             }
            return $results;
        }
            
    
    //function to search END
    
    
}


?>