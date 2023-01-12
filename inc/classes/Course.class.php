<?php

// MySQL [registration]> desc course;
// +-----------+----------+------+-----+---------+----------------+
// | Field     | Type     | Null | Key | Default | Extra          |
// +-----------+----------+------+-----+---------+----------------+
// | CourseID  | int      | NO   | PRI | NULL    | auto_increment |
// | ShortName | tinytext | YES  |     | NULL    |                |
// | LongName  | tinytext | YES  |     | NULL    |                |
// +-----------+----------+------+-----+---------+----------------+
// 3 rows in set (0.002 sec)

Class Course    {
    
    //Properties
    private $CourseID;
    private $ShortName;
    private $LongName;


    //Getters (for the lab we only need courseID and ShortName)
    public function getCourseID() {return $this->CourseID;}
    public function getShortName() {return $this->ShortName;}

}

?>