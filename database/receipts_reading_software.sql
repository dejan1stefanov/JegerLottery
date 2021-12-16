-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2021 at 05:08 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `receipts_reading_software`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(64) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `password` varchar(16) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `surname`, `username`, `email`, `password`, `status`) VALUES
(1, 'Dejan', 'Stefanov', 'dejanST', 'deni1stefanov@gmail.com', 'jegermaister', 'active'),
(2, 'John', 'Doe', 'JohnD', 'john.doe@gmail.com', 'somePassword', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `image` varchar(128) DEFAULT NULL,
  `img_status` tinyint(4) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `updatedTime` datetime NOT NULL DEFAULT current_timestamp(),
  `approval` varchar(16) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `email`, `image`, `img_status`, `text`, `updatedTime`, `approval`) VALUES
(359, 'dddd334@gmail.com', '61984d1b49cd15.40967421.jpg', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras in sollicitudin est, vel malesuada augue. Aenean tincidunt nisl neque. Proin eu sem sit amet mi vestibulum laoreet et nec augue. In in augue est. Donec porta eros leo, vitae fermentum sapien ultricies et. Nullam quis arcu a metus scelerisque imperdiet. In blandit erat quis suscipit vestibulum. Mauris venenatis blandit ante ut efficitur. Nunc vulputate libero dolor, eu posuere massa tempor quis. Curabitur hendrerit mattis diam, vel convallis elit hendrerit vel. Donec pellentesque libero eu dolor hendrerit, nec suscipit velit vehicula.', '2021-11-20 02:19:23', 'award'),
(373, 'dddd334@gmail.com', '61a131b0bc96d5.55562151.jpg', 1, 'Aliquam euismod velit nibh, sed finibus mi porttitor quis. Ut rutrum, augue ut dignissim egestas, velit elit lacinia turpis, sed sagittis augue turpis nec erat. Phasellus sit amet accumsan dui. In hac habitasse platea dictumst. In sed risus cursus, mattis metus a, pulvinar elit. In tortor diam, venenatis sit amet lorem a, consequat hendrerit nibh. Donec vitae consectetur nibh, vitae tristique ex. Fusce ornare tempor erat, a iaculis lacus ornare a. Ut rhoncus vehicula sodales. Maecenas suscipit tortor eleifend ornare fermentum. Nunc rhoncus, libero nec convallis fringilla, orci nulla convallis ligula, nec mollis est ipsum non augue. Mauris a nibh quis tellus vehicula elementum. Morbi dui tellus, sodales nec orci eget, dignissim iaculis dolor. Donec quis sagittis nulla. Sed ac magna nulla. Donec varius arcu vitae mauris mollis dictum.', '2021-11-26 20:12:48', 'award'),
(374, 'deni1stefanov@gmail.com', '61a131c0ed8c83.24547426.png', 1, 'Nulla augue diam, mollis in metus sed, bibendum faucibus ex. Donec facilisis purus a iaculis elementum. Sed quis nibh porta, bibendum sem eu, placerat sapien. Duis imperdiet rhoncus ligula, non commodo nisl pretium non. Nulla vel leo sit amet diam commodo suscipit a in ligula. In hac habitasse platea dictumst. Suspendisse tempor pharetra justo at vestibulum. Donec non pharetra felis. Fusce laoreet vitae odio et eleifend. ', '2021-11-26 20:13:04', 'award'),
(375, 'dejan1stefanov@gmail.com', '61a131d45a0849.02168843.jpg', 1, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas quis facilisis urna. Vivamus in pellentesque sapien. Quisque nec facilisis leo. Donec non vehicula justo. Integer molestie risus vel nisl luctus gravida. Nullam feugiat congue cursus. Sed sed purus finibus, iaculis mauris sollicitudin, mattis odio. Cras nec dolor diam. Vivamus maximus est vel libero accumsan rhoncus. Duis semper, turpis venenatis sollicitudin sagittis, erat urna tincidunt lacus, eget consectetur purus mauris sit amet elit. Sed convallis ligula et eros luctus posuere. Maecenas erat ante, congue vitae purus et, facilisis posuere mi. Morbi faucibus non magna vitae mollis.', '2021-11-26 20:13:24', 'award'),
(376, 'densdi1stefanov@gmail.com', '61a1321f4a3d63.11246345.jpg', 2, 'Curabitur blandit arcu id dapibus malesuada. Aliquam luctus suscipit placerat. Praesent elementum rhoncus condimentum. Suspendisse potenti. Morbi malesuada facilisis dolor fermentum fringilla. Duis pharetra urna placerat tortor interdum suscipit. Nulla id libero id sem gravida ultrices eu quis metus. Etiam condimentum finibus mauris sed elementum. Proin suscipit, enim in interdum auctor, orci ex feugiat purus, ut hendrerit velit nisi non ipsum. Etiam in quam vitae est sagittis malesuada. Mauris imperdiet molestie erat nec facilisis. Phasellus id ante eu purus porttitor laoreet ut ut metus. Praesent mauris ligula, auctor at tellus non, pulvinar dapibus massa. Vivamus semper, purus et suscipit facilisis, erat massa commodo libero, non sagittis quam ex a tortor. Etiam quis nibh tellus.', '2021-11-26 20:14:39', 'award'),
(379, 'dddsda@gmail.com', '61a191e62b0d74.67549826.jpeg', 2, 'Nullam eleifend, nunc eu egestas suscipit, elit urna fringilla ligula, vel pharetra purus arcu sit amet odio. Integer pellentesque ultrices ultricies. Vestibulum maximus venenatis mi non auctor. Aenean molestie pretium quam, eget molestie ex molestie ut. Maecenas in vulputate ligula, nec tincidunt velit. Nullam sodales pharetra accumsan. Vivamus vitae vulputate nisi. Aenean ornare elementum magna, ac tempor orci sollicitudin vitae. Vivamus sodales sem quis ipsum congue fermentum. Nam tincidunt turpis eu odio dapibus tristique. Proin in blandit nulla, nec sollicitudin ipsum. Curabitur sapien mi, malesuada id eros non, varius elementum augue.', '2021-11-27 03:03:18', 'award'),
(381, 'deni1stefanov@hotmail.com', '61a1a6f86337a4.52196804.jpeg', 2, 'Praesent eget est eget ipsum scelerisque tincidunt. Morbi vehicula lorem nec est ullamcorper, id luctus nunc tristique. Fusce eget pellentesque mi. Praesent at diam placerat, aliquam ligula non, laoreet sem. Praesent eget luctus est. Quisque magna erat, tincidunt eu nulla et, pellentesque egestas tortor. Aenean porttitor nibh in metus accumsan pretium. Aliquam posuere arcu at lectus varius, id venenatis metus dignissim. Sed eget arcu ac est imperdiet mollis eu sed tortor. Nunc tincidunt sagittis tellus ut venenatis. Morbi elementum nisl dui, ut ultricies ipsum placerat at.', '2021-11-27 04:33:12', 'award'),
(383, 'deni1stefanov@yahoo.com', '61a1a83c0445e3.47568230.jpeg', 2, 'Phasellus efficitur quam quis aliquam malesuada. Duis nec enim fringilla nisi fermentum blandit id a ligula. Integer luctus, mi ut pharetra viverra, libero sapien venenatis lectus, in gravida quam eros eu ex. Praesent luctus interdum mattis. Ut placerat suscipit enim, eu gravida libero fringilla id. Nullam neque ipsum, bibendum quis felis nec, porta mattis magna. Aliquam vehicula orci ac elit posuere, quis efficitur eros egestas. Mauris vulputate, ipsum eu auctor molestie, massa quam blandit mi, eu vestibulum est orci viverra dui. Morbi quis tempor velit. Integer ac elementum purus. Morbi commodo est id nunc euismod, sit amet molestie nisl tristique. Duis malesuada erat sed efficitur pharetra.', '2021-11-27 04:38:36', 'award'),
(384, 'dddd334@gmail.com', '61a6c646c21c39.63362194.jpeg', 2, 'Phasellus efficitur quam quis aliquam malesuada. Duis nec enim fringilla nisi fermentum blandit id a ligula. Integer luctus, mi ut pharetra viverra, libero sapien venenatis lectus, in gravida quam eros eu ex. Praesent luctus interdum mattis. Ut placerat suscipit enim, eu gravida libero fringilla id. Nullam neque ipsum, bibendum quis felis nec, porta mattis magna. Aliquam vehicula orci ac elit posuere, quis efficitur eros egestas. Mauris vulputate, ipsum eu auctor molestie, massa quam blandit mi, eu vestibulum est orci viverra dui. Morbi quis tempor velit. Integer ac elementum purus. Morbi commodo est id nunc euismod, sit amet molestie nisl tristique. Duis malesuada erat sed efficitur pharetra.', '2021-12-01 01:48:06', 'award'),
(389, 'dddd334@gmail.com', '61a8096aa5ea16.05997548.jpeg', 1, 'Phasellus efficitur quam quis aliquam malesuada. Duis nec enim fringilla nisi fermentum blandit id a ligula. Integer luctus, mi ut pharetra viverra, libero sapien venenatis lectus, in gravida quam eros eu ex. Praesent luctus interdum mattis. Ut placerat suscipit enim, eu gravida libero fringilla id. Nullam neque ipsum, bibendum quis felis nec, porta mattis magna. Aliquam vehicula orci ac elit posuere, quis efficitur eros egestas. Mauris vulputate, ipsum eu auctor molestie, massa quam blandit mi, eu vestibulum est orci viverra dui. Morbi quis tempor velit. Integer ac elementum purus. Morbi commodo est id nunc euismod, sit amet molestie nisl tristique. Duis malesuada erat sed efficitur pharetra.', '2021-12-02 00:46:50', 'award'),
(398, 'dddd334@gmail.com', '61a8296c12c5d3.74659062.jpg', 1, 'Nulla ut enim quis mi interdum blandit ut sit amet arcu. Ut molestie turpis at egestas eleifend. Nunc vel leo arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nullam tempus quam vitae blandit venenatis. Morbi vitae magna quam. Phasellus quis semper odio. Nam nec nibh faucibus, maximus tellus at, aliquam tortor. Sed vulputate in ipsum ornare tempus. Proin metus libero, vehicula a justo et, tempus maximus justo. Nam in nisi dignissim, convallis arcu id, volutpat diam. Cras non dolor sed purus commodo pulvinar at ut massa. Nunc placerat dolor eget turpis aliquam fringilla. Duis sed commodo eros, nec hendrerit libero.', '2021-12-02 03:03:24', 'award'),
(399, 'dddd334@gmail.com', '61a90d8954dd11.45736882.jpg', 1, 'Suspendisse potenti. Cras ut risus sapien. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam vestibulum nibh non congue aliquet. Ut nec suscipit ipsum. Sed mauris lectus, cursus nec est a, sodales hendrerit ligula. Fusce blandit, risus nec sodales consectetur, tortor risus feugiat eros, eget dapibus leo ante quis tellus. Quisque sit amet risus porta, volutpat leo sed, elementum mi. Aliquam ornare facilisis diam ut interdum. Vivamus dignissim quis urna ac sagittis. Praesent nibh mauris, commodo sed malesuada quis, lobortis ut ante. Aenean vel egestas justo. Maecenas sed massa a velit malesuada interdum. Etiam commodo porta lorem, at elementum nisl eleifend ut.', '2021-12-02 19:16:41', 'award'),
(406, 'deni1stefanov@gmail.com', '61ab8c913c38c2.25132941.jpg', 1, 'In hac habitasse platea dictumst. Quisque vitae tempor mi. Cras sed consequat enim, id varius dui. Mauris et tristique lorem. Vestibulum in dapibus nulla. Praesent dapibus eget lectus a euismod. Praesent gravida mauris ac justo ultrices blandit.', '2021-12-04 16:43:13', 'Pending'),
(407, 'dddd334@gmail.com', '61ab8d0abe5954.68391980.jpg', 1, 'Pellentesque laoreet sodales magna ac faucibus. Nam semper lorem non elit auctor rutrum. Sed eget imperdiet enim. Phasellus gravida sodales massa, eget malesuada nunc condimentum non. Nunc rutrum ligula non urna vulputate, vitae tincidunt justo porttitor. Praesent volutpat facilisis efficitur. Nam ut imperdiet velit, vel tempus dui.', '2021-12-04 16:45:14', 'Pending'),
(408, 'dddd3d34@gmail.com', '61ab8d1f3e66b9.33801878.jpg', 1, 'Quisque quis leo auctor diam fringilla dapibus. Suspendisse et urna fringilla, rhoncus justo eu, lacinia diam. Nunc maximus risus nulla, lacinia consequat leo iaculis et. Pellentesque nisi est, scelerisque non tempus accumsan, lacinia a nunc. Donec nec massa neque. Aliquam blandit tristique tellus, quis efficitur dolor dictum vitae. Ut eget tempus leo. Morbi varius semper erat, eget dictum nibh semper at. Suspendisse sollicitudin in nibh eu faucibus. Sed hendrerit nibh at elit vestibulum, quis finibus elit blandit. Quisque nibh quam, rutrum sit amet tortor in, convallis ornare nisl. Nunc accumsan aliquam est, vitae posuere nibh pellentesque aliquam. Aliquam scelerisque vitae odio non semper. Mauris convallis ipsum ac odio tempor ultricies. Quisque at vulputate ipsum.', '2021-12-04 16:45:35', 'Pending'),
(410, 'dddd334@gmail.com', '61ab8d460e0a32.75577023.jpg', 2, 'Nullam eleifend, nunc eu egestas suscipit, elit urna fringilla ligula, vel pharetra purus arcu sit amet odio. Integer pellentesque ultrices ultricies. Vestibulum maximus venenatis mi non auctor. Aenean molestie pretium quam, eget molestie ex molestie ut. Maecenas in vulputate ligula, nec tincidunt velit. Nullam sodales pharetra accumsan. Vivamus vitae vulputate nisi. Aenean ornare elementum magna, ac tempor orci sollicitudin vitae. Vivamus sodales sem quis ipsum congue fermentum. Nam tincidunt turpis eu odio dapibus tristique. Proin in blandit nulla, nec sollicitudin ipsum. Curabitur sapien mi, malesuada id eros non, varius elementum augue.', '2021-12-04 16:46:14', 'Pending'),
(411, 'ddssdd334@gmail.com', '61ab8d5a88fb52.58383176.png', 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras in sollicitudin est, vel malesuada augue. Aenean tincidunt nisl neque. Proin eu sem sit amet mi vestibulum laoreet et nec augue. In in augue est. Donec porta eros leo, vitae fermentum sapien ultricies et. Nullam quis arcu a metus scelerisque imperdiet. In blandit erat quis suscipit vestibulum. Mauris venenatis blandit ante ut efficitur. Nunc vulputate libero dolor, eu posuere massa tempor quis. Curabitur hendrerit mattis diam, vel convallis elit hendrerit vel. Donec pellentesque libero eu dolor hendrerit, nec suscipit velit vehicula.', '2021-12-04 16:46:34', 'Pending'),
(412, 'dddd334@gmail.com', '61ab8df675caa8.17418042.png', 2, 'Nullam eleifend, nunc eu egestas suscipit, elit urna fringilla ligula, vel pharetra purus arcu sit amet odio. Integer pellentesque ultrices ultricies. Vestibulum maximus venenatis mi non auctor. Aenean molestie pretium quam, eget molestie ex molestie ut. Maecenas in vulputate ligula, nec tincidunt velit. Nullam sodales pharetra accumsan. Vivamus vitae vulputate nisi. Aenean ornare elementum magna, ac tempor orci sollicitudin vitae. Vivamus sodales sem quis ipsum congue fermentum. Nam tincidunt turpis eu odio dapibus tristique. Proin in blandit nulla, nec sollicitudin ipsum. Curabitur sapien mi, malesuada id eros non, varius elementum augue.', '2021-12-04 16:49:10', 'reject'),
(413, 'dejan1stefanov@gmail.com', '61ab8e3e78d589.72883843.jpg', 2, 'Phasellus efficitur quam quis aliquam malesuada. Duis nec enim fringilla nisi fermentum blandit id a ligula. Integer luctus, mi ut pharetra viverra, libero sapien venenatis lectus, in gravida quam eros eu ex. Praesent luctus interdum mattis. Ut placerat suscipit enim, eu gravida libero fringilla id. Nullam neque ipsum, bibendum quis felis nec, porta mattis magna. Aliquam vehicula orci ac elit posuere, quis efficitur eros egestas. Mauris vulputate, ipsum eu auctor molestie, massa quam blandit mi, eu vestibulum est orci viverra dui. Morbi quis tempor velit. Integer ac elementum purus. Morbi commodo est id nunc euismod, sit amet molestie nisl tristique. Duis malesuada erat sed efficitur pharetra.', '2021-12-04 16:50:22', 'reject'),
(414, 'deni1stefanov@gmail.com', '61ab8e765416f4.06589410.jpg', 2, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Maecenas quis facilisis urna. Vivamus in pellentesque sapien. Quisque nec facilisis leo. Donec non vehicula justo. Integer molestie risus vel nisl luctus gravida. Nullam feugiat congue cursus. Sed sed purus finibus, iaculis mauris sollicitudin, mattis odio. Cras nec dolor diam. Vivamus maximus est vel libero accumsan rhoncus. Duis semper, turpis venenatis sollicitudin sagittis, erat urna tincidunt lacus, eget consectetur purus mauris sit amet elit. Sed convallis ligula et eros luctus posuere. Maecenas erat ante, congue vitae purus et, facilisis posuere mi. Morbi faucibus non magna vitae mollis.', '2021-12-04 16:51:18', 'reject'),
(415, 'dddd334@gmail.com', '61ab925a52b1a5.88484367.jpeg', 1, 'Praesent eget est eget ipsum scelerisque tincidunt. Morbi vehicula lorem nec est ullamcorper, id luctus nunc tristique. Fusce eget pellentesque mi. Praesent at diam placerat, aliquam ligula non, laoreet sem. Praesent eget luctus est. Quisque magna erat, tincidunt eu nulla et, pellentesque egestas tortor. Aenean porttitor nibh in metus accumsan pretium. Aliquam posuere arcu at lectus varius, id venenatis metus dignissim. Sed eget arcu ac est imperdiet mollis eu sed tortor. Nunc tincidunt sagittis tellus ut venenatis. Morbi elementum nisl dui, ut ultricies ipsum placerat at.', '2021-12-04 17:07:54', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(128) NOT NULL,
  `img_name` varchar(128) NOT NULL,
  `description` text DEFAULT NULL,
  `availability` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`id`, `name`, `img_name`, `description`, `availability`) VALUES
(1, 'Black Jagermeister Cap', 'cap-black.jpg', 'Black Jagermeister Cap', 33),
(3, 'Brown Jagermeister Cap', 'cap-brown.jpg', 'Brown Jagermeister Cap', 0),
(4, 'Grey Jagermeister Cap', 'cap-grey.jpg', 'Grey Jagermeister Cap', 24),
(5, 'Black Jagermeister Shirt', 'shirt-black.jpg', 'Black Jagermeister Shirt', 21),
(6, 'Grey Jagermeister Shirt', 'shirt-grey.jpg', 'Grey Jagermeister Shirt', 23),
(7, 'White Jagermeister Shirt', 'shirt-white.jpg', 'White Jagermeister Shirt', 22),
(8, 'Jagermeister Sunglasses', 'sunglasses.jpeg', 'Black Jagermeister Sunglasses', 22),
(9, 'Jagermeister Phone Case', 'phone-case.jpg', 'Black Jagermeister Phone Case', 23),
(10, 'Jagermeister Shot Glasses', 'shots.jpg', 'Black Jagermeister Shot Glasses', 24);

-- --------------------------------------------------------

--
-- Table structure for table `rewarded_images`
--

CREATE TABLE `rewarded_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `images_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `reward_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rewarded_images`
--

INSERT INTO `rewarded_images` (`id`, `images_id`, `admin_id`, `reward_id`) VALUES
(84, 359, 1, 10),
(85, 373, 1, 6),
(86, 374, 1, 7),
(87, 384, 1, 9),
(88, 375, 1, 5),
(93, 376, 1, 8),
(94, 379, 1, 4),
(95, 398, 1, 6),
(96, 389, 1, 1),
(97, 399, 1, 5),
(98, 381, 1, 9),
(99, 383, 1, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rewarded_images`
--
ALTER TABLE `rewarded_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_id` (`images_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `reward_id` (`reward_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT for table `reward`
--
ALTER TABLE `reward`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rewarded_images`
--
ALTER TABLE `rewarded_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rewarded_images`
--
ALTER TABLE `rewarded_images`
  ADD CONSTRAINT `rewarded_images_ibfk_1` FOREIGN KEY (`images_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `rewarded_images_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `rewarded_images_ibfk_3` FOREIGN KEY (`reward_id`) REFERENCES `reward` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
