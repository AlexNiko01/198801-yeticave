-- Напишите запросы для добавления информации в БД:
-- Существующий список категорий
INSERT INTO `categories`(`name`) VALUES ('Доски и лыжи'), ('Крепления'), ('Ботинки'), ('Одежда'), ('Инструменты'), ('Разное')

-- Существующий список пользователей
INSERT INTO `users`(`name`, `email`, `password`) VALUES ( 'Игнат','ignat.v@gmail.com','$2y$10$OqvsKHQwr0Wk6FMZDoHo1uHoXd4UdxJG/5UDtUiie00XaxMHrW8ka'),
('Леночка','kitty_93@li.ru','$2y$10$bWtSjUhwgggtxrnJ7rxmIe63ABubHQs0AS0hgnOo41IEdMHkYoSVa'), ('Руслан','warrior07@mail.ru','$2y$10$2OxpEH7narYpkOT1H5cApezuzh10tZEEQ2axgFOaKW.55LxIJBgWW')

-- Список объявлений
INSERT INTO `lots`(`title`, `photo`, `start_price`, `category_id`) VALUES
( '2014 Rossignol District Snowboard' , 'img/lot-1.jpg', '10999', 1),
( 'DC Ply Mens 2016/2017 Snowboard' , 'img/lot-2.jpg', '15999', 1),
( 'Крепления Union Contact Pro 2015 года размер L/XL' , 'img/lot-3.jpg', '8000', 2),
( 'Ботинки для сноуборда DC Mutiny Charocal' , 'img/lot-4.jpg', '10999', 3),
( 'Куртка для сноуборда DC Mutiny Charocal' , 'img/lot-5.jpg', '7500', 4),
( 'Маска Oakley Canopy' , 'img/lot-6.jpg', '5400', 6)

-- Добавьте пару ставок для любого объявления
INSERT INTO `rates`(`date`, `price`, `user_id`, `lot_id`) VALUES ('2017-01-01 00:00:00','9999','1','1')



-- получить список из всех категорий;
SELECT * FROM `categories`

-- получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, количество ставок, название категории;

$products = select_data($mysqliConnect, "SELECT lots.id, lots.title, lots.start_price, lots.photo, lots.favourite_count, lots.category_id, categories.name AS cat FROM lots LEFT JOIN categories ON categories.id=lots.category_id WHERE expire_date > NOW()  ORDER BY lots.id ASC");

-- найти лот по его названию или описанию;
SELECT * FROM `lots` WHERE title = 'Маска Oakley Canopy' OR description = 'Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив снег мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот снаряд отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом кэмбер позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется, просто посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла равнодушным.'

-- обновить название лота по его идентификатору;
UPDATE `lots` SET title = 'test' WHERE id = 1

-- получить список самых свежих ставок для лота по его идентификатору;
SELECT * FROM rates WHERE id = 3 ORDER BY id DESC LIMIT 6