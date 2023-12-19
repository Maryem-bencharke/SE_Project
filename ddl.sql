CREATE DATABASE Hospital;
USE Hospital;

-- Create Nurse Table
CREATE TABLE Nurse (
    NurseID INT PRIMARY KEY,
    Username VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(100) NOT NULL,
    Email VARCHAR(50),
    PhoneNumber VARCHAR(20),
    Address VARCHAR(100),
    CIN VARCHAR(20)
);
-- Create Doctor Table

CREATE TABLE Doctor (
    DoctorID INT PRIMARY KEY,
    Username VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(100) NOT NULL,
    Email VARCHAR(50),
    PhoneNumber VARCHAR(20),
    Address VARCHAR(100),
    CIN VARCHAR(20)
);
-- Create Admin Table

CREATE TABLE Administrator (
    AdminID INT PRIMARY KEY,
    Username VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(100) NOT NULL,
    Email VARCHAR(50),
    PhoneNumber VARCHAR(20),
    Address VARCHAR(100),
    CIN VARCHAR(20)
);
-- Create Patient Table
CREATE TABLE Patient (
    PatientID INT PRIMARY KEY,
    FirstName VARCHAR(50) NOT NULL,
    LastName VARCHAR(50) NOT NULL,
    BirthDate DATE,
    Gender ENUM('F', 'M'),
    BloodGroup ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'),
    PhoneNumber VARCHAR(20),
    Address VARCHAR(100),
    Email VARCHAR(50),
    CIN VARCHAR(20),
    InsuranceInfo VARCHAR(100),
    emergencyContactName VARCHAR(100),
    emergencyContactPhone VARCHAR(20),
    emergencyContactAddress VARCHAR(100),
    emergencyContactEmail VARCHAR(50),
    emergencyContactRelation VARCHAR(50),
    emergencyContactBloodGroup ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'),
    emergencyContactCIN VARCHAR(20)
);

-- Create MedicalRecord Table with Image Data
CREATE TABLE MedicalRecord (
    RecordID INT PRIMARY KEY,
    PatientID INT,
    DoctorID INT,
    NurseID INT,
    DateCreated DATE,
    Record TEXT,
    TreatmentPlan TEXT,
    TestResults TEXT,
    ImageData BLOB, 
    FOREIGN KEY (PatientID) REFERENCES Patient(PatientID),
    FOREIGN KEY (DoctorID) REFERENCES Doctor(DoctorID),
    FOREIGN KEY (NurseID) REFERENCES Nurse(NurseID)
);


-- Create Appointment Table
CREATE TABLE Appointment (
    AppointmentID INT PRIMARY KEY,
    PatientID INT,
    DoctorID INT,
    NurseID INT,
    AppointmentDate DATE,
    Status VARCHAR(20),
    FOREIGN KEY (PatientID) REFERENCES Patient(PatientID),
    FOREIGN KEY (DoctorID) REFERENCES Doctor(DoctorID),
    FOREIGN KEY (NurseID) REFERENCES Nurse(NurseID)
);

