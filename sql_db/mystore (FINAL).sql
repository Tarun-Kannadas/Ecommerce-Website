-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2024 at 05:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mystore`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'AMD'),
(2, 'Cooler Master'),
(3, 'Ant Esports'),
(4, 'BenQ'),
(5, 'MSI'),
(6, 'Intel'),
(7, 'Razor'),
(9, 'XPG'),
(10, 'Antec'),
(11, 'Lianli'),
(12, 'Gigabyte'),
(13, 'Asus'),
(14, 'Corsair'),
(15, 'Western Digital (WD Blue)'),
(16, 'Western Digital (WD Green)'),
(17, 'Crucial'),
(18, 'Seagate'),
(19, 'Samsung'),
(20, 'Zebronics');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_details`
--

INSERT INTO `cart_details` (`cart_id`, `product_id`, `user_id`, `quantity`, `date`) VALUES
(68, 17, 8, 1, '2024-03-10 13:21:40'),
(75, 21, 8, 1, '2024-04-17 16:02:49');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Gaming Chair'),
(2, 'Gaming Mouse'),
(3, 'Gaming Headset'),
(4, 'Custom Cables'),
(5, 'Gamepads'),
(6, 'Thermal Paste'),
(7, 'Monitors'),
(8, 'Gaming Keyboards'),
(9, 'Keyboards'),
(10, 'Mouses'),
(11, 'Gaming Monitors'),
(12, 'Case Fans'),
(13, 'Graphics Cards'),
(14, 'Motherboards'),
(15, 'Cabinets'),
(16, 'Rams'),
(17, 'Hard Disk(HDD)'),
(18, 'SSD'),
(19, 'Power Supply'),
(20, 'UPS'),
(21, 'Processors'),
(22, 'CPU Fans'),
(23, 'Liquid Coolers'),
(24, 'Mousepads');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message_text` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `user_id`, `message_text`, `timestamp`) VALUES
(1, 6, '                  hello  ', '2028-02-24 01:18:00'),
(2, 6, '              wassup      ', '2028-02-24 01:19:00'),
(3, 7, '         cool           ', '2028-02-24 01:23:00'),
(4, 7, '                    ya ikr', '2028-02-24 01:23:00'),
(5, 8, '  its me sneha\r\n                  ', '2028-02-24 01:24:00'),
(15, 8, 'cool', '2028-02-24 01:33:00'),
(16, 8, 'hola', '2028-02-24 03:12:00'),
(17, 6, 'hello', '2001-03-24 05:00:00'),
(18, 6, 'wassup\r\ndanger', '2001-03-24 06:06:00'),
(19, 6, 'kello', '2001-03-23 22:06:00'),
(20, 9, 'hello', '2007-03-23 23:19:00'),
(21, 8, 'cool community right', '2010-03-24 05:40:00'),
(22, 8, 'awesome', '2024-03-10 05:41:33'),
(23, 10, 'hey have to you guys how is the company CREEDBOZ', '2024-04-17 15:56:27'),
(24, 11, 'i liked it a lot', '2024-04-18 05:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`, `code`) VALUES
(40, 6, 691873984, 10, 1, 'pending', ''),
(41, 6, 691873984, 12, 1, 'pending', ''),
(42, 6, 1655398235, 5, 1, 'pending', ''),
(43, 6, 1655398235, 12, 1, 'pending', ''),
(44, 6, 1655398235, 10, 1, 'pending', ''),
(45, 6, 2102265068, 13, 2, 'pending', ''),
(46, 6, 2102265068, 14, 1, 'pending', ''),
(47, 6, 342077532, 13, 3, 'pending', ''),
(48, 6, 342077532, 16, 3, 'pending', ''),
(49, 6, 342077532, 10, 3, 'pending', ''),
(50, 8, 569302499, 6, 1, 'pending', ''),
(51, 6, 996372696, 11, 1, 'pending', ''),
(52, 6, 996372696, 9, 2, 'pending', ''),
(53, 6, 996372696, 1, 2, 'pending', ''),
(54, 6, 996372696, 7, 1, 'pending', ''),
(55, 6, 996372696, 13, 2, 'pending', ''),
(56, 6, 996372696, 2, 1, 'pending', ''),
(57, 7, 1614834304, 16, 1, 'pending', ''),
(58, 6, 1044632195, 28, 1, 'pending', 'special'),
(59, 6, 1044632195, 38, 1, 'pending', 'special'),
(60, 6, 1044632195, 45, 1, 'pending', 'special'),
(61, 6, 1044632195, 21, 1, 'pending', 'special'),
(62, 6, 1044632195, 40, 1, 'pending', 'special'),
(63, 6, 1044632195, 11, 1, 'pending', 'special'),
(64, 6, 1044632195, 26, 1, 'pending', 'special'),
(65, 6, 1044632195, 33, 1, 'pending', 'special'),
(66, 6, 1044632195, 1, 1, 'pending', 'special'),
(67, 6, 308564151, 29, 1, 'pending', 'special'),
(68, 6, 308564151, 44, 1, 'pending', 'special'),
(69, 6, 308564151, 26, 1, 'pending', 'special'),
(70, 6, 308564151, 33, 1, 'pending', 'special'),
(71, 6, 308564151, 1, 1, 'pending', 'special'),
(72, 6, 308564151, 40, 1, 'pending', 'special'),
(73, 6, 308564151, 21, 1, 'pending', 'special'),
(74, 6, 308564151, 10, 1, 'pending', 'special'),
(75, 6, 308564151, 37, 1, 'pending', 'special'),
(76, 10, 1547623497, 37, 1, 'pending', 'special'),
(77, 10, 1547623497, 21, 1, 'pending', 'special'),
(78, 10, 1547623497, 31, 1, 'pending', 'special'),
(79, 10, 1547623497, 44, 1, 'pending', 'special'),
(80, 10, 1547623497, 10, 1, 'pending', 'special'),
(81, 10, 1547623497, 25, 1, 'pending', 'special'),
(82, 10, 1547623497, 34, 1, 'pending', 'special'),
(83, 10, 1547623497, 1, 1, 'pending', 'special'),
(84, 10, 1547623497, 41, 1, 'pending', 'special'),
(85, 10, 2053567998, 30, 1, 'pending', 'normal'),
(86, 10, 2053567998, 45, 1, 'pending', 'normal'),
(87, 10, 2053567998, 6, 1, 'pending', 'normal'),
(88, 10, 2053567998, 39, 1, 'pending', 'normal'),
(89, 10, 1681556222, 37, 1, 'pending', 'special'),
(90, 10, 1681556222, 21, 1, 'pending', 'special'),
(91, 10, 1681556222, 31, 1, 'pending', 'special'),
(92, 10, 1681556222, 44, 1, 'pending', 'special'),
(93, 10, 1681556222, 10, 1, 'pending', 'special'),
(94, 10, 1681556222, 25, 1, 'pending', 'special'),
(95, 10, 1681556222, 34, 1, 'pending', 'special'),
(96, 10, 1681556222, 1, 1, 'pending', 'special'),
(97, 10, 1681556222, 41, 2, 'pending', 'special'),
(98, 6, 449421388, 1, 4, 'pending', 'normal'),
(99, 6, 449421388, 6, 3, 'pending', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `pc_cart`
--

CREATE TABLE `pc_cart` (
  `build_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_title` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pc_cart`
--

INSERT INTO `pc_cart` (`build_id`, `product_id`, `user_id`, `product_title`, `discount`, `quantity`) VALUES
(205, 29, 6, 'Crucial P3 500GB PCIe 3.0 3D NAND NVMe M.2 SSD', '3299', 1),
(206, 44, 6, 'Ant Esports ICE-240', '5499', 1),
(207, 26, 6, 'CORSAIR Vengeance (16GBx2) DDR5 DRAM 5200MHz C40 Desktop Ram', '16599', 1),
(208, 33, 6, 'Western Digital 2Tb Wd Blue 7200RPM', '5299', 1),
(209, 1, 6, 'AMD Ryzen™ 5 5600G', '13699', 2),
(210, 40, 6, 'Cooler Master MWE 450W Bronze', '3599', 1),
(211, 21, 6, 'GIGABYTE B450M DS3H V2', '5199', 1),
(212, 10, 6, 'Cooler Master CMP510', '4689', 1),
(213, 37, 6, 'MSI GTX 1630 VENTUS XS 4GB OC', '16599', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_keyword` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `product_image1` varchar(255) DEFAULT NULL,
  `product_image2` varchar(255) DEFAULT NULL,
  `product_image3` varchar(255) DEFAULT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_discount` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) DEFAULT NULL,
  `stocks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `product_description`, `product_keyword`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `product_discount`, `date`, `status`, `stocks`) VALUES
(1, 'AMD Ryzen™ 5 5600G', 'Series Ryzen 5, 6 Cores, 12 Threads, Socket AM4, 3.9 GHz SPEED, (TURBO) 4.4 GHz, CACHE 19 MB, INTEGRATED GRAPHICS Yes, INCLUDED CPU COOLER Yes, UNLOCKED Yes, TDP 65W', 'AMD, ryzen, ryzen 5, 5600G, best perfomance, inbuilt graphics cpu, integrated graphics, desktop processors, processors, powerful processor', 21, 1, '5600g-image-main-600x600.jpg', 'amd_ryzen_5_5600g_processor-2.jpg', '2471-front.jpg', '29699', '13699', '2024-02-23 07:00:33', 'true', 93),
(2, 'AMD Ryzen™ 5 5600x', '6 Cores & 12 Threads, 35 MB Cache Base Clock: 3.7 GHz, Max Boost Clock: up to 4.6 GHz. Max. Operating Temperature (Tjmax) 95°C Memory Support: DDR4 3200MHz, Memory Channels: 2, TDP: 65W, PCI Express Generation : PCIe Gen 4 Compatible with Motherboards based on 500 Series Chipset, Socket AM4', 'AMD, ryzen 5 series, 5600x, best performance, desktop processors, processors, powerful performance', 21, 1, '100-100000065box-image-main-600x600.jpg', '61twhaihHtL._SX679_.jpg', '2365-front.jpg', '25599', '15699', '2024-02-23 07:10:14', 'true', 100),
(3, 'AMD Ryzen™ 9 5900X', 'The World’s Best Gaming Processor 12 cores to power through gaming, streaming and more.', 'AMD, ryzen 9 series, 5900x, highest performance, desktop processors, processors, powerful performance', 21, 1, 'AMD-Ryzen-9-5900X-box.jpg', '86261900_9461678019.jpg', 'images.jfif', '62599', '36799', '2024-02-23 07:15:24', 'true', 100),
(4, 'AMD Ryzen™ 7 5800X', 'Desktop Processor 8 cores 16 Threads 36 MB Cache 3.8 GHz Upto 4.7 GHz AM4 Socket 500 Series Chipset (100-100000063WOF)', 'ryzen, amd, ryzen 7, 5800x, desktop processors, processors, powerful, high perfomance', 21, 1, '03rEdEqzjUQgOTwlFpvmL1T-22.fit_lpad.size_625x365.v1569478056.jpg', 'main-qimg-567370ea740ba443d8b1f3137b0b7d7c-lq.jfif', '61l7QVhSBwL._AC_UF1000,1000_QL80_.jpg', '42599', '23699', '2024-02-23 07:21:07', 'true', 100),
(5, 'AMD Ryzen™ 9 7900X', 'The Best for Gaming and Creating. The 16-core powerhouse processor can do it all for the most demanding gamers and creators.', 'AMD, ryzen 9 series,,ryzen 9, 7900x, best performance, desktop processors, processors, powerful performance', 21, 1, 'AMD_Zen4_7900x7.jpg', '2022-09-30-image-5.webp', '51CjeDpAvnL._AC_UF1000,1000_QL80_.jpg', '69999', '57899', '2024-02-23 07:24:18', 'true', 100),
(6, 'Cooler Master Caliber R3 Purple', 'Continuing the legacy of the Caliber R2 Gaming Chair, the Caliber R3 offers a a brand new design with improved comfort and ergonomics.', 'Gaming chair, cooler master, Caliber r3 purple edition, comfortable, any purpose chair, high quality', 1, 2, 'caliber-r3-original-gallery-02-image.png', 'caliber-r3-original-gallery-01-image.png', 'caliber-r3-original-gallery-04-image.png', '21599', '18799', '2024-02-23 07:30:25', 'true', 96),
(7, 'Cooler Master TD500 Mesh (With Type C Port)', 'A design with emphasis on form and function. The polygonal mesh design featuring a three-dimensional contour that’s not only aesthetical but is capable of simultaneously providing high airflow and dust filtration.', 'cooler master, TD500 Mesh, cabinet, inbuilt type C port, best for gaming, budget friendly, budget cabinet', 15, 2, 'td500-mesh-black-gallery-1-image.png', 'td500-mesh-black-gallery-7-image.png', 'td500-mesh-black-gallery-6-image.png', '8999', '7999', '2024-02-23 07:33:29', 'true', 100),
(8, 'COOLER MASTER MWE GOLD 1050 – V2 ATX 3.0', 'Highly. Efficient Performance: The 80 Plus Gold Certification gurantees a minimum efficiency of 90% 10 Years Warranty: The MWE Gold V2 comes with a 10 year factory warranty from purchase date.', 'Efficient peformance, cooler master, MWE GOLD 1050, V2 ATX 3.0, future proof', 19, 2, 'mwe-gold-1050-v2-atx3-gallery-01-image.png', 'mwe-gold-1050-v2-atx3-gallery-06-image.png', 'mwe-gold-1050-v2-atx3-gallery-07-image.png', '24699', '17699', '2024-02-23 07:36:45', 'true', 100),
(9, 'Cooler Master Hyper H410R RGB', 'Stacked fin array ensure least airflow resistance which allows cooler air flow into the heat sink. Snap and Play – Intuitive fan bracket design makes upgrading and removing the fan a breeze.', 'cooler master, cpu fan, hyper H410R RGB, rgb cpu fan, best quality, best cooling', 22, 2, 'h410r-rgb-gallery-1-image.png', 'h410r-rgb-gallery-2-image.png', 'h410r-rgb-gallery-3-image.png', '2789', '1789', '2024-02-23 07:40:05', 'true', 100),
(10, 'Cooler Master CMP510', 'A glowing ARGB edge is cut into the clean geometry of the front panel design. The front panel is constructed with a substantially large, unrestricted intake grill to provide superb airflow to the system. Support for up to six fans and front, top, and rear radiator support ensure that performance is not compromised. Let your system stand out with an all-black background and a PSU cover to hide cables', 'cabinet, cooler master, CMP510, RGB fans inbuild, neat geometry, budget cabinet, best amount of space', 15, 2, 'cmp510_webpages_4000x4000_gallery-13-zoom.png', 'cmp510_webpage_1175x1120_imagewithtext-3-imageleftorright.png', 'Cooler-Master-CMP510-Case-4.jpg', '5589', '4689', '2024-02-23 07:44:28', 'true', 100),
(11, 'Cooler Master MB520 RGB', 'Dark mirror front panel : Shade light through a transparent, tinted front panel Performance Intake : Large intakes on each side of the front panel let the system breathe easy RGB LED Fans And Lighting Control : Three 120mm RGB LED fans in front are pre-installed to create an amazing lighting effect; One RGB controller is included in the accessory pack; If your motherboard does not support the RGB control function, you can connect the RESET button and control the RGB lighting directly from the I/O panel', 'RGB fans inbuild, cooler master, MB520, best case, gaming. best quality, ARGB', 15, 2, 'mb520rgb_g2-image.png', 'mb520rgb_g6-image.png', 'mb520rgb_g8-image.png', '7599', '6999', '2024-02-23 07:47:34', 'true', 100),
(12, 'Ant Esports SX7 Mid-Tower ARGB Gaming Cabinet White', 'The Ant Esports SX7 is tailored made to bring together rugged looks, high airflow performance and solid build quality in one single package. Designed to house up to ATX size motherboards, makes it the ideal choice for serious gamers looking to build a high-performance system.', 'ant esports, SX7, white, gaming, rgb fans, budget cabinet', 15, 3, 'Ant_Esports_SX7_White__5_-removebg-preview.png', 'Ant-Esports-SX7-White-9.png', 'Sx7-A-11-1.jpg', '4599', '3699', '2024-02-23 07:54:28', 'true', 100),
(13, 'Ant Esports 250 Air', 'The Ant Esports 250 Air is a distinctive, yet minimalist, mid-tower ATX case with easy cable management and exceptional cooling. A highly durable solid steel front panel etched with stylish air flow vents delivers high airflow along with great looks.', 'ant esports, 250 Air, gaming cabinet, budget, cabinet', 15, 3, '71LRY7I08vL._SL1500_-removebg-preview.png', 'Ant-Esports-Chassis-250-Air-Black-04-min.jpg', 'image_2024-02-23_133059737.png', '4699', '3599', '2024-02-23 08:01:27', 'true', 100),
(14, 'Ant Esports GP310R Wireless', 'Plug & Play, Support PS4,PS3,Xbox360 gaming console, (note – Cannot support sensor function for ps4,ps3 ) Support PC windows system of win7/8/10. Dual vibration supported.', 'ant esports, gamepad, console, wireless, GP310R, gaming console, gaming, dual vibration', 5, 3, '59297bc0-bcaa-4d24-a86e-0a10db01307f.__CR0,0,3000,1856_PT0_SX970_V1___.jpg', 'gp310r-image-03-600x600-1-1.jpg', '91lCywBPiiL._AC_UF350,350_QL80_.jpg', '3599', '2299', '2024-02-23 08:32:12', 'true', 100),
(15, 'Ant Esports H1000 Pro', 'Round 3D Draping Earcups With Excellent Sound Insulation Effect And Is Comfortable To Wear Lightweight Design, Self-Adjusting Head Beam Design, The Best Game Wearing Experience High Sensitivity Microphone Delivers More Accurate, Clear And Smooth Audio. 05. Glaring LED RGB Iluminated Earcups To Suit The Gaming Environmen', 'gaming headset, budget, budget headset, ant esports, h1000 pro, best quality, worth of money', 3, 3, '55424b58-82e9-4e49-811f-97872a764485.__CR0,0,1080,1080_PT0_SX300_V1___.jfif', 'Ant-Sports-H1000-Gaming-Headset.jpg', '51V+XHN4FRL._AC_UF1000,1000_QL80_.jpg', '2599', '1299', '2024-02-23 08:35:38', 'true', 100),
(16, 'Ant Esports ICE-511 MAX', 'Mesh Front Panel: The mesh front panel offers efficient airflow for demanding systems. Sliding Tempered Glass Panel: Showcase your build and system lighting effect through sliding tampered glass side panel. Auto-RGB Fans: All four 120mm Auto-RGB LED fans are pre-installed to create an amazing lighting effect, you can control the RGB lighting effects directly from the I/O panel', 'ant esports, ICE-511 MAX, gaming cabinet, budget cabinet, budget, efficient, best, quality, perfomance, airflow', 15, 3, '502ea8d9-f585-4476-aebe-ef1027a92073.__CR0,0,300,300_PT0_SX300_V1___.jfif', '05f4474a-78cf-4a21-9c2d-975bec7ae120.__CR0,0,300,300_PT0_SX300_V1___.jfif', '511max.png', '5689', '4599', '2024-02-23 08:40:23', 'true', 100),
(17, 'Ant Esports GP110 Wired Gamepad', 'Compatibility – PC / Laptop Computer(Windows 10/8/7),Play Station 3(PS3) Excellent Design – Wear-resistant Anti-slip Joystick | Cool Appearance | Comfortable Grip Integrated with 3 adjustable Vibration Levels – comes with dual Intensity motor Plug & Play -Only for PC games supporting X input mode, Play Station 3. No need to install drivers except for Windows XP Feature – Multi-mode : X input, D input, PS3 | Vibration Feedback Function', 'ant esports, GP110, wired, gaming console, gamepad, for gamers', 5, 3, '30d61d05-95c6-4071-94c7-f52d26279132.__CR0,0,3000,1856_PT0_SX970_V1___.jpg', 'gp110-image-main-600x600.jpg', 'gp110-image-02-600x600-1.png', '1799', '899', '2024-02-23 08:43:47', 'true', 100),
(19, 'MSI B450M Pro-Vdh Max Gaming Fullat Motherboard', 'Supports 1st, 2nd and 3rd Gen AMD Ryzen / Ryzen with Radeon Vega Graphics and 2nd Gen AMD Ryzen with Radeon Graphics / Athlon with Radeon Vega Graphics Desktop Processors for Socket AM4\r\nSupports DDR4 Memory, up to 3466+(OC) MHz. Turbo M.2: Running at PCI-E Gen3 x4 maximizes performance for NVMe based SSDs. DDR4 Boost: Advanced technology to deliver pure data signals for the best performance.', 'motherboard, gaming motherboard, MSI, B450M, Pro, MSI B450M Pro-Vdh Max Gaming Fullat Motherboard', 14, 5, '61Xg0w1uCQL._SX679_.jpg', 'msi-b450m-pro-vdh-max-gaming-fullat-motherboard-500x500.webp', '71eHm7MaZWL.jpg', '10000', '5599', '2024-03-07 10:15:18', 'true', 100),
(21, 'GIGABYTE B450M DS3H V2', 'Supports AMD 3rd Gen Ryzen/ 2nd Gen Ryzen/ 1st Gen Ryzen/ 2nd Gen Ryzen with Radeon Vega Graphics/ 1st Gen Ryzen with Radeon Vega Graphics/ Athlon with Radeon Vega Graphics Processors;Dual Channel Non-ECC Unbuffered DDR4, 4 DIMMs\r\nGIGABYTE Exclusive 8118 Gaming LAN with Bandwidth Management;RGB Fusion supports RGB LED Strips in 7-Colors\r\nSmart Fan 5 Features 5 Temperature Sensors and 2 Hybrid Fan Headers with FAN STOP;APP Center Including EasyTune and Cloud Station Utilities\r\nGraphics Card Interface: Pci E', 'GIGABYTE B450M DS3H V2, motherboard, budget motherboard, motherboards, budget motherboards', 14, 12, '71Inv9RA9CL._SX679_.jpg', '71+E4u2NaBL._SX679_.jpg', '71nD1TaLRFL._SX679_.jpg', '9099', '5199', '2024-03-07 10:20:40', 'true', 100),
(22, 'MSI B760 Gaming Plus WiFi Motherboard, ATX', '12th & 13th Gen Core - The MSI B760 GAMING PLUS WIFI (ATX) motherboard features a 12 Duet Rail Power System (P-PAK) VRM designed for the Intel B760 chipset (LGA 1700, 12th & 13th Gen Core). It includes MSI Core Boost technology for enhanced stability and performance. Integrated Cooling - The VRM cooling system includes 7W/mK MOSFET thermal pads and an extended heatsink. Additional cooling features consist of a chipset heatsink, M.2 Shield Frozr, a dedicated pump-fan cooling header, and a 6-layer PCB with 2 oz. thickened copper. DDR5 Memory, Dual PCIe 4.0 x16 Slots - The motherboard has 4 DDR5 DIMM slots with Memory Boost isolated circuitry for overclocking (1DPC 1R, 6800+ MHz). It also includes 2 PCIe 4.0 x16 slots (64GB/s) for graphics cards, with the primary PCIe x16 slot featuring Steel Armor. Dual M.2 Connectors - Storage options include 2 M.2 Gen4 x4 64Gbps slots, with Shield Frozr on the primary slot to prevent thermal throttling during hyper-fast SSD access. Wi-Fi 6E Connectivity - The motherboard features an Intel Wi-Fi 6E module with Bluetooth 5.3 and 2.5Gbps LAN. Rear ports include USB 3.2 Gen 2 Type-C and Type-A (10Gbps), HDMI 2.1 and DisplayPort 1.4, and 7.1 HD Audio with Audio Boost (supports S/PDIF output).', 'gaming motherboard, gaming motherboards, Gaming, wifi motherboards, WIFI, wifi, ATX, MSI, B760', 14, 5, '91uLE4tvpyL._SX679_.jpg', '91OeLmqhIML._SX679_.jpg', '917l+TPy70L._SY879_.jpg', '29599', '19599', '2024-03-07 10:23:53', 'true', 100),
(23, 'ASUS ROG Strix B760-I Gaming WiFi LGA 1700 Mini ITX Motherboard', 'Intel LGA 1700 socket: Ready for 13th Gen Intel Core, and 12th Gen Intel Core, Pentium Gold, and Celeron Processors\r\nRobust Power Solution: 8 + 1 power stages rated for 80A, ProCool power connectors, high-quality alloy chokes, and durable capacitors are all leveraged to support the latest multi-core processors\r\nOptimized VRM Thermals: Thick heatsinks bridged to the VRM with high-conductivity thermal pads, and the larger one integrated with the I/O cover for added surface area\r\nNext-Gen Networking: On-board Intel Wi-Fi 6E (802.11ax) and Intel 2.5G Ethernet with ASUS LANGuard\r\nIntelligent Control: ASUS-exclusive AI Networking and Two-Way AI Noise Cancelation to simplify setup and improve performance', 'intel motherboard, intel support, asus rog, ASUS, B760 Gaming Wifi LGA 1700, mini ITX, motherboard, high performance, gaming motherboards, motherboards', 14, 13, '810xRriwz7L._SX679_.jpg', '81v9MKa9GcL._SX679_.jpg', '81UOo4F54iL._SX679_.jpg', '34599', '24299', '2024-03-07 10:27:52', 'true', 100),
(24, 'Corsair Vengeance LPX (1 * 16GB) 2400 Mhz DDR4 Desktop Ram', 'Each Vengeance LPX module is built with a pure aluminum heat spreader for faster heat dissipation and cooler operation; and the eight-layer PCB helps manage heat and provides superior overclocking headroom. Designed for great looks: Available in multiple colors to match your motherboard, your components, or just your style Vengeance LPX is optimized and compatibility tested for the latest Intel 100 Series motherboards and offers higher frequencies, greater bandwidth, and lower power consumption. XMP 2.0 support for trouble-free automatic overclocking Low-profile heat spreader design: The Vengeance LPX module height is carefully designed to fit smaller spaces.', 'ram, 16gb ram, 16gb, ram stick, corsair vengance, corsair, vengance, LPX, DDR4, ddr4, desktop ram', 16, 14, '61H-QIsyIjL._SX679_.jpg', '71X83MYfMzL._SY879_.jpg', '51HyPyH+PZL._SX679_.jpg', '15599', '8599', '2024-03-07 10:34:17', 'true', 100),
(25, 'Corsair Vengeance LPX 8GB (1x8GB) DDR4 3200MHZ C16 Desktop RAM', 'XMP 2.0 SUPPORT: One setting is all it takes to automatically adjust to the fastest safe speed for your VENGEANCE LPX. Tested Voltage 1.35V\r\nALUMINUM HEAT SPREADER: The unique design of the VENGEANCE LPX heat spreader optimally pulls heat away from the ICs and into your system’s cooling path, so you can push it harder.\r\nDESIGNED FOR HIGH-PERFORMANCE OVERCLOCKING: Each VENGEANCE LPX module is built from an custom performance PCB and highly-screened memory ICs.\r\nLOW-PROFILE DESIGN: The small form factor makes it ideal for smaller cases or any system where internal space is at a premium. SPD Latency 15-15-15-36', 'ram, 8gb ram, 8gb, ram stick, corsair vengance, corsair, vengance, vengance lpx,LPX, DDR4, ddr4, desktop ram, budget ram, budget memory, memory stick', 16, 14, '51YEohMMIyL._SY879_.jpg', '51gKjHeEmGL._SX679_.jpg', '512BfBMLaVL._SX679_.jpg', '3459', '1999', '2024-03-07 10:38:09', 'true', 100),
(26, 'CORSAIR Vengeance (16GBx2) DDR5 DRAM 5200MHz C40 Desktop Ram', 'CORSAIR VENGEANCE DDR5, optimized for Intel motherboards, delivers higher frequencies and greater capacities of DDR5 technology in a high-quality, compact module that suits your system.', 'ram, 16gb ram, 16gb, ram stick, corsair vengance, corsair, vengance, LPX, DDR5, ddr5, desktop ram, 32gb, 32gb memory, 32gb ram, C40 desktop ram, RAM, 5200MHz', 16, 14, '31RJ9UWMemL._SY300_SX300_QL70_FMwebp_.webp', '81255vxF2DL._SX679_.jpg', '81PCDwr-8wL._SX679_.jpg', '29999', '16599', '2024-03-07 10:41:33', 'true', 100),
(27, 'Corsair Vengeance RGB Pro SL (2x16GB) DDR4 Desktop Memory', 'Illuminate your system with vivid, animated lighting from ten individually addressable, ultra-bright RGB LEDs per module. Choose from dozens of preset lighting profiles, or create your own in CORSAIR iCUE software. Just 44mm tall for wide compatibility with air coolers such as the CORSAIR A500. Optimized for maximum bandwidth and tight response times on the latest Intel and AMD DDR4 motherboards. A custom performance PCB provides the highest signal quality for the greatest level of performance and stability. VENGEANCE RGB PRO SL modules use only tightly screened memory chips, for extended overclocking potential. Take control with CORSAIR iCUE software and synchronize lighting with other CORSAIR RGB products, including coolers, keyboards and fans.', 'ram, 16gb ram, 16gb, ram stick, corsair vengance, corsair, vengance, LPX, DDR4, ddr4, desktop ram', 16, 14, '51plQyRoadL._SX522_.jpg', '61vVi2QdblL._SX522_.jpg', '51Ju99jUihL._SX522_.jpg', '25599', '12199', '2024-03-07 10:44:41', 'true', 100),
(28, 'ZEBRONICS ZEB-MN26 256GB M.2 NVMe Solid State Drive (SSD)', 'M.2 NVMe 2280 Form Factor. Sequential Read Speed 1900Mb/s & Write speed 1000Mb/s. PCIe Gen 3.0 x4 NVMe. S.M.A.R.T. MTBF is Expressed in 2 Million Hours', 'zebronics, ZEB-MN26, 256gb ssd, SSD, ssd, budget ssd, M.2 NVMe SSD, m.2 NVMe ssd', 18, 20, 'be1776b4-7a5e-4a8d-a8dd-899d5686c143.__CR0,0,970,600_PT0_SX970_V1___.jpg', '71W-OZLeN8L._SX679_.jpg', '51Ymki0Ol5L._SX679_.jpg', '8699', '1999', '2024-03-07 10:59:50', 'true', 100),
(29, 'Crucial P3 500GB PCIe 3.0 3D NAND NVMe M.2 SSD', 'Impressive read/ write speeds up to 3500/3000MB/sSpacious storage up to 4TBSolid Gen3 performance. Micron Advanced 3D NAND. NVMe PCIe 3.0 M.2 (2280).Performs up to 45% better than the previous generation⁴Dynamic write acceleration. Multistep data integrity algorithm.', 'crucial, Crucial P3 500GB PCIe 3.0 3D NAND NVMe M.2 SSD, 500gb, ssd, SSD, ssd, budget ssd, M.2 NVMe SSD, m.2 NVMe ssd, PCIe 3.0, supports PCIe 3.0, 500gb ssd  ', 18, 17, '61kW1AYUZZL._SX679_.jpg', '61ipuzrFotL._SX679_.jpg', '51XuNS7R-lL._SX679_.jpg', '4599', '3299', '2024-03-07 11:00:15', 'true', 100),
(30, 'Samsung 980 1TB Up to 3,500 MB/s PCIe 3.0 NVMe M.2', 'Sequential Read speeds up to 3,500MB/s. Performance varies based on system hardware and configuration\r\nInterface : PCIe 3.0 NVMe (PCIe Gen 3.0 x 4)\r\n5-Year Limited Warranty or 600 TBW Limited Warranty. Up to 3,000 MB/s * Performance may vary based on system hardware\r\nDesigned for gamers, Mainstream PC users, Value maximizers', 'samsung, 980, 1tb ssd, 1TB SSD, PCIe 3.0, NVMe M.2, 1TB, 1tb', 18, 19, '38543b3a-0e39-40c9-8389-9094cbcc283c.__CR0,0,1293,800_PT0_SX970_V1___.jpg', 'e0044816-4fe7-449c-8778-b26e39bb0591.__CR73,0,1293,800_PT0_SX970_V1___.jpg', '60f39013-d093-4351-9d5b-4562c25bb867.__CR69,0,1310,810_PT0_SX970_V1___.jpg', '15599', '7999', '2024-03-07 11:04:49', 'true', 100),
(31, 'Crucial T500 1TB Gen4 NVMe M.2 Internal Gaming SSD', 'LIGHTNING SPEEDS: Get incredible performance with sequential reads/writes up to 7,300/6,800MB/s and random read/writes up to 1.15M/1.44M IOPs\r\nCOMPATIBLE: Ready for performance with your laptop, desktop or workstation, the T500 installs easily in your M.2 slot\r\nULTIMATE GAMING: Load games up to 16% faster and get faster texture renders and less CPU utilization with Microsoft DirectStorage', 'gaming ssd, T500, crucial, ZEB-MN26, 1TB ssd, SSD, ssd, Gen4, M.2 NVMe SSD, m.2 NVMe ssd', 18, 17, '718tn7xZwJL._SX679_.jpg', '71GwYmyjpGL._SX679_.jpg', '71uTl5+2r1L._SX679_.jpg', '18599', '13599', '2024-03-07 11:07:37', 'true', 100),
(32, 'Seagate Barracuda 2 TB Internal Hard Drive HDD', 'Store more, compute faster, and do it confidently with the proven reliability of BarraCuda internal hard drives\r\nBuild a powerhouse gaming computer or desktop setup with a variety of capacities and form factors\r\nThe go-to SATA hard drive solution for nearly every PC application—from music to video to photo editing to PC gaming\r\nConfidently rely on internal hard drive technology backed by 20 years of innovation\r\nMigrate and clone data from old drives with ease using our free Seagate DiscWizard software tool', 'seagate, 2tb hdd, internal hdd, HDD, barracuda, 2TB, 2tb, Hard disk, hard disk', 17, 18, '614rFGMUwTL._SX679_.jpg', '81dBMjLd2EL._SX679_.jpg', '812orAfGfLL._SX679_.jpg', '6999', '4999', '2024-03-07 11:24:06', 'true', 100),
(33, 'Western Digital 2Tb Wd Blue 7200RPM', 'NoTouch Ramp Load technology – The recording head never touches the disk media, ensuring significantly less wear to the recording head and media as well as better drive protection in transit.\r\nLow power consumption – State-of-the-art seeking algorithms and advanced power management features ensure low power consumptio', 'wd blue, WD blue, western digital, 2tb, 2TB, budget hdd', 17, 15, '81yWIjiHIDL._SX679_.jpg', '81Zal05LbjL._SX679_.jpg', '81cdQuJqKjS._SX679_.jpg', '7299', '5299', '2024-03-07 11:29:53', 'true', 100),
(34, 'Western Digital 4Tb Wd Blue', 'NoTouch Ramp Load technology – The recording head never touches the disk media, ensuring significantly less wear to the recording head and media as well as better drive protection in transit.\r\nLow power consumption – State-of-the-art seeking algorithms and advanced power management features ensure low power consumption', '4tb, wd blue, WD, WD blue, 4tb hdd, Western Digital 4Tb Wd Blue', 17, 15, 'shopping (2).png', 'shopping.png', 'shopping (1).png', '8999', '7999', '2024-03-07 11:37:20', 'true', 100),
(35, 'MSI RTX 4070 Ti Gaming X Trio', 'Chipset: GeForce RTX 4070 Ti\r\nVideo Memory: 12GB GDDR6X\r\nMemory Interface: 192-bit\r\nOutput: DisplayPort x 3 (v1.4a) / HDMI 2.1 x 1\r\nDigital maximum resolution: 7680 x 4320', 'msi, RTX, MSI, rtx, 4070 ti, gaming, graphics card, 4070 Ti Gaming X Trio', 13, 5, 'download.png', 'download (1).png', 'download (2).png', '118598', '97599', '2024-03-07 11:41:21', 'true', 100),
(36, 'MSI RTX™ 4090 SUPRIM X 24G', 'TRI FROZR 3S\r\nPush performance with the latest MSI cooling design and elevate\r\nsophistication with a prestigious appearance.\r\nTORX FAN 5.0\r\nFan blades linked by ring arcs and a fan cowl work together to\r\nstabilize and maintain high-pressure airflow.\r\nVapor Chamber\r\nThe GPU and memory modules are covered with a Vapor\r\nChamber which rapidly transfers heat to Core Pipes.', 'msi, rtx, RTX, MSI, 4090 SUPRIM X 24G, 24gb card, graphics card, excellent performance', 13, 5, 'VD24MSRTX4090GS.jpg', '3812958865.jpg', 'LD0005984094.jpg', '224599', '205699', '2024-03-07 11:46:54', 'true', 100),
(37, 'MSI GTX 1630 VENTUS XS 4GB OC', 'Boost Clock / Memory Speed\r\n1785 MHz / 12 Gbps\r\n4GB GDDR6\r\nDisplayPort x 1(v1.4a)\r\nHDMI x 1(Supports 4K@60Hz as specified in HDMI 2.0b)\r\nDL-DVI-D x 1', 'msi, GTX, gtx, 1630, ventus XS, 4gb card, graphics card, Ventus XS 4gb OC, OC', 13, 5, '71g+DpBBoAL.jpg', 'MSI-GTX-1630-Ventus-XS-OC-4GB-Gaming-Graphics-Card-4.jpg', 'msi-geforce-gtx-1630-ventus-xs-4g-oc-4gb-gddr6-graphic-card-500x500.webp', '22199', '16599', '2024-03-07 11:49:40', 'true', 100),
(38, 'MSI GTX 1650 Super Ventus XS OC 4GB', 'Boost Clock / Memory Speed\r\n1740 MHz / 12 Gbps\r\n4GB GDDR6\r\nDisplayPort x 1 / HDMI x 1 / DL-DVI-D x 1', 'msi gtx, GTX, MSI, 1650 Super Ventus XS OC, OC, ventus, 1650 Super, 1650 super, 4gb card, graphics card, 4gb', 13, 5, 'Msi-GeForce-GTX-1650-VENTUS-XS-4G-OCV1-1.jpg', '51B7uDTIzaL.jpg', 'NewProject_52_8c287125-15f3-4fb9-b46c-56e05252b57b.webp', '29999', '14999', '2024-03-07 11:52:17', 'true', 100),
(39, 'MSI RTX 2060 VENTUS 12G OC', 'Includes G-Sync option. Gives you more of what you want in a gaming experience. Incredibly smooth, tear-free gameplay at refresh rates up to 240Hz', 'msi, rtx, RTX, MSI, 2060 OC, 12gb card, graphics card, ventus 12gb OC, MSI RTX 2060 VENTUS 12G OC', 13, 5, '51qVgcJ7EVL._AC_UF894,1000_QL80_.jpg', 'geforce-rtx-2060-ventus-gp-oc-msi-original-imagdw54cmtzdmpe.webp', 'vmf3jdbbm3t1ihm62ce51ca83085042787612.jpg', '67999', '38999', '2024-03-07 11:56:07', 'true', 100),
(40, 'Cooler Master MWE 450W Bronze', 'With Active Power Factor Correction design and forward topology. Meeting the 80 PLUS certification for 230V, the MWE will guarantee a typical efficiency of at least 85% during normal use.', 'cooler master, MWE 450W Bronze, bronze, 450W, power supply, SMPS, PSU, psu, budget psu, budget', 19, 2, 'TcN1Kw0UxuH5v-xxlarge.webp', 'mpe-4501-acabw-bin-image-main-600x600.jpg', 'mwe-bronze-450-1200x630.jpg', '3949', '3599', '2024-03-07 12:00:35', 'true', 100),
(41, 'Cooler Master MWE 650', 'It’s important to understand what efficiency is and what the ratings actually mean. The efficiency rating indicates how much power is retained and/or lost when transferring it from the wall to your components. It does not indicate the overall quality of the PSU. A PSU doesn’t need an 80 PLUS Gold rating to be safe and reliable. And a PSU with an 80 PLUS Gold rating isn’t necessarily either of those things. The MWE White guarantees a typical efficiency of 85% while being both safe and reliable. Cooler Master now reports Cybenetics noise and efficiency ratings for current power supply units where applicable.', 'cooler master, MWE 650W Bronze, bronze, 650W, power supply, SMPS, PSU, psu, budget psu, budget', 19, 2, '81ghpcd8hrL.jpg', 'mwe-650-bronze-v2-230v-1200x630.jpg', 'mwe-bronze-650-380x380-1-hover.png', '5199', '4699', '2024-03-07 12:03:05', 'true', 100),
(42, 'Cooler Master MWE 750 V2', 'It’s important to understand what efficiency is and what the ratings actually mean. The efficiency rating indicates how much power is retained and/or lost when transferring it from the wall to your components. It does not indicate the overall quality of the PSU. A PSU doesn’t need an 80 PLUS Gold rating to be safe and reliable. And a PSU with an 80 PLUS Gold rating isn’t necessarily either of those things. The MWE White guarantees a typical efficiency of 85% while being both safe and reliable. Cooler Master now reports Cybenetics noise and efficiency ratings for current power supply units where applicable.', 'cooler master, MWE 750W Bronze, bronze, 750W, power supply, SMPS, PSU, psu', 19, 2, 'Cooler-Master-MWE-750-V2-80-Plus-Bronze-SMPS-1.jpg', 'mpe-7501-acabw-bin-1-800x800.jpg', 'mpe-7501-afaag-in-2-550x550.jpg', '9599', '8299', '2024-03-07 12:05:04', 'true', 100),
(43, 'Cooler Master ML240L ARGB V2', 'Close-Loop AIO CPU Liquid Cooler, 3rd Gen Dual Chamber Pump, Dual SickleFlow 120mm for AMD Ryzen/Intel LGA 1200/1151 (MLW-D24M-A18PA-R2)', 'cooler master, ML240L, ARGB, V2, cooling system, cpu cooler, budget cooling system, argb cooling system, cpu liquid cooling, cpu cooling', 23, 2, 'masterliquidml240lv2argb-1-700x550-500x500.webp', 'cm-ml240l-argb-v2_2-2000x2000.jpg', '6100QDwwGgL.jpg', '7599', '6659', '2024-03-07 12:10:40', 'true', 100),
(44, 'Ant Esports ICE-240', '240mm Addressable RGB 2600RPM AIO I CPU Liquid Cooler , Efficient Cooling , low-noise Efficiency\r\nCPU Socket Compatibility - Intel - LGA115X/1200/1700/1366/2011/2066 I AMD - FM1/FM2/AM2//AM2+/AM3/AM3+/AM4/AM5\r\nRadiator Material : Aluminum Alloy I Radiator Dimensions : 274×120×27 mm I Fan Dimensions : 120×120×25 mm\r\nFan Speed : 800~2000 RPM±10% I Fan Airflow : 75 CFM Max I Fan Air Pressure : 2.9 mmAq I Fan Noise : 32 dB(A)', 'liquid cooler, ant esports, ICE-240, ARGB, cooling system, cpu cooler, budget cooling system, argb cooling system, cpu liquid cooling, cpu cooling', 23, 3, '61rBywkAR4L._SX679_.jpg', '71iP2YO3FYL._SX679_.jpg', '812grlKgH6L._SX679_.jpg', '6499', '5499', '2024-03-07 12:13:58', 'true', 100),
(45, 'Corsair H100 RGB 240mm CPU Cooler', '240mm All-in-one CPU cooling that gives your PC build dramatic color with 2x 120mm CORSAIR SP RGB ELITE PWM fans generating great airflow and vibrant RGB lighting.\r\n29 Total individually addressable RGB LEDs (13x on the pump cap, 16x on the fans) produce stunning, customizable lighting effects to match your build.\r\nKeep your CPU cool with fan speeds running up to 1,500 RPM, bolstered by AirGuide technology that channels concentrated airflow where it’s needed.\r\nA 240mm radiator fits in almost any 240mm fan mount for high surface area cooling.', 'liquid cooler, corsair, corsair liquid cooler, ICE-240, ARGB, cooling system, cpu cooler, budget cooling system, argb cooling system, cpu liquid cooling, cpu cooling', 23, 14, '61ph7C9nhYL._SX679_.jpg', '61UN+IfjK5L._SX679_.jpg', '61y4VS-D3mL._SX679_.jpg', '13199', '6749', '2024-03-07 12:16:18', 'true', 100);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `review_text` varchar(255) NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`review_id`, `product_id`, `user_id`, `rating`, `review_text`, `review_date`, `status`) VALUES
(8, 42, 6, 4, 'Awesome product, long lasting quality', '2024-03-10 04:59:41', 1),
(9, 42, 8, 5, 'A very good quality product. ', '2024-03-10 05:10:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_status` varchar(255) NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `tracking_status` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `payment_status`, `order_status`, `tracking_status`, `code`) VALUES
(25, 6, 8388, 691873984, 2, '2024-04-17 15:46:38', 'Paid', 'Complete', 'Delivered', 'normal'),
(26, 6, 66287, 1655398235, 3, '2024-04-17 15:46:35', 'Paid', 'Complete', 'Delivered', 'normal'),
(27, 6, 9497, 2102265068, 2, '2024-03-19 04:46:33', 'Paid', 'Complete', 'Delivered', 'normal'),
(28, 6, 38661, 342077532, 3, '2024-04-15 08:46:44', 'Paid', 'pending', 'Ordered', 'normal'),
(29, 8, 18799, 569302499, 1, '2024-04-16 15:46:42', 'Paid', 'pending', 'Ordered', 'normal'),
(30, 6, 68871, 996372696, 6, '2024-04-09 23:46:40', 'Paid', 'pending', 'Ordered', 'normal'),
(31, 7, 4599, 1614834304, 1, '2024-04-17 15:46:30', 'Unpaid', 'pending', '', 'normal'),
(32, 6, 75141, 1044632195, 9, '2024-04-02 03:11:17', 'Paid', 'pending', 'Ordered', 'special'),
(33, 6, 74481, 308564151, 9, '2024-04-16 18:16:52', 'Unpaid', 'pending', '', 'special'),
(34, 10, 73981, 1547623497, 9, '2024-03-28 04:40:20', 'Unpaid', 'pending', '', 'special'),
(35, 10, 72546, 2053567998, 4, '2024-04-13 23:45:53', 'Unpaid', 'pending', '', 'normal'),
(36, 10, 78680, 1681556222, 9, '2024-04-17 15:52:40', 'Unpaid', 'pending', '', 'special'),
(37, 6, 111193, 449421388, 2, '2024-04-18 14:40:45', 'Unpaid', 'pending', '', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `date`) VALUES
(1, 21, 1281429014, 4998, 'Credit/Debit Card', '2024-04-17 14:26:32'),
(2, 25, 691873984, 8388, 'Credit/Debit Card', '2024-04-17 14:26:32'),
(3, 26, 1655398235, 66287, 'Credit/Debit Card', '2024-04-17 14:26:32'),
(4, 27, 2102265068, 9497, 'Credit/Debit Card', '2024-04-17 14:26:32'),
(5, 28, 342077532, 38661, 'Credit/Debit Card', '2024-04-17 14:26:32'),
(6, 29, 569302499, 18799, 'Credit/Debit Card', '2024-04-17 14:26:32'),
(7, 30, 996372696, 68871, 'Credit/Debit Card', '2024-04-17 14:26:32'),
(8, 32, 1044632195, 75141, 'Credit/Debit Card', '2024-04-17 14:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `user_number` varchar(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `user_email`, `user_password`, `user_address`, `user_image`, `user_number`, `status`) VALUES
(6, 'Nikhil', 'nikhil@gmail.com', 'nikhil@123', 'HMT Juntion Rockwell Road', 'Tatako.png', '9072160041', 0),
(7, 'Tarun', 'tarunkannadas@gmail.com', 'admin@123', 'Infra Hillock Apartment', 'Yohamo.png', '9946141220', 1),
(8, 'Sneha', 'sneha@gmail.com', 'sneha@123', 'Infra Hillock Apartment', 'Chinnu.png', '7593097898', 0),
(9, 'Kalyani', 'kalyani@gmail.com', 'kalyani@123', 'Address', 'waifu.png', '5987613589', 0),
(10, 'Madhav', 'madhav@gmail.com', 'madhav@123', 'Address', 'af181b29e104f4a37330ed84f03dc091.jpg', '7946137913', 0),
(11, 'Ashin', 'ashin@gmail.com', 'ashin@123', 'North Paravur, Mannam', 'portrait-anime-character-with-black-hoodie_662214-105921.avif', '8593694712', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pc_cart`
--
ALTER TABLE `pc_cart`
  ADD PRIMARY KEY (`build_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `pc_cart`
--
ALTER TABLE `pc_cart`
  MODIFY `build_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`);

--
-- Constraints for table `pc_cart`
--
ALTER TABLE `pc_cart`
  ADD CONSTRAINT `pc_cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `pc_cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
