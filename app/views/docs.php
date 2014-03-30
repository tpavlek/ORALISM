<h1>User Documentation</h1>

<h2>Login Module</h2>

<p>To get to the login page you can press the Log in button on the navigation bar.</p>

<h4>Logging in</h4>

<p>To login first proceed to the login page by pressing the Log in button on the
navigation bar. Then enter your username and password in the text boxes
labelled UserName and Password respectively. Clicking the button labelled LOGIN
will log you in if the given login credentials are correct.</p>

<h4>Invalid login credentials</h4>

<p>If the login credentials provided are incorrect then you will be taken
back to the login page and there will be a message displaying that
the provided login credentials were invalid.</p>

<h4>Logging out</h4>

<p>To logout you can click the Log out <username> button on the navigation bar.
This will log you out, and take you back to the home screen.</p>

<h2>User Management Module</h2>

<p>The User Management Module allows administrators to add new users, and
modify existing users. This page is accessible only while logged in
as an administrator. It can be accessed by clicking on the
"User Management" button on the navigation bar.</p>

<h4>Adding new users</h4>

<p>A new user can be added to the system by clicking the "NEW USER" button
on the User Management page. Clicking this button will take you to a new
page where the new users information can be entered.</p>

<p>The new user page requires a first name, last name, address, email,
phone number, username, password, and class. All fields are required. 
The email must be in the form <user>@<domain>.<extension>. The phone
number must be 10 digits long (e.g. 123-456-7890).</p>

<p>Clicking the "SAVE" button will create the new user with a login
with the given username, password and class. After this, new logins
can be created using the method described below.</p>

<p>Clicking the "CANCEL" button will not create a new user, and will return to the
User Management screen.</p>

<h4>Creating new logins</h4>

<p>Users can have multiple logins. In order to add a new login to a user,
a user must first be created using the above method.</p>

<p>To add a new login to a user, first find the user on the User Management page.
Then click the "NEW LOGIN" button beside that users name. This will take
you to a new page. On the new page you must enter the new username, password,
and select the class of the new login. All of the users old logins will still
remain, upon the creation of the new login. To create the new login, click the
"SAVE" button. To cancel the new login, click the "CANCEL" button.</p>

<h4>Editing a user</h4>

<p>A user can be edited by click on the "EDIT" button beside their name
in the table of users on the User Management page.</p>

<p>The edit user page can also be reached by clicking the "Edit Info" button
on the navigation bar. However, that will only allow you to modify the user
info of the user you are currently logged into.</p>

<p>On the edit user page, the name, address, email, and phone number of the
user can be modified. In addition the username, password, and class of
any of the users logins can be changed.</p>

<p>After making any changes to the user, the "SAVE" button must be clicked
for the changes to take affect.</p>

<h4>Managing doctors</h4>

<p>To manage doctors of a person, click the "MANAGE DOCTORS" button beside
that persons name on the User Management page. This will take you to a new
page where you can remove existing doctors, and add new doctors.</p>

<h5>Adding new doctors to a person</h5>

<p>Once on the Manage Doctors page. You can give the person a new family
doctor by selecting the doctor from the drop down list and clicking "SAVE".
This will add the doctor to the patient. Clicking "CANCEL" will take you back
to the User Management page.</p>

<h5>Removing doctors from a person</h5>

<p>If a person has family doctors, they can be removed from the Manage
Doctors page. To remove a family doctor, find the doctor in the table
of family doctors. Clicking the "REMOVE" button will remove the family
doctor from that person. The list of family doctors will only be visible
if the selected person have family doctors assigned to them.</p>

<h2>Report Generating Module</h2>

<p>The report generating page can be accessed by administrators by clicking the
"Reports" button in the navigation bar.</p>

<h4>Generating Reports</h4>

<p>To generate a report, first get to the report generating page. Once on this
page, reports can be generated by selecting the required criteria and clicking
the "GENERATE" button.</p>

<p>When generating a report, you can choose the diagnosis to search for using the
drop down box beside the label "Diagnosis". This box contains a list of all
the diagnoses in the database. In addition to the diagnosis, the start date and
end date of diagnoses must be selected using the inputs labelled "Start Date" and
"End Date".</p>

<h4>Viewing a generated report</h4>

<p>Once a report is generated it will be displayed in a table on a new page.
The table lists the name, address, phone number, and test date of all
patients that have the given diagnosis and were tested between the two given
dates (inclusive).</p>

<p>If you want to generate another report, you can do so by clicking the
"GENERATE ANOTHER" button on the report page, which will take you back to the 
report generating page.</p>

<h2>Uploading Module</h2>

<p>An uploading module is provided to allow radiologists to create new records
and attach images. This module is accessible to radiologists
by clicking on the "Upload" button on the navigation bar.</p>

<h4>Creating records</h4>

<p>Clicking on the "Upload" button on the navigation bar will take you to the
record creation page. This page contains fields for all the information
required to create a new record.</p>

<p>First begin by selecting the patient, doctor, and test type from the drop
down menus. These drop down menus contain all of the patients, doctors, and
test types in the database. Next you must select the prescribing and test
dates. Finally, a short diagnosis, and description of the record must be
included.</p>

