CREATE TABLE IF NOT EXISTS Users (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(100) NOT NULL UNIQUE,
  lastname VARCHAR(100) NOT NULL UNIQUE,
  email VARCHAR(255) NOT NULL UNIQUE,
  password VARCHAR(100) NOT NULL,
  avatar VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS Conversations (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  author_id int NOT NULL,
  subject VARCHAR(255) NOT NULL,
  FOREIGN KEY (author_id) REFERENCES Users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS  Messages (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  date DATE NOT NULL,
  author_id int NOT NULL,
  conversation_id int NOT NULL,
  content VARCHAR(255) NOT NULL,
  FOREIGN KEY (author_id) REFERENCES Users(id),
  FOREIGN KEY (conversation_id) REFERENCES Conversations(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS Reactions (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  author_id int NOT NULL,
  message_id int NOT NULL,
  emoji VARCHAR(50) NOT NULL,
  FOREIGN KEY (author_id) REFERENCES Users(id),
  FOREIGN KEY (message_id) REFERENCES Messages(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;