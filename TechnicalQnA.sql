-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 12, 2024 at 01:29 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TechnicalQnA`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `upvoteCount` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `questionId`, `username`, `description`, `upvoteCount`, `created_at`, `updated_at`) VALUES
(26, 32, 'chamudiabeysinghe', 'If you ran npx create-next-app your-app there should be an App.js file in the src directory. That file is where you shoul\n\nd add your random component or rename App.js to Random.js and import it to index.js.', 0, '2024-05-12 11:09:41', '2024-05-12 11:09:51'),
(27, 32, 'kulajakodikara', 'There is no clear definition of App in your app.js. You would have to create a class for App, then export it. I think you meant export default Random, or some other thing actually defined.', 2, '2024-05-12 11:11:07', '2024-05-12 11:19:06'),
(28, 33, 'kulajakodikara', 'The error java.lang.StackOverflowError is thrown to indicate that the application’s stack was exhausted, due to deep recursion i.e your program/script recurses too deeply.', 0, '2024-05-12 11:11:36', '2024-05-12 11:11:36'),
(29, 34, 'savithjayasinghe', 'Fixed!.................\nThe reason was the dbpath variable in /etc/mongodb.conf. Previously, I was using mongodb 1.8, where the default value for dbpath was /data/db. The upstart job mongodb(which comes with mongodb-10gen package) invokes the mongod with --config /etc/mongodb.conf option.', 0, '2024-05-12 11:14:11', '2024-05-12 11:14:11'),
(30, 32, 'savithjayasinghe', 'If you ran npx create-next-app your-app there should be an App.js file in the src directory. ', 3, '2024-05-12 11:15:05', '2024-05-12 11:18:57'),
(31, 33, 'umeshdulanjana', 'What actually causes a java.lang.StackOverflowError is typically unintentional recursion. For me it\'s often when I intended to call a super method for the overidden method.', 0, '2024-05-12 11:18:32', '2024-05-12 11:18:32'),
(33, 35, 'teronshanel', 'It needs to install verion \"webpack\" \"4.19.1\" so\n\nfirstly we have to uninstall our old version \"webpack\" by using: \n\n$npm uninstall -g webpack', 0, '2024-05-12 11:20:58', '2024-05-12 11:20:58'),
(34, 33, 'teronshanel', 'I had this error because I was parsing a list of objects mapped on both sides @OneToMany and @ManyToOne to json using jackson which caused an infinite loop.\n\nIf you are in the same situation you can solve this by using @JsonManagedReference and @JsonBackReference annotations.', 0, '2024-05-12 11:24:05', '2024-05-12 11:24:05');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `questionCount` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `questionCount`, `created_at`, `updated_at`, `description`) VALUES
(6, 'MySQL', 0, '2024-05-12 10:55:43', '2024-05-12 10:55:43', 'A relational database management system used for storing and retrieving data across applications.'),
(7, 'React', 2, '2024-05-12 10:55:43', '2024-05-12 11:17:08', 'A JavaScript library for building interactive user interfaces, particularly single-page applications.'),
(8, 'JavaScript', 0, '2024-05-12 10:55:43', '2024-05-12 10:57:47', 'A programming language commonly used to create dynamic web pages.'),
(9, 'MobileDevelopment', 0, '2024-05-12 10:55:43', '2024-05-12 10:58:35', 'Design and development of applications for mobile devices like smartphones.'),
(10, 'WebDevelopment', 0, '2024-05-12 10:55:43', '2024-05-12 10:59:21', 'Focuses on the creation of web applications, covering both front-end and back-end technologies.'),
(11, 'MongoDB', 1, '2024-05-12 10:55:43', '2024-05-12 11:12:37', 'A NoSQL database known for its high performance, high availability, and easy scalability.'),
(12, 'Python', 0, '2024-05-12 10:55:43', '2024-05-12 10:55:43', 'A programming language known for its readability and broad applicability in areas like web development, automation, and data analysis.'),
(13, 'Java', 1, '2024-05-12 10:55:43', '2024-05-12 11:08:19', 'A widely-used programming language, designed to have as few implementation dependencies as possible, used in web and application development.'),
(14, 'APIs', 0, '2024-05-12 10:55:43', '2024-05-12 10:55:43', 'Stands for Application Programming Interfaces, which allow different software applications to communicate with each other.'),
(15, 'CSS', 2, '2024-05-12 10:55:43', '2024-05-12 11:25:27', 'Short for Cascading Style Sheets, used to style and layout web pages — for example, changing fonts, colors, and spacing.'),
(16, 'HTML', 0, '2024-05-12 10:55:43', '2024-05-12 11:01:01', 'Hyper Text Markup Language: The standard markup language used to create and design web pages and web applications.'),
(17, 'CloudComputing', 0, '2024-05-12 10:55:43', '2024-05-12 10:55:43', 'Covers services such as servers, storage, databases, networking, software, over the internet (\"the cloud\").'),
(18, 'MachineLearning', 0, '2024-05-12 10:55:43', '2024-05-12 10:55:43', 'Focuses on algorithms and statistical models that computer systems use to perform tasks without explicit instructions.'),
(19, 'Security', 0, '2024-05-12 10:55:43', '2024-05-12 10:55:43', 'Encompasses the techniques and tools used to protect data and systems from unauthorized access and threats.'),
(20, 'NodeJS', 0, '2024-05-12 10:55:43', '2024-05-12 10:56:04', 'An open-source, cross-platform JavaScript runtime environment that executes JavaScript code outside of a browser.'),
(21, 'Angular', 0, '2024-05-12 10:55:43', '2024-05-12 10:55:43', 'A platform and framework for building single-page client applications using HTML and TypeScript.'),
(22, 'Swift', 0, '2024-05-12 10:55:43', '2024-05-12 10:55:43', 'A powerful and intuitive programming language for macOS, iOS, watchOS, and tvOS app development.'),
(25, 'DataScience', 0, '2024-05-12 10:55:43', '2024-05-12 11:02:20', 'The field of extracting knowledge and insights from structured and unstructured data.');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `upvoteCount` int(11) DEFAULT 0,
  `answerCount` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `username`, `category`, `title`, `description`, `upvoteCount`, `answerCount`, `created_at`, `updated_at`) VALUES
(32, 'purnaperamune', 'React', 'Getting an error when using React - \'App\' is not defined', 'Completely new to React and failing to understand this error: Compiled with problems. \nI have found multiple \"solutions\" for this but none of which I can completely comprehend in my case for some reason, probably just a mental blocker. I essentially used the template create-react-app and added in my own files which had what I wanted to create a basic color changer app. After adding files I get the above error.', 1, 3, '2024-05-12 11:03:59', '2024-05-12 11:26:29'),
(33, 'chamudiabeysinghe', 'Java', 'What causes a java.lang.StackOverflowError?', 'What can cause a java.lang.StackOverflowError? The stack printout that I get is not very deep at all (only 5 methods).', 2, 3, '2024-05-12 11:08:19', '2024-05-12 11:24:05'),
(34, 'kulajakodikara', 'MongoDB', 'Mongodb service is not starting up.', 'I\'ve installed the mongodb 2.0.3, using the mongodb-10gen debian package. Everything went well, except the service which is installed by default is not starting up when computer starts. The mongod is running only as root user. maybe this is the reason. but as far as I know, the services should be running since they are added by the root user.\n\nWhat may be the solution?', 3, 1, '2024-05-12 11:12:37', '2024-05-12 11:21:23'),
(35, 'umeshdulanjana', 'React', 'React.js: create-react-app working but returns this type of error', 'I\'m new to React and I used this explanation to build a basic React app:\n\nWhen I try to create new react app by using\n\n\"npm create-react-app trail-app\"\nthen it\'s returns an error. ', 2, 1, '2024-05-12 11:17:08', '2024-05-12 11:23:22'),
(36, 'teronshanel', 'CSS', 'Align header at the top of the container in HTML/CSS?', 'I\'m currently working on a project where I have a header that I\'d like to position at the top of a container in my HTML/CSS layout. However, the header is currently appearing on the left side, and I want it to be at the top.', 0, 0, '2024-05-12 11:23:02', '2024-05-12 11:23:02'),
(37, 'purnaperamune', 'CSS', 'How can I make a TextArea 100% width without overflowing when padding is present in CSS?', 'The problem is that the text area ends up being 8px wider (2px for border + 6px for padding) than the parent. Is there a way to continue to use border and padding but constrain the total size of the textarea to the width of the parent?', 1, 0, '2024-05-12 11:25:27', '2024-05-12 11:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `secondName` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstName`, `secondName`, `username`, `password`, `created_at`) VALUES
(50, 'Lavan', 'Chethila', 'chethila', '$2y$10$mSsxu7saNVf4/ARlF8CwOeQcgNaoHEVDcJy2AB8nKz60zA.31K0l2', '2024-05-12 05:30:18'),
(52, 'Purna', 'Peramune', 'purnaperamune', '$2y$10$H/hz4ey0Gnw2bXGDTIbE2.j5RZtTPB0XZMj3K4Qrd6gkOoMF8JOgm', '2024-05-12 10:42:39'),
(53, 'Chamudi', 'Abeysinghe', 'chamudiabeysinghe', '$2y$10$CwA7dz4.buOV1v5fifMfqOEtX6eYsN1dgXLXumMeQp98FXjftORz2', '2024-05-12 11:07:10'),
(54, 'Kulaja', 'Kodikara', 'kulajakodikara', '$2y$10$wfbgoDQp2MH7H6g/A.BYReuCl1Dnio7IWJFJ2ph1l.PvZSdbZ931.', '2024-05-12 11:10:40'),
(55, 'Savith', 'Jayasinghe', 'savithjayasinghe', '$2y$10$Aos0evSEvRpCpTTI3u3FN.PzcVq7Xg82rexsLtExB6JTwXOMCm0AO', '2024-05-12 11:13:04'),
(56, 'Umesh', 'Dulanjana', 'umeshdulanjana', '$2y$10$PZGzZa7kNkNtedeMOrUNEuwgsfP2oKCJVhbsjeipnMbpfId1vJcCe', '2024-05-12 11:15:36'),
(57, 'Teron', 'Shanel', 'teronshanel', '$2y$10$7q6aZsOW/Rqnmu961snIxueFb44k41wdngUJToX/lyp0E9laok/.C', '2024-05-12 11:19:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `question` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`name`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
