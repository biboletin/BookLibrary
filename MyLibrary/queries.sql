CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(45) NULL,
    `first_name` VARCHAR(50) NULL,
    `last_name` VARCHAR(50) NULL,
    `password` VARCHAR(123) NULL,
    `email` VARCHAR(45) NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX (`email`)
)  ENGINE=INNODB DEFAULT CHARACTER SET=UTF8;

CREATE TABLE IF NOT EXISTS `books` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `book_name` VARCHAR (255) NOT NULL,
    `book_isbn` VARCHAR (20) NOT NULL,
    `book_year` YEAR NOT NULL,
    `book_description` TEXT NOT NULL,
    `user_id` INT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = INNODB ;

