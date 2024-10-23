-- Clients table to store client information
CREATE TABLE Clients (
    ClientID INT AUTO_INCREMENT PRIMARY KEY,  -- Unique ID for each client
    ClientName VARCHAR(255) NOT NULL,         -- Name of the client
    Email VARCHAR(255) NOT NULL,              -- Email address for client communication
    PhoneNumber VARCHAR(15),                  -- Contact phone number of the client
    Address VARCHAR(255),                     -- Address of the client
    City VARCHAR(100),                        -- City where the client is located
    ZipCode VARCHAR(10)                       -- Zip code of the client's location
);

-- Staff table to store information about the point person (staff member managing the project)
CREATE TABLE Staff (
    StaffID INT AUTO_INCREMENT PRIMARY KEY,   -- Unique ID for each staff member
    FirstName VARCHAR(100) NOT NULL,          -- First name of the staff member
    LastName VARCHAR(100) NOT NULL,           -- Last name of the staff member
    Email VARCHAR(255),                       -- Email address of the staff member
    PhoneNumber VARCHAR(15),                  -- Contact phone number of the staff member
    Position VARCHAR(100)                     -- Position of the staff (e.g., Manager, Supervisor)
);

-- Projects table to store project details
-- This table has a one-to-many relationship with both Clients and Staff
CREATE TABLE Projects (
    ProjectID INT AUTO_INCREMENT PRIMARY KEY,  -- Unique ID for each project
    ClientID INT,                              -- Foreign key linking to Clients table (one client can have many projects)
    StaffID INT,                               -- Foreign key linking to Staff table (one staff can handle many projects)
    DateFiled DATE,                            -- Date when the project was filed
    ProjectSpecification TEXT,                 -- Detailed description of the project specifications
    PriorityLevel VARCHAR(50),                 -- Priority level of the project (e.g., High, Medium, Low)
    Status VARCHAR(50),                        -- Current status of the project (e.g., In progress, Completed)
    DueDate DATE,                              -- Deadline for the project
    RemainingDays INT,                         -- Number of days remaining until the project is due
    Remarks TEXT,                              -- Additional comments or remarks about the project
    FOREIGN KEY (ClientID) REFERENCES Clients(ClientID),  -- Establishes one-to-many relationship with Clients
    FOREIGN KEY (StaffID) REFERENCES Staff(StaffID)       -- Establishes one-to-many relationship with Staff
);



