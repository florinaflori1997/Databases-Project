DROP DATABASE movie_database;
CREATE DATABASE movie_database;
-- -----------------------------------------------------------------------------
CREATE TABLE `users` (
  `user_id` int(10) AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  CONSTRAINT user_id_pk PRIMARY KEY (`user_id`)
);
-- -----------------------------------------------------------------------------
CREATE TABLE `movies` (
  `movie_id` int(10) AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `genre_id` int(10),
  `year` int(4),
  `timing` varchar(10),
  `country_id` int(10),
  `review` varchar(500),
  `user_id` int(10) NOT NULL,
  `photo_id` int(10),
  CONSTRAINT movie_id_pk PRIMARY KEY (`movie_id`),
  CONSTRAINT photo_id_uk UNIQUE (`photo_id`),
  CONSTRAINT year_ck CHECK (`year` < 9999)
);
-- -----------------------------------------------------------------------------
CREATE TABLE `genres` (
  `genre_id` int(10) AUTO_INCREMENT,
  `genre_name` varchar(25),
  CONSTRAINT genre_id_pk PRIMARY KEY (`genre_id`)
);
-- -----------------------------------------------------------------------------
CREATE TABLE `countries` (
  `country_id` int(10) AUTO_INCREMENT,
  `country_code` varchar(2),
  `country_name` varchar(50),
  CONSTRAINT country_id_pk PRIMARY KEY (`country_id`)
);
-- -----------------------------------------------------------------------------
CREATE TABLE `photos` (
  `photo_id` int(10) AUTO_INCREMENT,
  `photo_url` varchar(500),
  CONSTRAINT review_id_pk PRIMARY KEY (`photo_id`)
);
-- -----------------------------------------------------------------------------
INSERT INTO `users` (`username`, `password`,`email`) VALUES
('adminflorina', 'admin', 'florina_bj@yahoo.com'),
('frentescumaria', 'mariaDB', 'maria_frentescu97@yahoo.com'),
('lucateodora', 'teutzano1', 'luca.teodora.stefania@gmail.com');
-- --------------------------------------------
INSERT INTO `movies` (`title`, `genre_id`, `year`, `timing`, `country_id`, `review`, `user_id`, `photo_id`) VALUES
('Toy Story 4', 3, 2019, '89', 231, 'Great', 1, 1),
('Forrest Gump', 8, 1994, '142', 231, 'Fantastic', 3, 2),
('The Lord of the Rings: The Fellowship of the Ring', 2, 2001, '178', 231, 'WOW', 2, 3),
('Titanic', 8, 1997, '194', 231, '*Tear*', 1, 4),
('Slumdog Millionaire', 8, 2008, '120', 230, '$$$', 1, 5);
-- --------------------------------------------
INSERT INTO `genres` (`genre_name`) VALUES
('Action'),
('Adventure'),
('Animation'),
('Biography'),
('Comedy'),
('Crime'),
('Documentary'),
('Drama'),
('Family'),
('Fantacy'),
('Musical'),
('Mystery'),
('Romance'),
('Short'),
('Thriller'),
('War'),
('Western');
-- --------------------------------------------
INSERT INTO `photos` (`photo_url`) VALUES
('https://upload.wikimedia.org/wikipedia/en/4/4c/Toy_Story_4_poster.jpg'),
('https://i.pinimg.com/originals/56/28/de/5628de60c9f5bd8f1eb26f350c4ce6d0.jpg'),
('https://m.media-amazon.com/images/M/MV5BN2EyZjM3NzUtNWUzMi00MTgxLWI0NTctMzY4M2VlOTdjZWRiXkEyXkFqcGdeQXVyNDUzOTQ5MjY@._V1_.jpg'),
('https://images-na.ssl-images-amazon.com/images/I/71Ik6TBZyGL.jpg'),
('https://developmenteducation.ie/app/uploads/2017/02/slumdog-millionaire-1412799096.jpg');
-- -----------------------------------------------------------------------------
ALTER TABLE `movies`
ADD CONSTRAINT genre_id_fk FOREIGN KEY (`genre_id`) REFERENCES genres (`genre_id`),
ADD CONSTRAINT user_id_fk FOREIGN KEY (`user_id`) REFERENCES users (`user_id`),
ADD CONSTRAINT photo_id_fk FOREIGN KEY (`photo_id`) REFERENCES photos (`photo_id`);
-- --------------------------------------------
