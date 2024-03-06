# Ernesto Alvarez RESTFUL API 
A RESTful API for customers transactions

It is a just simple showcase of API Knowledge or example for making simple RESTful API with  **for exam purposes only** 
Coded with share screen with a Tech Reviewer

## Installation & Run
```bash
# Download this project visit and clone
https://github.com/ernestoalvarezgit/simple-customers-api
```

Before running API server, you should set the database config with yours or set the your database config with my values on [db]
```
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_DATABASE','db_exam');
```

```bash
# Build and Run
cd /htdocs/simple-customers/api

# Sample API Endpoint : http://localhost/img/api.php/customer/list?limit=15
```

## Structure
```
├── simple-customers-api
│   ├── api.php // main file 
│   ├── db.php          // DB Config and connection class
│   └── ApiController.php     // Our Controller for managing the transactions
```

## API

#### /customer/list
* `GET` : Get all projects

#### /customer/show/{customerId}
* `GET` : Get a customer record

#### /customer/
* `POST` : Insert a Customer Record on the Database

#### /customer/{customerId}
* `PUT` : Update a Customer Record on the database  a task of a project

#### /customer/{customerId}
* `PATCH` : Update a Customer Record on the database  a task of a project using PATCH Method for single fields

#### /customer/{customerId}
* `DELETE` : Delete a Customer Record on the database

## List of TODO to test the REST API

- [ ] Setup the Database by Importing the SQL File
- [ ] Set the DB Config File Values properly
- [ ] Open a Database Client in order to view the records
- [ ] Refer the the API Endpoints to be able to test
- [ ] Download Postman or any API Clients to send the proper HTTP Methods 
 
