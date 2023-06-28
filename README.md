# freteRapido
Project realized for Frete Rápido testing. The purpose of the directory is to build a Rest API for external queries that return only the requested values.

Necessary to install locally:

1. Php 8.0
2. FrameWork Laravel
3. Docker Compose
4. Mysql
5. Postman

   
I chose to have two types of DockerFile because being in different places one will not be affected by the other.
The project is not complete because I had difficulty in some parts, but quickly explaining what was done:

I created a Model called Price, it shows a small table that shows us the name of the service provider operator, the type of service, price and value. Declared with $fillable for 'mass content'.

Then a file was created in the Migration folder called FareTable, with it we can create a table in our MYSQL Database.

With our edited FareTable we can configure the routes. I created the FareController file, which as the name says, it gives the correct direction for our Api to be able to be located.
