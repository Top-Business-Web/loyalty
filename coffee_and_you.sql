-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 10:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coffee_and_you`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `image`, `created_at`, `updated_at`) VALUES
(1, 'abdullah', 'admin@admin.com', '$2y$10$y3Ed.t5y/.9N51.vbXpzhuMl6oVp/5q/EABH22Zj/3rzCq80kwlO2', NULL, '2023-01-26 07:42:00', '2023-01-26 07:42:00');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `name_ar`, `name_en`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'hailey16', 'jorge.little', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(2, 1, 'sophia.muller', 'bfriesen', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(3, 1, 'shanon27', 'nelson61', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(4, 1, 'rhiannon.leffler', 'tara59', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(5, 1, 'marc71', 'john31', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_10_17_144300_create_reset_code_passwords_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2022_03_20_123415_create_admins_table', 1),
(4, '2022_03_20_134518_create_settings_table', 1),
(5, '2022_07_21_143846_create_users_table', 1),
(6, '2022_09_25_205512_create_setting_table', 1),
(7, '2023_01_18_095531_create_categories_table', 1),
(8, '2023_01_18_095558_create_products_table', 1),
(9, '2023_01_22_151056_create_orders_table', 1),
(10, '2023_01_23_105320_create_order_details_table', 1),
(11, '2023_01_26_153528_create_contact_us_table', 2),
(12, '2023_02_02_101458_create_payments_table', 3),
(13, '2023_05_14_133821_create_rates_table', 4),
(14, '2023_05_21_092951_create_packages_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('new','offered','accepted','rejected','preparing','on_way','delivered') COLLATE utf8mb4_unicode_ci DEFAULT 'new',
  `total_price` double DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `provider_id`, `note`, `status`, `total_price`, `created_at`, `updated_at`) VALUES
(14, 1, 1, 'dd', 'new', 200, '2023-05-17 10:55:14', '2023-05-17 10:55:14'),
(15, 1, 1, 'dd', 'new', 200, '2023-05-17 10:55:45', '2023-05-17 10:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` double NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `category_id`, `sub_category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(26, 15, 3, 3, NULL, NULL, NULL, '2023-05-17 10:55:45', '2023-05-17 10:55:45'),
(27, 15, 5, 3, NULL, NULL, NULL, '2023-05-17 10:55:45', '2023-05-17 10:55:45');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` double(10,2) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `price`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 100.00, 'عنوان', 'تفاصيل', '2023-05-21 07:59:29', '2023-05-21 07:59:29'),
(2, 120.00, 'عنوان', 'تفاصيل', '2022-08-25 07:21:29', '2022-08-24 07:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tran_ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `price_after_discount` double(10,2) DEFAULT NULL,
  `the_best` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `name_ar`, `name_en`, `price`, `price_after_discount`, `the_best`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 5, 'xgrady', 'Erna', 164.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(2, 1, 4, 'waters.emanuel', 'Ward', 70.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(3, 1, 3, 'kub.narciso', 'Leonora', 169.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(4, 1, 1, 'zbins', 'Rocky', 88.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(5, 1, 5, 'kiarra28', 'Elsie', 150.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(6, 1, 2, 'chelsea.bosco', 'Hector', 158.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(7, 1, 2, 'antoinette75', 'Jacky', 91.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(8, 1, 5, 'hahn.yolanda', 'Lulu', 136.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(9, 1, 1, 'kub.parker', 'Edison', 93.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(10, 1, 5, 'daniel.glenna', 'Jovanny', 143.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(11, 1, 4, 'maude.lynch', 'Delilah', 80.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(12, 1, 4, 'tad.pollich', 'Olin', 175.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(13, 1, 1, 'lhartmann', 'Tanya', 136.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(14, 1, 2, 'wquitzon', 'Mae', 153.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(15, 1, 1, 'pcartwright', 'Minerva', 53.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(16, 1, 2, 'xbergnaum', 'Jimmy', 133.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(17, 1, 3, 'alexandrine26', 'Leanne', 69.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(18, 1, 5, 'lempi79', 'Lon', 30.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(19, 1, 5, 'sipes.michale', 'Beth', 129.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(20, 1, 2, 'cooper53', 'Mollie', 127.00, NULL, '0', NULL, '2023-01-26 07:42:01', '2023-01-26 07:42:01'),
(21, 2, 1, 'wsd', 'dfwef', 45.00, NULL, '0', NULL, '2023-02-19 07:50:49', '2023-02-19 07:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `provider_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `value`, `comment`, `client_id`, `provider_id`, `created_at`, `updated_at`) VALUES
(1, '4', 'sdasfddasdas dsdasd', 2, 1, '2023-05-14 11:32:14', '2023-05-14 11:32:14'),
(4, '2', 'sdasfddasdas dsdasd', 6, 2, '2023-05-15 06:28:45', '2023-05-15 06:29:02'),
(5, '5', 'sdasfddasdas dsdasd', 6, 7, '2023-05-15 06:30:06', '2023-05-15 06:30:06');

-- --------------------------------------------------------

--
-- Table structure for table `reset_code_passwords`
--

CREATE TABLE `reset_code_passwords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `about_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacy_ar` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `privacy_en` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `about_ar`, `about_en`, `terms_ar`, `terms_en`, `privacy_ar`, `privacy_en`, `instagram`, `whatsapp`, `created_at`, `updated_at`) VALUES
(1, 'ما هو لوريم إيبسوم؟ لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان Lorem Ipsum هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة. لقد نجت ليس فقط خمسة قرون ، ولكن أيضًا القفزة في التنضيد الإلكتروني ، وظلت دون تغيير جوهري. تم نشره في الستينيات من القرن الماضي بإصدار أوراق Letraset التي تحتوي على مقاطع Lorem Ipsum ، ومؤخرًا مع برامج النشر المكتبي مثل Aldus PageMaker بما في ذلك إصدارات Lorem Ipsum. لماذا نستخدمه؟ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام لوريم إيبسوم هو أنه يحتوي على توزيع طبيعي -إلى حد ما- للأحرف ، بدلاً من استخدام \"هنا يوجد محتوى نصي ، هنا يوجد محتوى نصي\" ، مما يجعلها تبدو وكأنها إنجليزية قابلة للقراءة. تستخدم العديد من حزم النشر المكتبي ومحرري صفحات الويب الآن Lorem Ipsum كنص نموذج افتراضي ، وسيكشف البحث عن \"lorem ipsum\" عن العديد من مواقع الويب التي لا تزال في مهدها. تطورت إصدارات مختلفة على مر السنين ، أحيانًا عن طريق الصدفة ، وأحيانًا عن قصد (روح الدعابة المحقونة وما شابه ذلك). حيث أنها لا تأتي من؟ خلافًا للاعتقاد الشائع ، فإن Lorem Ipsum ليس مجرد نص عشوائي. لها جذور في قطعة من الأدب اللاتيني الكلاسيكي من 45 قبل الميلاد ، مما يجعلها أكثر من 2000 عام. قام ريتشارد مكلينتوك ، الأستاذ اللاتيني في كلية هامبدن سيدني في فرجينيا ، بالبحث عن واحدة من أكثر الكلمات اللاتينية غموضًا ، consectetur ، من مقطع لوريم إيبسوم ، وتصفح اقتباسات الكلمة في الأدب الكلاسيكي ، اكتشف المصدر الذي لا شك فيه. يأتي Lorem Ipsum من الأقسام 1.10.32 و 1.10.33 من \"de Finibus Bonorum et Malorum\" (أقصى الخير والشر) بقلم شيشرون ، الذي كتبه عام 45 قبل الميلاد. هذا الكتاب عبارة عن أطروحة حول نظرية الأخلاق ، وقد حظيت بشعبية كبيرة خلال عصر النهضة. السطر الأول من Lorem Ipsum ، \"Lorem ipsum dolor sit amet ..\" ، يأتي من سطر في القسم 1.10.32.', 'What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Where does it come from? Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of de Finibus Bonorum et Malorum (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, Lorem ipsum dolor sit amet.., comes from a line in section 1.10.32.', 'ما هو لوريم إيبسوم؟ لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان Lorem Ipsum هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة. لقد نجت ليس فقط خمسة قرون ، ولكن أيضًا القفزة في التنضيد الإلكتروني ، وظلت دون تغيير جوهري. تم نشره في الستينيات من القرن الماضي بإصدار أوراق Letraset التي تحتوي على مقاطع Lorem Ipsum ، ومؤخرًا مع برامج النشر المكتبي مثل Aldus PageMaker بما في ذلك إصدارات Lorem Ipsum. لماذا نستخدمه؟ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام لوريم إيبسوم هو أنه يحتوي على توزيع طبيعي -إلى حد ما- للأحرف ، بدلاً من استخدام \"هنا يوجد محتوى نصي ، هنا يوجد محتوى نصي\" ، مما يجعلها تبدو وكأنها إنجليزية قابلة للقراءة. تستخدم العديد من حزم النشر المكتبي ومحرري صفحات الويب الآن Lorem Ipsum كنص نموذج افتراضي ، وسيكشف البحث عن \"lorem ipsum\" عن العديد من مواقع الويب التي لا تزال في مهدها. تطورت إصدارات مختلفة على مر السنين ، أحيانًا عن طريق الصدفة ، وأحيانًا عن قصد (روح الدعابة المحقونة وما شابه ذلك). حيث أنها لا تأتي من؟ خلافًا للاعتقاد الشائع ، فإن Lorem Ipsum ليس مجرد نص عشوائي. لها جذور في قطعة من الأدب اللاتيني الكلاسيكي من 45 قبل الميلاد ، مما يجعلها أكثر من 2000 عام. قام ريتشارد مكلينتوك ، الأستاذ اللاتيني في كلية هامبدن سيدني في فرجينيا ، بالبحث عن واحدة من أكثر الكلمات اللاتينية غموضًا ، consectetur ، من مقطع لوريم إيبسوم ، وتصفح اقتباسات الكلمة في الأدب الكلاسيكي ، اكتشف المصدر الذي لا شك فيه. يأتي Lorem Ipsum من الأقسام 1.10.32 و 1.10.33 من \"de Finibus Bonorum et Malorum\" (أقصى الخير والشر) بقلم شيشرون ، الذي كتبه عام 45 قبل الميلاد. هذا الكتاب عبارة عن أطروحة حول نظرية الأخلاق ، وقد حظيت بشعبية كبيرة خلال عصر النهضة. السطر الأول من Lorem Ipsum ، \"Lorem ipsum dolor sit amet ..\" ، يأتي من سطر في القسم 1.10.32.', 'What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Where does it come from? Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of de Finibus Bonorum et Malorum (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, Lorem ipsum dolor sit amet.., comes from a line in section 1.10.32.', 'ما هو لوريم إيبسوم؟ لوريم إيبسوم هو ببساطة نص شكلي يستخدم في صناعة الطباعة والتنضيد. كان Lorem Ipsum هو النص الوهمي القياسي في الصناعة منذ القرن الخامس عشر الميلادي ، عندما أخذت طابعة غير معروفة لوحًا من النوع وتدافعت عليه لعمل كتاب عينة. لقد نجت ليس فقط خمسة قرون ، ولكن أيضًا القفزة في التنضيد الإلكتروني ، وظلت دون تغيير جوهري. تم نشره في الستينيات من القرن الماضي بإصدار أوراق Letraset التي تحتوي على مقاطع Lorem Ipsum ، ومؤخرًا مع برامج النشر المكتبي مثل Aldus PageMaker بما في ذلك إصدارات Lorem Ipsum. لماذا نستخدمه؟ هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. الهدف من استخدام لوريم إيبسوم هو أنه يحتوي على توزيع طبيعي -إلى حد ما- للأحرف ، بدلاً من استخدام \"هنا يوجد محتوى نصي ، هنا يوجد محتوى نصي\" ، مما يجعلها تبدو وكأنها إنجليزية قابلة للقراءة. تستخدم العديد من حزم النشر المكتبي ومحرري صفحات الويب الآن Lorem Ipsum كنص نموذج افتراضي ، وسيكشف البحث عن \"lorem ipsum\" عن العديد من مواقع الويب التي لا تزال في مهدها. تطورت إصدارات مختلفة على مر السنين ، أحيانًا عن طريق الصدفة ، وأحيانًا عن قصد (روح الدعابة المحقونة وما شابه ذلك). حيث أنها لا تأتي من؟ خلافًا للاعتقاد الشائع ، فإن Lorem Ipsum ليس مجرد نص عشوائي. لها جذور في قطعة من الأدب اللاتيني الكلاسيكي من 45 قبل الميلاد ، مما يجعلها أكثر من 2000 عام. قام ريتشارد مكلينتوك ، الأستاذ اللاتيني في كلية هامبدن سيدني في فرجينيا ، بالبحث عن واحدة من أكثر الكلمات اللاتينية غموضًا ، consectetur ، من مقطع لوريم إيبسوم ، وتصفح اقتباسات الكلمة في الأدب الكلاسيكي ، اكتشف المصدر الذي لا شك فيه. يأتي Lorem Ipsum من الأقسام 1.10.32 و 1.10.33 من \"de Finibus Bonorum et Malorum\" (أقصى الخير والشر) بقلم شيشرون ، الذي كتبه عام 45 قبل الميلاد. هذا الكتاب عبارة عن أطروحة حول نظرية الأخلاق ، وقد حظيت بشعبية كبيرة خلال عصر النهضة. السطر الأول من Lorem Ipsum ، \"Lorem ipsum dolor sit amet ..\" ، يأتي من سطر في القسم 1.10.32.', 'What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Why do we use it? It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using Content here, content here, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for lorem ipsum will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). Where does it come from? Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of de Finibus Bonorum et Malorum (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, Lorem ipsum dolor sit amet.., comes from a line in section 1.10.32.', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privacy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insta` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `link`, `created_at`, `updated_at`) VALUES
(1, 'assets/uploads/sliders/39091684060765.png', NULL, '2023-05-14 09:39:25', '2023-05-14 09:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2 COMMENT '1 => provider, 2 => client',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 => un active, 1 => active',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `is_best` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `advantages_ar` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`advantages_ar`)),
  `advantages_en` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`advantages_en`)),
  `description_ar` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description_ar`)),
  `description_en` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`description_en`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_code`, `phone`, `location`, `password`, `role_id`, `status`, `image`, `balance`, `is_best`, `remember_token`, `advantages_ar`, `advantages_en`, `description_ar`, `description_en`, `created_at`, `updated_at`) VALUES
(1, 'Osama Arafa', 'admin@admin.com', '+20', '01016830875', NULL, '$2y$10$y3Ed.t5y/.9N51.vbXpzhuMl6oVp/5q/EABH22Zj/3rzCq80kwlO2', 1, 1, NULL, 0, '1', NULL, NULL, NULL, NULL, NULL, '2023-01-26 07:42:00', '2023-05-15 10:07:20'),
(2, 'Osama Arafa 45', 'use4r@admin.com', '+20', '01016830876', NULL, '$2y$10$y3Ed.t5y/.9N51.vbXpzhuMl6oVp/5q/EABH22Zj/3rzCq80kwlO2', 2, 1, 'assets/uploads/users/23321676880043.png', 200, '0', NULL, NULL, NULL, NULL, NULL, '2023-01-26 07:42:00', '2023-02-20 08:00:43'),
(6, 'Osama Arafa', 'adminss@admin.com', '+20', '01090439660', NULL, '$2y$10$y3Ed.t5y/.9N51.vbXpzhuMl6oVp/5q/EABH22Zj/3rzCq80kwlO2', 2, 1, NULL, 0, '0', NULL, NULL, NULL, NULL, NULL, '2023-01-26 07:42:00', '2023-01-26 07:42:00'),
(7, 'Osama Arafa 45', 'use4r@admin.com', '+20', '01016830878', NULL, '$2y$10$y3Ed.t5y/.9N51.vbXpzhuMl6oVp/5q/EABH22Zj/3rzCq80kwlO2', 1, 1, 'assets/uploads/users/23321676880043.png', 200, '0', NULL, NULL, NULL, NULL, NULL, '2023-01-26 07:42:00', '2023-02-20 08:00:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_category_id_foreign` (`category_id`),
  ADD KEY `order_details_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `order_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rates_client_id_foreign` (`client_id`),
  ADD KEY `rates_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `reset_code_passwords`
--
ALTER TABLE `reset_code_passwords`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reset_code_passwords_email_index` (`email`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reset_code_passwords`
--
ALTER TABLE `reset_code_passwords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rates_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
