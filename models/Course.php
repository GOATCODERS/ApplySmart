<?php

class Course
{
    private $courseId;
    private $db;

    public function __construct($courseId, $db)
    {
        $this->courseId = $courseId;
        $this->db = $db;
    }

    public function getCourseDetails() {
        try {
            $sql = "SELECT c.course_name, c.description, c.minimum_duration_years, c.closing_date, 
                           c.subject_required, c.admission_point_score, c.possible_further_studies, 
                           c.possible_careers, c.price, f.department_name as faculty_name, 
                           i.institution_name, i.location as institution_location 
                    FROM courses c
                    LEFT JOIN faculty f ON c.faculty_id = f.faculty_id
                    LEFT JOIN institutions i ON c.institution_id = i.institution_id
                    WHERE c.course_id = :course_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':course_id', $this->courseId, PDO::PARAM_INT);
            $stmt->execute();
            
            $course = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $course ? $course : null;
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage() . "\r\n", 3, 'E:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred while retrieving course details. Please try again later.';
            return null;
        }
    }

    public function getCurriculumDetails() {
        try {
            $sql = "SELECT 
                        m.code, 
                        m.name, 
                        m.nqf_level, 
                        m.credits, 
                        m.prerequisite_modules, 
                        cm.curriculum_id, 
                        m.module_id, 
                        c.course_id, 
                        c.year, 
                        c.semester, 
                        c.total_credits
                    FROM 
                        modules m
                    JOIN 
                        curriculum_modules cm ON m.module_id = cm.module_id
                    JOIN 
                        curriculum c ON cm.curriculum_id = c.curriculum_id
                    WHERE 
                        course_id = :course_id;
                    ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':course_id', $this->courseId);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $errorMessage = sprintf(
                "Error: %s in %s on line %d\r\n",
                $e->getMessage(),
                $e->getFile(),
                $e->getLine()
            );
            error_log($errorMessage, 3, 'E:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            return [];
        }
    }
}
?>
