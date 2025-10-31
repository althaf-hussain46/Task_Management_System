<h1 align="center">TASK MANAGEMENT SYSTEM</h1>
<h2 align="center">(Interview Task)</h2>

<h3>1. Task Overview :</h3>
<font color="purple">Developed a web-based Task Management System with two modules - Projects and Tasks - to efficiently assign and track user activities.</font>
<h3>2. Key Features :</h3>
<ul>
  <li>Implemented project creation, user assignment and task assginment functionalities.</li>
  <li>Designed task allocation by admin and progress tracking by user under each project.</li>
  <li>Focused on a user-friendly interface for smoth workflow.</li>
  <li>Added a feature for the admin to view the progress of assigned task of each user.</li>
  <li>Developed using  HTML, CSS, Bootstrap, JavaScript, PHP And MySQL.</li>
</ul>
<h3>3. Development Details :</h3>
<pre>
  <b>Start Date</b>      : 24.10.2025 (5:00 PM)
  <b>Completion Date</b> : 31.10.2025 (9:00 PM)
</pre>

<h3>4. Setup instructions</h3>
<ul>
  <li>Visual Studio Code (IDE for writing code)</li>
  <li>Xampp Server (For Local Hosting)</li>
  <li>MySQL Database (Data Storing)</li>
</ul>

<h3>5. Database structure - tms</h3>
<h6>5.1 Tables Used & Its Structure:</h6>

<img width="1343" height="418" alt="image" src="https://github.com/user-attachments/assets/dd10029a-befb-4f49-aca0-5e347905384b" />
<h3 align="center">Fig. 5.1.1 – Tables Used</h3>

<img width="1345" height="270" alt="image" src="https://github.com/user-attachments/assets/95e666b0-f36d-43db-87f6-29a8080ed77e" />
<h3 align="center">Fig. 5.1.2 – project_master – Table Structure</h3>

<img width="1309" height="364" alt="image" src="https://github.com/user-attachments/assets/6d421754-7581-4dcf-b1c5-b61d0a3aacf9" />
<h3 align="center">Fig. 5.1.3 – project – Table Structure</h3>

<img width="1340" height="424" alt="image" src="https://github.com/user-attachments/assets/0af09117-8843-484d-a010-6fb9e5401b97" />
<h3 align="center">Fig. 5.1.4 – task – Table Structure</h3>

<img width="1302" height="307" alt="image" src="https://github.com/user-attachments/assets/6e9cb68d-abcd-46c3-9704-dd9093195497" />
<h3 align="center">Fig. 5.1.5 – user – Table Structure</h3>

<h3>6.Queries To Create Tables ( 4 )</h4>

CREATE TABLE project_master (
  project_name_id int AUTO_INCREMENT PRIMARY KEY,
  project_name varchar(50),
  project_description text,
  created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY project_name (project_name));

CREATE TABLE project (
  project_id int AUTO_INCREMENT PRIMARY KEY,
  project_name_id int,
  start_date date,
  end_date date,
  assigned_user_id varchar(30),
  created_at timestamp DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (project_name_id) REFERENCES project_master (project_name_id) ON DELETE CASCADE);

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

CREATE TABLE user (
  user_id int AUTO_INCREMENT PRIMARY KEY,
  user_name varchar(50),
  user_email varchar(100),
  user_password varchar(30),
  created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_email (user_email));

7 Admin Credentials :
o	User Name : admin
o	Password    : 123
