## Laravel REST API
### How to start

1. docker-compose up -d
2. npm install
3. php artisan migrate
4. php artisan db:seed

### Methods

1. GET - localhost/api/movies - show all
2. POST - localhost/api/movies ['name', genre_id, [actors]] - create new
3. GET - localhost/api/movies/ . MovieId - show the movie
4. POST - localhost/api/movies/. MovieId ['_method'(PUT), 'name', genre_id, [actors]] - update the movie
5. POST - localhost/api/movies/ . MovieId ['_method'(DELETE)] - delete the movie
6. GET - localhost/filtered_movies/ [genre_id, [actors]] - filter movies
7. GET - localhost/ordered_movies/ ['order'] - order movies by name
