SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE product_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
);

-- Creating the product table
CREATE TABLE product (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(100),
    name VARCHAR(100),
    type INT,
    description VARCHAR(255),
    image VARCHAR(100),
    price DECIMAL(10, 2),
    additional_price VARCHAR(255),
    schedule VARCHAR(100),
    FOREIGN KEY (type) REFERENCES product_types(id)
);

INSERT INTO product_types (name)
VALUES ('product'),
       ('service');

INSERT INTO `product` (`code`, `name`, `type`, `description`, `image`, `price`, `additional_price`, `schedule`) VALUES
('SW1', 'Sourdough White', '1', 'Our standard sourdough', 'assets/sourdough_white.webp', 7.00, '', ''),
('SR1', 'Sourdough Rye', '1', 'Sourdough created with 50% rye flour', 'assets/sourdough_rye.webp', 8.00, '', ''),
('SS1', 'Sourdough Spelt', '1', 'Sourdough created with 100% spelt flour', 'assets/sourdough_splet.webp', 9.00, '', '' ),
('SS1', 'Sourdough Seeded', '1', 'Sourdough including a mixture of yummy seeds','assets/sourdough_seeded.webp',  9.50, '', ''),
('SMC1', 'Sourdough bread making classes', '2', 'Learn to make your own bread', 'assets/sourdough_making_classes.webp', 350, 'GST.', 'First Saturday of every month 9 am to 5 pm with lunch provided.');