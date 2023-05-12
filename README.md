# Notefy

![Notefy Logo](public/img/notefy-logo-white.png)

Notefy is a web application developed in Laravel for task and note management. It allows users to create, edit, delete, and mark tasks as completed, as well as create and edit personal notes for their own reference. Additionally, the application integrates with the email service Mailtrap to allow users to send emails based on their tasks and notes.

**Note:** This application does not have a responsive layout as the focus of the project was on practicing Laravel skills.

## Running the application with Laragon

1. Install Laragon on your computer.
2. Create a MySQL database named "notefy" and export the .sql database that I leave on the "public" folder on it.
3. Clone this repository into your Laragon www folder.
4. Run the `php artisan serve` command to start the server.

## Features

- Google OAuth authentication to allow users to log in with their Google account.
- Task management: Users can create, edit, delete, and mark tasks as completed. Tasks are stored in a MySQL database using Laravel's RESTful API.
- Note management: Users can create, edit, and delete notes for their own reference. Notes are stored in a MySQL database using Laravel's RESTful API.
- Mailtrap integration: Users can send emails based on their tasks and notes, or for any other purposes they desire. Emails are sent through Mailtrap using Laravel's RESTful API.
- Route protection with Laravel Sanctum to ensure only authenticated users can access relevant routes.
- Automated testing using PHPUnit to ensure the application is functioning correctly.
- API documentation using Swagger to make it easy for developers to integrate the API into other applications.

## License

This project is licensed under the MIT License. See the LICENSE file for details.