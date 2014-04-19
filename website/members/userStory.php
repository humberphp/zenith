<?php


class userStory{
        
    public function getAllStories(){    
        $conn = Database::getDB(); 
        $query = 'SELECT * FROM tbl_successstories';
        $statement = $conn -> prepare($query);
        $statement -> execute();
        $allstories = $statement -> fetchAll();
        
        return $allstories;
    }

    public function getStoryDetails($StoryId){
    	$conn = Database::getDB();
    	$query = 'SELECT * FROM tbl_successstories WHERE
    	successStoryId = :StoryId';
    	$statement = $conn -> prepare($query);
    	$statement -> bindValue(':StoryId',$StoryId);
    	$statement -> execute();
    	$result = $statement -> fetch();

    	return $result;
    }

    public function subStory($message, $submitDate, $image, $storyTitle){
    	$conn = Database::getDB();
    	$query = 'INSERT INTO tbl_successstories
    	(message, submitDate, imageName, storyTitle) VALUES 
    	( :message, :subdate, :images, :title)';
    	$statement = $conn->prepare($query);
    	//$statement -> bindValue(':StoryId',$StoryId);
    	$statement->bindValue(':message',$message);
    	$statement->bindValue(':subdate',$submitDate);
    	$statement->bindValue(':images',$image);
    	$statement->bindValue(':title',$storyTitle);
    	$row = $statement->execute();
        
        return $row;
    }

    public function approveStories($StoryId,$decision){
    	$conn = Database::getDB();
    	$query = 'UPDATE tbl_successstories SET isApproved = :decision
    	WHERE successStoryId =:storry';
        $statement = $conn -> prepare($query);
        $statement -> bindValue(':storry',$StoryId);
    	$statement -> bindValue(':decision',$decision);
    	$return = $statement -> execute();

        return $return;
    }

    public function getApprovedStories(){
    	$conn = Database::getDB();
    	$query = 'SELECT * FROM tbl_successstories WHERE isApproved = 1 LIMIT 2';
    	$statement = $conn -> query($query);
    	$result = $statement;

    	return $result;
    }

    public function getStoryById($storryID){
        $conn = Database::getDB();
        $query = 'SELECT imageName,message FROM tbl_successstories WHERE successStoryId = $storryID';
        $statement = $conn -> query($query);
        $result = $statement;

        return $result;
    }

    public function updateApprovedstories($StoryId,$storyTitle,$message) {
    	$conn = Database::getDB();
    	$query = 'UPDATE tbl_successstories SET message = :message, storyTitle = :title
    	WHERE successStoryId =:StoryId';
        $statement = $conn -> prepare($query);
        $statement -> bindValue(':message',$message);
    	$statement -> bindValue(':title',$storyTitle);
    	$statement -> execute();
    }
}
?>    