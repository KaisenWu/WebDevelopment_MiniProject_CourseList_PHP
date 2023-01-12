<?php

//Require config for database
require_once("inc/config.inc.php");

//Require Section and Course Class
require_once("inc/classes/Section.class.php");
require_once("inc/classes/Course.class.php");

//Require all the utility classes, Page, PDOService, Section and CourseDAO
require_once("inc/classes/SectionDAO.class.php");
require_once("inc/classes/CourseDAO.class.php");
require_once("inc/classes/PDOService.class.php");
require_once("inc/classes/Page.class.php");

//Initialize the DAO(s)
SectionDAO::initialize();
CourseDAO::initialize();


//If there was post data from an edit form then process it
if (!empty($_POST)) {
    //If there was an edit action....
    if ($_POST["action"] == "edit") {
        //Assemble the Section to update
        $eSection = new Section();
        $eSection->setSemester($_POST["semester"]);
        $eSection->setInstructorName($_POST["instructor"]);
        $eSection->setSectionID($_POST["sectionid"]);
        $eCourseShortName = $_POST["courseid"];
        //Send the section to the DAO to be updated
        SectionDAO::updateSection($eSection);
        CourseDAO::updateCourses($eCourseShortName,$_POST["sectionid"]);
        //Otherwise there must be create form adata
        $cSection->setSemester($_POST["semester"]);
        $cSection->setInstructorName($_POST["instructor"]);
    } else if ($_POST["action"] == "create")    {
        //Assemble the Section to Insert
        $cSection = new Section();
        $cSection->setCourseID($_POST["courseid"]);    
        //Send the section to the DAO for insertion
        //Send the section to the DAO to be created
        SectionDAO::createSection($cSection);
    }
}

//If there was a delete that came in via GET
if (isset($_GET["action"]) && $_GET["action"] == "delete")  {
    //Call the DAO and delete the respecitve Section
    SectionDAO::deleteSection(intval($_GET["id"]));
}

Page::$_title = "Course List with MySQL by Kaisen";
Page::header();
//List all the sections
Page::listSections(SectionDAO::getSectionsList());

//If someone clicked Edit
if (isset($_GET["action"]) && $_GET["action"] == "edit")  {
    //Pull the section to Edit from the DAO
    $sectionToEdit = SectionDAO::getSection($_GET["id"]);
    //Render the  Edit Section form with the section to edit and  alist of the courses.
    //Otherwise just show the create form
    Page::editSectionForm($sectionToEdit,CourseDAO::getCourses());
} else {
    //Call the create Section form, pass in a list of current courses for the drop down.
    Page::createSectionForm(CourseDAO::getCourses());
}
Page::footer();
