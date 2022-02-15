# PHP-data-access-methods-code-generator
This Repo contains a code generator written in PHP. Developers need not waste time writing methods for retrieving data, inserting data, updating data, submitting forms etc as this code generates all that code automatically. To use this, specify a database table (at the minimum) and run the script to generate code for methods that can be used to manipulate data in the table. 

HOW TO USE:

1) Follow the instructions in the PHP script to configure the parameters for your database connection and target table name, as well as other variables like table columns exclusion list and so on.

2) Copy the script to a directory on your webserver. 

3) Run the script on a browser as http://serverhost:port/anydirectory/test_codegen.php.   Note: replace 'serverhost', 'port' and 'anydirectory' with the appropriate values as it applies to your webserver and application directory

4) Copy the auto generated PHP methods and functions code on the browser and use in your project
