<?php

//SectionID	Semester	InstructorName	CourseID

class CourseDAO  {

    //Static DB
    private static $_db;

    //Initialize the CourseDAO
    static function initialize()    {
        //Remember to send in the course name
        self::$_db = new PDOService("Course");
    }

    //Get all the courses
    static function getCourses() {
        //Select *
        $sql = "SELECT * FROM course;";
        //Prepare the Query
        self::$_db->query($sql);
        self::$_db->execute();
        //Return the results
        //Return resultSet
        return self::$_db->resultSet();
    }

    static function updateCourses($name,$sectionID) {
        $sql ="UPDATE Course JOIN Section on Section.CourseID = Course.CourseID
        SET ShortName=:ShortName WHERE SectionID=:SectionID;";
        
        self::$_db->query($sql);
        self::$_db->bind(":ShortName", $name);
        self::$_db->bind(":SectionID",$sectionID);
        self::$_db->execute();
        return self::$_db->rowCount();
    }

}


?>