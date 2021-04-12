
--
-- Database: `demo` and php web application user
CREATE DATABASE sergeMart;
GRANT USAGE ON *.* TO 'serge'@'localhost' IDENTIFIED BY 'root';
GRANT ALL PRIVILEGES ON sergeMart.* TO 'serge'@'localhost';
FLUSH PRIVILEGES;

USE sergeMart;
--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int(10) NOT NULL,
  `rating` int(10) NOT NULL,
  `description` varchar(500) NOT NULL,
  `thumbnail` varchar(100) NOT NULL,
  `pictures` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `products` (`id`, `name`, `price`, `rating`, `description`,
`thumbnail`,  `pictures`, `category`) VALUES
(2, 'Ray-Ban', 50, 4, "Get that special game day look.
The unlocked PG 5 By You gives you the freedom to create left and
right shoes independently for a totally custom pair. Graphics that nod to PG's love of fishing and the outdoors.",
'ray1.png', 'suit.png', 'clothes');

