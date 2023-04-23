
# Public Image Gallery App
This is a project developed as a public image gallery app, where users can view and upload images publicly. The project is developed using Laravel PHP framework, Breeze authentication, Laravel DebugBar for testing and TailwindCSS for styling.

  

## Requirements

- PHP 7.4 or higher

- MySQL 5.7 or higher

- Docker environment

- Composer

- NPM

  

## Installation

  

1. Clone the project from Github 
 `git clone https://github.com/kisnatwari/image-showcase-docker.git` 

3. Navigate to the project directory in terminal 

4. Run `composer install` and `npm install` to install the required packages

5. Include 8 images with naming [defaul1.jpg, default2.jpg, default3.jpg........ default8.jpg] in "storage/app/public/uploads"

6. Migrate the table using `sail artisan migrate` command

7. Seed 3 tables in a sequential manner using the following commands:

- `sail artisan db:seed --class=UsersTableSeeder`

- `sail artisan db:seed --class=PostsTableSeeder`

- `sail artisan db:seed --class=CommentsTableSeeder`

  

## Usage

  

1. Run `sail up` and `npm run dev` command to start the docker environment and start running the application.

2. Access the app at `http://localhost` in a web browser.

  

## Contributing

  

Contributions to the project are welcome. To contribute, please follow the standard Github workflow of forking the project and submitting a pull request.

  

## License

  

This project is licensed under the MIT License - see the LICENSE file for details.