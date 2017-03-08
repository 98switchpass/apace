# Tutorial

### Hello World
Let's create a Hello World application. 
First make sure you have followed the installation instructions under 'Getting started - Installation' 
here: https://github.com/apacedev/apace/blob/master/README.md .

**Open up your preferred text-editor and open up your Apace framework installation.**

First, from your root folder, navigate to application/app/view and open up layout.php.
This is the default master template for all your views, so all your views will automatically be rendered inside this layout.

**Update the file so it look's like this:**

```
<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Apace</title>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'  />

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">

	<link href="<?=Apace::getDataUrl('css/minified');?>layout.css" rel="stylesheet"/>
	<link href="<?=Apace::getDataUrl('css/lib');?>apacegrid.css" rel="stylesheet"/>

</head>

<body>

	<h1>Welcome to Apace MVC!</h1>
	<?=$data['content']?>
		
	<script type="text/javascript" src="<?=Apace::getDataUrl('js/minified');?>app.js"></script>
```

*Maybe you've noticed that there is no closing ```</body>``` and ```</html>``` tag, this is because the Apace framework automatically generates
these tags, so a Apace layout should never contain these two closing tags.*

From your root folder, navigate to application/app/controller and open up IndexController.php. 
Add the following line in the index function: $this->setViewData('myvariable', 'Hello World');

**Your IndexController will now look like this:**

```
<?php

class IndexController extends Controller {

	public function index() {
		$this->setViewData('myvariable', 'Hello World');
	}

}
```

Now, let's pass this viewdata to the IndexController's corresponding view and show it.

From your root folder, navigate to application/app/view. Open up 'index' folder and the open the file index.php.
*The 'index' folder corresponds to the controllers name and the index.php file corresponds to the controllers function.*

Inside index.php, delete everything that is already there and instead add this line: 
```<?php echo $data['myvariable']; ?>```

Now open up your application in the browser, for example ```http://apace.local```. 
You will see the Hello World text that you set inside your controller.

### Creating a database connection

Navigate to engine/settings and open up the local.ini file, it looks something like this:

```
[server]
timezone = "Europe/Stockholm"

[database]
host = "localhost"
user = ""
password = ""
db = ""

[domainmapping]
http://apace.local/ = "app"

[subdomainmapping]
http://apace.local/ap-admin/ = "ap-admin"
```

Under the [database] section, add your username and password credentials to your database and select the database to connect to.

That's it, now you can connect to your database using the built in database connection in the framework. Now create a table in your database called 'user' and add one column called 'username' to the table.

Open up IndexController.php again, and add this line:

```
$results = Apace::$db->query('SELECT * FROM user);

foreach ($results as $result) {
      echo $result[username];
}
```

This will connect to your database with the credentials you specified and select and display all data from your 'user' table.

### Adding css
Now, let's add some basic minified css to our application. For this, we will use the Apace MVC environment CLI which is super easy to use.
The Apace MVC environment CLI currently only works for windows.

From your root folder, navigate to engine/environment and run ApaceCLI.bat by double clicking it.
The Apace MVC environment CLI will ask us which application we want to work with, and since we're currently working with the application
called 'app', simply type 'app' in the command line and press enter.

From your root folder navigate to data/appdata/css and open the file layout.less.

**Add this line to the file and click save:**

```
body {
	background-color: #CCC;
}
```

Open up the Apace MVC environment CLI you started earlier and you will see that it has automatically compiled and minified your layout.less file, 
it is located in minfied/css/layout.css. Open up your browser again and visit your applications url, you can see that the background of your application 
is now gray.

Tip: The Apace MVC environment CLI also monitors and autocompiles all your javascript files, so if you want to add minfied javascript
to your application just open up data/appdata/js and open the file app.js, it will be minfied automatically as you save to the minified 
folder inside data/appdata/js.