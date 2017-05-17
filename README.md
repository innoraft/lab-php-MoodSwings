# MOODSWING

**About**
This project is about tracking emotions of people.You need to mail in the following format:
*@feeling:happy* to moodswing@innoraft.com

1. Users can send emails to a particular email id
2. The email will contain the status
3. The portal/system will capture the email and get the status and email, and store it
4. The email can have data like
	1. Action
		@feeling:frustrated, which will store the data like [feeling:frustrated]
		@doing:timepass, which will store the data like [doing:timepass]
		And more!
	2. Content - simple text
5. All the data must be stored in the proper manner so we can create analytics like “on wednesdays people mostly feel happy, tired, frustrated”
6. Users can login using the same email id and see their statuses

Name of the database used: moodswing

There are 3 tables:
1. Messages
2. Users
3. UserRole



**PRE-REQUISITES**

1. Clone the project.
2. Open terminal on the location and type *composer install* (note-you should have the composer installed in your system) which will install the auto loader files.
3. In the file *dbcredentials.php* and the file *config.ini* replace the variables with your credentials.
4. Run the *dbcreate.php* to create the neccessary tables for the database.
