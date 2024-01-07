# Hospital Patient Archive Management Platform


The Hospital Patient Archive Management Platform is a comprehensive digital system designed to streamline the management of patient records and archives within a healthcare facility. This platform provides an efficient way to handle patient information, enhancing the workflow within medical institutions.
## Getting Started 
### Prerequisites: 

Before you begin, ensure you have the following installed on your system:

WAMP Server: This package contains Apache, MySQL, and PHP, essential for running the platform locally.
### Configuration

### Database Setup
The platform uses a MySQL database. The connection details are set in the PHP class Db (db/db.php). You will need to adjust these settings according to your local environment.

### Modify Connection Details:
In the Db class (db/db.php) , you will find variables for host, username, password, and database name. Adjust these to match your local MySQL setup.

## Usage  
### Dashboard  
Upon opening the platform, you will be greeted with the login screen.

![Alt text](Demo/login.png)


### Doctor's Dashboard  

If you log in as a doctor, you will see the following dashboard.
![Alt text](Demo/doctorDash.png)

 ### View Patient Management Record  
To view patient management records:

![Alt text](Demo/viewPatient.png)

Here you can select the number of entries to display.

### Search for a Patient 


You can search for a patient using their first and last name.

![Alt text](Demo/search.png)


Alternatively, a simple name search is also available.


![Alt text](Demo/search1.png)

 ### Update a Patient's Information  
To update a patient's information, follow these steps:
![Alt text](Demo/update1.png)
![Alt text](Demo/update2.png)
![Alt text](Demo/update3.png)

### View Patient Information 
You can also view detailed patient information.
![Alt text](Demo/view.png)


### View Medical Record Detail 
To view a patient's medical record details:
![Alt text](Demo/viewRecord.png)



### Appointments Per Day 
Go back to the dashboard to view appointments scheduled for the day.
![Alt text](Demo/appDay.png)
 ### Logout 
You can log out of the system as needed.
![Alt text](Demo/logout.png)

### Nurse's Dashboard 
If you log in as a nurse, you will see a similar dashboard.
![Alt text](Demo/nurseDash.png)


### Patient List 
Nurses can access the complete list of patients.
![Alt text](Demo/patientList.png)

The search and update functionalities for nurses are similar to those in the doctor's dashboard.
### Adding a New Patient 
Nurses can add new patients to the system.
![Alt text](Demo/addPatient1.png)
![Alt text](Demo/addPatient2.png)


### Nurse's Appointments 
From the nurse's dashboard, you can view and manage appointments.
![Alt text](Demo/appNurse.png)
### Adding a New Appointment 
Nurses can schedule new appointments.
![Alt text](Demo/addApp.png)

### Admin's Dashboard 


![Alt text](Demo/adminDash.png)

###   Manage doctors
Admin can Manage doctors

![Alt text](Demo/image-9.png)
Admin can Add a new doctor
![Alt text](Demo/image-10.png)
Admin can Edit a doctor

![Alt text](Demo/image-1.png)

Admin can delete a doctor
![Alt text](Demo/image-2.png)
![Alt text](Demo/image-11.png)

###   Manage nurses
Admin can Manage nurses

![Alt text](Demo/image-12.png)
Admin can Add a new nurse
![Alt text](Demo/image-13.png)
Admin can Edit a nurse
![Alt text](Demo/image-4.png)
Admin can delete a nurse
![Alt text](Demo/image-2.png)
![Alt text](Demo/image-5.png)

###   Manage admins
Admin can Manage admins

![Alt text](Demo/image-14.png)
Admin can add admins
![Alt text](Demo/image-16.png)
Admin can Edit admins


![Alt text](Demo/image-15.png)
Admin can delete an admin 
![Alt text](Demo/image-2.png)
![Alt text](Demo/image-5.png)