<p>Upon creation time one or more images can be attached to the record using
the file selection at the bottom of the page. This will open a file system
browser where you can select the related images from. Multiple images can
be selected using the shift and ctrl keys, in addition to clicking.</p>

<p>Once all of the fields have been filled out, you can create the record by
clicking the button labelled "CREATE" at the bottom of the page.</p>

<h2>Search Module</h2>

<p>While performing searches there are two main pages. The first page
is the search page where a query is input. The second page is the
results page where the results of a search are displayed.</p>

<h4>Making a search</h4>

<p>To get to the search page, click the Search button on the navigation bar.
To make a query against existing records, type the query into the textbox
labelled search and click the button labelled SEARCH. This will take you to the
search results page (explained below).</p>

<h4>Limiting a search based on dates</h4>

<p>The query can be narrowed down by specifying the start and end date. If only
the start date is specified then all records matching the query after that date
will be displayed. If only the end date is specified then all records matching
the query before that date will be displayed. If both are specified then only
records matching the query that fall between those two dates will be displayed.</p>

<p>The dates selected are inclusive in the search results. Meaning that the
records displayed will be from the start date, inclusive, to the end date, also
inclusive.</p>

<p>It is possible to leave the query blank and only select dates. If this is
done then the search results will contain all records between the selected
dates, based on the description above.</p>

<h4>Search result ordering</h4>

<p>There are three different ways to order the results. These can be selected
using the drop down menu below the date entry.</p>

<p>The first method is by relevancy. If this method is selected then the results
will be displayed based on the relevancy of the record to the search query. If
the search query is left blank then the results have no guaranteed ordering.</p>

<p>The second and third method are most-recent-first, and most-recent-last. These
two methods order the results based on test date. The records with the most
recent and least recent test dates are displayed first respectively.</p>

<h4>Viewing search results</h4>

<p>Search results are displayed on a separate page after clicking the search
button on the search page. If the given query matches no records then the
text "No Results Found!" will be displayed. Otherwise a table of matching
records will be displayed. The table displays the patient, doctor,
radiologist, test type, prescribing date, test date, diagnosis, description,
and thumbnails.</p>

<h4>Viewing record images</h4>

<p>There are two ways to view record images from the search results page. The
first method is to click on the images thumbnail in the search results table.
This will open a new window containing the image. The two buttons can be used
to increase or decrease the size of the image.</p>

<p>The second method to view a records images is to click on the "View" button in
the same row as the record you want to view images for. This will take you to
the records page. At the bottom of this page is a list of images for the
record. Again the two buttons can be used to increase or decrease the size of
the image.</p>

<h2>Data Analysis Module</h2>

<p>The data analysis page is accessible to an admin by clicking on the "Analysis"
button in the navigation bar.</p>

<h4>Submitting an analysis request</h4>

<p>Once on the data analysis page, a request can be submitted by filling out the
fields and clicking the "SUBMIT" button at the bottom of the page. At least
one of the filter checkboxes must be checked before the request can be submitted.
When specifying the data (patient, test type, etc) to get data for, the
corresponding checkbox must be selected in the filter section. Otherwise the
data will not be taken into consideration.</p>

<p>The period selection defines how frequently the output data is broken down.
The smaller the period the less time there is between data points in the output.</p>

<p>Upon completing the form, submit the request to view the results.</p>

<h4>Viewing data analysis results</h4>

<p>Once the data analysis request is submitted, you will be taken to a new page to
view the results. If the request had no matching records then the resulting page
will say "No results to display".</p>

<p>If the request has results, then a table will be output. Each row of the table
represents a period of time. So if weekly was selected for the period, then each
row of the table represents a week. The beginning of the time period is listed
in the first column of the table. If the period filter was not selected then
the result will contain one row, which contains the results for all of time.
In this case the first column will contain "NULL" meaning that there is no
time period corresponding to these results.</p>

<p>In all cases, the second column of the table in the results is the image count.
This number refers to the number of images contained by all records matching
the input request, broken down based on the period selected. Each rows image
count corresponds to the number of images that are attached to records that
match the request in the time period in the first column (or all of time if the
first column contains "NULL").</p>

<p>Once done viewing the results, another request can be made by clicking on the
"SEARCH AGAIN" button at the bottom of the screen. This will take you back to
the data analysis page.</p>

<h1>Installation Instructions</h1>

<p>First, either clone the code from the git repository (available at , or unzip
the source tarball.</p>

<p>ORALISM is backed by MySQL and PHP. In order for it to run you will need to
install PHP 5.5.3 and MySQL Ver 14.14 Distrib 5.5.32. Newer versions of PHP and
MySQL may work with ORALISM, however they have not been tested.</p>

<p>A database needs to be created in MySQL by the name 'oralism'. In addition a
user with the username 'oralism' must be created and granted all priviledges on
the database 'oralism'. The password for the user 'oralism' must be 'farts' to
work with the current configuration file. Directions to create the database,
create the user and set up priviledges can be found at mysql.com.</p>

<p>In the directory of the cloned repository run <code>composer install</code> to install
all dependencies for the project. Once the database is configured properly run
<code>php artisan migrate</code> to run the initial migration and create all the necessary
tables and keys for the application.</p>

<p>From there, point your webserver at the /public directory, or run <code>php artisan
serve</code>.</p>
