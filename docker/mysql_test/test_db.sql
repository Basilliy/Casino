DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
                          `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
                          `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `batch` int(11) NOT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
