CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Student'),
(2, 'Pracownik');

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `number_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `birth_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `users` (`id`, `role_id`, `number_id`, `name`, `surname`) VALUES
(1, 1, 95021101295, 'Marcin', 'Krasucki'),
(2, 2, 96031201294, 'Ferdynand', 'Kiepski');
