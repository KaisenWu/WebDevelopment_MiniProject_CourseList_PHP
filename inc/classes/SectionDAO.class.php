<?php

//SectionID	Semester	InstructorName	CourseID

class SectionDAO  {

    //Hold the $_db in a variable.
    private static $_db;

    static function initialize()    {
      //Create the PDOService instance locally, be sure to specify the class.
      self::$_db = new PDOService("Section");
    }

    static function createSection(Section $newSection) {
        //Create means INSERT        
        //QUERY
        $sql = "INSERT INTO section(Semester, InstructorName, CourseID)
        VALUES(:Semester, :InstructorName, :CourseID);";
        self::$_db->query($sql);
        //BIND 
        self::$_db->bind(":Semester",$newSection->getSemester());
        self::$_db->bind(":InstructorName",$newSection->getInstructorName());
        self::$_db->bind(":CourseID",$newSection->getCourseID());
        //EXECUTE
        self::$_db->execute();
        //RETURN
        return self::$_db->lastInsertedId();
    }
    
    static function getSection(int $sectionId)  {
        //Get means get one
        $sql = "SELECT * FROM section WHERE SectionID = :SectionId;";
        //QUERY
        self::$_db->query($sql);
        //BIND
        self::$_db->bind(":SectionId", $sectionId);
        //EXECUTE
        self::$_db->execute();
        //RETURN
        return self::$_db->singleResult();
    }

    static function getSections() {
        //No parameters so no bind 
        //Prepare the Query
        $sql="SELECT * FROM section;";
        self::$_db->query($sql);
        //execute the query
        self::$_db->execute();
        //Return results
        return self::$_db->resultSet();
    }
    
    static function updateSection (Section $sectionToUpdate) {
        //update means UPDATE query
        $sql = "UPDATE section SET Semester=:Semester, InstructorName=:InstructorName 
                WHERE SectionID=:SectionID;";            
        //QUERY
        self::$_db->query($sql); 
        //BIND 
        self::$_db->bind(":Semester", $sectionToUpdate->getSemester());
        self::$_db->bind(":InstructorName", $sectionToUpdate->getInstructorName());
        self::$_db->bind(":SectionID", $sectionToUpdate->getSectionID());
        //EXECUTE 
        self::$_db->execute();
        //RETURN THE RESULTS
        return self::$_db->rowCount(); 
    }
    
    static function deleteSection(int $sectionId) {
        $sql = "DELETE FROM section WHERE SectionID = :SectionId";
        self::$_db->query($sql);
        self::$_db->bind(":SectionId",$sectionId);
        self::$_db->execute();
        return self::$_db->rowCount();
    }

    //We have a little hack with a joing to get the sections list 
    //with the appropriate course name instead of CourseID :)
    static function getSectionsList() {
        $sql = "SELECT SectionID, Semester, InstructorName, ShortName
                FROM Section, Course
                WHERE Section.CourseID = Course.CourseID;";
        //Prepare the Query
        self::$_db->query($sql);
        //Execute the query
        self::$_db->execute();
        //Return the results
        //Return row
        return self::$_db->resultSet();       
    }

}


?>