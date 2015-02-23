Task: 

Create a simple supplier address list displaying data from one of the data sources provided. Pick one that suits you the best. 
Use Composer to install Zend Framework 2, PHPUnit and any other 3rd party libraries you need. Your task will be assessed on your use of OOP, dependency injection, unit testing, commenting and code readability. 
We will test your code with PHP's built in webserver so we strongly suggest that you use it too. 

1. Suppliers should be displayed as a table with following columns: 
 Supplier name, address line 1, address line 2, town, post code, telephone, fax, email. 
2. Include a way to Create, Read, Update and Delete records in database. 
3. Provide a filter (text input) that will filter the results on supplier name. 
 

Notes: 
Supplier may have 0 or more addresses to be displayed. 
You can create new folders and files as needed but you cannot change current folder structure. 

Supplied database contains 3 tables: 
Suppliers (supplier_id, supplier_name)
Addresses (address_id,address_line_1,address_line_2,town,post_code,telephone,fax,email)
Supplier_addresses(supplier_address_id, supplier_id, address_id)
