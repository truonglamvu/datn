-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  ven. 01 nov. 2019 à 12:35
-- Version du serveur :  10.4.8-MariaDB
-- Version de PHP :  7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mytour_docs`
--

DELIMITER $$
--
-- Fonctions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `CAP_FIRST_phuongnm` (`input` VARCHAR(255), `spec_char` VARCHAR(1)) RETURNS VARCHAR(255) CHARSET utf8 COLLATE utf8_unicode_ci BEGIN
                    DECLARE len INT;
                    DECLARE i INT;
                    SET len   = CHAR_LENGTH(input);
                    SET input = LOWER(input);
                    SET i = 0;
                    WHILE (i < len) DO
                      IF (MID(input,i,1) = spec_char OR i = 0) THEN
                        IF (i < len) THEN
                          SET input = CONCAT(
                              LEFT(input,i),
                              UPPER(MID(input,i + 1,1)),
                              RIGHT(input,len - i - 1)
                          );
                        END IF;
                      END IF;
                      SET i = i + 1;
                    END WHILE;
                
                    RETURN input;
                  END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `slugify_phuongnm` (`str` TEXT, `f_char` VARCHAR(1), `t_char` VARCHAR(1), `is_lower` BOOLEAN, `cap_first` BOOLEAN) RETURNS TEXT CHARSET utf8 COLLATE utf8_unicode_ci BEGIN
                    DECLARE len, i INTEGER;
                    DECLARE codau,kdau,dup_char VARCHAR(255);
                    IF is_lower Then
                      SET str = lower(str);
                    END IF;
                    SET codau = 'áàảãạâấầẩẫậăắằẳẵặđéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵ\#$%&/¿?¡!¬|@~«<{[()]}>»·*+=.,;:ªº^°"''''`´‘’”“';
                    SET kdau =  'aaaaaaaaaaaaaaaaadeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyy                                                ';
                    SET len = CHAR_LENGTH(codau);
                    SET i = 1;
                
                    WHILE len >= i  DO
                      SET str = replace(str, substr(codau,i,1), substr(kdau,i,1));
                      SET i = i + 1;
                    END WHILE;
                    SET str = REPLACE(
                        REPLACE(
                            str
                            ,f_char
                            ,t_char
                        )
                        , ' '
                        , t_char
                    );
                    SET dup_char = Concat(t_char,t_char);
                
                    IF substr(str,1,1) = t_char Then
                      SET str = right(str, CHAR_LENGTH(str) - 1);
                    END IF;
                    IF substr(str,CHAR_LENGTH(str),1) = t_char Then
                      SET str = left(str, CHAR_LENGTH(str) - 1);
                    END IF;
                    IF cap_first Then
                      SET str = CAP_FIRST_phuongnm(str, t_char);
                    END IF;
                    RETURN str;
                  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menu_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible_on` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `role_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `menu_name`, `visible_on`, `parent_id`, `active`, `created_at`, `updated_at`, `deleted_at`, `role_id`) VALUES
