<?php
// Include necessary files for database configuration and data handling
require_once 'core/dbconfig.php'; // Database connection
require_once 'core/datamodel.php'; // Data model functions
require_once 'core/handleform.php'; // Handle form
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff and Client Input</title>
    <link rel="stylesheet" href="style.css"> <!-- Linking to the CSS file -->
</head>
<body>
    <div class="container">
        <h1>Printing - Project Management System</h1>

        <!-- Client Form -->
        <form method="POST" action="core/handleform.php" id="clientForm">
            <h2>Client Information</h2>
            <div class="form-group">
                <label for="clientName">Client Name:</label>
                <input type="text" name="ClientName" id="clientName" required>
            </div>
            <div class="form-group">
                <label for="clientEmail">Email:</label>
                <input type="email" name="Email" id="clientEmail" required>
            </div>
            <div class="form-group">
                <label for="clientPhone">Phone Number:</label>
                <input type="text" name="PhoneNumber" id="clientPhone" required>
            </div>
            <div class="form-group">
                <label for="clientAddress">Address:</label>
                <input type="text" name="Address" id="clientAddress" required>
            </div>
            <div class="form-group">
                <label for="clientCity">City:</label>
                <input type="text" name="City" id="clientCity" required>
            </div>
            <div class="form-group">
                <label for="clientZipCode">Zip Code:</label>
                <input type="text" name="ZipCode" id="clientZipCode" required>
            </div>
            <button type="submit" name="insertClientBtn">Submit Client</button>
        </form>

        <!-- Staff Form -->
        <form method="POST" action="core/handleform.php" id="staffForm">
            <h2>Staff Information</h2>
            <div class="form-group">
                <label for="staffFirstName">First Name:</label>
                <input type="text" id="staffFirstName" name="staffFirstName" required>
            </div>
            <div class="form-group">
                <label for="staffLastName">Last Name:</label>
                <input type="text" id="staffLastName" name="staffLastName" required>
            </div>
            <div class="form-group">
                <label for="staffEmail">Email:</label>
                <input type="email" id="staffEmail" name="staffEmail" required>
            </div>
            <div class="form-group">
                <label for="staffPhone">Phone Number:</label>
                <input type="text" id="staffPhone" name="staffPhone">
            </div>
            <div class="form-group">
                <label for="staffPosition">Position:</label>
                <input type="text" id="staffPosition" name="staffPosition">
            </div>
            <button type="submit" name="insertStaffBtn">Submit Staff</button>
        </form>

        <!-- Insert New Project Form -->
        <form action="core/handleform.php" method="POST" id="insert-project-form">
            <div class="ClientID">
            <h2>Project Information</h2>
                <label for="clientID">Client Name:</label>
                <select id="clientID" name="ClientID" required>
                    <option value="">Select Client</option>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?php echo htmlspecialchars($client['ClientID']); ?>">
                            <?php echo htmlspecialchars($client['ClientName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="StaffID">
                <label for="staffID">Staff Name: </label>
                <select id="staffID" name="StaffID" required>
                    <option value="">Select Staff</option>
                    <?php foreach ($staff as $staffMember): ?>
                        <option value="<?php echo htmlspecialchars($staffMember['StaffID']); ?>">
                            <?php echo htmlspecialchars($staffMember['FirstName'] . ' ' . $staffMember['LastName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="DateFiled">
                <label for="dateFiled">Date Filed:</label>
                <input type="date" id="dateFiled" name="DateFiled" required>
            </div>

            <div class="ProjectSpecification">
                <label for="projectSpecification">Project Specification:</label>
                <textarea id="projectSpecification" name="ProjectSpecification" rows="4" required></textarea>
            </div>

            <div class="Prioritylevel">
                <label for="priorityLevel">Priority Level:</label>
                <select id="priorityLevel" name="PriorityLevel" required>
                    <option value="">Select Priority Level</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>

            <div class="Status">
                <label for="status">Status:</label>
                <select id="status" name="Status" required>
                    <option value="">Select Status</option>
                    <option value="In progress">In progress</option>
                    <option value="Completed">Completed</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <div class="DueDate">
                <label for="dueDate">Due Date:</label>
                <input type="date" id="dueDate" name="DueDate" required>
            </div>

            <div class="RemainingDays">
                <label for="remainingDays">Remaining Days:</label>
                <input type="number" id="remainingDays" name="RemainingDays" required>
            </div>

            <div class="Remarks">
                <label for="remarks">Remarks:</label>
                <textarea id="remarks" name="Remarks" rows="4"></textarea>
            </div>

            <button type="submit" name="insertProjectBtn">Submit Project</button>
        </form>

        <!-- Clients Table -->
        <h2>Clients</h2>
        <table>
            <thead>
                <tr>
                    <th>Client ID</th>
                    <th>Client Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Zip Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($clients) > 0): ?>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($client['ClientID']); ?></td>
                            <td><?php echo htmlspecialchars($client['ClientName']); ?></td>
                            <td><?php echo htmlspecialchars($client['Email']); ?></td>
                            <td><?php echo htmlspecialchars($client['PhoneNumber']); ?></td>
                            <td><?php echo htmlspecialchars($client['Address']); ?></td>
                            <td><?php echo htmlspecialchars($client['City']); ?></td>
                            <td><?php echo htmlspecialchars($client['ZipCode']); ?></td>
                            <td>
                            <form action="viewproject/viewprojectclient.php" method="GET" style="display:inline;">
                                <input type="hidden" name="ClientID" value="<?php echo htmlspecialchars($client['ClientID']); ?>">
                                <button type="submit" class="view-btn">View Projects</button>
                            </form>
                                <form action="edit/editclient.php" method="GET" style="display:inline;">
                                    <input type="hidden" name="ClientID" value="<?php echo htmlspecialchars($client['ClientID']); ?>">
                                    <button type="submit" class="edit-btn">Edit</button>
                                </form>
                                <form action="delete/deleteclient.php" method="GET" style="display:inline;">
                                    <input type="hidden" name="ClientID" value="<?php echo htmlspecialchars($client['ClientID']); ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8">No clients found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Staff Table -->
        <h2>Staff</h2>
        <table>
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($staff) > 0): ?>
                    <?php foreach ($staff as $staffMember): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($staffMember['StaffID']); ?></td>
                            <td><?php echo htmlspecialchars($staffMember['FirstName']); ?></td>
                            <td><?php echo htmlspecialchars($staffMember['LastName']); ?></td>
                            <td><?php echo htmlspecialchars($staffMember['Email']); ?></td>
                            <td><?php echo htmlspecialchars($staffMember['PhoneNumber']); ?></td>
                            <td><?php echo htmlspecialchars($staffMember['Position']); ?></td>
                            <td>
                            <form action="viewproject/viewprojectstaff.php" method="GET" style="display:inline;">
                                    <input type="hidden" name="StaffID" value="<?php echo htmlspecialchars($staffMember['StaffID']); ?>">
                                    <button type="submit" class="view-btn">View Project</button>
                                </form>
                                <form action="edit/editstaff.php" method="GET" style="display:inline;">
                                    <input type="hidden" name="StaffID" value="<?php echo htmlspecialchars($staffMember['StaffID']); ?>">
                                    <button type="submit" class="edit-btn">Edit</button>
                                </form>
                                <form action="delete/deletestaff.php" method="GET" style="display:inline;">
                                    <input type="hidden" name="StaffID" value="<?php echo htmlspecialchars($staffMember['StaffID']); ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No staff found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
