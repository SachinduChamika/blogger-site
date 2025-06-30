
# Neutronix Blog

Neutronix Blog is a versatile platform for sharing insights, stories, tips, and updates across a wide range of topics including technology, lifestyle, travel, health, education, and more. Whether you're a curious reader or a passionate writer, Neutronix Blog offers a space to explore fresh perspectives, spark ideas, and stay informed.



## Features

- Easy-to-use content management
- Responsive design
- Clean and modern user interface
- Search functionality to quickly find content
- Secure user registration and login system

## Installation

Follow these steps to set up the Neutronix Blog project locally:

### Prerequisites

- Install [WAMP](https://www.wampserver.com/en/) or [XAMPP](https://www.apachefriends.org/index.html) to run Apache, PHP, and MySQL on your computer.
- Basic knowledge of using phpMyAdmin or MySQL command line.

### Steps

1. **Download the Project Files**  
   Download or clone the Neutronix Blog project files into your web server’s root folder:  
   - For WAMP: `C:\wamp64\www\neutronix-blog`  
   - For XAMPP: `C:\xampp\htdocs\neutronix-blog`

2. **Start the Server**  
   Open the WAMP/XAMPP control panel and start Apache and MySQL services.

3. **Create the Database**  
   - Open your browser and go to [http://localhost/phpmyadmin](http://localhost/phpmyadmin)  
   - Create a new database named `blogger_site`.

4. **Import the Database Schema and Dummy Data**  
   - Select the `blogger_site` database in phpMyAdmin.  
   - Click on the **Import** tab.  
   - Choose the SQL file (e.g., `dummy-data.sql`) provided in the project folder and import it.

5. **Configure Database Connection**  
   - Open `includes/db-connection.php` in the project folder.  
   - Update the database credentials if needed:
   ```php
   $servername = "localhost";
   $username = "root";
   $password = ""; // Default for WAMP/XAMPP is empty
   $dbname = "blogger_site";
## Usage / Examples

### Site Overview

- The **index page** features a cover section and a search bar for finding blog posts.
- The **blog page** displays all posts in reverse chronological order (newest first) when no search query is provided.
- If a search query is entered, only matching posts are shown based on the keywords or content.

### User Roles & Permissions

- **Visitor / Viewer** (logged in users):  
  - Can browse and read all published blog posts.  
  - Can logout from their account normally.  
  - If banned by an admin, the viewer cannot logout or access the site content.

- **Admin**:  
  - Can create new blog posts.  
  - Can edit or delete existing posts.  
  - Can ban or unban users, controlling their access to the site.  
  - Has full access to site management features.

### How to Use

1. **Register or Login**  
   - Use the registration page to create a new account.  
   - Use the login page to access your account as viewer or admin.

2. **Search Posts**  
   - Use the search bar on the index or blog page to find posts by keywords.

3. **Admin Actions** (if logged in as admin)  
   - Create new posts from the admin dashboard or blog management page.  
   - Edit or delete posts as needed.  
   - Manage user accounts by banning or unbanning users.

4. **Viewer Experience**  
   - Browse posts freely unless banned.  
   - Logout using the logout button.
## Tech Stack

This project is built using the following technologies:

- **HTML5** – Structure and layout of the web pages  
- **CSS3** – Styling and visual design  
- **JavaScript** – Basic interactivity (client-side validation or effects)  
- **PHP** – Server-side scripting for handling logic, authentication, and database operations  
- **MySQL** – Relational database used for storing users and blog content  
- **WAMP Server** – Local development environment that includes Apache (web server), MySQL (database), and PHP (backend language)

## License

MIT License

Copyright (c) 2025 Neutronix

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
## Author

- **Sachindu Chamika** – *Sole Designer & Developer*  
  [GitHub](https://github.com/SachinduChamika)  
  [Email](mailto:sachinduc2008@gmail.com)
## Acknowledgements

- Thanks to the developers of [WAMP Server](https://www.wampserver.com/) for providing a robust local server environment.
- Icons and illustrations from [Unsplash](https://unsplash.com/) and [Font Awesome](https://fontawesome.com/).
- Inspired by various open-source blog platforms and community tutorials.
