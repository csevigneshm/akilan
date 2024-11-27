CREATE TABLE `fabric_items` (
  `roll_no` int(11) NOT NULL,
  `shade` char(1) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `sh_length` int(11) DEFAULT NULL,
  `sh_width` int(11) DEFAULT NULL
)

INSERT INTO `fabric_items` (`roll_no`, `shade`, `length`, `width`, `sh_length`, `sh_width`) VALUES
(1, 'A', 456, 52, 5, 5),
(45, 'A', 54, 60, 3, 5),
(65, 'C', 300, 53, 2, 3),
(72, 'B', 200, 52, 0, 0),
(87, 'A', 100, 55, 0, 0);

ALTER TABLE `fabric_items` ADD PRIMARY KEY (`roll_no`);
