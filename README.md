# Laravel File Upload and Preview Project

This project is a simple Laravel application that allows users to upload files, view uploaded files, and preview them using Bootstrap.

## Features

- User authentication
- File upload
- File preview
- File download

## Prerequisites

- PHP >= 7.4
- Composer
- Node.js and npm
- PostgreSql or any other supported database

### 1. Clone the Repository

```bash
git clone https://github.com/ashiqur31/laravelapp.git
cd laravelapp

```
#### 2. Install Dependencies

```bash
composer install
npm install
npm run dev
```

##### 3. Environment Configuration

Copy the .env.example file to .env and configure your environment variables:

```bash
cp .env.example .env
```
Update your .env file with your database and other necessary configurations.

##### 4. Generate Application Key

```bash
php artisan key:generate
```

###### 5. Run Migrations

```bash
php artisan migrate
```

##### 6. Serve the Application

Start the development server:

```bash 
php artisan serve
```
The application will be available at http://localhost:8000.


#### Usage
# Authentication
- Register a new user or log in with existing credentials.
- After logging in, you will be redirected to the dashboard.
## File Upload
- Navigate to the "Uploaded Files" section.
- Use the file upload form to upload a new file.
- Uploaded files will be listed in a table with options to download.
## File Preview
- Click the "Preview" button next to the file you want to preview.


##### Project Structure
- app/Http/Controllers/DashboardController.php: Handles file upload, preview, and download.
- app/Imports/ExcelImport.php: Handles the import of Excel files.
- app/Models/UploadedFile.php: Model representing an uploaded file.
- resources/views/dashboard.blade.php: View for displaying the file upload form and list of uploaded files.
- routes/web.php: Defines the web routes for the application.

##### Routes
- GET /login: View the login page.
- POST /login: Login to the application.
- GET /register: View the register page.
- POST /register: Register user.
- POST /logout: logout user.
- POST /dashboard: view dashboard
- POST /file-preview: Preview file before uploading
- GET /cancel_upload: To cancel upload after preview
- POST /upload-file: To upload file after preview
- GET /download-file/{id}: download the uploaded files
- GET /profile: View user profile

##### License
This project is open-sourced software licensed under the MIT license.


### Summary

This `README.md` file provides a comprehensive overview of the project, including installation steps, usage instructions, and important project structure details. It ensures that any developer or user can set up and use the application effectively.
