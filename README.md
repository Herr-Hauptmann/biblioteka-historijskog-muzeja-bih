
# Library for the History Museum of Bosnia and Herzegovina

This thesis describes the development of a web application for the Library of the Historical Museum of Bosnia and Herzegovina using Laravel, Inertia.js, Vue.js, and Tailwind. The application aims to provide the public with information about the books offered by the Museum Library, as well as news, library usage rules, and publications. Close collaboration with the Historical Museum of Bosnia and Herzegovina ensured that the application met all the needs and requirements of its users. Agile methodology was applied for efficient communication and rapid response to client's changing requirements, resulting in an outstanding product that satisfied all client's demands. The final product allows users to search the Library's catalog by authors, titles, and keywords, and to view publications, news, and library rules. The use of the mentioned technologies enabled fast and efficient development, easy maintenance, and scalability of the application. A modern and intuitive user interface was implemented, enhancing the user experience with dynamic and interactive features provided by Vue.js. Tailwind was used for styling, allowing easy customization of the appearance and behavior of elements. Laravel facilitated easy integration with the database and the use of best practices for data protection. Inertia.js enabled swift page transitions and quick response to user actions. In conclusion, the construction of this application for the Museum Library of Bosnia and Herzegovina was successful due to the close collaboration with the client and the application of agile methodology. The implementation of Vue.js, Tailwind, Inertia.js, and Laravel allowed for the creation of a fast, secure, and reliable web application that met the client's needs and requirements. The application has improved access to the Library's publications and enhanced communication with its users.

## Prerequisites

- **XAMPP:** Make sure you have XAMPP installed on your system. You can download it from the [official website](https://www.apachefriends.org/index.html).
- **Composer:** Laravel requires Composer to manage its dependencies. If you haven't already installed Composer, you can download it from [getcomposer.org](https://getcomposer.org/).

## Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/Herr-Hauptmann/biblioteka-historijskog-muzeja-bih
   ```

2. **Navigate to the project directory**

   ```bash
   cd biblioteka-historijskog-muzeja-bih
   ```

3. **Install dependencies**

   ```bash
   composer install
   ```

4. **Create a copy of the .env file**

   ```bash
   cp .env.example .env
   ```

5. **Generate an application key**

   ```bash
   php artisan key:generate
   ```

6. **Create a new database**

   Open XAMPP and start Apache and MySQL. Then, open phpMyAdmin in your browser (usually accessible at `http://localhost/phpmyadmin`) and create a new database for your Laravel project.

7. **Update the .env file**

   Open the `.env` file in your project directory and set the `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` variables to match the credentials of the database you just created.

   ```plaintext
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

8. **Run the database migrations (optional)**

   Run the following commands to start the migrations and seed the database:

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

9. **Compile assets with Vite**

   ```bash
   npm run dev
   ```

10. **Start the Laravel development server**

   ```bash
   php artisan serve
   ```

   The project should now be accessible at `http://localhost:8000`.

## Usage

Provide instructions on how to use your Laravel project, including any available routes, features, and how to access them.

## Contributing

If you have suggestions for improvements or bug fixes, feel free to contribute by following these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your_feature_name`).
3. Make your changes and commit them (`git commit -am 'Add some feature'`).
4. Push to the branch (`git push origin feature/your_feature_name`).
5. Create a new pull request.
