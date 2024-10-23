<?php 
require_once 'dbconfig.php'; 
require_once 'datamodel.php'; 


// Handle client insertion
if (isset($_POST['insertClientBtn'])) {
    $query = insertClient($pdo, $_POST['ClientName'], $_POST['Email'], $_POST['PhoneNumber'], 
        $_POST['Address'], $_POST['City'], $_POST['ZipCode']);

    if ($query) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Insertion failed";
    }
}

// Client Editing handle form
if (isset($_POST['editClientBtn'])) {
    // Ensure ClientID is passed
    if (isset($_POST['ClientID'])) {
        $clientID = $_POST['ClientID'];
        $clientName = $_POST['ClientName'];
        $email = $_POST['Email'];
        $phoneNumber = $_POST['PhoneNumber'];
        $address = $_POST['Address'];
        $city = $_POST['City'];
        $zipcode = $_POST['ZipCode'];

        // Call the updateClient function
        $query = updateClient($pdo, $clientID, $clientName, $email, $phoneNumber, $address, $city, $zipcode);

        if ($query) {
            header("Location: ../index.php?message=Client+Edited+successfully"); // Redirect to the client list or another page
            exit(); // Always exit after a redirect
        } else {
            echo "Edit failed"; // Optionally, handle the error
        }
    } else {
        echo "Client ID is missing.";
    }
}


// Client deleting handle form
if (isset($_POST['deleteClientBtn']) && isset($_GET['ClientID'])) {
    $clientID = $_GET['ClientID'];

    // Call delete function
    $query = deleteClient($pdo, $clientID);

    if ($query) {
        header("Location: ../index.php?message=Client+deleted+successfully");
        exit();
    } else {
        echo "Deletion failed";
    }
}





// Handle staff insertion
if (isset($_POST['insertStaffBtn'])) {
    $query = insertStaff($pdo, $_POST['staffFirstName'], $_POST['staffLastName'], $_POST['staffEmail'], 
        $_POST['staffPhone'], $_POST['staffPosition']);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Insertion failed";
    }
}

// Handle staff editing
if (isset($_POST['editStaffBtn'])) {
    // Ensure staffID is passed
    if (isset($_POST['StaffID'])) {
        $staffID = $_POST['StaffID'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $position = $_POST['position'];

        // Call the updateStaff function
        $query = updateStaff($pdo, $staffID, $firstName, $lastName, $email, $phoneNumber, $position);

        if ($query) {
            header("Location: ../index.php?message=Staff+edited+successfully");
            exit();
        } else {
            echo "Edit failed"; // Optionally, handle the error
        }
    } else {
        echo "Staff ID is missing.";
    }
}



// Handle staff deletion
if (isset($_POST['deleteStaffBtn'])) {
    $query = deleteStaff($pdo, $_GET['StaffID']);

    if ($query) {
        header("Location: ../index.php?message=Staff+deleted+successfully");
        exit();
    } else {
        echo "Deletion failed";
    }
}

// Handle project insertion
if (isset($_POST['insertProjectBtn'])) {
    $query = insertProject($pdo, $_POST['ClientID'], $_POST['StaffID'], $_POST['DateFiled'], 
        $_POST['ProjectSpecification'], $_POST['PriorityLevel'], $_POST['Status'], 
        $_POST['DueDate'], $_POST['RemainingDays'], $_POST['Remarks']);

    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Insertion failed";
    }
}


// Handle project update project client
if (isset($_POST['updateProjectBtn'])) {
    // Get the project ID from the URL
    $project_id = isset($_GET['ProjectID']) ? intval($_GET['ProjectID']) : 0;

    // Validate project ID
    if ($project_id <= 0) {
        die("Invalid project ID.");
    }

    // Retrieve form data
    $project_specification = $_POST['ProjectSpecification'];
    $priority_level = $_POST['PriorityLevel'];
    $status = $_POST['Status'];
    $due_date = $_POST['DueDate'];
    $remaining_days = $_POST['RemainingDays'];
    $remarks = $_POST['Remarks'];

    // Prepare the update statement
    $sql = "UPDATE projects SET 
                ProjectSpecification = ?, 
                PriorityLevel = ?, 
                Status = ?, 
                DueDate = ?, 
                RemainingDays = ?, 
                Remarks = ?
            WHERE ProjectID = ?";

    // Execute the statement
    $stmt = $pdo->prepare($sql);
    $updated = $stmt->execute([
        $project_specification,
        $priority_level,
        $status,
        $due_date,
        $remaining_days,
        $remarks,
        $project_id
    ]);

    // Check if the update was successful
    if ($updated) {
        header("Location: ../viewproject/viewprojectclient.php");
        exit;
    } else {
        echo "Failed to update the project.";
    }
}

// Handle project update project staff
if (isset($_POST['updateProjectBtnstaff'])) {
    // Get the project ID from the URL
    $project_id = isset($_GET['ProjectID']) ? intval($_GET['ProjectID']) : 0;

    // Validate project ID
    if ($project_id <= 0) {
        die("Invalid project ID.");
    }

    // Retrieve form data
    $project_specification = $_POST['ProjectSpecification'];
    $priority_level = $_POST['PriorityLevel'];
    $status = $_POST['Status'];
    $due_date = $_POST['DueDate'];
    $remaining_days = $_POST['RemainingDays'];
    $remarks = $_POST['Remarks'];

    // Prepare the update statement
    $sql = "UPDATE projects SET 
                ProjectSpecification = ?, 
                PriorityLevel = ?, 
                Status = ?, 
                DueDate = ?, 
                RemainingDays = ?, 
                Remarks = ?
            WHERE ProjectID = ?";

    // Execute the statement
    $stmt = $pdo->prepare($sql);
    $updated = $stmt->execute([
        $project_specification,
        $priority_level,
        $status,
        $due_date,
        $remaining_days,
        $remarks,
        $project_id
    ]);

    // Check if the update was successful
    if ($updated) {
        header("Location: ../viewproject/viewprojectclient.php");
        exit;
    } else {
        echo "Failed to update the project.";
    }
}


// Handle project deletion
if (isset($_POST['deleteProjectBtn']) && isset($_GET['ProjectID'])) {
    $project_id = intval($_GET['ProjectID']); // Ensure it's a valid integer
    
    if ($project_id > 0) {
        $query = deleteProject($pdo, $project_id);

        if ($query) {
            header("Location: ../viewproject/viewprojectclient.php");
            exit;
        } else {
            echo "Deletion failed";
        }
    } else {
        echo "Invalid project ID.";
    }
} 

// Fetch all clients and staff for display
$clients = getAllClients($pdo);
$staff = getAllStaff($pdo);

?>
