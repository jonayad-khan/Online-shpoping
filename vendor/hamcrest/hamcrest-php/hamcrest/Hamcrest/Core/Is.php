<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>JavaScript Basic</title>
    </head>
    
    <body>
        <table border="1">
            <tr>
                <td>First Name</td>
                <td><input type="text" name="first_name" id="first_name" ></td>
            </tr>
              <tr>
                <td>Last Name</td>
                <td><input type="text" name="last_name" id="last_name"></td>
              <hr>
            </tr>
        </table>
        
        <hr>
        
        
        <table border="1">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Full Name</th>
            </tr>
            <tr>
                <td id="putFirstName"></td>
                <td id="putLastName"></td>
                <td id="putFullName" o></td>
            </tr>
        </table>
        
                

        
        
        <script>
         
            
            var fElement = document.getElementById('first_name');
            
            fElement.onkeyup = function(){
               var fValue = document.getElementById('first_name').value;
               document.getElementById('putFirstName').innerHTML = fValue;
            }
            
             var lElement