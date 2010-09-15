DROP TABLE IF EXISTS `benutzer`;
CREATE TABLE IF NOT EXISTS `benutzer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vorname` varchar(40) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `passwort` varchar(20) DEFAULT NULL,
  `registriert_seit` date DEFAULT NULL,
  `anrede` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


INSERT INTO `benutzer` (`id`, `vorname`, `name`, `email`, `passwort`, `registriert_seit`, `anrede`) VALUES
(1, 'Frank', 'Reich', 'f.reich@example.com', 'kochtopf', '2008-04-12', 'Herr'),
(2, 'Marie', 'Huana', 'huana@example.com', 'reibekuche', '2009-02-03', 'Frau'),
(3, 'Andreas', 'Meisenbär', 'a.meisenbÃ¤r@example.com', 'schÃ¼ssel', '2008-07-15', 'Herr'),
(4, 'Klaus', 'Uhr', 'klaus@ur.org', 'bratpfanne', '2008-02-05', 'Herr'),
(5, 'Mike', 'Rosoft', 'sichtbar_grundlegend@kleinweich.com', 'teekessel', '2009-11-11', 'Herr'),
(6, 'Beatrice', 'LÃ¶dmann', 'beatrice@fraudoktor.de', 'kaffeemuehle', '2006-09-09', 'Dr');



DROP TABLE IF EXISTS `nimmt_teil`;
CREATE TABLE IF NOT EXISTS `nimmt_teil` (
  `benutzer_id` int(11) NOT NULL DEFAULT '0',
  `seminartermin_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`benutzer_id`,`seminartermin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


INSERT INTO `nimmt_teil` (`benutzer_id`, `seminartermin_id`) VALUES
(1, 6);



DROP TABLE IF EXISTS `seminare`;
CREATE TABLE IF NOT EXISTS `seminare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titel` varchar(120) NOT NULL,
  `beschreibung` text,
  `preis` decimal(6,2) DEFAULT NULL,
  `kategorie` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `titel` (`titel`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


INSERT INTO `seminare` (`id`, `titel`, `beschreibung`, `preis`, `kategorie`) VALUES
(1, 'Relationale Datenbanken & MySQL', 'Nahezu alle modernen W...', '975.00', 'Datenbanken'),
(2, 'Ruby on Rails', 'Ruby on Rails ist das neue, sensation...', '2500.00', 'Programmierung'),
(3, 'Ajax & DOM-Scripting', 'Ajax ist lÃ¤ngst dem Hype-Stadium ... JavaScript ist dabei ein essentieller Teil ...', '1699.99', 'Programmierung'),
(4, 'Moderne JavaScript-Programmierung', '...gilt als DIE Programmiersprache fÃ¼r clientseitige Web...', '2500.00', 'Programmierung'),
(5, 'Adobe Flash Professional (Grundlagen)', 'Adobe Flash bringt voll animierte, multimediale, interaktive PrÃ¤sentationen und Anwendungen ...', '1500.00', 'Webdesign'),
(6, 'Adobe Flash Professional (ActionScript)', 'FÃ¼r anspruchsvolle Flash-PrÃ¤sentationen und interaktive Anwendungen werden fundierte Kenntnisse in der Programmierung mit ActionScript ...', '1500.00', 'Programmierung'),
(7, 'Digitale Bildbearbeitung mit Adobe Photoshop', 'In diesem Seminar lernen Sie die Grundlagen der digitalen Bildbearbeitung mit Adobe Photoshop ...', '1500.00', 'Webdesign'),
(8, 'Web Useability', 'bla..', NULL, 'Webdesign'),
(9, 'Kochen lernen', '...', NULL, 'Freizeit');



DROP TABLE IF EXISTS `seminartermine`;
CREATE TABLE IF NOT EXISTS `seminartermine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `beginn` date DEFAULT NULL,
  `ende` date DEFAULT NULL,
  `raum` varchar(30) DEFAULT NULL,
  `seminar_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


INSERT INTO `seminartermine` (`id`, `beginn`, `ende`, `raum`, `seminar_id`) VALUES
(1, '2005-06-20', '2005-06-25', 'Schulungsraum 1', 1),
(2, '2005-11-07', '2005-11-12', 'Schulungsraum 2', 1),
(3, '2006-03-20', '2006-03-25', 'Schulungsraum 1', 1),
(4, '2006-12-04', '2006-12-09', 'Besprechungsraum', 1),
(5, '2005-01-17', '2005-01-24', 'Schulungsraum 1', 4),
(6, '2005-05-31', '2005-06-07', 'Aula', 4),
(7, '2005-10-17', '2005-10-24', 'Schulungsraum 2', 4);
