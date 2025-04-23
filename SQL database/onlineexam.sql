-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2024 at 07:35 AM
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
(1, 31143, '2024-08-24', '12:30:00', 'Completed', '2024-08-24 04:26:03'),
(2, 5555, '2024-08-27', '12:30:00', 'Scheduled', '2024-08-27 04:15:31'),
(3, 21664, '2024-08-27', '13:00:00', 'Scheduled', '2024-08-27 04:35:30');

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
('21664', 'Jennie', 'Kim', 'fabianmeg74@gmail.com'),
('31143', 'Meg', 'Fabian', 'megangeline08@gmail.com');

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
(68, 21664, 'Teapot', 17);

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
(18, 31143, '15', 22);

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
(18, 31143, 'Birds', 19);

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
(17, 31143, 'Earth', 2);

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
(2, 31143, '2024-08-24', '12:30:00', '00:00:00', 14, 4, 11, 11, 40, 'FAILED', '2024-08-24 04:13:42'),
(4, 21664, '2024-08-27', '13:00:00', '00:00:00', 13, 0, 0, 0, 0, '', '2024-08-27 05:32:00');

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
(5555, 'Lisa', 'Lalalisa', '2024-08-26 13:27:08'),
(21664, 'jen', 'Jennpass00!', '2024-08-26 09:54:29'),
(31143, 'meg', 'Newpass00!', '2024-07-31 22:00:00'),
(31322, 'jisoo', 'jisoo', '2024-08-26 13:26:20'),
(44444, 'Rose', 'Chaeyong', '2024-08-26 13:26:39');

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
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `logic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `student_answer_math`
--
ALTER TABLE `student_answer_math`
  MODIFY `mathID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `student_answer_reading_comprehension`
--
ALTER TABLE `student_answer_reading_comprehension`
  MODIFY `reading_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `student_answer_science`
--
ALTER TABLE `student_answer_science`
  MODIFY `science_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `student_examination_score`
--
ALTER TABLE `student_examination_score`
  MODIFY `studExam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `control_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44445;
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
