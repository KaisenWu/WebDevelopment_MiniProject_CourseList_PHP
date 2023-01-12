<?php

// +----------------+------------+------+-----+---------+----------------+
// | Field          | Type       | Null | Key | Default | Extra          |
// +----------------+------------+------+-----+---------+----------------+
// | SectionID      | int        | NO   | PRI | NULL    | auto_increment |
// | Semester       | varchar(3) | YES  |     | NULL    |                |
// | InstructorName | tinytext   | YES  |     | NULL    |                |
// | CourseID       | int        | NO   | MUL | NULL    |                |
// +----------------+------------+------+-----+---------+----------------+
// 4 rows in set (0.008 sec)

class Section {

//SectionID	Semester	InstructorName	CourseID

    //Attributes, make sure they match the column names!
    private $SectionID;
    private $Semester;
    private $InstructorName;
    private $CourseID;

    //Cant use a constructor! Why!?

    //Setters
    public function setSectionID($nSectionID) {$this->SectionID = $nSectionID;}
    public function setSemester($nSemester) {$this->Semester = $nSemester;}
    public function setInstructorName($nInstructorName) {$this->InstructorName = $nInstructorName;}
    public function setCourseID($nCourseID) {$this->CourseID = $nCourseID;}

    //Getters
    public function getSectionID() {return $this->SectionID;}
    public function getSemester() {return $this->Semester;}
    public function getInstructorName() {return $this->InstructorName;}
    public function getCourseID() {return $this->CourseID;}
}