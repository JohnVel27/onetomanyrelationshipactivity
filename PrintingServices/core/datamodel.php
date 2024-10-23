<?php

require_once 'dbconfig.php';

// Insert a new client
function insertClient($pdo, $ClientName, $Email, $PhoneNumber, $Address, $City, $ZipCode) {
    $sql = "INSERT INTO clients (ClientName, Email, PhoneNumber, Address, City, ZipCode) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$ClientName, $Email, $PhoneNumber, $Address, $City, $ZipCode]);

    if ($executeQuery) {
        return true;
    }
}

// Update a client's details
function updateClient($pdo, $client_id, $client_name, $email, $phone_number, $address, $city, $zipcode) {
    $sql = "UPDATE clients 
            SET ClientName = ?, Email = ?, PhoneNumber = ?, Address = ?, City = ?, ZipCode = ?
            WHERE ClientID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$client_name, $email, $phone_number, $address, $city, $zipcode, $client_id]);

    return $executeQuery; // Return true if the update was successful, false otherwise
}

// Delete a client
function deleteClient($pdo, $ClientID) {
    $sql = "DELETE FROM clients WHERE ClientID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$ClientID]);

    return $executeQuery; // Return true or false based on execution result
}


// Get all clients
function getAllClients($pdo) {
    $sql = "SELECT * FROM clients";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

// Get a client by ID
function getClientByID($pdo, $ClientID) {
    $sql = "SELECT * FROM clients WHERE ClientID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ClientID]);

    if ($stmt->rowCount() > 0) { // Check if any rows were returned
        return $stmt->fetch();
    }
    return false; // Return false if no client is found
}


// Insert a new staff member
function insertStaff($pdo, $FirstName, $LastName, $Email, $PhoneNumber, $Position) {
    $sql = "INSERT INTO staff (FirstName, LastName, Email, PhoneNumber, Position) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$FirstName, $LastName, $Email, $PhoneNumber, $Position]);

    if ($executeQuery) {
        return true;
    }
}

// Update a staff member's details
function updateStaff($pdo, $staffID, $firstName, $lastName, $email, $phoneNumber, $position) {
    $sql = "UPDATE staff 
            SET FirstName = ?, LastName = ?, Email = ?, PhoneNumber = ?, Position = ?
            WHERE StaffID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$firstName, $lastName, $email, $phoneNumber, $position, $staffID]);

    return $executeQuery; // Return true or false based on success
}


// Delete a staff member
function deleteStaff($pdo, $staff_id) {
    $sql = "DELETE FROM staff WHERE StaffID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$staff_id]);

    if ($executeQuery) {
        return true;
    }
}

// Get all staff members
function getAllStaff($pdo) {
    $sql = "SELECT * FROM staff";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

// Get a staff member by ID
function getStaffByID($pdo, $StaffID) {
    $sql = "SELECT * FROM staff WHERE StaffID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$StaffID]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

// Insert a new project
function insertProject($pdo, $ClientID, $StaffID, $DateFiled, $ProjectSpecification, $PriorityLevel, $Status, $DueDate, $RemainingDays, $Remarks) {
    $sql = "INSERT INTO projects (ClientID, StaffID, DateFiled, ProjectSpecification, PriorityLevel, Status, DueDate, RemainingDays, Remarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$ClientID, $StaffID, $DateFiled, $ProjectSpecification, $PriorityLevel, $Status, $DueDate, $RemainingDays, $Remarks]);

    if ($executeQuery) {
        return true;
    }
}

// Update a project's details
function updateProject($pdo, $project_id, $client_id, $staff_id, $date_filed, $project_specification, $priority_level, $status, $due_date, $remaining_days, $remarks) {
    $sql = "UPDATE projects 
            SET ClientID = ?, StaffID = ?, DateFiled = ?, ProjectSpecification = ?, PriorityLevel = ?, Status = ?, DueDate = ?, RemainingDays = ?, Remarks = ?
            WHERE ProjectID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$client_id, $staff_id, $date_filed, $project_specification, $priority_level, $status, $due_date, $remaining_days, $remarks, $project_id]);

    if ($executeQuery) {
        return true;
    }
}

// Delete a project function
function deleteProject($pdo, $project_id) {
    $sql = "DELETE FROM projects WHERE ProjectID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$project_id]);

    if ($executeQuery) {
        return true;
    } else {
        return false;
    }
}


// Get all projects
function getAllProjects($pdo) {
    $sql = "SELECT * FROM projects";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute();

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

// Get a project by ID
function getProjectByID($pdo, $ProjectID) {
    $sql = "SELECT * FROM projects WHERE ProjectID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$ProjectID]);

    if ($executeQuery) {
        return $stmt->fetch();
    }
}

// Get all projects for a specific client
function getProjectsByClient($pdo, $ClientID) {
    $sql = "SELECT * FROM projects WHERE ClientID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$ClientID]);

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}

// Get all projects managed by a specific staff member
function getProjectsByStaff($pdo, $StaffID) {
    $sql = "SELECT * FROM projects WHERE StaffID = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$StaffID]);

    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}
?>
