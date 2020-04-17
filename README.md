![Symfony_logo](https://lineadecodigo.com/wp-content/uploads/2019/04/symfony.png) 

# Symfony Documentation

*First of all we need to setup and install the symfony framework.*

1. We must run the following command to check out the requirements: 

> symfony check:requirements

2. Let's create our application:

#### We need to open our console terminal and run the following command to create a new Symfony application ( a traditional web application):

 > symfony new my_project_name --full

this command will create new folders and files in our project file. 
The --full option installs all the packages that you usually need to build web applications, so the installation size will be bigger.

Now to create our application we will also need the **Composer** so for that we will run the next command:

> composer create-project symfony/website-skeleton my_project_name

Now let’s check out if our app is running fine:

 > cd my-project

 > symfony server:start


If everything goes ok then we will see the **"Welcome to symfony"** quote in our browser:

![Welcome](/images/welcome.png)

A common practice when developing Symfony applications is to install packages (Symfony calls them bundles) that provide ready-to-use features.

Composer commands to provide advanced features so let’s run the next two commands:

 > cd my-project/
 > composer require logger

Up to this point we have you basic application running. Now our next step will be to install the **Doctrine ORM** tool of symfony.
 
## Doctrine

1. First, install Doctrine support via the orm Symfony pack, as well as the MakerBundle, which will help generate some code:

 > composer require symfony/orm-pack
 > composer require --dev symfony/maker-bundle

After this step we need to **configure the database**. The database connection information is stored as an environment variable called **DATABASE_URL**. For development, you can find and customize this inside **.env** file:

![.env folder](/images/env.png)

Inside this file (at very bottom) we need to customize the following line:

![inside-envFolder](/images/database.png)
	 
We need to enter the information of our database: user, password and the database name.

for example:

DATABASE_URL="mysql://root:1234@127.0.0.1:3307/symfony"

2. Now let’s create our database:

> php bin/console doctrine:database:create

3. Next step is to create an entity class. We can use the make:entity command to create this class and any fields we need. The command will ask us some questions - answer them like done below:

![product entity](/images/product.png)

4. The **Product class** is fully-configured and ready to save to a product table. To migrate it we use the next command:

> php bin/console make:migration


But what if you need to add a new field property to Product, like a description? You can edit the class to add the new property. But, you can also use make:entity again and fill the information as we did before.

The migration system is smart. It compares all of your entities with the current state of the database and generates the SQL needed to synchronize them! Like before, execute your migrations:

> php bin/console doctrine:migrations:migrate

And we can see the changes in our database that it has create a table named “product”. This table shows null values for every entity because we haven't saved any values yet.

![Tables in MySQL](/images/tables.png)

## Persisting Objects to the Database:

It's time to save a Product object to the database! Let's create a new controller to experiment:

> php bin/console make:controller ProductController

And to see the result let’s try it on browser: 127.0.0.1:8000/product

![productTable in browser](/images/product_in_browser.png)

Now we can start to code our application! 

