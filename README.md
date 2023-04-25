
  

  

# Public Image Gallery App

  

  

This is a project developed as a public image gallery app, where users can view and upload images publicly. The project is developed using Laravel PHP framework, Breeze authentication, Laravel DebugBar for testing and TailwindCSS for styling.

  

  

### Requirements:

  

- You Just need Laravel and Docker compatible environment in your pc

  

## Installation

  

  

1. Clone the project from Github: `git clone https://github.com/kisnatwari/image-showcase-docker.git`

2. Navigate to the project directory in terminal

3. Copy and paste .env.example file and rename it to .env

4. Now, configure database details from new .env file.

5. and change host to `mysql` from `http://127.0.0.1:8000`

6. Run `sail composer install` and `sail npm install` to install the required packages.

7. Include 8 images with naming [`default1.jpg`, `default2.jpg`, `default3.jpg`, `default4.jpg`, `default5.jpg`, `default6.jpg`, `default7.jpg`, `default8.jpg`] in "storage/app/public/uploads".

8. Migrate the table using `sail artisan migrate` command.

9. Seed 3 tables in a sequential manner using the following commands:

  

- `sail artisan db:seed --class=UsersTableSeeder`

  

- `sail artisan db:seed --class=PostsTableSeeder`

  

- `sail artisan db:seed --class=CommentsTableSeeder`

  

  

## Usage

  

  

1. Run `sail up` and `sail npm run dev` command to start the docker environment and start running the application.

  

  

2. Access the app at `http://localhost` in a web browser.

  

  

## Contributing

  

  

Contributions to the project are welcome. To contribute, please follow the standard Github workflow of forking the project and submitting a pull request.

  

  

## License

  

  

This project is licensed under the MIT License - see the LICENSE file for details.