CREATE DATABASE Hospital



-- Create Nurse Table
CREATE TABLE Nurse (
    NurseID INT PRIMARY K
    Username VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(100) NOT NULL,
);
-- Create Doctor Table

CREATE TABLE Doctor (
    DoctorID INT PRIMARY KEY,
    Username VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(100) NOT NULL,
);
-- Create Admin Table

CREATE TABLE Administrator (
    AdminID INT PRIMARY KEY,
    Username VARCHAR(50) UNIQUE NOT NULL,
    Password VARCHAR(100) NOT NULL,
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
    FOREIGN KEY (DoctorID) REFERENCES Doctor(DoctorID),
    FOREIGN KEY (NurseID) REFERENCES Nurse(NurseID)
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
    FOREIGN KEY (DoctorID) REFERENCES Doctor(DoctorID),
    FOREIGN KEY (NurseID) REFERENCES Nurse(NurseID)
);

