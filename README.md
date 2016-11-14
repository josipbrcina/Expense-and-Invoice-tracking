# Expense and Invoice tracking
- Simple laravel application for tracking Company expenses and invoices

### Installation and setup instructions
1) Clone **this** repo with GIT - `git clone https://github.com/josipbrcina/project.git` or download `.zip` file https://github.com/josipbrcina/project/archive/master.zip
2) Inside project directory run from terminal or cmd `composer install`
3) Create database named `project`
4) Rename `.envexample` file to `.envexample`
4) Change the DB details in the .env file and also in the /config/database.php
5) Inside project directory run from terminal or cmd `php artisan migrate`
6) Inside project directory run from terminal or cmd `php artisan key:generate` 
7) You are done! :) Go to your browser and run application

### Application parts and usage instructions
- Application has login/register form for user authentication 
- After registration > login you go to home/dashboard page
- Application has got Expenses, Companies, Invoices and Chart page

##### 1) Companies page
 - You can create new company clicking on Add new company button
 - After the Company is created it will appear on Companies list 
 - Page has got search engine filtered by OIB and Company name
 - You can Edit Company clicking on Edit button or delete it with Delete button visible on Companies index page
##### 2) Expenses page
- You can create new expense by clicking Add new expense button
- Fill the form with required data and click Create new expense
- After expense is created it will appear on Expenses index list
- Page has got search engine filtered by Company name, Expense start - end date, Amount from-to
- Like companies you can also edit and delete any listed expense

##### 3) Invoices page
- You can create new invoice by clicking Add new invoice button
- Fill the form with required data and click Create new invoice
- After invoice is created it will appear on Invoices index list
- Page has got search engine filtered by Company name, Invoice start - end due date, Amount from-to
- Like companies you can also edit and delete any listed invoice

##### NOTE
- When you delete any Company from Companies page, app will automatically delete expenses and invoices that are related with that Company
  
  
##### 4) Chart page
  - Chart page has got dynamically chart based on User input
  - It shows Expenses and Invoices for selected time range
  - It's also showing report with total number of Expenses and Invoices with calculated difference
  - When chart index page is opened it's showing last 12 months by default