(1, 'Admin', 'a:1:{i:0;s:11:\"super-admin\";}', 0, 1, '2019-10-25 00:41:59', '2019-10-25 00:42:05', NULL, NULL),
(2, 'Pet', 'a:1:{i:0;s:11:\"super-admin\";}', 1, 1, '2019-10-25 00:44:01', '2019-10-25 00:44:06', NULL, NULL),
(3, 'Education', 'a:1:{i:0;s:11:\"super-admin\";}', 1, 1, '2019-11-01 03:41:59', '2019-11-01 03:42:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_11_22_093320_entrust_setup_tables', 1),
(4, '2017_11_27_020439_create_posts_table', 1),
(5, '2017_11_27_020928_create_menus_table', 1),
(6, '2017_11_27_021227_create_logs_table', 1),
(7, '2017_12_13_041611_add_role_id_to_menus_table', 1),
(8, '2018_03_12_074521_create_function_cap_first', 1),
(9, '2018_03_12_075008_create_function_slugify', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create-post', 'Create Posts', 'create new blog posts', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(2, 'edit-user', 'Edit Users', 'edit existing users', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(3, 'delete-user', 'Delete user', 'Can delete user', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(4, 'edit-document', 'Edit document', 'Can edit document', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(5, 'delete-document', 'Delete document', 'Can delete document', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(6, 'create-permission', 'Create new permission', 'Can create new permission', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(7, 'edit-permission', 'Edit a permission', 'Can edit permission', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(8, 'delete-permission', 'Delete permission', 'Can delete permission', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(9, 'create-role', 'Create new role', 'Can create new role', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(10, 'edit-role', 'Edit a role', 'Can edit role', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(11, 'delete-role', 'Delete a role', 'Can delete a role', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(12, 'active-role', 'Active a role', 'Can active a role', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(13, 'active-user', 'Active a user', 'Can active a user', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(14, 'show-list-role', 'show list role', 'show list role', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(15, 'view-user', 'View user', 'Can view user page', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(16, 'view-role', 'View role', 'Can view role page', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(17, 'view-docs', 'View document', 'Can view document page', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(18, 'view-permission', 'View permission', 'Can view permission page', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(19, 'view-menu', 'View menu', 'Can view menu page', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(20, 'create-menu', 'Create new menu', 'Can create new menu', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(21, 'edit-menu', 'Edit menu', 'Can edit menu', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(22, 'delete-menu', 'Delete a menu', 'Can delete a menu', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(23, 'view-detail-document', 'View detail document', 'Can view detail document', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(24, 'active-document', 'Active a document', 'Can active a document', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(25, 'create-user', 'Create new user', 'Can create new user', '2019-10-24 20:58:16', '2019-10-24 20:58:16');

-- --------------------------------------------------------

--
-- Structure de la table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 7),
(2, 7),
(3, 7),
(4, 7),
(5, 7),
(6, 7),
(7, 7),
(8, 7),
(9, 7),
(10, 7),
(11, 7),
(12, 7),
(13, 7),
(14, 7),
(15, 7),
(16, 7),
(17, 7),
(18, 7),
(19, 7),
(20, 7),
(21, 7),
(22, 7),
(23, 7),
(24, 7),
(25, 7);

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_parameter` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_return` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `content`, `title`, `url`, `description_parameter`, `data_return`, `error`, `header`, `method`, `active`, `user_id`, `menu_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '<p>Lấy về danh sách đề thi</p>', 'Example', 'http://edutalk.vn/api/v1/exam', 'a:1:{i:0;a:5:{s:3:\"key\";s:12:\"classroom_id\";s:5:\"value\";s:3:\"488\";s:11:\"description\";N;s:9:\"data_type\";s:7:\"integer\";s:8:\"required\";s:8:\"required\";}}', '{\r\n  \"data\": [\r\n    {\r\n      \"id\": 51,\r\n      \"teacher_id\": 36,\r\n      \"course_id\": 71,\r\n      \"center_id\": 12,\r\n      \"classroom_id\": 488,\r\n      \"month\": \"1\",\r\n      \"type\": \"tS\",\r\n      \"level\": \"1\",\r\n      \"category\": \"Phát Âm\",\r\n      \"begin_time\": \"0000-00-00 00:00:00\",\r\n      \"end_time\": \"0000-00-00 00:00:00\",\r\n      \"created_at\": null,\r\n      \"classroom\": {\r\n        \"id\": 488,\r\n        \"name\": \"GTCB_46\",\r\n        \"date_start\": \"20/12/2018 00:00:00\",\r\n        \"status\": 1,\r\n        \"course_id\": 71,\r\n        \"teacher_id\": 36,\r\n        \"branch_id\": 22,\r\n        \"months\": 1,\r\n        \"days_per_month\": 58,\r\n        \"total_student\": 22,\r\n        \"current_student\": 22,\r\n        \"type\": \"official\",\r\n        \"calendar\": null,\r\n        \"created_at\": \"04/01/2019 19:55:42\"\r\n      },\r\n      \"time_exam\": 0\r\n    },\r\n    {\r\n      \"id\": 124,\r\n      \"teacher_id\": 36,\r\n      \"course_id\": 71,\r\n      \"center_id\": 12,\r\n      \"classroom_id\": 488,\r\n      \"month\": \"2\",\r\n      \"type\": \"tS\",\r\n      \"level\": \"1\",\r\n      \"category\": \"Phát Âm\",\r\n      \"begin_time\": \"0000-00-00 00:00:00\",\r\n      \"end_time\": \"0000-00-00 00:00:00\",\r\n      \"created_at\": null,\r\n      \"classroom\": {\r\n        \"id\": 488,\r\n        \"name\": \"GTCB_46\",\r\n        \"date_start\": \"20/12/2018 00:00:00\",\r\n        \"status\": 1,\r\n        \"course_id\": 71,\r\n        \"teacher_id\": 36,\r\n        \"branch_id\": 22,\r\n        \"months\": 1,\r\n        \"days_per_month\": 58,\r\n        \"total_student\": 22,\r\n        \"current_student\": 22,\r\n        \"type\": \"official\",\r\n        \"calendar\": null,\r\n        \"created_at\": \"04/01/2019 19:55:42\"\r\n      },\r\n      \"time_exam\": 0\r\n    },\r\n    {\r\n      \"id\": 186,\r\n      \"teacher_id\": 36,\r\n      \"course_id\": 71,\r\n      \"center_id\": 12,\r\n      \"classroom_id\": 488,\r\n      \"month\": \"3\",\r\n      \"type\": \"tS\",\r\n      \"level\": \"1\",\r\n      \"category\": \"Phát Âm\",\r\n      \"begin_time\": \"0000-00-00 00:00:00\",\r\n      \"end_time\": \"0000-00-00 00:00:00\",\r\n      \"created_at\": null,\r\n      \"classroom\": {\r\n        \"id\": 488,\r\n        \"name\": \"GTCB_46\",\r\n        \"date_start\": \"20/12/2018 00:00:00\",\r\n        \"status\": 1,\r\n        \"course_id\": 71,\r\n        \"teacher_id\": 36,\r\n        \"branch_id\": 22,\r\n        \"months\": 1,\r\n        \"days_per_month\": 58,\r\n        \"total_student\": 22,\r\n        \"current_student\": 22,\r\n        \"type\": \"official\",\r\n        \"calendar\": null,\r\n        \"created_at\": \"04/01/2019 19:55:42\"\r\n      },\r\n      \"time_exam\": 0\r\n    },\r\n    {\r\n      \"id\": 233,\r\n      \"teacher_id\": 36,\r\n      \"course_id\": 71,\r\n      \"center_id\": 12,\r\n      \"classroom_id\": 488,\r\n      \"month\": \"4\",\r\n      \"type\": \"tS\",\r\n      \"level\": \"1\",\r\n      \"category\": \"Phát Âm\",\r\n      \"begin_time\": \"0000-00-00 00:00:00\",\r\n      \"end_time\": \"0000-00-00 00:00:00\",\r\n      \"created_at\": null,\r\n      \"classroom\": {\r\n        \"id\": 488,\r\n        \"name\": \"GTCB_46\",\r\n        \"date_start\": \"20/12/2018 00:00:00\",\r\n        \"status\": 1,\r\n        \"course_id\": 71,\r\n        \"teacher_id\": 36,\r\n        \"branch_id\": 22,\r\n        \"months\": 1,\r\n        \"days_per_month\": 58,\r\n        \"total_student\": 22,\r\n        \"current_student\": 22,\r\n        \"type\": \"official\",\r\n        \"calendar\": null,\r\n        \"created_at\": \"04/01/2019 19:55:42\"\r\n      },\r\n      \"time_exam\": 0\r\n    },\r\n    {\r\n      \"id\": 273,\r\n      \"teacher_id\": 36,\r\n      \"course_id\": 71,\r\n      \"center_id\": 12,\r\n      \"classroom_id\": 488,\r\n      \"month\": \"5\",\r\n      \"type\": \"tS\",\r\n      \"level\": \"1\",\r\n      \"category\": \"Phát Âm\",\r\n      \"begin_time\": \"0000-00-00 00:00:00\",\r\n      \"end_time\": \"0000-00-00 00:00:00\",\r\n      \"created_at\": null,\r\n      \"classroom\": {\r\n        \"id\": 488,\r\n        \"name\": \"GTCB_46\",\r\n        \"date_start\": \"20/12/2018 00:00:00\",\r\n        \"status\": 1,\r\n        \"course_id\": 71,\r\n        \"teacher_id\": 36,\r\n        \"branch_id\": 22,\r\n        \"months\": 1,\r\n        \"days_per_month\": 58,\r\n        \"total_student\": 22,\r\n        \"current_student\": 22,\r\n        \"type\": \"official\",\r\n        \"calendar\": null,\r\n        \"created_at\": \"04/01/2019 19:55:42\"\r\n      },\r\n      \"time_exam\": 0\r\n    }\r\n  ],\r\n  \"links\": {\r\n    \"first\": \"http://edutalk.vn/api/v1/exam?page=1\",\r\n    \"last\": \"http://edutalk.vn/api/v1/exam?page=1\",\r\n    \"prev\": null,\r\n    \"next\": null\r\n  },\r\n  \"meta\": {\r\n    \"current_page\": 1,\r\n    \"from\": 1,\r\n    \"last_page\": 1,\r\n    \"path\": \"http://edutalk.vn/api/v1/exam\",\r\n    \"per_page\": 25,\r\n    \"to\": 5,\r\n    \"total\": 5\r\n  }\r\n}', 'a:1:{i:0;a:2:{s:10:\"error_code\";N;s:11:\"description\";N;}}', 'a:1:{i:0;a:2:{s:10:\"header_key\";N;s:12:\"header_value\";N;}}', 1, 1, 1, 3, '2019-11-01 03:49:32', '2019-11-01 03:49:32', NULL),
(2, '<p>Nộp bài tập</p>', 'Submit example', 'http://edutalk.vn/api/v1/exam/nop-bai', 'a:1:{i:0;a:5:{s:3:\"key\";s:7:\"results\";s:5:\"value\";s:111:\"[{   \"question_id\": 5,   \"choose\": 13,   \"is_true\": 0 },{   \"question_id\": 5,   \"choose\": 14,   \"is_true\": 0 }]\";s:11:\"description\";s:136:\"Mảng kết quả bài thi. Mỗi item: [‘question_id’ => ‘id cau hoi’,’choose’ => ‘id cau tra loi’,’is_true’ => 0]\";s:9:\"data_type\";s:6:\"object\";s:8:\"required\";s:6:\"option\";}}', '{\r\n  \"errors\": false,\r\n  \"message\": \"Gửi bài thành công!\"\r\n}', 'a:1:{i:0;a:2:{s:10:\"error_code\";N;s:11:\"description\";N;}}', 'a:1:{i:0;a:2:{s:10:\"header_key\";N;s:12:\"header_value\";N;}}', 2, 1, 1, 3, '2019-11-01 03:52:35', '2019-11-01 04:04:18', NULL),
(3, '<p>Lấy về danh sách câu hỏi</p>', 'Questions for Exam', 'http://edutalk.vn/api/v1/exam/questions', 'a:1:{i:0;a:5:{s:3:\"key\";s:7:\"exam_id\";s:5:\"value\";s:1:\"8\";s:11:\"description\";N;s:9:\"data_type\";s:7:\"integer\";s:8:\"required\";s:8:\"required\";}}', '{\r\n  \"data\": [\r\n    {\r\n      \"id\": 5,\r\n      \"text\": \"Chọn từ có phần gạch chân khác với các từ còn lại\",\r\n      \"category\": \"Phát Âm\",\r\n      \"type\": \"u\",\r\n      \"level\": \"1\",\r\n      \"mark\": 0,\r\n      \"answers\": [\r\n        {\r\n          \"id\": 13,\r\n          \"text\": \"rough\",\r\n          \"is_true\": 0\r\n        },\r\n        {\r\n          \"id\": 14,\r\n          \"text\": \"sum\",\r\n          \"is_true\": 0\r\n        },\r\n        {\r\n          \"id\": 15,\r\n          \"text\": \"utter\",\r\n          \"is_true\": 0\r\n        },\r\n        {\r\n          \"id\": 16,\r\n          \"text\": \"union\",\r\n          \"is_true\": 1\r\n        }\r\n      ],\r\n      \"created_at\": \"27/12/18 14:53:08\"\r\n    },\r\n    {\r\n      \"id\": 9,\r\n      \"text\": \"Chọn từ có phần gạch chân khác với các từ còn lại:\",\r\n      \"category\": \"Phát Âm\",\r\n      \"type\": \"i:\",\r\n      \"level\": \"1\",\r\n      \"mark\": 0,\r\n      \"answers\": [\r\n        {\r\n          \"id\": 25,\r\n          \"text\": \"pleasure\",\r\n          \"is_true\": 1\r\n        },\r\n        {\r\n          \"id\": 26,\r\n          \"text\": \"heat\",\r\n          \"is_true\": 0\r\n        },\r\n        {\r\n          \"id\": 27,\r\n          \"text\": \"meat\",\r\n          \"is_true\": 0\r\n        },\r\n        {\r\n          \"id\": 28,\r\n          \"text\": \"feed\",\r\n          \"is_true\": 0\r\n        }\r\n      ],\r\n      \"created_at\": \"11/07/19 13:48:24\"\r\n    },\r\n    {\r\n      \"id\": 17,\r\n      \"text\": \"Điền a, an, the hoặc 0 vào ô trống:\\r\\nBy this time I had come to ________conclusion that he wasn\'t ________genuine meter reader; and ________moment he left ________house I rang ________police.\",\r\n      \"category\": \"Ngữ Pháp\",\r\n      \"type\": \"mạo từ\",\r\n      \"level\": \"3\",\r\n      \"mark\": 0,\r\n      \"answers\": [\r\n        {\r\n          \"id\": 55,\r\n          \"text\": \"the\",\r\n          \"is_true\": 1\r\n        },\r\n        {\r\n          \"id\": 56,\r\n          \"text\": \"a\",\r\n          \"is_true\": 1\r\n        },\r\n        {\r\n          \"id\": 57,\r\n          \"text\": \"the\",\r\n          \"is_true\": 1\r\n        },\r\n        {\r\n          \"id\": 58,\r\n          \"text\": \"the\",\r\n          \"is_true\": 1\r\n        },\r\n        {\r\n          \"id\": 59,\r\n          \"text\": \"the\",\r\n          \"is_true\": 1\r\n        }\r\n      ],\r\n      \"created_at\": \"11/07/19 13:48:30\"\r\n    }\r\n  ],\r\n  \"links\": {\r\n    \"first\": \"http://edutalk.vn/api/v1/exam/questions?page=1\",\r\n    \"last\": \"http://edutalk.vn/api/v1/exam/questions?page=1\",\r\n    \"prev\": null,\r\n    \"next\": null\r\n  },\r\n  \"meta\": {\r\n    \"current_page\": 1,\r\n    \"from\": 1,\r\n    \"last_page\": 1,\r\n    \"path\": \"http://edutalk.vn/api/v1/exam/questions\",\r\n    \"per_page\": 25,\r\n    \"to\": 3,\r\n    \"total\": 3\r\n  }\r\n}', 'a:1:{i:0;a:2:{s:10:\"error_code\";N;s:11:\"description\";N;}}', 'a:1:{i:0;a:2:{s:10:\"header_key\";N;s:12:\"header_value\";N;}}', 1, 1, 1, 3, '2019-11-01 03:55:56', '2019-11-01 03:55:56', NULL),
(4, '<p>Lấy về danh sách bài thi đã nộp</p>', 'Results Example', 'http://edutalk.vn/api/v1/exam/results', 'a:1:{i:0;a:5:{s:3:\"key\";s:7:\"exam_id\";s:5:\"value\";s:1:\"8\";s:11:\"description\";N;s:9:\"data_type\";s:7:\"integer\";s:8:\"required\";s:8:\"required\";}}', '{\r\n  \"data\": [],\r\n  \"links\": {\r\n    \"first\": \"http://edutalk.vn/api/v1/exam/results?page=1\",\r\n    \"last\": \"http://edutalk.vn/api/v1/exam/results?page=1\",\r\n    \"prev\": null,\r\n    \"next\": null\r\n  },\r\n  \"meta\": {\r\n    \"current_page\": 1,\r\n    \"from\": null,\r\n    \"last_page\": 1,\r\n    \"path\": \"http://edutalk.vn/api/v1/exam/results\",\r\n    \"per_page\": 25,\r\n    \"to\": null,\r\n    \"total\": 0\r\n  }\r\n}', 'a:1:{i:0;a:2:{s:10:\"error_code\";N;s:11:\"description\";N;}}', 'a:1:{i:0;a:2:{s:10:\"header_key\";N;s:12:\"header_value\";N;}}', 1, 1, 1, 3, '2019-11-01 03:58:45', '2019-11-01 04:05:34', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'Project Owner', 'User is the owner of a given project', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(2, 'admin', 'User Administrator', 'User is allowed to manage and edit other users', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(3, 'Guest', 'View Document public', 'Can view documents public', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(4, 'intern', 'Intern', 'internship', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(5, 'hms', 'hms', 'HMS', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(6, 'pms', 'pms', 'PMS', '2019-10-24 20:58:16', '2019-10-24 20:58:16'),
(7, 'super-admin', 'Super admin', 'Super admin', '2019-10-24 20:58:17', '2019-10-24 20:58:17');

-- --------------------------------------------------------

--
-- Structure de la table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 7),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` datetime NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(4) NOT NULL COMMENT '0 - nu, 1 - nam',
  `phone` char(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avarta` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `date_of_birth`, `address`, `gender`, `phone`, `email`, `password`, `login_name`, `avarta`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Trương Lâm Vũ', '2019-10-25 03:58:17', 'Hà Nội', 1, '0962469879', 'vutl.hust@gmail.com', '$2y$10$lkATn2pheWbb3DYrUQ1rfurPS9safKic6X8XVdxmExtR9j5Xi3BCK', 'truonglamvu', 'Thai-do.jpg', 1, 'hm7Zh1YdpF1EHlYb7GJjfRzMuaWZCXsJgKPmvIJC69siXgjvLg5SrqsJSoJ1', '2019-10-24 20:58:17', '2019-10-24 20:58:17', NULL),
(2, 'Nguyễn Văn An', '1970-01-01 00:00:00', 'Hà Nội', 1, '0522065445', 'annv@gmail.com', '$2y$10$1PwT0d0LmDxOhlgF6LDir.nrQ/hApiCZEoM3yFssawMWsAccsVRPi', 'nguyenvanan', '', 1, NULL, '2019-10-25 00:31:31', '2019-10-25 00:31:37', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Index pour la table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Index pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
