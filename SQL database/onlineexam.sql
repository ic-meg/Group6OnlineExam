-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2025 at 02:10 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlineexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminaccount`
--

CREATE TABLE `adminaccount` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminaccount`
--

INSERT INTO `adminaccount` (`admin_id`, `username`, `password`, `email`, `phone`, `DateCreated`) VALUES
(2130, 'admin', 'admin123', 'admin@gmail.com', '0912345678', '2024-08-26 10:40:22'),
(2137, 'ley', 'Newpassnile00!', '', '', '2024-08-26 13:17:08'),
(2138, 'meg', 'Newadmin00!', '', '', '2024-08-26 13:17:27'),
(2139, 'gil', 'Gil12345600!', '', '', '2024-08-26 13:17:55'),
(2140, 'andrei', 'Andreirama00!', '', '', '2024-08-26 13:18:19'),
(2141, 'Pam', 'Pamela00!', '', '', '2024-08-26 13:18:32');

-- --------------------------------------------------------

--
-- Table structure for table `admin_booking`
--

CREATE TABLE `admin_booking` (
  `book_id` int(11) NOT NULL,
  `control_number` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `Schedule` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_booking`
--

INSERT INTO `admin_booking` (`book_id`, `control_number`, `date`, `time`, `Schedule`, `created_at`) VALUES
(6, 38710, '2025-05-24', '20:00:00', 'Completed', '2025-05-24 12:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `admin_exam_set`
--

CREATE TABLE `admin_exam_set` (
  `exam_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `duration` int(255) NOT NULL,
  `totalItems` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_exam_set`
--

INSERT INTO `admin_exam_set` (`exam_id`, `date`, `title`, `duration`, `totalItems`) VALUES
(1, '2021-10-06', 'Entrance Exam', 60, 70);

-- --------------------------------------------------------

--
-- Table structure for table `admin_logic`
--

CREATE TABLE `admin_logic` (
  `questionID` int(11) NOT NULL,
  `questionText` text NOT NULL,
  `ChoiceA` text NOT NULL,
  `ChoiceB` text NOT NULL,
  `ChoiceC` text NOT NULL,
  `ChoiceD` text NOT NULL,
  `AnswerKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_logic`
--

INSERT INTO `admin_logic` (`questionID`, `questionText`, `ChoiceA`, `ChoiceB`, `ChoiceC`, `ChoiceD`, `AnswerKey`) VALUES
(2, 'Which of the following is a true statement?', 'All squares are rectangles.', 'Some squares are not rectangles.', 'All rectangles are squares.', 'No rectangles are squares.', 'All squares are rectangles.'),
(3, 'Identify the conclusion in the following argument: \"All cats are mammals. All mammals are animals. Therefore, all cats are animals.\"', 'All cats are mammals.', 'Therefore, all cats are animals.', 'All mammals are animals.', 'None of the above.', 'All mammals are animals.'),
(4, 'What type of reasoning is used in the statement: \"If it rains, then the ground will be wet. It is raining. Therefore, the ground is wet.\"?', 'Inductive reasoning', 'Abductive reasoning', 'Deductive reasoning', 'Analogical reasoning', 'Abductive reasoning'),
(6, 'If you drop a yellow hat in the Red Sea, what does it become?', 'Wet', 'Yellow', 'Red', 'Hatless', 'Wet'),
(7, 'What is always coming but never arrives?', 'Tomorrow', 'Today', 'Yesterday', 'The weekend', 'Tomorrow'),
(8, 'How can a man go eight days without sleep?', 'Take naps during the day', 'Sleep at night', 'Drink lots of coffee', 'He\'s not sleeping at all', 'Take naps during the day'),
(9, 'What is so fragile that saying its name breaks it?', 'Silence', 'Heart', 'Glass', 'Ice', 'Glass'),
(11, 'What can you hold in your right hand but not in your left hand?', 'Left hand', 'Left foot', 'Right hand', 'Right foot', 'Left hand'),
(13, 'What occurs once in a minute, twice in a moment, but never in a thousand years?', 'The letter \'M\'', 'The letter \'O\'', 'The letter \'E\'', 'The letter \'X\'', 'The letter \'M\''),
(14, 'Forward I am heavy, but backward I am not. What am I?', 'Ton', 'Light', 'Not', 'Knot', 'Ton'),
(15, 'What can be seen once in a minute, twice in a moment, but never in a thousand years?', 'Daylight', 'The letter \'M\'', 'The letter \'E\'', 'The letter \'O\'', 'The letter \'M\''),
(16, 'What has keys that can open no locks?', 'Piano', 'Calculator', 'Car', 'Typewriter', 'Piano'),
(17, 'What starts with the letter \'t\', is filled with \'t\' and ends in \'t\'?', 'Teapot', 'Teetotaler', 'Teaspoon', 'Throat', 'Teapot'),
(18, 'What belongs to you but is used more by others?', 'Your name', 'Your time', 'Your money ', 'Your car', 'Your name'),
(19, 'What has many keys but can\'t open a single lock?', 'Keyboard', 'Remote control ', 'Piano', 'Calculator', 'Keyboard'),
(20, 'Which of the following statements best represents an example of a categorical syllogism?', 'If it rains, then the ground will be wet. It is raining. Therefore, the ground is wet.', 'All mammals are warm-blooded. All whales are mammals. Therefore, all whales are warm-blooded.', 'Either the cake is chocolate or vanilla. The cake is not vanilla. Therefore, the cake is chocolate.', 'If the temperature drops below freezing, the lake will freeze. The temperature has dropped below freezing. Therefore, the lake will freeze.', 'All mammals are warm-blooded. All whales are mammals. Therefore, all whales are warm-blooded.'),
(21, 'If all philosophers are thinkers and some thinkers are writers, which of the following conclusions can be logically inferred?', 'All philosophers are writers.', 'All writers are philosophers.', 'Some philosophers are not writers', 'All thinkers are philosophers', 'Some philosophers are not writers');

-- --------------------------------------------------------

--
-- Table structure for table `admin_math`
--

CREATE TABLE `admin_math` (
  `questionID` int(11) NOT NULL,
  `questionText` text NOT NULL,
  `ChoiceA` text NOT NULL,
  `ChoiceB` text NOT NULL,
  `ChoiceC` text NOT NULL,
  `ChoiceD` text NOT NULL,
  `AnswerKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_math`
--

INSERT INTO `admin_math` (`questionID`, `questionText`, `ChoiceA`, `ChoiceB`, `ChoiceC`, `ChoiceD`, `AnswerKey`) VALUES
(5, 'What is the value of Ï€ (pi) approximately?', '3.14', '2.71', '1.62', '4.29', '3.14'),
(6, 'What is the square root of 64?', '6', '7', '8', '9', '8'),
(8, 'If a rectangle has a length of 10 cm and a width of 5 cm, what is its perimeter?', '15 cm', '20 cm', '25cm', '30cm', '30cm'),
(9, 'What is the next prime number after 31?', '32', '33', '34', '37', '37'),
(10, 'What is the value of 3Â² + 4Â²?', '7', '16', '9', '25', '25'),
(11, 'How many degrees are in a right angle?\n\n', '45 degrees', '90 degrees', '135 degrees', '180 degrees', '90 degrees'),
(12, 'Simplify: 3/4 + 1/2', '5/6', '1', '7/8', '11/4', '7/8'),
(13, 'What is the cube of 3?', '6', '9', '12', '27', '27'),
(14, 'What is the value of 2â´\n\n', '6', '8', '12', '16', '16'),
(15, 'How many faces does a cube have?', '4', '6', '8', '12', '6'),
(16, 'If a car travels at 60 km/h for 3 hours, how far does it travel?', '120 km', '160 km', '180 km', '200 km', '180 km'),
(17, 'What is the sum of the first 10 positive integers?', '45', '50', '55', '60', '55'),
(18, 'What is the circumference of a circle with radius 5 cm? (Use Ï€ = 3.14)', '10.5 cm', '15.7 cm', '31.4 cm', '47.1 cm', '31.4 cm'),
(19, 'Solve for x: 2x + 5 = 15', '5', '6', '7', '8', '6'),
(20, 'What is the sum of the exterior angles of any polygon?', '90 degrees', '180 degrees', '270 degrees', '360 degrees', '360 degrees'),
(21, 'Simplify: (2/3) Ã· (4/5)', '2/5', '5/6', '8/15', '15/8', '5/6'),
(22, 'What is the value of 5! (factorial of 5)?', '15', '60', '120', '720', '120'),
(23, ' What is the sum of the interior angles of a triangle?', ' 90 degrees', '180 degrees', 'T270 degrees', '360 degrees ', '180 degrees');

-- --------------------------------------------------------

--
-- Table structure for table `admin_reading_comprehension`
--

CREATE TABLE `admin_reading_comprehension` (
  `questionID` int(11) NOT NULL,
  `questionText` text NOT NULL,
  `ChoiceA` text NOT NULL,
  `ChoiceB` text NOT NULL,
  `ChoiceC` text NOT NULL,
  `ChoiceD` text NOT NULL,
  `AnswerKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_reading_comprehension`
--

INSERT INTO `admin_reading_comprehension` (`questionID`, `questionText`, `ChoiceA`, `ChoiceB`, `ChoiceC`, `ChoiceD`, `AnswerKey`) VALUES
(2, 'How many wings do butterflies have?', 'Two', 'Four', 'Six', 'Eight', 'Four'),
(3, 'What cover the wings of butterflies?', 'Feathers', 'Fur', 'Tiny scales', 'Skin', 'Tiny scales'),
(4, 'What is the first stage of a butterfly\'s life cycle?', 'Larva', 'Pupa', 'Adult', 'Egg', 'Egg'),
(5, '\nWhich stage comes after the larva (caterpillar) stage?', 'Egg', 'Pupa (chrysalis)  ', 'Adult', 'None', 'Pupa (chrysalis)'),
(6, 'What do butterflies feed on?', 'Leaves', 'Nectar from flowers', 'Insects', 'Fruits', 'Nectar from flowers'),
(7, 'What do butterflies use to feed?', 'Beak', 'Teeth', 'Long, coiled proboscis', 'Tongue', 'Long, coiled proboscis'),
(8, 'Why are butterflies\' colors and patterns important?', 'For warmth', 'For camouflage or warning signals', 'For flying', 'For mating', 'For camouflage or warning signals'),
(9, 'What stage is a butterfly in when it is inside a chrysalis?', 'Egg', 'Larva', 'Pupa', 'Adult', 'Pupa'),
(10, 'Where can butterflies be found?', 'Only in tropical areas', 'Only in forests', 'In many parts of the world', 'Only in deserts', 'In many parts of the world'),
(11, 'What type of forest is a rainforest?', 'Dry forest', 'Temperate forest', 'Tropical forest', 'Coniferous forest', 'Tropical forest'),
(12, 'How much rainfall do rainforests receive each year?', 'Very little', 'Moderate', 'High amounts', 'None', 'High amounts'),
(13, 'Why are rainforests important for the Earth\'s climate?', 'They produce carbon dioxide', 'They absorb oxygen', 'They absorb carbon dioxide and produce oxygen', 'They provide sunlight', 'They absorb carbon dioxide and produce oxygen'),
(14, 'Which layer of the rainforest is the highest?', 'Emergent layer', 'Canopy', 'Understory', 'Forest floor', 'Emergent layer'),
(15, 'What is happening to rainforests at an alarming rate?', 'They are expanding', 'They are being destroyed', 'They are being protected', 'They are being planted', 'They are being destroyed'),
(16, 'What are some reasons for the destruction of rainforests?', 'Natural growth', 'Migration of animals', 'Logging, agriculture, and urbanization', 'Natural disasters', 'Logging, agriculture, and urbanization'),
(17, 'What can be found in rainforests that are often unique?', 'Climate patterns', 'Common plants', 'Unique plant and animal species', 'Desert plants', 'Unique plant and animal species'),
(18, 'Which layer of the rainforest is closest to the ground?', 'Emergent layer', 'Canopy', 'Understory', 'Forest floor', 'Forest floor'),
(19, 'What are butterflies?     ', 'Birds', 'Insects', 'Mammals', 'Reptiles', 'Insects');

-- --------------------------------------------------------

--
-- Table structure for table `admin_science`
--

CREATE TABLE `admin_science` (
  `questionID` int(11) NOT NULL,
  `questionText` text NOT NULL,
  `ChoiceA` text NOT NULL,
  `ChoiceB` text NOT NULL,
  `ChoiceC` text NOT NULL,
  `ChoiceD` text NOT NULL,
  `AnswerKey` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_science`
--

INSERT INTO `admin_science` (`questionID`, `questionText`, `ChoiceA`, `ChoiceB`, `ChoiceC`, `ChoiceD`, `AnswerKey`) VALUES
(1, 'What is the powerhouse of the cell?', 'Nucleus', 'Golgi apparatus', 'Mitochondria', 'Endoplasmic reticulum', 'Mitochondria'),
(2, 'Which planet is known as the Red Planet?', 'Earth', 'Mars', 'Jupiter', 'Saturn', 'Mars'),
(3, 'What process allows plants to make their own food?', 'Respiration', 'Photosynthesis', 'Transpiration', 'Germination', 'Photosynthesis'),
(4, 'What is the hardest natural substance found on Earth?', 'Gold', 'Diamond', 'Quartz', 'Ruby', 'Diamond'),
(5, 'What force pulls objects towards the center of the Earth?', 'Magnetic force', 'Gravitational force', 'Centrifugal force', 'Electrostatic force', 'Gravitational force'),
(6, 'Which of these is not a type of cloud?', 'Cumulus', 'Cirrus', 'Stratosphere', 'Nimbostratus', 'Stratosphere'),
(7, 'What is the chemical symbol for water?', 'O2', 'CO2', 'H2O', 'H2SO4', 'H2O'),
(8, 'What part of the plant absorbs water and nutrients from the soil?', 'Stems', 'Leaves', 'Roots', 'Flowers', 'Roots'),
(9, 'What is the process of liquid water changing into water vapor called?', 'Melting ', 'Evaporation', 'Condensation', 'Sublimation', 'Evaporation'),
(10, 'Which animal is known for its hibernation during winter months?', 'Bear', 'Tiger', 'Monkey', 'Elephant', 'Bear'),
(11, 'What gas do plants absorb from the atmosphere during photosynthesis?', 'Oxygen', 'Nitrogen', 'Carbon Dioxide', 'Hydrogen', 'Carbon Dioxide'),
(12, 'What is the largest organ in the human body?', 'Brain', 'Skin', 'Heart', 'Liver', 'Skin'),
(13, 'Which planet is the closest to the Sun?', 'Venus', 'Earth', 'Mercury ', 'Mars', 'Mercury '),
(14, 'What is the unit used to measure electrical resistance?', 'Watt', 'Volt', 'Ohm', 'Ampere', 'Ohm'),
(15, 'Which scientist is credited with discovering the law of gravity?', 'Isaac Newton', 'Albert Einstein', 'Galileo Galilei', 'Nikola Tesla', 'Isaac Newton'),
(16, 'What type of energy is stored in a battery?', 'Mechanical', 'Potential', 'Kinetic', 'Chemical', 'Chemical'),
(17, 'What is the densest planet in our solar system?', 'Earth', 'Jupiter', 'Saturn', 'Mercury', 'Earth');

-- --------------------------------------------------------

--
-- Table structure for table `imported_control_numbers`
--

CREATE TABLE `imported_control_numbers` (
  `control_number` varchar(255) NOT NULL,
  `firstname` varchar(244) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imported_control_numbers`
--

INSERT INTO `imported_control_numbers` (`control_number`, `firstname`, `lastname`, `email`) VALUES
('38710', 'Meg', 'Fabian', 'fabian.megangeline2003@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `student_answer_logic`
--

CREATE TABLE `student_answer_logic` (
  `logic_id` int(11) NOT NULL,
  `control_number` int(11) NOT NULL,
  `Answer` varchar(255) NOT NULL,
  `questionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_answer_logic`
--

INSERT INTO `student_answer_logic` (`logic_id`, `control_number`, `Answer`, `questionID`) VALUES
(18, 31143, 'Keyboard', 19),
(19, 31143, 'All squares are rectangles.', 2),
(20, 31143, 'Ton', 14),
(21, 31143, 'Piano', 16),
(22, 31143, 'Take naps during the day', 8),
(23, 31143, 'Wet', 6),
(24, 31143, 'Silence', 9),
(25, 31143, 'Left hand', 11),
(26, 31143, 'If the temperature drops below freezing, the lake will freeze. The temperature has dropped below freezing. Therefore, the lake will freeze.', 20),
(27, 31143, 'The letter \'M\'', 15),
(28, 31143, 'Some philosophers are not writers', 21),
(29, 31143, 'Your name', 18),
(30, 31143, 'The letter \'M\'', 13),
(31, 31143, 'Tomorrow', 7),
(32, 31143, 'Teapot', 17),
(33, 31143, 'Therefore, all cats are animals.', 3),
(34, 31143, 'Abductive reasoning', 4),
(35, 21664, 'All philosophers are writers.', 21),
(36, 21664, 'Yellow', 6),
(37, 21664, 'Piano', 16),
(38, 21664, 'Some squares are not rectangles.', 2),
(39, 21664, 'All cats are mammals.', 3),
(40, 21664, 'Teetotaler', 17),
(41, 21664, 'Left hand', 11),
(42, 21664, 'Your name', 18),
(43, 21664, 'Keyboard', 19),
(44, 21664, 'Silence', 9),
(45, 21664, 'Either the cake is chocolate or vanilla. The cake is not vanilla. Therefore, the cake is chocolate.', 20),
(46, 21664, 'The letter \'M\'', 13),
(47, 21664, 'Tomorrow', 7),
(48, 21664, 'He\'s not sleeping at all', 8),
(49, 21664, 'Deductive reasoning', 4),
(50, 21664, 'Ton', 14),
(51, 21664, 'The letter \'M\'', 15),
(52, 21664, 'Piano', 16),
(53, 21664, 'Keyboard', 19),
(54, 21664, 'Your name', 18),
(55, 21664, 'Left hand', 11),
(56, 21664, 'Ton', 14),
(57, 21664, 'If the temperature drops below freezing, the lake will freeze. The temperature has dropped below freezing. Therefore, the lake will freeze.', 20),
(58, 21664, 'The letter \'M\'', 15),
(59, 21664, 'Inductive reasoning', 4),
(60, 21664, 'All philosophers are writers.', 21),
(61, 21664, 'The letter \'M\'', 13),
(62, 21664, 'All mammals are animals.', 3),
(63, 21664, 'Tomorrow', 7),
(64, 21664, 'All squares are rectangles.', 2),
(65, 21664, 'Silence', 9),
(66, 21664, 'Wet', 6),
(67, 21664, 'Take naps during the day', 8),
(68, 21664, 'Teapot', 17),
(69, 29182, 'He\'s not sleeping at all', 8),
(70, 29182, 'Wet', 6),
(71, 29182, 'All mammals are animals.', 3),
(72, 29182, 'Left hand', 11),
(73, 29182, 'The letter \'M\'', 13),
(74, 29182, 'Piano', 16),
(75, 29182, 'All philosophers are writers.', 21),
(76, 29182, 'Teetotaler', 17),
(77, 29182, 'Either the cake is chocolate or vanilla. The cake is not vanilla. Therefore, the cake is chocolate.', 20),
(78, 29182, 'All rectangles are squares.', 2),
(79, 29182, 'Your name', 18),
(80, 29182, 'Ton', 14),
(81, 29182, 'Tomorrow', 7),
(82, 29182, 'Keyboard', 19),
(83, 29182, 'Deductive reasoning', 4),
(84, 29182, 'Silence', 9),
(85, 29182, 'The letter \'O\'', 15),
(86, 38710, 'Silence', 9),
(87, 38710, 'The letter \'M\'', 13),
(88, 38710, 'Piano', 16),
(89, 38710, 'All mammals are animals.', 3),
(90, 38710, 'Left hand', 11),
(91, 38710, 'Teapot', 17),
(92, 38710, 'Inductive reasoning', 4),
(93, 38710, 'The letter \'M\'', 15),
(94, 38710, 'No rectangles are squares.', 2),
(95, 38710, 'Keyboard', 19),
(96, 38710, 'He\'s not sleeping at all', 8),
(97, 38710, 'Wet', 6),
(98, 38710, 'If the temperature drops below freezing, the lake will freeze. The temperature has dropped below freezing. Therefore, the lake will freeze.', 20),
(99, 38710, 'Your name', 18),
(100, 38710, 'Tomorrow', 7),
(101, 38710, 'Not', 14),
(102, 38710, 'Some philosophers are not writers', 21);

-- --------------------------------------------------------

--
-- Table structure for table `student_answer_math`
--

CREATE TABLE `student_answer_math` (
  `mathID` int(11) NOT NULL,
  `control_number` int(11) NOT NULL,
  `Answer` varchar(255) NOT NULL,
  `questionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_answer_math`
--

INSERT INTO `student_answer_math` (`mathID`, `control_number`, `Answer`, `questionID`) VALUES
(1, 31143, '5', 19),
(2, 31143, '33', 9),
(3, 31143, '6', 14),
(4, 31143, '15 cm', 8),
(5, 31143, '180 degrees', 20),
(6, 31143, '45 degrees', 11),
(7, 31143, '9', 13),
(8, 31143, '5/6', 21),
(9, 31143, '6', 15),
(10, 31143, '6', 6),
(11, 31143, '50', 17),
(12, 31143, '3.14', 5),
(13, 31143, '1', 12),
(14, 31143, '31.4 cm', 18),
(15, 31143, '200 km', 16),
(16, 31143, '16', 10),
(17, 31143, '360 degrees ', 23),
(18, 31143, '15', 22),
(19, 29182, '45', 17),
(20, 29182, '180 degrees', 20),
(21, 29182, '6', 6),
(22, 29182, '3.14', 5),
(23, 29182, '60', 22),
(24, 29182, '2/5', 21),
(25, 29182, '6', 19),
(26, 29182, '33', 9),
(27, 29182, '15 cm', 8),
(28, 29182, '9', 13),
(29, 29182, '360 degrees ', 23),
(30, 29182, '31.4 cm', 18),
(31, 29182, '7/8', 12),
(32, 29182, '7', 10),
(33, 29182, '45 degrees', 11),
(34, 29182, '6', 15),
(35, 29182, '120 km', 16),
(36, 29182, '8', 14),
(37, 38710, '55', 17),
(38, 38710, '180 degrees', 20),
(39, 38710, '9', 6),
(40, 38710, '3.14', 5),
(41, 38710, '720', 22),
(42, 38710, '5/6', 21),
(43, 38710, '5', 19),
(44, 38710, '33', 9),
(45, 38710, '15 cm', 8),
(46, 38710, '9', 13),
(47, 38710, 'T270 degrees', 23),
(48, 38710, '31.4 cm', 18),
(49, 38710, '5/6', 12),
(50, 38710, '16', 10),
(51, 38710, '90 degrees', 11),
(52, 38710, '8', 15),
(53, 38710, '160 km', 16),
(54, 38710, '8', 14);

-- --------------------------------------------------------

--
-- Table structure for table `student_answer_reading_comprehension`
--

CREATE TABLE `student_answer_reading_comprehension` (
  `reading_id` int(11) NOT NULL,
  `control_number` int(11) NOT NULL,
  `Answer` varchar(255) NOT NULL,
  `questionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_answer_reading_comprehension`
--

INSERT INTO `student_answer_reading_comprehension` (`reading_id`, `control_number`, `Answer`, `questionID`) VALUES
(1, 31143, 'Four', 2),
(2, 31143, 'Feathers', 3),
(3, 31143, 'Larva', 4),
(4, 31143, 'Pupa (chrysalis)  ', 5),
(5, 31143, 'Nectar from flowers', 6),
(6, 31143, 'Long, coiled proboscis', 7),
(7, 31143, 'For camouflage or warning signals', 8),
(8, 31143, 'Pupa', 9),
(9, 31143, 'In many parts of the world', 10),
(10, 31143, 'Tropical forest', 11),
(11, 31143, 'High amounts', 12),
(12, 31143, 'They absorb carbon dioxide and produce oxygen', 13),
(13, 31143, 'Forest floor', 14),
(14, 31143, 'They are being protected', 15),
(15, 31143, 'Logging, agriculture, and urbanization', 16),
(16, 31143, 'Unique plant and animal species', 17),
(17, 31143, 'Emergent layer', 18),
(18, 31143, 'Birds', 19),
(19, 29182, 'Four', 2),
(20, 29182, 'Tiny scales', 3),
(21, 29182, 'Larva', 4),
(22, 29182, 'Pupa (chrysalis)  ', 5),
(23, 29182, 'Nectar from flowers', 6),
(24, 29182, 'Long, coiled proboscis', 7),
(25, 29182, 'For camouflage or warning signals', 8),
(26, 29182, 'Pupa', 9),
(27, 29182, 'In many parts of the world', 10),
(28, 29182, 'Temperate forest', 11),
(29, 29182, 'Very little', 12),
(30, 29182, 'They absorb carbon dioxide and produce oxygen', 13),
(31, 29182, 'Forest floor', 14),
(32, 29182, 'They are being planted', 15),
(33, 29182, 'Logging, agriculture, and urbanization', 16),
(34, 29182, 'Unique plant and animal species', 17),
(35, 29182, 'Understory', 18),
(36, 29182, 'Mammals', 19),
(37, 29182, 'Four', 2),
(38, 29182, 'Tiny scales', 3),
(39, 29182, 'Larva', 4),
(40, 29182, 'Pupa (chrysalis)  ', 5),
(41, 29182, 'Nectar from flowers', 6),
(42, 29182, 'Long, coiled proboscis', 7),
(43, 29182, 'For camouflage or warning signals', 8),
(44, 29182, 'Pupa', 9),
(45, 29182, 'In many parts of the world', 10),
(46, 29182, 'Temperate forest', 11),
(47, 29182, 'Very little', 12),
(48, 29182, 'They absorb carbon dioxide and produce oxygen', 13),
(49, 29182, 'Forest floor', 14),
(50, 29182, 'They are being planted', 15),
(51, 29182, 'Logging, agriculture, and urbanization', 16),
(52, 29182, 'Unique plant and animal species', 17),
(53, 29182, 'Understory', 18),
(54, 29182, 'Mammals', 19),
(55, 38710, 'Four', 2),
(56, 38710, 'Tiny scales', 3),
(57, 38710, 'Larva', 4),
(58, 38710, 'Pupa (chrysalis)  ', 5),
(59, 38710, 'Nectar from flowers', 6),
(60, 38710, 'Long, coiled proboscis', 7),
(61, 38710, 'For camouflage or warning signals', 8),
(62, 38710, 'Pupa', 9),
(63, 38710, 'Only in tropical areas', 10),
(64, 38710, 'Temperate forest', 11),
(65, 38710, 'High amounts', 12),
(66, 38710, 'They absorb carbon dioxide and produce oxygen', 13),
(67, 38710, 'Emergent layer', 14),
(68, 38710, 'They are being destroyed', 15),
(69, 38710, 'Logging, agriculture, and urbanization', 16),
(70, 38710, 'Unique plant and animal species', 17),
(71, 38710, 'Emergent layer', 18),
(72, 38710, 'Reptiles', 19);

-- --------------------------------------------------------

--
-- Table structure for table `student_answer_science`
--

CREATE TABLE `student_answer_science` (
  `science_id` int(11) NOT NULL,
  `control_number` int(11) NOT NULL,
  `Answer` varchar(255) NOT NULL,
  `questionID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_answer_science`
--

INSERT INTO `student_answer_science` (`science_id`, `control_number`, `Answer`, `questionID`) VALUES
(1, 31143, 'Watt', 14),
(2, 31143, 'Isaac Newton', 15),
(3, 31143, 'H2O', 7),
(4, 31143, 'Skin', 12),
(5, 31143, 'Mitochondria', 1),
(6, 31143, 'Mars', 13),
(7, 31143, 'Chemical', 16),
(8, 31143, 'Roots', 8),
(9, 31143, 'Stratosphere', 6),
(10, 31143, 'Carbon Dioxide', 11),
(11, 31143, 'Diamond', 4),
(12, 31143, 'Photosynthesis', 3),
(13, 31143, 'Magnetic force', 5),
(14, 31143, 'Tiger', 10),
(15, 31143, 'Saturn', 17),
(16, 31143, 'Evaporation', 9),
(17, 31143, 'Earth', 2),
(18, 29182, 'Skin', 12),
(19, 29182, 'Carbon Dioxide', 11),
(20, 29182, 'Mars', 2),
(21, 29182, 'Diamond', 4),
(22, 29182, 'Earth', 17),
(23, 29182, 'Isaac Newton', 15),
(24, 29182, 'Mars', 13),
(25, 29182, 'Cumulus', 6),
(26, 29182, 'Evaporation', 9),
(27, 29182, 'Mechanical', 16),
(28, 29182, 'Photosynthesis', 3),
(29, 29182, 'Roots', 8),
(30, 29182, 'Elephant', 10),
(31, 29182, 'Magnetic force', 5),
(32, 29182, 'Nucleus', 1),
(33, 29182, 'H2O', 7),
(34, 29182, 'Ohm', 14),
(35, 38710, 'Ohm', 14),
(36, 38710, 'Monkey', 10),
(37, 38710, 'Nimbostratus', 6),
(38, 38710, 'Mercury ', 13),
(39, 38710, 'Evaporation', 9),
(40, 38710, 'Jupiter', 17),
(41, 38710, 'Gravitational force', 5),
(42, 38710, 'Leaves', 8),
(43, 38710, 'H2O', 7),
(44, 38710, 'Diamond', 4),
(45, 38710, 'Mars', 2),
(46, 38710, 'Chemical', 16),
(47, 38710, 'Photosynthesis', 3),
(48, 38710, 'Albert Einstein', 15),
(49, 38710, 'Nitrogen', 11),
(50, 38710, 'Heart', 12),
(51, 38710, 'Mitochondria', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_examination_score`
--

CREATE TABLE `student_examination_score` (
  `studExam_id` int(11) NOT NULL,
  `control_number` int(11) NOT NULL,
  `date` date NOT NULL,
  `timeStarted` time NOT NULL,
  `duration` time NOT NULL,
  `logic_id` int(11) NOT NULL,
  `math_id` int(11) NOT NULL,
  `science_id` int(11) NOT NULL,
  `reading_id` int(11) NOT NULL,
  `total_score` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `submittedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_examination_score`
--

INSERT INTO `student_examination_score` (`studExam_id`, `control_number`, `date`, `timeStarted`, `duration`, `logic_id`, `math_id`, `science_id`, `reading_id`, `total_score`, `status`, `submittedAt`) VALUES
(1, 38710, '2025-05-24', '20:00:00', '00:00:00', 11, 5, 10, 12, 38, 'FAILED', '2025-05-24 12:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `control_number` int(11) NOT NULL,
  `username` varchar(244) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`control_number`, `username`, `password`, `created_at`) VALUES
(38710, 'student', 'Studpass00@@', '2025-05-24 11:54:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminaccount`
--
ALTER TABLE `adminaccount`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_booking`
--
ALTER TABLE `admin_booking`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `st_ID3` (`control_number`),
  ADD KEY `control_number` (`control_number`);

--
-- Indexes for table `admin_exam_set`
--
ALTER TABLE `admin_exam_set`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `admin_logic`
--
ALTER TABLE `admin_logic`
  ADD PRIMARY KEY (`questionID`);

--
-- Indexes for table `admin_math`
--
ALTER TABLE `admin_math`
  ADD PRIMARY KEY (`questionID`);

--
-- Indexes for table `admin_reading_comprehension`
--
ALTER TABLE `admin_reading_comprehension`
  ADD PRIMARY KEY (`questionID`);

--
-- Indexes for table `admin_science`
--
ALTER TABLE `admin_science`
  ADD PRIMARY KEY (`questionID`);

--
-- Indexes for table `imported_control_numbers`
--
ALTER TABLE `imported_control_numbers`
  ADD PRIMARY KEY (`control_number`),
  ADD UNIQUE KEY `control_number` (`control_number`);

--
-- Indexes for table `student_answer_logic`
--
ALTER TABLE `student_answer_logic`
  ADD PRIMARY KEY (`logic_id`),
  ADD KEY `st_ID5` (`control_number`);

--
-- Indexes for table `student_answer_math`
--
ALTER TABLE `student_answer_math`
  ADD PRIMARY KEY (`mathID`),
  ADD KEY `st_ID6` (`control_number`);

--
-- Indexes for table `student_answer_reading_comprehension`
--
ALTER TABLE `student_answer_reading_comprehension`
  ADD PRIMARY KEY (`reading_id`),
  ADD KEY `st_ID7` (`control_number`);

--
-- Indexes for table `student_answer_science`
--
ALTER TABLE `student_answer_science`
  ADD PRIMARY KEY (`science_id`),
  ADD KEY `st_ID8` (`control_number`),
  ADD KEY `control_number` (`control_number`);

--
-- Indexes for table `student_examination_score`
--
ALTER TABLE `student_examination_score`
  ADD PRIMARY KEY (`studExam_id`),
  ADD KEY `st_ID13` (`control_number`),
  ADD KEY `control_number` (`control_number`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`control_number`),
  ADD KEY `control_number` (`control_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminaccount`
--
ALTER TABLE `adminaccount`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2142;
--
-- AUTO_INCREMENT for table `admin_booking`
--
ALTER TABLE `admin_booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `admin_logic`
--
ALTER TABLE `admin_logic`
  MODIFY `questionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `admin_math`
--
ALTER TABLE `admin_math`
  MODIFY `questionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `admin_reading_comprehension`
--
ALTER TABLE `admin_reading_comprehension`
  MODIFY `questionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `admin_science`
--
ALTER TABLE `admin_science`
  MODIFY `questionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `student_answer_logic`
--
ALTER TABLE `student_answer_logic`
  MODIFY `logic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `student_answer_math`
--
ALTER TABLE `student_answer_math`
  MODIFY `mathID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `student_answer_reading_comprehension`
--
ALTER TABLE `student_answer_reading_comprehension`
  MODIFY `reading_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `student_answer_science`
--
ALTER TABLE `student_answer_science`
  MODIFY `science_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `student_examination_score`
--
ALTER TABLE `student_examination_score`
  MODIFY `studExam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `control_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38711;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_booking`
--
ALTER TABLE `admin_booking`
  ADD CONSTRAINT `st_ID3` FOREIGN KEY (`control_number`) REFERENCES `useraccount` (`control_number`);

--
-- Constraints for table `student_answer_logic`
--
ALTER TABLE `student_answer_logic`
  ADD CONSTRAINT `st_ID5` FOREIGN KEY (`control_number`) REFERENCES `useraccount` (`control_number`);

--
-- Constraints for table `student_answer_math`
--
ALTER TABLE `student_answer_math`
  ADD CONSTRAINT `st_ID6` FOREIGN KEY (`control_number`) REFERENCES `useraccount` (`control_number`);

--
-- Constraints for table `student_answer_reading_comprehension`
--
ALTER TABLE `student_answer_reading_comprehension`
  ADD CONSTRAINT `st_ID7` FOREIGN KEY (`control_number`) REFERENCES `useraccount` (`control_number`);

--
-- Constraints for table `student_answer_science`
--
ALTER TABLE `student_answer_science`
  ADD CONSTRAINT `st_ID8` FOREIGN KEY (`control_number`) REFERENCES `useraccount` (`control_number`);

--
-- Constraints for table `student_examination_score`
--
ALTER TABLE `student_examination_score`
  ADD CONSTRAINT `st_ID13` FOREIGN KEY (`control_number`) REFERENCES `useraccount` (`control_number`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
