<h1 align="center">TASK MANAGEMENT SYSTEM</h1>
<!-- <h2 align="center"><a href="Task_Management_System_Interview_Task_Description.pdf" target="_blank" style="text-decoration:underline;">(Interview Task)</a></h2> -->
<p align="center">
  <a href="Task_Management_System_Interview_Task_Description.pdf" target="_blank">
    <img src="https://img.shields.io/badge/Interview%20Task-blue?style=for-the-badge" alt="Interview Task">
  </a>
</p>




<h3>1. Task Overview :</h3>
<pre>     Developed a web-based Task Management System with Three modules - Admin, User & Deadline Tracking - 
     to efficiently assign and track user activities.
</pre>
<h3>2. Key Features :</h3>
<pre>
        🔵 Implemented project creation, user assignment and task assginment functionalities.
        🔵 Designed task allocation by admin and progress tracking by user under each project.
        🔵 Focused on a user-friendly interface for smoth workflow.
        🔵 Added a feature for the admin to view the progress of assigned task of each user.
        🔵 Developed using  HTML, CSS, Bootstrap, JavaScript, PHP And MySQL.

</pre>
<h3>3. Development Details :</h3>
<pre>
        <b>Start Date</b>      : 24.10.2025 (5:00 PM)
        <b>Completion Date</b> : 31.10.2025 (9:00 PM)
</pre>

<h3>4. Setup instructions</h3>
<pre>        🔵 Visual Studio Code (IDE for writing code)
        🟠 Xampp Server (For Local Hosting)
        ⚪ MySQL Database (Data Storing)
</pre>


<h3>5. Database structure - tms</h3>
<h3>5.1 Tables Used & Its Structure:</h3>

<img width="1343" height="418" alt="image" src="https://github.com/user-attachments/assets/dd10029a-befb-4f49-aca0-5e347905384b" />
<h3 align="center">Fig. 5.1.1 – Tables Used</h3>
<br>
<br>
<br>
<img width="1345" height="270" alt="image" src="https://github.com/user-attachments/assets/95e666b0-f36d-43db-87f6-29a8080ed77e" />
<h3 align="center">Fig. 5.1.2 – project_master – Table Structure</h3>
<br>
<br>
<br>
<img width="1309" height="364" alt="image" src="https://github.com/user-attachments/assets/6d421754-7581-4dcf-b1c5-b61d0a3aacf9" />
<h3 align="center">Fig. 5.1.3 – project – Table Structure</h3>
<br>
<br>
<br>
<img width="1340" height="424" alt="image" src="https://github.com/user-attachments/assets/0af09117-8843-484d-a010-6fb9e5401b97" />
<h3 align="center">Fig. 5.1.4 – task – Table Structure</h3>
<br>
<br>
<br>
<img width="1302" height="307" alt="image" src="https://github.com/user-attachments/assets/6e9cb68d-abcd-46c3-9704-dd9093195497" />
<h3 align="center">Fig. 5.1.5 – user – Table Structure</h3>
<br>
<br>
<h3>6. Queries To Create Tables ( 4 )</h4>

 ```mysql
 CREATE TABLE project_master (
  project_name_id int AUTO_INCREMENT PRIMARY KEY,
  project_name varchar(50),
  project_description text,
  created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY project_name (project_name));
```
```mysql  
CREATE TABLE project (
  project_id int AUTO_INCREMENT PRIMARY KEY,
  project_name_id int,
  start_date date,
  end_date date,
  assigned_user_id varchar(30),
  created_at timestamp DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (project_name_id) REFERENCES project_master (project_name_id) ON DELETE CASCADE);
```
```mysql
CREATE TABLE task (
  task_id int AUTO_INCREMENT PRIMARY KEY,
  project_id int,
  task_name varchar(50),
  task_description varchar(200),
  assigned_user_id int,
  priority_level varchar(10),
  dead_line date,
  task_status varchar(30) DEFAULT 'Not Started',
  created_at timestamp DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (project_id) REFERENCES project_master (project_name_id) ON DELETE CASCADE);
```
```mysql
CREATE TABLE user (
  user_id int AUTO_INCREMENT PRIMARY KEY,
  user_name varchar(50),
  user_email varchar(100),
  user_password varchar(30),
  created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_email (user_email));
```

### 7. Admin Credentials :

- 👤 User Name : admin
- 🔑 Password  : 123


### 8. User Credentials :

- 👤 User Name : althafhussain2k3@gmail.com
- 🔑 Password  : 123

<br>

- 👤 User Name : sam123@gmail.com
- 🔑 Password  : 123
  
<br> 

- 👤 User Name : john@gmail.com
- 🔑 Password  : 123
  
<br>  
<br>

### 9. Screenshots :
<br>
<br>
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/c8bcb529-0885-4966-9be0-c2e2014cb6bb" />
<br>
<br>
<br>
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/9b9ed044-fa4b-4252-91f0-613ebad3d75e" />
<br>
<br>
<br>
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/16f1513c-014c-49f8-9ca8-11162644d43a" />
<br>
<br>
<br>
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/ee0cb48f-e2c7-424d-acf0-f62afa72d1ba" />
<br>
<br>
<br>
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/df33e857-ceaa-4b5d-985a-948fa966e224" />
<br>
<br>
<br>
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/e3f69b37-79e8-4f59-87a5-a22f51714764" />
<br>
<br>
<br>
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/9e0d87b7-107c-4e52-85cc-aeeac05ea578" />
<br>
<br>
<br>
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/2d157117-eb95-48dc-ad48-c9610ec3ed81" />
<br>
<br>
<br>
<img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/53bce542-5af3-4286-944c-ec070b7d6f7f" />
<br>
<br>

### 10. Project Links :

Website Link : https://taskmanagementsystem.42web.io/
<br>
<br>
GitHub Repository :  https://github.com/althaf-hussain46/Task_Management_System
<br>
<br>
Online Deployed Demo Video  : https://drive.google.com/file/d/1Wmz1jVyHKrbi24e2QXhlfK51vZTD5rPP/view?usp=sharing
<br>
<br>
Youtube (Development Process) : https://www.youtube.com/@Althaf_Hussain_Projects

