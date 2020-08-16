--
-- `cakephp-dependent-lists`
--

-- --------------------------------------------------------

--
-- `classifiers`
--

CREATE TABLE `classifiers` (
  `id` int(11) NOT NULL,
  `model` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` char(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `classifiers` (`id`, `model`, `entity`, `description`, `type`) VALUES
(1, 'ClassifierProducts', 'classifier_product', 'Type of product', ''),
(2, 'ClassifierAppliances', 'classifier_appliance', 'Type of appliance', ''),
(3, 'ClassifierBrands', 'classifier_brand', 'Name of brand', ''),
(4, 'ClassifierComputers', 'classifier_computer', 'Type of computer', ''),
(5, 'ClassifierElectricTools', 'classifier_electric_tool', 'Type of electric tool', ''),
(6, 'ClassifierFurnitures', 'classifier_furniture', 'Type of furnitures', ''),
(7, 'ClassifierGadgets', 'classifier_gadget', 'Type of gadget', ''),
(8, 'ClassifierLaptops', 'classifier_laptop', 'Type of laptop', '');

-- --------------------------------------------------------

--
-- `classifier_appliances`
--

CREATE TABLE `classifier_appliances` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `classifier_appliances` (`id`, `name`) VALUES
(1, 'TV'),
(2, 'Heaters'),
(3, 'Dishwashers'),
(4, 'Washing machines'),
(5, 'Refrigerators');

-- --------------------------------------------------------

--
-- `classifier_brands`
--

CREATE TABLE `classifier_brands` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `classifier_brands` (`id`, `name`) VALUES
(1, 'Asus'),
(2, 'Apple'),
(3, 'Dell'),
(4, 'HP'),
(5, 'Lenovo');

-- --------------------------------------------------------

--
-- `classifier_computers`
--

CREATE TABLE `classifier_computers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `classifier_computers` (`id`, `name`) VALUES
(1, 'Personal computers'),
(2, 'Laptops'),
(3, 'System unit'),
(4, 'HDD'),
(5, 'Office equipment');

-- --------------------------------------------------------

--
-- `classifier_electric_tools`
--

CREATE TABLE `classifier_electric_tools` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `classifier_electric_tools` (`id`, `name`) VALUES
(1, 'Drills'),
(2, 'Saws'),
(3, 'Lawnmowers'),
(4, 'Jigsaws'),
(5, 'Perforators');

-- --------------------------------------------------------

--
-- `classifier_furnitures`
--

CREATE TABLE `classifier_furnitures` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `classifier_furnitures` (`id`, `name`) VALUES
(1, 'Sofas'),
(2, 'Armchairs'),
(3, 'Chairs'),
(4, 'Beds'),
(5, 'Shelves');

-- --------------------------------------------------------

--
-- `classifier_gadgets`
--

CREATE TABLE `classifier_gadgets` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `classifier_gadgets` (`id`, `name`) VALUES
(1, 'Smartphones'),
(2, 'Tablets'),
(3, 'E-book'),
(4, 'Headphones'),
(5, 'Chargers');

-- --------------------------------------------------------

--
-- `classifier_laptops`
--

CREATE TABLE `classifier_laptops` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `classifier_laptops` (`id`, `name`) VALUES
(1, 'Notebook'),
(2, 'Ultrabook'),
(3, 'Netbook'),
(4, 'Transformer'),
(5, 'MacBook');

-- --------------------------------------------------------

--
-- `classifier_products`
--

CREATE TABLE `classifier_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `classifier_products` (`id`, `name`) VALUES
(1, 'Computers'),
(2, 'Gadgets'),
(3, 'Appliances'),
(4, 'Electric tools'),
(5, 'Furnitures');

-- --------------------------------------------------------

--
-- `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` char(255) NOT NULL,
  `classifier_product_id` int(5) UNSIGNED DEFAULT NULL,
  `classifier_appliance_id` int(5) UNSIGNED DEFAULT NULL,
  `classifier_brand_id` int(5) UNSIGNED DEFAULT NULL,
  `classifier_computer_id` int(5) UNSIGNED DEFAULT NULL,
  `classifier_electric_tool_id` int(5) UNSIGNED DEFAULT NULL,
  `classifier_furniture_id` int(5) UNSIGNED DEFAULT NULL,
  `classifier_gadget_id` int(5) UNSIGNED DEFAULT NULL,
  `classifier_laptop_id` int(5) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

INSERT INTO `products` (`id`, `name`, `classifier_product_id`, `classifier_appliance_id`, `classifier_brand_id`, `classifier_computer_id`, `classifier_electric_tool_id`, `classifier_furniture_id`, `classifier_gadget_id`, `classifier_laptop_id`) VALUES
(1, 'My product name', 1, NULL, 2, 2, NULL, 4, NULL, 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `classifiers`
--
ALTER TABLE `classifiers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `classifier_appliances`
--
ALTER TABLE `classifier_appliances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `classifier_brands`
--
ALTER TABLE `classifier_brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `classifier_computers`
--
ALTER TABLE `classifier_computers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `classifier_electric_tools`
--
ALTER TABLE `classifier_electric_tools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `classifier_furnitures`
--
ALTER TABLE `classifier_furnitures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `classifier_gadgets`
--
ALTER TABLE `classifier_gadgets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `classifier_laptops`
--
ALTER TABLE `classifier_laptops`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `classifier_products`
--
ALTER TABLE `classifier_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `classifiers`
--
ALTER TABLE `classifiers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `classifier_appliances`
--
ALTER TABLE `classifier_appliances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `classifier_brands`
--
ALTER TABLE `classifier_brands`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `classifier_computers`
--
ALTER TABLE `classifier_computers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `classifier_electric_tools`
--
ALTER TABLE `classifier_electric_tools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `classifier_furnitures`
--
ALTER TABLE `classifier_furnitures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `classifier_gadgets`
--
ALTER TABLE `classifier_gadgets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `classifier_laptops`
--
ALTER TABLE `classifier_laptops`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `classifier_products`
--
ALTER TABLE `classifier_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
