<?php
// Include necessary files for database configuration and data handling
require_once '../core/dbconfig.php'; // Database connection
require_once '../core/datamodel.php'; // Data model functions

// Get the client ID from the query string
$client_id = isset($_GET['ClientID']) ? intval($_GET['ClientID']) : 0;

// Fetch projects for the specific client
$projects = getProjectsByClient($pdo, $client_id);

// Fetch the client's name
$client_name = '';
if ($client_id) {
    $sql = "SELECT ClientName FROM Clients WHERE ClientID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$client_id]);
    $client = $stmt->fetch();
    if ($client) {
        $client_name = $client['ClientName']; // Concatenate FirstName and LastName
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects for Client</title>
    <link rel="stylesheet" href="../viewclientstyle.css"> 
</head>
<body>
    <div class="container">
        <h1>Projects for  <?php echo htmlspecialchars($client_name); ?></h1>

        <?php if (empty($projects)): ?>
            <p>No projects found for this client.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Project ID</th>
                        <th>Project Specification</th>
                        <th>Priority Level</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Remaining Days</th>
                        <th>Remarks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($project['ProjectID']); ?></td>
                            <td><?php echo htmlspecialchars($project['ProjectSpecification']); ?></td>
                            <td><?php echo htmlspecialchars($project['PriorityLevel']); ?></td>
                            <td><?php echo htmlspecialchars($project['Status']); ?></td>
                            <td><?php echo htmlspecialchars($project['DueDate']); ?></td>
                            <td><?php echo htmlspecialchars($project['RemainingDays']); ?></td>
                            <td><?php echo htmlspecialchars($project['Remarks']); ?></td>
                            <td>
                            <form action="../edit/editprojectclient.php?ProjectID=<?php echo htmlspecialchars($project['ProjectID']); ?>" method="GET" style="display:inline;">
                                <input type="hidden" name="ProjectID" value="<?php echo htmlspecialchars($project['ProjectID']); ?>">
                                <button type="submit" class="edit-btn">Edit</button>
                            </form>

                                <form action="../core/handleform.php?ProjectID=<?php echo htmlspecialchars($project['ProjectID']); ?>" method="POST" style="display:inline;">
                                    <button type="submit" name="deleteProjectBtn" class="delete-btn">Delete</button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>

