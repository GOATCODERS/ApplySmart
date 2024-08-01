<?php

class JobDescription {
    private $job_id;
    private $job_title;
    private $company;
    private $location;
    private $type;
    private $about_us;
    private $role_description;
    private $responsibilities;
    private $we_offer;
    private $other;
    private $closing_date;
    private $db;

    
    public function __construct($jobId, $db) {
        $this->jobId = $jobId;
        $this->db = $db;
        $this->loadFromDatabase($jobId);
    }

    // Setters
    public function setJobTitle($job_title) {
        $this->job_title = $job_title;
    }
    public function setCompany($company) {
        $this->company = $company;
    }
    public function setLocation($location) {
        $this->location = $location;
    }
    public function setType($type) {
        $this->type = $type;
    }
    public function setAboutUs($about_us) {
        $this->about_us = $about_us;
    }
    public function setRoleDescription($role_description) {
        $this->role_description = $role_description;
    }
    public function setResponsibilities($responsibilities) {
        $this->responsibilities = $responsibilities;
    }
    public function setWeOffer($we_offer) {
        $this->we_offer = $we_offer;
    }
    public function setOther($other) {
        $this->other = $other;
    }
    public function setClosingDate($closing_date) {
        $this->closing_date = $closing_date;
    }

    // Getters
    public function getJobId() {
        return $this->job_id;
    }
    public function getJobTitle() {
        return $this->job_title;
    }
    public function getCompany() {
        return $this->company;
    }
    public function getLocation() {
        return $this->location;
    }
    public function getType() {
        return $this->type;
    }
    public function getAboutUs() {
        return $this->about_us;
    }
    public function getRoleDescription() {
        return $this->role_description;
    }
    public function getResponsibilities() {
        return $this->responsibilities;
    }
    public function getWeOffer() {
        return $this->we_offer;
    }
    public function getOther() {
        return $this->other;
    }
    public function getClosingDate() {
        return $this->closing_date;
    }

    // Create job description in the database
    public function createJobDescription() {
        try {
            $sql = "INSERT INTO job_description (Job_Title, Company, Location, Type, About_us, Role_Description, Responsibilities, We_Offer, Other, Closing_date) 
                    VALUES (:job_title, :company, :location, :type, :about_us, :role_description, :responsibilities, :we_offer, :other, :closing_date)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':job_title', $this->job_title);
            $stmt->bindParam(':company', $this->company);
            $stmt->bindParam(':location', $this->location);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':about_us', $this->about_us);
            $stmt->bindParam(':role_description', $this->role_description);
            $stmt->bindParam(':responsibilities', $this->responsibilities);
            $stmt->bindParam(':we_offer', $this->we_offer);
            $stmt->bindParam(':other', $this->other);
            $stmt->bindParam(':closing_date', $this->closing_date);

            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage(), 3, 'C:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred. Please try again later.';
        }
    }

    // Retrieve job description by job_id
    public static function getJobDescription($job_id, $db) {
        try {
            $sql = "SELECT * FROM job_description WHERE Job_id = :job_id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':job_id', $job_id);
            $stmt->execute();
            $jobDescription = $stmt->fetch(PDO::FETCH_ASSOC);
            return $jobDescription ? $jobDescription : null;
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage(), 3, '/var/log/app_errors.log');
            echo 'An error occurred while retrieving job description. Please try again later.';
            return null;
        }
    }

    // Update job description
    public function updateJobDescription() {
        try {
            $sql = "UPDATE job_description SET 
                    Job_Title = :job_title, 
                    Company = :company, 
                    Location = :location, 
                    Type = :type, 
                    About_us = :about_us, 
                    Role_Description = :role_description, 
                    Responsibilities = :responsibilities, 
                    We_Offer = :we_offer, 
                    Other = :other, 
                    Closing_date = :closing_date
                    WHERE Job_id = :job_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':job_id', $this->job_id);
            $stmt->bindParam(':job_title', $this->job_title);
            $stmt->bindParam(':company', $this->company);
            $stmt->bindParam(':location', $this->location);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':about_us', $this->about_us);
            $stmt->bindParam(':role_description', $this->role_description);
            $stmt->bindParam(':responsibilities', $this->responsibilities);
            $stmt->bindParam(':we_offer', $this->we_offer);
            $stmt->bindParam(':other', $this->other);
            $stmt->bindParam(':closing_date', $this->closing_date);

            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage(), 3, 'C:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred. Please try again later.';
        }
    }

    // Delete job description
    public function deleteJobDescription() {
        try {
            $sql = "DELETE FROM job_description WHERE Job_id = :job_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':job_id', $this->job_id);

            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error: ' . $e->getMessage(), 3, 'C:\\xampp\\htdocs\\ApplySmart\\var\\log\\app_errors.log');
            echo 'An error occurred. Please try again later.';
        }
    }

    // Load job description data into the current instance
    public function loadFromDatabase($job_id) {
        $jobDescription = self::getJobDescription($job_id, $this->db);

        if ($jobDescription) {
            $this->job_id = $jobDescription['Job_id'];
            $this->job_title = $jobDescription['Job_Title'];
            $this->company = $jobDescription['Company'];
            $this->location = $jobDescription['Location'];
            $this->type = $jobDescription['Type'];
            $this->about_us = $jobDescription['About_us'];
            $this->role_description = $jobDescription['Role_Description'];
            $this->responsibilities = $jobDescription['Responsibilities'];
            $this->we_offer = $jobDescription['We_Offer'];
            $this->other = $jobDescription['Other'];
            $this->closing_date = $jobDescription['Closing_date'];
        } else {
            echo 'Job description not found.';
        }
    }
}
?>
