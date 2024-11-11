-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 07:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE TABLE `author` (
  `AuthorID` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `AuthorName` varchar(255) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `book` (
  `BookISBN` varchar(255) PRIMARY KEY NOT NULL,
  `BookName` varchar(255) NOT NULL,
  `CoverPicture` varchar(255) NOT NULL,
  `PublishedYear` year(4) NOT NULL,
  `AuthorID` int(11) NOT NULL,
  `PageCount` int(11) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `ReadingLink` varchar(255) DEFAULT NULL,
  `AvailableCount` int(11) NOT NULL,

  KEY `AuthorID` (`AuthorID`),

  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`AuthorID`) REFERENCES `author` (`AuthorID`) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `genre` (
  `GenreID` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `GenreName` varchar(255) NOT NULL,
  `Decription` varchar(255) DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `user` (
  `UserID` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `UserIcon` varchar(255) NOT NULL,
  `UserPermissionLevel` int(11) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL UNIQUE,
  `Email` varchar(32) NOT NULL UNIQUE,

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `bookgenre` (
  `BookGenreID` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `BookISBN` varchar(255) NOT NULL,
  `GenreID` int(11) NOT NULL,

  KEY `BookISBN` (`BookISBN`),
  KEY `GenreID` (`GenreID`),

  CONSTRAINT `bookgenre_ibfk_1` FOREIGN KEY (`GenreID`) REFERENCES `genre` (`GenreID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bookgenre_ibfk_2` FOREIGN KEY (`BookISBN`) REFERENCES `book` (`BookISBN`) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `bookmarkedbook` (
  `BookmarkedBookID` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `BookISBN` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Page` int(11) NOT NULL,
  `DateCreated` date NOT NULL,

  KEY `BookISBN` (`BookISBN`),
  KEY `UserID` (`UserID`),

  CONSTRAINT `bookmarkedbook_ibfk_1` FOREIGN KEY (`BookISBN`) REFERENCES `book` (`BookISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bookmarkedbook_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `borrowhistory` (
  `BorrowID` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `UserID` int(11) NOT NULL,
  `BookISBN` varchar(255) NOT NULL,
  `BorrowDate` date NOT NULL,
  `ReturnDate` date DEFAULT NULL,
  `LateFees` decimal(10,2) DEFAULT NULL,

  KEY `UserID` (`UserID`),
  KEY `BookISBN` (`BookISBN`),

  CONSTRAINT `borrowhistory_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `borrowhistory_ibfk_2` FOREIGN KEY (`BookISBN`) REFERENCES `book` (`BookISBN`) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `favourites` (
  `FavouritesID` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `UserID` int(11) NOT NULL,
  `BookISBN` varchar(255) NOT NULL,

  KEY `UserID` (`UserID`),
  KEY `BookISBN` (`BookISBN`),

  CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`BookISBN`) REFERENCES `book` (`BookISBN`) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `following` (
  `FollowingID` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `UserID` int(11) NOT NULL,
  `AuthorID` int(11) DEFAULT NULL,
  `FollowingUserID` int(11) DEFAULT NULL,

  KEY `UserID` (`UserID`),
  KEY `AuthorID` (`AuthorID`),
  KEY `FollowingUserID` (`FollowingUserID`),

  CONSTRAINT `following_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `following_ibfk_2` FOREIGN KEY (`AuthorID`) REFERENCES `author` (`AuthorID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `following_ibfk_3` FOREIGN KEY (`FollowingUserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `rating` (
  `RatingID` int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `UserID` int(11) NOT NULL,
  `BookISBN` varchar(255) NOT NULL,
  `Stars` int(11) NOT NULL,
  `Comments` varchar(255) DEFAULT NULL,
  `DateTimeCreated` datetime NOT NULL,

  KEY `UserID` (`UserID`),
  KEY `BookISBN` (`BookISBN`),

  CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`BookISBN`) REFERENCES `book` (`BookISBN`) ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `author` (`AuthorID`, `AuthorName`) VALUES
(1, 'F. Scott Fitzgerald'),
(2, 'Harper Lee'),
(3, 'Frank Herbert'),
(4, 'George Orwell'),
(5, 'Dante Alighieri'),
(6, 'Fyodor Dostoevsky'),
(7, 'J. K. Rowling'),
(8, 'Barry A. Burd'),
(9, 'Stephen R. Davis'),
(10, 'Richard Blum'),
(11, 'Janet Valade'),
(12, 'Stef Maruch'),
(13, 'Dan Gookin'),
(14, 'Allen G. Taylor');

INSERT INTO `book` (`BookISBN`, `BookName`, `CoverPicture`, `PublishedYear`, `AuthorID`, `PageCount`, `Description`, `ReadingLink`, `AvailableCount`) VALUES
('0470317264', 'C++ for Dummies', 'https://librarycatalogue.com/books/c++-for-dummies-cover', '2009', 9, 402, 'C++ For Dummies, 6th Edition, helps you understand C++ programming. It\'s full of examples to show you how things work, and explains the why so you understand how the pieces fit together.', 'https://librarycatalogue.com/books/c++-for-dummies/1', 2),
('0470467010', 'Linux for Dummies', 'https://librarycatalogue.com/images/linux-for-dummies-cover9', '2009', 10, 456, 'If you\'ve been wanting to migrate to Linux, this book is the best way to get there.', 'https://librarycatalogue.com/books/linux-for-dummies/1', 5),
('0470527587', 'PHP & MySQL for Dummies', 'https://libraraycatalogue.com/images/php-&-mysql-for-dummies-cover4', '2009', 11, 464, 'Here\'s what Web Designers need to know to create dynamic, database-driven Web sites\r\nTo be on the cutting edge, Web sites need to serve up HTML, CSS, and products specific to the needs of different customers using different browsers.', 'https://librarycatalogue.com/books/php-&-mysql-for-dummies/1', 4),
('0471778648', 'Python for Dummies', 'https://librarycatalogue.com/images/python-for-dummies-cover1', '2006', 12, 432, 'Python For Dummies is a guide to learning the ins & outs of this program. This hands-on book will show you how to build programs, debug code, simplifying development, and defining what actions it can perform.', 'https://librarycatalogue.com/books/python-for-dummies/1', 5),
('0764570684', 'C for Dummies', 'https://librarycatalogue.com/images/c-for-dummies-cover', '2004', 13, 408, 'After digesting C For Dummies, 2nd Edition, you’ll understand it. C programs are fast, concise and versatile. They let you boss your computer around for a change.', 'https://librarycatalogue.com/books/c-for-dummies/1', 3),
('1118607961', 'SQL for Dummies', 'https://librarycatalogue.com/images/sql-for-dummies-cover2', '2013', 14, 460, 'This fun and friendly guide will help you demystify database management systems so you can create more powerful databases and access information with ease.', 'https://librarycatalogue.com/books/sql-for-dummies/1', 3),
('1119235553', 'Java for Dummies', 'https://librarycatalogue.com/images/java-for-dummies-cover', '2017', 8, 504, 'If you want to learn to speak the world’s most popular programming language like a native, Java For Dummies is your ideal companion. With a focus on reusing existing code, it quickly and easily shows you how to create basic Java objects, work with Java...', 'https://librarycatalogue.com/books/java-for-dummies/1', 3),
('1408855666', 'Harry Potter and the Chamber of Secrets', 'https://librarycatalogue.com/images/harry-potter-chamber-of-secrets-cover7', '2014', 7, 384, 'Harry Potter’s summer has included the worst birthday ever, doomy warnings from a house-elf called Dobby and rescue from the Dursleys by his friend Ron Weasley in a magical flying car! Back at Hogwarts School of Witchcraft and Wizardry for his second...', 'https://librarycatalogue.com/books/harry-potter-chamber-of-secrets/1', 1),
('1408855674', 'Harry Potter and the Prisoner of Azkaban', 'https://librarycatalogue.com/images/harry-potter-prisoner-of-azkaban-cover7', '2014', 7, 480, 'Loved by millions of readers worldwide, let the third story in the greatest children\'s book series of all time take you on an unforgettable journey. The hope and wonder of Harry Potter\'s world will make you want to escape to Hogwarts again and again...', 'https://librarycatalogue.com/books/harry-potter-prisoner-of-azkaban/1', 2),
('1408855682', 'Harry Potter and the Goblet of Fire', 'https://librarycatalogue.com/images/harry-potter-goblet-of-fire-cover7', '2014', 7, 640, 'Loved by millions of readers worldwide, let the fourth story in the greatest children\'s book series of all time take you on an unforgettable journey. The hope and wonder of Harry Potter\'s world will make you want to escape to Hogwarts again and again...', 'https://librarycatalogue.com/books/harry-potter-goblet-of-fire/1', 1),
('1408855712', 'Harry Potter and the Deathly Hallows', 'https://librarycatalogue.com/images/harry-potter-deathly-hallows-cover7', '2014', 7, 640, 'Loved by millions of readers worldwide, let the seventh story in the greatest children\'s book series of all time take you on an unforgettable journey. The hope and wonder of Harry Potter\'s world will make you want to escape to Hogwarts again and again...', 'https://librarycatalogue.com/books/harry-potter-deathly-hallows/1', 0),
('1435170512', 'The Great Gatsby', 'https://librarycatalogue.com/images/the-great-gatsby-cover12', '1925', 1, 208, 'The Great Gatsby tells the story of Jay Gatsby, a self-made millionaire, and his pursuit of Daisy Buchanan, a wealthy young woman whom he loved in his youth. Set in 1920s New York, the book is narrated by Nick Carraway.', 'https://librarycatalogue.com/books/the-great-gatsby/1', 5),
('9780060935467', 'To Kill A Mockingbird', 'https://librarycatalogue.com/images/to-kill-a-mockingbird-cover1', '1960', 2, 336, 'To Kill a Mockingbird is a 1961 novel by Harper Lee. Set in small-town Alabama, the novel is a bildungsroman, or coming-of-age story, and chronicles the childhood of Scout and Jem Finch as their father Atticus defends a Black man falsely accused of rape. ', 'https://librarycatalogue.com/books/to-kill-a-mockingbird/1', 3),
('9780425266540', 'Dune', 'https://librarycatalogue.com/images/dune-cover4', '1965', 3, 412, 'Set on the desert planet Arrakis, Dune is the story of the boy Paul Atreides, heir to a noble family tasked with ruling an inhospitable world where the only thing of value is the “spice”, a drug capable of extending life and enhancing consciousness.', 'https://librarycatalogue.com/books/dune-frank-herbert/1', 1),
('9780452262935', '1984', 'https://librarycatalogue.com/images/1984-cover1', '1949', 4, 328, '1984 is a dystopian novel that was written by George Orwell and published in 1949. It tells the story of Winston Smith, a citizen of the miserable society of Oceania, who is trying to rebel against the Party and its omnipresent symbol, Big Brother.', 'https://librarycatalogue.com/books/1984/1', 7),
('9781408855652', 'Harry Potter and the Philosopher\'s Stone', 'https://librarycatalogue.com/images/harry-potter-philosophers-stone-cover7', '2014', 7, 342, 'HARRY POTTER has never even heard of Hogwarts when the LETTERS start dropping on the doormat at number four, Privet Drive. Addressed in GREEN INK on yellowish parchment with a PURPLE SEAL, they are swiftly confiscated by his GRISLY aunt and...', 'https://librarycatalogue.com/books/harry-potter-philosophers-stone/1', 2),
('9781408855690', 'Harry Potter and the Order of the Phoenix', 'https://librarycatalogue.com/images/harry-potter-order-of-the-phoenix-cover7', '2014', 7, 816, 'Loved by millions of readers worldwide, let the fifth story in the greatest children\'s book series of all time take you on an unforgettable journey. The hope and wonder of Harry Potter\'s world will make you want to escape to Hogwarts again and again...', 'https://librarycatalogue.com/books/harry-potter-order-of-the-phoenix/1', 0),
('9781408855706', 'Harry Potter and the Half-Blood Prince', 'https://librarycatalogue.com/images/harry-potter-half-blood-prince-cover7', '2014', 7, 560, 'Loved by millions of readers worldwide, let the sixth story in the greatest children\'s book series of all time take you on an unforgettable journey. The hope and wonder of Harry Potter\'s world will make you want to escape to Hogwarts again and again...', 'https://librarycatalogue.com/books/harry-potter-half-blood-prince/1', 1),
('9781435162068', 'The Divine Comedy', 'https://librarycatalogue.com/images/the-divine-comedy-cover3', '1901', 5, 928, 'Dante Alighieri\'s The Divine Comedy is one of the most critically lauded works of Renaissance literature. It tells the story of Dante making his way through the three realms of the Christian afterlife.', 'https://librarycatalogue.com/books/the-divine-comedy/1', 2),
('9781495969058', 'The Brothers Karamazov', 'https://librarycatalogue.com/images/the-brothers-karamazov-cover1', '1901', 6, 875, 'The Brothers Karamazov is a novel with a simple plot about a murder and a complex discussion of faith, doubt, and morality.', 'https://librarycatalogue.com/books/the-brothers-karamazov/1', 6);

INSERT INTO `genre` (`GenreID`, `GenreName`, `Decription`) VALUES
(1, 'Fantasy', 'A genre of fiction that contains elements that cannot exist in the real world.'),
(2, 'Mystery', 'Genre of fiction where the nature of an event (usually a murder or other crime) remains mysterious until the end of the story.'),
(3, 'Fiction', 'Any narrative work portraying individuals, events, or places that are imaginary or in ways that are imaginary.'),
(4, 'Drama', 'Stories composed in verse or prose, usually for theatrical performances.'),
(5, 'Fairy Tale', 'Short stories usually originating from folklore.'),
(6, 'Romance', 'Stories that primarily focuses on the relationships and romantic love between 2 people.'),
(7, 'History', 'Stories about events of significant change that happened in the past.'),
(8, 'Myth', 'Folklore consisting primarily of narratives that played a key role in a society.'),
(9, 'Biography', 'Detailed description of a person\'s life.'),
(10, 'Western', 'Stories set in the American Old West frontier typically around the late 18th to late 19th century.'),
(11, 'Poems', 'Poems and short stories.'),
(12, 'Sci-Fi', 'Speculative fiction typically dealing with imaginative and futuristic concepts.'),
(13, 'Thriller', 'Usually crime, horror and detective fiction stories. Defined by its narrative mood/atmosphere.'),
(14, 'Young Adult', 'Stories typically written for readers aged 12 to 18.'),
(15, 'Academic', 'Essays, lab reports, case-studies, book reviews, research proposals, etc.'),
(16, 'Crime', 'Narratives that center on criminal acts and especially on the investigation, often murders.'),
(17, 'Adventure', 'Stories usually presenting a hero\'s journey, giving the reader a sense of excitement.'),
(18, 'Autobiography', 'Self-written account of a person\'s life.'),
(19, 'Comedy', 'Books about a series of funny or comical events or scenes intended to make the reader laugh.'),
(20, 'Graphic Novels', 'Novels in comic-strip format.');

INSERT INTO `user` (`UserID`, `UserName`, `PasswordHash`, `UserIcon`, `UserPermissionLevel`, `PhoneNumber`, `Email`) VALUES
(1, 'John Doe', '94890005F3B2117A353DA7260259531878CAE4F541BF59998511887D1F0221A5', 'https://librarycatalogue.com/images/john-doe-profile1', 1, '0123456789', 'johndoe@example.com'),
(2, 'Jane Doe', 'ED37D99B1445238AF3386F81A77A2CAF3FFFC0CD610BE39B4F3BA53943DC66BF', 'https://librarycatalogue.com/images/john-doe-profilepic', 1, '0124329765', 'janedoe@example.com'),
(3, 'Alice Lee', '35B6AEF9BC9577CA8A7DC11F420040355C3DA63577503925B224D4B494E77D4B', 'https://librarycatalogue.com/images/alice-lee-pic1', 1, '0164571259', 'alice.lee@example.com'),
(4, 'Bob Tan', 'E979AF46CDCE9C0FA1BA53710418C68D718119EBA293D4798CAC774236541D1D', 'https://librarycatalogue.com/images/bob-tan-s-profile', 1, '0247853169', 'bobtan123@example.com'),
(5, 'Jerry Liu', 'B3D313DCC3703BE02CB42A7D7A0ED6C75E535D5FE62684FBBAE983378F087DBC', 'https://librarycatalogue.com/images/liu-jerry-face1', 1, '0351247512', 'jerryliu@example.com'),
(6, 'Rohan Kumar', 'F5DA08800D1BF97565BE7F8F70ECFC00661C1EC7E872CEDDEBF158B2871D87EE', 'https://librarycatalogue.com/images/rohan-profile1', 1, '0351246589', 'rohankumar@example.com'),
(7, 'Amir Patel', 'F38EC101896667AF30A9DCE11B0D7774DD13BAEEEC3E1831CB1085D6E96E8BB2', 'https://librarycatalogue.com/images/amir-patel-picture1', 1, '0124573652', 'amir.patel@example.com'),
(8, 'Sergey Petrov', '79512615CB65FB11A4A1ACC0CB06EAB77C4286C6938F19A8138286E9EE563B71', 'https://librarycatalogue.com/images/sergei-pictures', 1, '0354216834', 'sergei37petrov@example.com'),
(9, 'Anastasia Shevchenko', '9EB8AB3C7F124D20C0E7149CE092EBA376A8DAAE3123E35FF61FED5900C64641', 'https://librarycatalogue.com/images/anast-profile2', 1, '0354216789', 'anastasiaschenko@example.com'),
(10, 'Adam Wan', '0C8309944396F41CB19D67489214799B3444DA606775AA94A84C75B7B02B3281', 'https://librarycatalogue.com/images/adam-wan-profile1', 1, '0328468516', 'adamwan@example.com'),
(11, 'Aaron Goh', 'ED064A77A8F3B9A3E58C729E8D4751B706B5DF847E9812DEF5184FBA28BDFD55', 'https://librarycatalogue.com/images/goh-aaron-profilepic', 1, '0123449888', 'aarongoh@example.com'),
(12, 'Muhammad Abdul', '2E33A185C34010008551F4508D88B2B944C0825689A1206E7B59327141C1624C', 'https://librarycatalogue.com/images/muhammad-abdul-profilep', 1, '0154662337', 'muhammadabdul@example.com'),
(13, 'Daniel Kim', 'B0269AAF7C3CE170070B602444ABCA9DFF5586A85E3CB143038D6AD473122F81', 'https://librarycatalogue.com/images/kim-daniel-face2', 1, '0234989878', 'danielkim@example.com'),
(14, 'Somchai Ayutthaya', 'C9E5590EE7C92CEA9FA20D8F01AF0063C6FF0CB00870FC1B7701BB08E13B80E5', 'https://librarycatalogue.com/images/somchai-ayut-profilepic2', 1, '0233265577', 'somchaiayutthaya@example.com'),
(15, 'Chanthra Suwan', '01D67A70CCCBEC9A3A30758312B2FE1F6042CFCDCE78F325C7E05EF99FB4D499', 'https://librarycatalogue.com/images/chantra-profiles', 1, '0214551554', 'chantrasuwan@example.com'),
(16, 'Jane Smith', 'AD7EC6522E9609082B3D4DCEEDD47ED552E1FB5106118F30548CF63DA263CD83', 'https://librarycatalogue.com/images/jane-smith-picture', 1, '0334558614', 'janesmith@example.com'),
(17, 'Emily Wong', '1BF61A4E4E177FCDC5D8C7F06A3952F1D1A7BD176C9B825AB2C3682BA9A4BBCA', 'https://librarycatalogue.com/images/emily-wong-profpic', 1, '0451127745', 'emilywong@example.com'),
(18, 'Joseph Bautista', '9785BB6914F7241A4F51115EB6F26FE2B33106226AF49F1FB88FAA8FBA5DB4CD', 'https://librarycatalogue.com/images/joseph-bautista-pics2', 1, '0327859987', 'josephbautista@example.com'),
(19, 'David Tan', '4EE9262B59B892F9585A921F95E5DAC812E193B641FEF4A02A1C7B70254503BB', 'https://librarycatalogue.com/images/david-tan-profilepicture', 1, '0345781121', 'davidtan@example.com'),
(20, 'Isaac Wong', 'BDF8D12CFA7412771AB4E809CAAD6C9C27A0007C380BA26EFA7EAF2964B1CED0', 'https://librarycatalogue.com/images/isaac-wong-profile2', 1, '0124456738', 'isaacwong@example.com');

INSERT INTO `bookgenre` (`BookGenreID`, `BookISBN`, `GenreID`) VALUES
(1, '0470317264', 15),
(2, '0470467010', 15),
(3, '0470527587', 15),
(4, '0471778648', 15),
(5, '0764570684', 15),
(6, '1118607961', 15),
(7, '1119235553', 15),
(8, '9781408855652', 2),
(9, '9781408855652', 1),
(10, '9781408855652', 14),
(11, '9781408855652', 3),
(12, '9781408855690', 1),
(13, '9781408855690', 2),
(14, '9781408855690', 3),
(15, '9781408855690', 14),
(16, '9781408855706', 1),
(17, '9781408855706', 2),
(18, '9781408855706', 3),
(19, '9781408855706', 14),
(20, '1408855666', 1),
(21, '1408855666', 2),
(22, '1408855666', 3),
(23, '1408855666', 14),
(24, '1408855674', 1),
(25, '1408855674', 2),
(26, '1408855674', 3),
(27, '1408855674', 14),
(28, '1408855682', 1),
(29, '1408855682', 2),
(30, '1408855682', 3),
(31, '1408855682', 14),
(32, '1408855712', 1),
(33, '1408855712', 2),
(34, '1408855712', 3),
(35, '1408855712', 14),
(36, '1435170512', 3),
(37, '9780060935467', 13),
(38, '9780425266540', 3),
(39, '9780425266540', 12),
(40, '9780425266540', 1),
(41, '9780425266540', 17),
(42, '9780425266540', 6),
(43, '9780452262935', 12),
(44, '9780452262935', 3),
(45, '9781435162068', 11),
(46, '9781435162068', 1),
(47, '9781495969058', 3),
(48, '9781495969058', 2);

INSERT INTO `bookmarkedbook` (`BookmarkedBookID`, `BookISBN`, `UserID`, `Page`, `DateCreated`) VALUES
(1, '1408855712', 15, 231, '2024-11-07'),
(2, '0470467010', 2, 377, '2024-11-10'),
(3, '1119235553', 5, 37, '2024-11-10'),
(4, '1118607961', 20, 226, '2024-11-08'),
(5, '0764570684', 12, 178, '2024-11-01');

INSERT INTO `borrowhistory` (`BorrowID`, `UserID`, `BookISBN`, `BorrowDate`, `ReturnDate`, `LateFees`) VALUES
(1, 3, '1408855682', '2024-10-16', '2024-11-11', 5.00),
(2, 15, '1408855712', '2024-10-30', NULL, NULL),
(3, 17, '1435170512', '2024-11-04', '2024-11-09', 0.00),
(4, 14, '9780425266540', '2024-10-08', '2024-10-15', 0.00),
(5, 4, '9781435162068', '2024-09-02', '2024-09-30', 5.00),
(6, 11, '9781495969058', '2024-04-01', '2024-04-02', 0.00),
(7, 9, '9781495969058', '2024-08-07', '2024-09-06', 5.00),
(8, 8, '9781495969058', '2024-01-18', '2024-02-29', 5.00),
(9, 13, '0764570684', '2024-01-01', '2024-11-01', 50.00),
(10, 7, '9780452262935', '2024-06-04', '2024-07-01', 5.00),
(11, 2, '0470467010', '2024-11-06', NULL, NULL),
(12, 5, '1119235553', '2024-11-10', NULL, NULL),
(13, 20, '1118607961', '2024-11-04', NULL, NULL),
(14, 12, '0764570684', '2024-10-23', NULL, NULL);

INSERT INTO `favourites` (`FavouritesID`, `UserID`, `BookISBN`) VALUES
(1, 3, '1408855682'),
(2, 13, '0764570684'),
(3, 8, '9781495969058'),
(4, 13, '0764570684'),
(5, 9, '9781495969058');

INSERT INTO `following` (`FollowingID`, `UserID`, `AuthorID`, `FollowingUserID`) VALUES
(3, 1, NULL, 2),
(4, 3, 7, NULL),
(5, 15, 7, NULL),
(6, 7, NULL, 18),
(7, 11, NULL, 17),
(8, 17, 1, NULL),
(9, 14, 3, NULL),
(10, 4, 5, NULL),
(11, 11, 6, NULL),
(12, 9, 6, NULL),
(13, 8, 6, NULL),
(14, 5, NULL, 12),
(15, 13, 13, NULL),
(16, 10, NULL, 9);

INSERT INTO `rating` (`RatingID`, `UserID`, `BookISBN`, `Stars`, `Comments`, `DateTimeCreated`) VALUES
(1, 3, '1408855682', 5, 'Loved it!', '2024-11-10 18:10:45'),
(2, 11, '9781495969058', 1, 'Too complex for me...', '2024-11-10 18:21:29'),
(3, 9, '9781495969058', 3, NULL, '2024-11-10 18:23:00'),
(4, 8, '9781495969058', 5, 'Amazing read; highly recommend!', '2024-11-10 18:23:00'),
(5, 13, '0764570684', 5, 'Really helped out during self study sessions', '2024-11-10 19:13:34'),
(6, 15, '1408855712', 5, 'Perfect ending to the series!', '2024-11-10 19:16:12'),
(7, 3, '1408855682', 4, NULL, '2024-11-10 19:16:46');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
