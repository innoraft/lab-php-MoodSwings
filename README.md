# MOODSWING

**About**
This project is about tracking emotions of people.You need to mail in the following format:
*@feeling:happy* to moodswing@innoraft.com

1.Users can send emails to a particular email id
2.The email will contain the status
3.The portal/system will capture the email and get the status and email, and store it
4.The email can have data like
	a.Action
		@feeling:frustrated, which will store the data like [feeling:frustrated]
		@doing:timepass, which will store the data like [doing:timepass]
		And more!
	b.Content - simple text
5.All the data must be stored in the proper manner so we can create analytics like “on wednesdays people mostly feel happy, tired, frustrated”
6.Users can login using the same email id and see their statuses

Name of the database used: moodswing

There are 3 tables:
1. Messages
2. Users
3. UserRole



**PRE-REQUISITES**

1. Clone the project.
2. Open terminal on the location and type *composer install* (note-you should have the composer installed in your system) which will install 	the auto loader files.
3. Run the following commands to create the database and the tables needed in your terminal(use the command "mysql -u root -p" without quotes 	 to enter into mysql database:
	
	mysql>CREATE DATABASE moodswing;

	mysql>use moodswing;

	mysql>CREATE TABLE Messages
     (	  
     	  Id int UNIQUE KEY AUTO_INCREMENT,
          MessageId varchar(50) NOT NULL PRIMARY KEY,
          Activity varchar(50),
          Content varchar(50),
          Date BIGINT,
          EmailId varchar(100)
     );

     mysql>CREATE TABLE Users
     (
     EmailId varchar(100) UNIQUE KEY,
     Password varchar(50),
     UserRoleId int
     );

     mysql>CREATE TABLE UserRole
     (
          UserRoleId int PRIMARY KEY,
          UserRoleName varchar(50),
          UserDescription varchar(50)
     );

4. Replace the CLIENT_ID,CLIENT_SECRET and the REDIRECT_URI in the file gmail.php 





