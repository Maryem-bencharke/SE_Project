CREATE DATABASE Hospital



-- Create User Table
CREATE TABLE User (
    UserID INT PRIMARY KEY,
    Username VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(100) NOT NULL,
    Role VARCHAR(20) NOT NULL
);

-- Create Patient Table
CREATE TABLE Patient (
    PatientID INT PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    BirthDate DATE,
    Gender VARCHAR(10),
    InsuranceInfo VARCHAR(100),
    UNIQUE (FirstName, LastName, BirthDate)
);

-- Create MedicalRecord Table with Image Data
CREATE TABLE MedicalRecord (
    RecordID INT PRIMARY KEY,
    PatientID INT,
    DoctorID INT,
    NurseID INT,
    DateCreated DATE,
    MedicalHistory TEXT,
    TreatmentPlan TEXT,
    TestResults TEXT,
    ImageData BLOB, 
    FOREIGN KEY (PatientID) REFERENCES Patient(PatientID),
    FOREIGN KEY (DoctorID) REFERENCES User(UserID),
    FOREIGN KEY (NurseID) REFERENCES User(UserID)
);


-- Create Appointment Table
CREATE TABLE Appointment (
    AppointmentID INT PRIMARY KEY,
    PatientID INT,
    DoctorID INT,
    NurseID INT,
    AppointmentDate DATETIME,
    Status VARCHAR(20),
    FOREIGN KEY (PatientID) REFERENCES Patient(PatientID),
    FOREIGN KEY (DoctorID) REFERENCES User(UserID),
    FOREIGN KEY (NurseID) REFERENCES User(UserID)
);

-- Create Report Table
CREATE TABLE Report (
    ReportID INT PRIMARY KEY,
    ReportType VARCHAR(50),
    Content TEXT,
    DateGenerated DATE,
    UserID INT,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);