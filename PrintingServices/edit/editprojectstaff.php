<?php
// Include necessary files for database configuration and data handling
require_once '../core/dbconfig.php'; // Database connection
require_once '../core/datamodel.php'; // Data model functions
require_once '../core/handleform.php';

// Get the project ID from the query string
$project_id = isset($_GET['ProjectID']) ? intval($_GET['ProjectID']) : 0;

// Fetch the project details for the given project ID
$project = null;
if ($project_id) {
    $sql = "SELECT * FROM projects WHERE ProjectID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$project_id]);
    $project = $stmt->fetch();
}

if (!$project) {
    die("Project not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link rel="stylesheet" href="../editprojectstyle.css">
</head>
<body>
    <h1>Edit Project for Staff</h1>

    <form action="../core/handleform.php?ProjectID=<?php echo htmlspecialchars($project_id); ?>" method="POST">
        <label for="ProjectSpecification">Project Specification:</label>
        <textarea name="ProjectSpecification" required><?php echo htmlspecialchars($project['ProjectSpecification']); ?></textarea>

        <label for="PriorityLevel">Priority Level:</label>
        <input type="text" name="PriorityLevel" value="<?php echo htmlspecialchars($project['PriorityLevel']); ?>" required>

        <label for="Status">Status:</label>
        <input type="text" name="Status" value="<?php echo htmlspecialchars($project['Status']); ?>" required>

        <label for="DueDate">Due Date:</label>
        <input type="date" name="DueDate" value="<?php echo htmlspecialchars($project['DueDate']); ?>" required>

        <label for="RemainingDays">Remaining Days:</label>
        <input type="number" name="RemainingDays" value="<?php echo htmlspecialchars($project['RemainingDays']); ?>" required>

        <label for="Remarks">Remarks:</label>
        <textarea name="Remarks"><?php echo htmlspecialchars($project['Remarks']); ?></textarea>

        <button type="submit" name="updateProjectBtnstaff">Update Project</button>
    </form>
</body>
</html>