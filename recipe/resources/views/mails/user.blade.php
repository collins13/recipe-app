<!DOCTYPE html>
<html>
    <head>
        <title>Peter Recipes</title>
    </head>
    <body>
        <h4>Hello {{ $details['name'] }}</h4>
        <p>Here are your logins details</p>
        <ul>
            <li>Email: {{ $details['email'] }}</li>
            <li>Password: {{ $details['password'] }}</li>
        </ul>
        login <a href="{{ url('login') }}">here</a>
    </body>
</html>