-- adding categories:
INSERT INTO `categories`(`name`) VALUES ('Доски и лыжи'), ('Крепления'), ('Ботинки'), ('Одежда'), ('Инструменты'), ('Разное')

-- adding users:
INSERT INTO `users`(`name`, `email`, `password`) VALUES ( 'Игнат','ignat.v@gmail.com','$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'),
('Леночка','kitty_93@li.ru','$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa'), ('Руслан','warrior07@mail.ru','$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW')

-- adding lots
INSERT INTO `lots`(`title`, `photo`, `start_price`) VALUES ( '2014 Rossignol District Snowboard' , 'img/lot-1.jpg', '10999'),
( 'DC Ply Mens 2016/2017 Snowboard' , 'img/lot-2.jpg', '15999'),
( 'Крепления Union Contact Pro 2015 года размер L/XL' , 'img/lot-2.jpg', '15999'),

-- adding rates
INSERT INTO `rates`(`date`, `price`, `user_id`, `lot_id`) VALUES ('1505300969','9999','5','7' ),