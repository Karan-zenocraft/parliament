-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 14, 2019 at 07:50 PM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parliament`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `answer_text` varchar(255) NOT NULL,
  `mp_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `mp_id`, `created_at`, `updated_at`) VALUES
(24, 51, 'weqwewqewqeqwe', 2, '2019-10-14 09:33:03', '2019-10-14 09:33:03'),
(25, 51, 'sdfwsfsdfsdfdsfsd nnnnnnnnnnnnnnnnn', 2, '2019-10-14 09:34:03', '2019-10-14 09:34:03'),
(26, 51, 'gdfgdfgdfgdsfg nnnnnnn gggggg', 2, '2019-10-14 09:42:44', '2019-10-14 09:42:44'),
(27, 51, 'safsdfsdfsdf lllllllll', 2, '2019-10-14 09:43:24', '2019-10-14 09:43:24'),
(28, 51, 'sadasd', 2, '2019-10-14 09:44:58', '2019-10-14 09:44:58'),
(29, 51, 'sadasdasd', 2, '2019-10-14 09:48:13', '2019-10-14 09:48:13'),
(30, 51, 'zxczxcZXC', 2, '2019-10-14 09:49:26', '2019-10-14 09:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `user_agent_id` bigint(20) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `is_delete` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `question_id`, `comment_text`, `user_agent_id`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 52, 'Hi this is my first comment', 2, 1, 0, '2019-10-14 10:52:55', '2019-10-14 10:52:55'),
(2, 52, 'sadasdasd', 2, 1, 0, '2019-10-14 10:54:32', '2019-10-14 10:54:32'),
(3, 52, 'sadasdasd', 2, 1, 0, '2019-10-14 10:54:38', '2019-10-14 10:54:38'),
(4, 53, 'sadasdasd', 2, 1, 0, '2019-10-14 10:55:10', '2019-10-14 10:55:10'),
(5, 53, 'sadasdasd', 2, 1, 0, '2019-10-14 10:55:20', '2019-10-14 10:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `email_format`
--

CREATE TABLE `email_format` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=In-Active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `email_format`
--

INSERT INTO `email_format` (`id`, `title`, `subject`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'forgot_password', 'Forgot Password', '<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">\n    <tbody>\n        <tr>\n            <td style=\"padding:20px 0 20px 0\" align=\"center\" valign=\"top\"><!-- [ header starts here] -->\n            <table style=\"border:1px solid #E0E0E0;\" cellpadding=\"10\" cellspacing=\"0\" bgcolor=\"FFFFFF\" border=\"0\" width=\"650\">\n                <tbody>\n                    <tr>\n                        <td style=\"background: #444444; \" bgcolor=\"#EAEAEA\" valign=\"top\"><p><a href=\"{logo_front_url}\"><img style=\"\" src=\"{logo_img_url}\" alt=\"Parliament\" title=\"Parliament\"></a></p><p></p><p></p></td>\n                    </tr>\n                    <!-- [ middle starts here] -->\n                    <tr>\n                        <td valign=\"top\">\n                        <p>Dear  {username},</p>  \n                        <p>Your New Password is :<br></p><p><strong>E-mail:</strong> {email}<br>     \n                         </p><p><strong>Password:</strong> {password}<br>    \n                        \n                        </p><p>&nbsp;</p>\n                        </td>\n                    </tr>\n                   <tr>\n                        <td style=\"background: #444444; text-align:center;color: white;\" align=\"center\" bgcolor=\"#EAEAEA\"><center>\n                        <p style=\"font-size:12px; margin:0;\">Parliament Team</p>\n                        </center></td>\n                    </tr>\n                </tbody>\n            </table>\n            </td>\n        </tr>\n    </tbody>\n</table>', 1, '2013-09-08 00:00:00', NULL),
(2, 'user_registration', 'Parliament -New Account', '<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\n    <tbody>\n        <tr>\n            <td style=\"padding:20px 0 20px 0\" valign=\"top\" align=\"center\"><!-- [ header starts here] -->\n            <table style=\"border:1px solid #E0E0E0;\" cellpadding=\"10\" cellspacing=\"0\" width=\"650\" bgcolor=\"FFFFFF\" border=\"0\">\n                <tbody>\n                    <tr>\n                        <td style=\"background:#444444; \" valign=\"top\" bgcolor=\"#EAEAEA\"><p><a href=\"{logo_front_url}\"><img style=\"\" src=\"{logo_img_url}\" alt=\"parliament\" title=\"Parliament\"></a></p><p></p><p></p></td>\n                    </tr>\n                    <!-- [ middle starts here] -->\n                    <tr>\n                        <td valign=\"top\">\n                        <p>Dear  {username},</p>  \n                        <p>Your account has been created.<br></p>\n                          <p>{loginurl}<br></p>\n                          <p><strong>E-mail:</strong> {email} <br></p>\n<p><strong>Password:</strong> {password} <br></p>\n                        <p></p><p>&nbsp;</p>\n                        </td>\n                    </tr>\n                   <tr>\n                        <td style=\"background: #444444; text-align:center;color: white;\" align=\"center\" bgcolor=\"#EAEAEA\"><center>\n                        <p style=\"font-size:12px; margin:0;\">Parliament Team</p>\n                        </center></td>\n                    </tr>\n                </tbody>\n            </table>\n            </td>\n        </tr>\n    </tbody>\n</table>', 1, '2013-09-08 00:00:00', NULL),
(3, 'reset_password', 'Reset Password', '<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">\n    <tbody>\n        <tr>\n            <td style=\"padding:20px 0 20px 0\" align=\"center\" valign=\"top\"><!-- [ header starts here] -->\n            <table style=\"border:1px solid #E0E0E0;\" cellpadding=\"10\" cellspacing=\"0\" bgcolor=\"FFFFFF\" border=\"0\" width=\"650\">\n                <tbody>\n                    <tr>\n                        <td style=\"background: #444444; \" bgcolor=\"#EAEAEA\" valign=\"top\"><p><a href=\"{logo_front_url}\"><img style=\"\" src=\"{logo_img_url}\" alt=\"parliament\" title=\"parliament\"></a></p><p></p><p></p></td>\n                    </tr>\n                    <!-- [ middle starts here] -->\n                    <tr>\n                        <td valign=\"top\">\n                        <p>Dear  {username},</p>  \n                        <p>Follow the link below to reset your password:</p>\n                        <p>{resetLink}</p>\n                        \n                        </p><p>&nbsp;</p>\n                        </td>\n                    </tr>\n                   <tr>\n                        <td style=\"background: #444444; text-align:center;color: white;\" align=\"center\" bgcolor=\"#EAEAEA\"><center>\n                        <p style=\"font-size:12px; margin:0;\">Parliament Team</p>\n                        </center></td>\n                    </tr>\n                </tbody>\n            </table>\n            </td>\n        </tr>\n    </tbody>\n</table>', 1, '2013-09-08 00:00:00', NULL),
(4, 'contact_us', 'Parliament Contact', '<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" border=\"0\">\r\n    <tbody>\r\n        <tr>\r\n            <td style=\"padding:20px 0 20px 0\" valign=\"top\" align=\"center\"><!-- [ header starts here] -->\r\n            <table style=\"border:1px solid #E0E0E0;\" cellpadding=\"10\" cellspacing=\"0\" width=\"650\" bgcolor=\"FFFFFF\" border=\"0\">\r\n                <tbody>\r\n                    <tr>\r\n                        <td style=\"background:#444444; \" valign=\"top\" bgcolor=\"#EAEAEA\"><p><a href=\"{logo_front_url}\"><img style=\"\" src=\"{logo_img_url}\" alt=\"Parliament\" title=\"Parliament\"></a></p><p></p><p></p></td>\r\n                    </tr>\r\n                    <!-- [ middle starts here] -->\r\n                    <tr>\r\n                        <td valign=\"top\">\r\n                        <p>Hello  Parliament Admin,\r\n                        <p>{message}<br></p>\r\n                        <p></p><p>&nbsp;</p>\r\n                        </td>\r\n                    </tr>\r\n                   <tr>\r\n                        <td style=\"background: #444444; text-align:center;color: white;\" align=\"center\" bgcolor=\"#EAEAEA\"><center>\r\n                        <p style=\"font-size:12px; margin:0;\">{name}</p>\r\n                        </center></td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n            </td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 1, '2013-09-08 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1568809632),
('m130524_201442_init', 1568809644),
('m190124_110200_add_verification_token_column_to_user_table', 1568809645);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) NOT NULL,
  `user_agent_id` bigint(20) NOT NULL,
  `question` varchar(600) NOT NULL,
  `mp_id` varchar(255) NOT NULL,
  `louder_by` longtext,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `is_delete` smallint(6) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `user_agent_id`, `question`, `mp_id`, `louder_by`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(39, 6, 'Hi Guys When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything?', '2,12,14,20,19', '6', 1, 0, '2019-10-07 13:10:25', '2019-10-11 15:18:19'),
(40, 6, 'hey MP i want to ask one question to you that our city\'s roads are very bad to drive and very risky also please repair it as soon as possible this is my complaint to you please fix it asap.', '12,14', '8', 1, 0, '2019-10-09 05:43:55', '2019-10-11 12:44:33'),
(41, 8, 'Hi How are you? MP', '12', '8,6', 1, 0, '2019-10-09 09:17:31', '2019-10-12 16:24:00'),
(42, 8, 'Hi How are you?', '12', '8,6', 1, 0, '2019-10-09 09:17:34', '2019-10-11 12:57:32'),
(43, 8, 'test question test question test question', '19', '8', 1, 0, '2019-10-09 09:18:08', '2019-10-11 12:57:14'),
(44, 8, 'test question 1', '19', '8,6', 1, 0, '2019-10-09 09:18:27', '2019-10-11 12:57:30'),
(45, 8, 'test question 1', '13', '8', 1, 0, '2019-10-09 09:18:32', '2019-10-11 12:57:26'),
(46, 8, 'test question 1', '13', '8,6', 1, 0, '2019-10-09 09:18:33', '2019-10-14 08:59:19'),
(47, 8, 'test question 2', '10', '8,6', 1, 0, '2019-10-09 09:18:50', '2019-10-12 16:23:56'),
(48, 8, 'test question 3', '17,10', '6', 1, 0, '2019-10-09 09:19:20', '2019-10-11 13:22:31'),
(49, 8, 'test question 4', '14', '8,6', 1, 0, '2019-10-09 09:19:32', '2019-10-11 12:50:28'),
(50, 8, 'test question 5 test question 5 test question 5test question 5 test question 5 test question 5 test question 5 test question 5 test question 5 test question 5 test question 5 test question 5 test question 5 test question 5test question 5 test question 5', '2,14', '8,6', 1, 0, '2019-10-09 09:19:59', '2019-10-14 08:59:10'),
(51, 6, 'When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. hope that I would not have a single bit of talent left and could say, I used When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say', '2,20,19', '8,6', 1, 0, '2019-10-09 11:40:53', '2019-10-12 16:24:23'),
(52, 6, 'dasdasdsadasd', '12,14,20,19,15', '6', 1, 1, '2019-10-11 15:34:11', '2019-10-14 14:07:13'),
(53, 6, 'When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. hope that I would not have a single bit of talent left and could say, I used When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say', '12', '6,6', 1, 1, '2019-10-12 16:56:34', '2019-10-14 14:06:29');

-- --------------------------------------------------------

--
-- Table structure for table `question_hide`
--

CREATE TABLE `question_hide` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `question_id` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_hide`
--

INSERT INTO `question_hide` (`id`, `user_id`, `question_id`, `created_at`, `updated_at`) VALUES
(3, 6, '52,53', '2019-10-14 14:06:55', '2019-10-14 14:08:04');

-- --------------------------------------------------------

--
-- Table structure for table `question_louder`
--

CREATE TABLE `question_louder` (
  `id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `question_reported`
--

CREATE TABLE `question_reported` (
  `id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `report_comment` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shares`
--

CREATE TABLE `shares` (
  `id` bigint(20) NOT NULL,
  `question_id` bigint(20) NOT NULL,
  `user_agent_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`, `role_id`) VALUES
(8, 'rutusha', 'bGGmDvu-kF2DhZr5_zbu8vOQIQmKts7K', '$2y$13$WT66IIMq9Oj440XP41paZ.jjm/2EjHtNzPh25OkzN59p5Gux69yTG', NULL, 'rutusha1212joshi@gmail.com', 10, 1568890574, 1569244192, 'uQqgSw6J397lVhL9gfKJcbeuxk7CWz7z_1568890574', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `city` text,
  `age` int(11) DEFAULT NULL,
  `gender` tinyint(5) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `education` varchar(255) DEFAULT NULL,
  `years_hopr` int(11) DEFAULT NULL,
  `password_reset_token` text,
  `badge_count` int(8) DEFAULT NULL,
  `standing_commitee` varchar(255) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '''0'':''Active,''1'':''In-Active''',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `email`, `password`, `user_name`, `city`, `age`, `gender`, `photo`, `education`, `years_hopr`, `password_reset_token`, `badge_count`, `standing_commitee`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'testingforproject0@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'parliament_admin', 'test', 1, NULL, 'bk1_5d8b08ac2cdd3.jpg', 'rrrrr', NULL, '', 0, '', 1, '2019-05-03 10:09:57', '2019-09-25 06:26:52'),
(2, 2, 'rutusha1212joshi@gmail.com', '21232f297a57a5a743894a0e4a801fc3', ' Cally Fenney', 'zydus', 30, 1, 'crs-fvicn-1_5d8b08d644ddd.png', 'MECE', NULL, NULL, 0, 'Foregign Relation & Peace', 1, '2019-05-03 10:09:57', '2019-09-25 13:36:05'),
(6, 3, 'rutusha.joshi@zenocraft.com', '21232f297a57a5a743894a0e4a801fc3', 'Shivani Barrow', 'ahmedabad', 3, 2, 'business-3370832_1280_5d8b05ac72aac.jpg', 'e', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-24 14:30:02', '2019-09-25 07:17:23'),
(8, 3, 'jay.varan@zenocraft.com', '21232f297a57a5a743894a0e4a801fc3', 'jay', 'ahmedabad', 29, 2, 'business-3370832_1280_5d8b05ac72aac.jpg', 'BECE', 3, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 06:14:04', '2019-09-25 07:37:59'),
(9, 2, 'chiefsrs1236@gmail.com', '13489faf95ad78aec2cbebab40ec5a73', 'Timur solomon', 'baroda', 5, 2, 'chief-rs_logo_5d8b1337e06d7.png', 'rrrrr', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 07:11:51', '2019-09-25 07:22:03'),
(10, 2, 'chiefsrs1234@gmail.com', '13489faf95ad78aec2cbebab40ec5a73', 'Norma Cano', 'rajkot', 90, 2, 'chief-rs_logo_5d8b1337e06d7.png', 'rrrrr', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 07:11:51', '2019-09-25 07:22:03'),
(11, 2, 'chiefsrs12s3@gmail.com', '13489faf95ad78aec2cbebab40ec5a73', 'Nims Caroz', 'surat', 89, 2, 'chief-rs_logo_5d8b1337e06d7.png', 'rrrrr', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 07:11:51', '2019-09-25 07:22:03'),
(12, 2, 'charlie@gmail.com', '13489faf95ad78aec2cbebab40ec5a73', 'Charlie Boss', 'charlie', 12, 2, 'chief-rs_logo_5d8b1337e06d7.png', 'rrrrr', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 07:11:51', '2019-09-25 07:22:03'),
(13, 2, 'jazz@gmail.com', '13489faf95ad78aec2cbebab40ec5a73', 'Jazz Campus', 'gg', 12, 2, 'chief-rs_logo_5d8b1337e06d7.png', 'rrrrr', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 07:11:51', '2019-09-25 07:22:03'),
(14, 2, 'danny@gmail.com', '13489faf95ad78aec2cbebab40ec5a73', 'Danny Goel', 'gg', 12, 2, 'chief-rs_logo_5d8b1337e06d7.png', 'rrrrr', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 07:11:51', '2019-09-25 07:22:03'),
(15, 2, 'Hoang@gmail.com', '13489faf95ad78aec2cbebab40ec5a73', 'Hoang ', 'gg', 12, 2, 'chief-rs_logo_5d8b1337e06d7.png', 'rrrrr', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 07:11:51', '2019-09-25 07:22:03'),
(16, 2, 'Hoang@gmail.com', '13489faf95ad78aec2cbebab40ec5a73', 'Hoang Dang', 'gg', 12, 2, 'chief-rs_logo_5d8b1337e06d7.png', 'rrrrr', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 07:11:51', '2019-09-25 07:22:03'),
(17, 2, 'jane@gmail.com', '13489faf95ad78aec2cbebab40ec5a73', 'Jane Strawbel', 'gg', 12, 2, 'chief-rs_logo_5d8b1337e06d7.png', 'rrrrr', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 07:11:51', '2019-09-25 07:22:03'),
(18, 2, 'janes@gmail.com', '13489faf95ad78aec2cbebab40ec5a73', 'Janes Starch', 'gg', 12, 2, 'chief-rs_logo_5d8b1337e06d7.png', 'rrrrr', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 07:11:51', '2019-09-25 07:22:03'),
(19, 2, 'helyd@gmail.com', '13489faf95ad78aec2cbebab40ec5a73', 'Hely Gomez', 'gg', 12, 2, 'chief-rs_logo_5d8b1337e06d7.png', 'rrrrr', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 07:11:51', '2019-09-25 07:22:03'),
(20, 2, 'hely@gmail.com', '13489faf95ad78aec2cbebab40ec5a73', 'helcuras Lee', 'gg', 12, 2, 'chief-rs_logo_5d8b1337e06d7.png', 'rrrrr', NULL, NULL, NULL, 'Foregign Relation & Peace', 1, '2019-09-25 07:11:51', '2019-09-25 07:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_name`, `role_description`) VALUES
(1, 'admin', 'Administartor'),
(2, 'MP', 'MP'),
(3, 'User Agent', 'User Agent');

-- --------------------------------------------------------

--
-- Table structure for table `user_rules`
--

CREATE TABLE `user_rules` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `privileges_controller` varchar(255) NOT NULL,
  `privileges_actions` text NOT NULL,
  `permission` enum('allow','deny') NOT NULL DEFAULT 'allow',
  `permission_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_rules`
--

INSERT INTO `user_rules` (`id`, `role_id`, `privileges_controller`, `privileges_actions`, `permission`, `permission_type`) VALUES
(1, 1, 'SiteController', 'index,logout,change-password,forgot-password', 'allow', 'admin'),
(2, 2, 'SiteController', 'logout,change-password,forgot-password,index,engagement,load-more-questions,answer-question,save-comment,validate-comment,report-question', 'allow', 'MP'),
(3, 3, 'SiteController', 'logout,change-password,forgot-password,index,engagement,current-city,make-louder,load-more-questions,save-comment,validate-comment,report-question,retract-question,hide-question', 'allow', 'user_agent'),
(4, 1, 'UsersController', 'create,update,delete,view,index', 'allow', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_rules_menu`
--

CREATE TABLE `user_rules_menu` (
  `id` int(10) NOT NULL,
  `category` enum('admin','front-top','front-bottom','front-middle') NOT NULL DEFAULT 'admin',
  `parent_id` int(10) NOT NULL DEFAULT '0',
  `user_rules_id` int(10) NOT NULL,
  `label` varchar(255) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `position` int(10) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 - inactive, 1 - active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_rules_menu`
--

INSERT INTO `user_rules_menu` (`id`, `category`, `parent_id`, `user_rules_id`, `label`, `class`, `url`, `position`, `status`) VALUES
(1, 'admin', 0, 1, 'Dashboard', 'icon-home', 'site/index', 1, 1),
(5, 'admin', 0, 4, 'Manage Users', 'icon-user', 'users/index', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `MP` (`mp_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_agent_id` (`user_agent_id`);

--
-- Indexes for table `email_format`
--
ALTER TABLE `email_format`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_agent` (`user_agent_id`),
  ADD KEY `MPs` (`mp_id`);

--
-- Indexes for table `question_hide`
--
ALTER TABLE `question_hide`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `question_louder`
--
ALTER TABLE `question_louder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question` (`question_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `question_reported`
--
ALTER TABLE `question_reported`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question` (`question_id`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `shares`
--
ALTER TABLE `shares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `user_agent_id` (`user_agent_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_rules`
--
ALTER TABLE `user_rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_rules_menu`
--
ALTER TABLE `user_rules_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_rules_id` (`user_rules_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `email_format`
--
ALTER TABLE `email_format`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `question_hide`
--
ALTER TABLE `question_hide`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `question_louder`
--
ALTER TABLE `question_louder`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question_reported`
--
ALTER TABLE `question_reported`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shares`
--
ALTER TABLE `shares`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_rules`
--
ALTER TABLE `user_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_rules_menu`
--
ALTER TABLE `user_rules_menu`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `MP` FOREIGN KEY (`mp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `question_id` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_agent_id` FOREIGN KEY (`user_agent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `user_agent` FOREIGN KEY (`user_agent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question_louder`
--
ALTER TABLE `question_louder`
  ADD CONSTRAINT `qquestion` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shares`
--
ALTER TABLE `shares`
  ADD CONSTRAINT `question` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `useragent` FOREIGN KEY (`user_agent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role_id` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
