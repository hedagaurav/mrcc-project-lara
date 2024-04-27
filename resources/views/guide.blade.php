<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Guide</title>
</head>

<body>

    <h4>Steps to run project:</h4>
    <ol>
        <li>Download the project.</li>
        <li>Open the project folder in the terminal/cmd and run command <b>composer install</b></li>
        <li>Create the database with name <b>mrcc-project-lara</b></li>
        <li></li>
        <li>Open the project folder in the terminal/cmd and run command <b>php artisan migrate</b></li>
        <li>Run command in terminal/cmd <b>php artisan serve</b></li>
    </ol>

    <h4>Tables – </h4>
    <p>Project (Project Code, Project Name)</p>
    <p>Task (Task Name, Task Hours)</p>

    <p>Details – </p>
    <ol>
        <li>Create Tables as mentioned above</li>
        <li>All the data is required, and Project Code cannot be duplicate</li>
        <li>Create a screen with Add/Edit form to capture Project and Tasks details</li>
        <li>There should be option to add multiple Tasks for each project and can Edit/Delete</li>
        <li>Once the form is submitted, it should navigate to the list screen</li>
        <li>There should be an option to filter the project based on name and code</li>
    </ol>

    <table>
        <tr>
            <th>Project Code</th>
            <th>Project Name</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>123456</td>
            <td>Project 1</td>
        </tr>
        <tr>
            <td></td>
            <td>Task 1 – 8 hours</td>
        </tr>
        <tr>
            <td></td>
            <td>Task 2 – 4 hours</td>
        </tr>
        <tr>
            <td>234567</td>
            <td>Project 2</td>
        </tr>
        <tr>
            <td></td>
            <td>Task 1 – 2 hours</td>
        </tr>
    </table>
</body>

</html>