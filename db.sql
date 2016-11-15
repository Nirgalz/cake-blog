CREATE TABLE articles
(
  id INT(10) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  title VARCHAR(50) NOT NULL,
  body TEXT NOT NULL,
  created DATETIME,
  modified DATETIME,
  user_id INT(11),
  published TINYINT(4) DEFAULT '0' NOT NULL
);
CREATE TABLE articles_tags
(
  tag_id INT(11) NOT NULL,
  article_id INT(11) NOT NULL,
  CONSTRAINT `PRIMARY` PRIMARY KEY (tag_id, article_id)
);
CREATE TABLE comments
(
  id INT(10) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  article_id INT(11) NOT NULL,
  comment_id INT(11),
  body TEXT NOT NULL,
  created DATETIME,
  modified DATETIME
);
CREATE TABLE files
(
  id INT(10) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(80),
  user_id INT(11),
  article_id INT(11),
  comment_id INT(11)
);
CREATE TABLE tags
(
  id INT(10) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL
);
CREATE TABLE users
(
  id INT(10) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  username VARCHAR(50),
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255),
  role VARCHAR(20),
  created DATETIME,
  modified DATETIME,
  photo VARCHAR(80),
  photo_dir VARCHAR(255)
);

INSERT INTO blog.users (username, email, password, role, created, modified, photo, photo_dir) VALUES ('admin', 'mail@admin.com', '$2y$10$5MLd6azQPrZBJM8PNRDMBuY1J7B45tFHrYv29QeGDSNy4cgXivLf2', 'admin', '2016-11-15 09:58:33', '2016-11-15 09:58:33', 'default_avatar.png', 'webroot/files/Users/photo/');