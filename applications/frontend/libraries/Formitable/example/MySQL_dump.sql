# phpMyAdmin MySQL-Dump
# version 2.2.5
# http://phpwizard.net/phpMyAdmin/
# http://phpmyadmin.sourceforge.net/ (download page)

#
# Table structure for table `formitable_demo`
#

CREATE TABLE formitable_demo (
  ID tinyint(3) unsigned NOT NULL auto_increment,
  f_name varchar(50) default NULL,
  l_name varchar(50) default NULL,
  description text,
  pets set('Dog','Cat','Fish','Horse','Frog','Rodent','Reptile','None') default NULL,
  foods set('pizza','pasta','salad','sandwich','hamburger') default NULL,
  color enum('Red','Blue','Green','Purple','Yellow','Other') default NULL,
  day_of_week enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') default NULL,
  b_day date default NULL,
  toon tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Table structure for table `formitable_toons`
#

CREATE TABLE formitable_toons (
  ID tinyint(3) unsigned NOT NULL auto_increment,
  name tinytext NOT NULL,
  PRIMARY KEY  (ID)
) TYPE=MyISAM;

#
# Dumping data for table `formitable_toons`
#

INSERT INTO formitable_toons (ID, name) VALUES (1, 'The Simpsons');
INSERT INTO formitable_toons (ID, name) VALUES (2, 'The Flinstones');
INSERT INTO formitable_toons (ID, name) VALUES (3, 'Dexter\'s Lab');
INSERT INTO formitable_toons (ID, name) VALUES (4, 'Power Puff Girls');
INSERT INTO formitable_toons (ID, name) VALUES (5, 'The Jetsons');
INSERT INTO formitable_toons (ID, name) VALUES (6, 'Family Guy');
INSERT INTO formitable_toons (ID, name) VALUES (7, 'Scooby Doo');
INSERT INTO formitable_toons (ID, name) VALUES (8, 'Other');