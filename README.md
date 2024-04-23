NewsAPI
??? Description
?   ??? NewsAPI is a REST API for managing news, providing features for adding, deleting, and modifying news articles. The main objective is to display the list of news articles in descending order of their publication date, excluding expired news articles.
??? Installation Instructions
?   ??? To set up the NewsAPI application, follow these steps:
?   ?   ??? Run Composer Installation:
?   ?   ?   ??? composer install 
?   ?   ??? Create a MySQL Database:
?   ?   ?   ??? Create a MySQL database named newsdb using your preferred MySQL management tool.
?   ?   ??? Run Migrations: 
?   ?   ?   ??? php artisan migrate 
?   ?   ??? Generate Application Key:
?   ?   ?   ??? php artisan key:generate 
?   ?   ??? Start the Server:
?   ?   ?   ??? php artisan serve 
??? Requirements
?   ??? Laravel 10
?   ??? PHP >= 8.2.12 
??? Routes
?   ??? CreateNew (POST):
?   ?   ??? Description: Creates a new news article.
?   ?   ??? Endpoint: /api/news/create
?   ?   ??? Request Body :
?   ?   ?   ??? {
?   ?   ?   ?   "Titre": "Sample News Title",
?   ?   ?   ?   "Contenu": "Sample News Content",
?   ?   ?   ?   "category_id": 1,
?   ?   ?   ?   "Date_debut": "2024-04-28",
?   ?   ?   ?   "Date_expiration": "2024-05-25",
?   ?   ?   ? }
?   ?   ??? Response: Returns the newly created news article.
?   ??? GetAll (GET):
?   ?   ??? Description: Returns all news articles, including expired ones.
?   ?   ??? Endpoint: /api/news/news
?   ?   ??? Response: Returns a list of news articles.
?   ??? GetLatestNews (GET):
?   ?   ??? Description: Returns only the latest news articles, excluding expired ones.
?   ?   ??? Endpoint: /api/news/getall
?   ?   ??? Response: Returns the latest news articles.
?   ??? GetNewById (GET):
?   ?   ??? Description: Retrieves a news article based on the ID provided in the route.
?   ?   ??? Endpoint: /api/news/getbyid/{id}
?   ?   ??? Response: Returns the news article corresponding to the given ID.
?   ??? EditNew (PUT):
?   ?   ??? Description: Updates an existing news article.
?   ?   ??? Endpoint: /api/news/update/{id}
?   ?   ??? Request Body
?   ?   ?   ??? {
?   ?   ?   ?   "Titre": "New Title",
?   ?   ?   ?   "Contenu": "New Content"
?   ?   ?   ? }
?   ?   ??? Response: Returns the updated news article.
?   ??? DeleteNew (DELETE):
?   ?   ??? Description: Deletes a news article based on the ID provided in the route.
?   ?   ??? Endpoint: /api/news/delete/{id}
?   ?   ??? Response: Returns a success message upon successful deletion.
?   ??? GetWithAllSubCategories (GET):
?   ?   ??? Description: Recursive search that traverses the category tree to find the requested category and retrieve all articles associated with that category and its subcategories.
?   ?   ??? Endpoint: /api/news/getwithSub/{categoryName}
?   ?   ??? Response: Returns a list of news articles associated with the specified category and its subcategories.
