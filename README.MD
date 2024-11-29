# Web sport app #

<p align="center">
   <strong>A website made in Symfony to manage sport event participation</strong><br />
</p>

## Prerequisites for use 🛠️

- NONE

## Prerequisites for installation 🛠️

- PHP 8.0.X
- MariaDB 10.10.X
- Symfony 7.0.1
- Composer

## How to Run the Project ▶️

1. Clone this repository to your local machine.
2. Modify your database connection information (`./.env -> DATABASE_URL`).
3. Run `composer install` to initialize the project.
4. Run `php bin/console doctrine:migrations:migrate` to create the database schema.
5. Load the data fixtures with `php bin/console doctrine:fixtures:load`.
6. Start the Symfony server with `symfony server:start -d`.

## Authors ✨

[@Nikoolaii](https://github.com/Nikoolaii)

## License 📄

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.