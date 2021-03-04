# OVERVIEW

This is a [solution](https://github.com/bav0813/test-assignment) of the task assignment by Andrew Bychkovsky dated Mar,04 2021

## System Requirements

This module was created with [Laravel framework](https://laravel.com) version 8.30.1 which requires PHP >= 7.3.

## Configuration

Environment configuration should be done in .env file in the root of the Laravel project. 


## Usage

Fill the database with dummy data ```php artisan db:seed ```.
Run Laravel build-in web server ```php artisan serve ``` and 
make a call via [Postman](https://www.postman.com) or other software.

There are five endpoints to the application for retrieving business data: 

- **api/get-businesses** - returns list of latest businesses with pagination. 
*Method:*  GET.
*Returned value:* JSON Data; Status codes: 200,404
- **api/get-business/{id}** - returns details of business with requested ID. 
*Method:*  GET.   
*Returned value:* JSON Data; Status codes: 200,404
- **api/store-business** - which accepts the required fields including a city and creates a new business. *Business name should be between 10 and 50 characters. Business price should be between 10 thousand and 10 million. 
*Method:* POST.
*Returned value:* JSON Data; Status codes: 201,400
- **api/update-business** - which updates an existing business and/or its city. *Business name should be between 10 and 50 characters. Business price should be between 10 thousand and 10 million. 
*Method:*  PUT. 
*Returned value:* JSON Data; Status codes: 201,400
- **api/delete-business/{id}** - which updates an existing business and/or its city. 
*Method:*  DELETE.  
*Returned value:* JSON Data; Status codes: 200,404


All responses are represented in JSON format. 

## Automated Tests

For running automated tests for the endpoints please execute ```php artisan test```.




## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

