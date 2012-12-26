SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(32) NOT NULL,
  `hash` varchar(128) NOT NULL,
  `mail` varchar(128) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `admin` (`id`, `user`, `hash`, `mail`, `approved`) VALUES
(1, 'admin', 'd725ce9bc8b13c65158d2b9818bd43bd24cea2279c0877cc5515ae579d0b86776bd7dc863270f1feb6d7a283ef1620d5de56b0e951099b84cd4d6ebc07421333', 'admin@admin.org', 0);

CREATE TABLE IF NOT EXISTS `uploads` (
  `uID` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL,
  `p_p` tinyint(1) NOT NULL,
  `warned` tinyint(1) NOT NULL,
  PRIMARY KEY (`uID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `uploads` (`uID`, `file`, `p_p`, `warned`) VALUES
(1, '1aa0175dc_x.png', 1, 0),
(2, '771865991_google_drive_icon-150x150.png', 0, 1),
(3, '751744910_StarRiver.jpg', 0, 0),
(4, '887105986_500px-Apple_Computer_Logo.png', 0, 0),
(5, '690410531_youtube_logo_standard_againstwhite-vflKoO81_.png', 0, 0);

CREATE TABLE IF NOT EXISTS `warnings` (
  `wID` int(11) NOT NULL,
  `warning` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `warnings` (`wID`, `warning`) VALUES
(2, 'Google logo.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
