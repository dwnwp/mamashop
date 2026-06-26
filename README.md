# MamaShop

MamaShop is an e-commerce website for instant noodles. This project is built using PHP, MySQL, HTML, CSS, and JavaScript.

## Project Structure

- `pages/`: Contains all the UI pages (e.g., `home.php`, `brand-mama.php`, `login.php`). These are the pages the user interacts with.
- `actions/`: Contains all the backend PHP scripts that process form submissions, handle database interactions, and perform logic (e.g., `login-db.php`, `add-product-db.php`). After processing, these scripts typically redirect the user back to the appropriate page in the `pages/` directory.
- `css/`, `img/`, `js/`: Static assets (stylesheets, images, and javascript files).

## Requirements

- A web server with PHP support (e.g., XAMPP, WAMP, LAMP).
- MySQL database.

## Setup Instructions

1. **Clone the Repository**: Clone this source code into your web server's document root.
2. **Database Setup**:
   - Create a MySQL database (e.g. `mamashop`).
   - Open the `config.php` file in the root of the project and ensure the database connection details are correct for your local setup. Default XAMPP settings are usually:
     ```php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "mamashop";
     ```
   - Import the database schema and sample data by an SQL dump in `sample_database/shoppingcart.sql`
3. **Running the Application**:
   - Start your Apache and MySQL services in your web server control panel (e.g., XAMPP Control Panel).
   - Open your web browser and go to `http://localhost/MamaShop/`.
   - To access the admin section, you can navigate to `http://localhost/MamaShop/pages/admin-menu.php`.
