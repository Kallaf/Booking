CREATE DATABASE booking;

CREATE TABLE customers(
    username varchar(255) NOT NULL,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    isBlacklisted BOOLEAN,
    PRIMARY KEY (username)
);


CREATE TABLE customer_notifications(
    content varchar(255) NOT NULL,
    customername varchar(255) NOT NULL,
    notificationDate DATE, 
    seen BOOLEAN,
    FOREIGN KEY (customername) REFERENCES customers(username)
);


CREATE TABLE owners(
    username varchar(255) NOT NULL,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    rating TINYINT,
    stars TINYINT,
    location varchar(255),
    accountpayable FLOAT,
    ishidden BOOLEAN,
    image LONGBLOB,
    lastPayingDate DATE NOT NULL,
    PRIMARY KEY (username)
);

CREATE TABLE owner_notifications(
    content varchar(255) NOT NULL,
    ownername varchar(255) NOT NULL,
    notificationDate DATE, 
    seen BOOLEAN,
    FOREIGN KEY (ownername) REFERENCES owners(username)
);

CREATE TABLE rooms(
   ownername varchar(255) NOT NULL,
   type varchar(255) NOT NULL,
   no INT NOT NULL,
   facilities varchar(255) NOT NULL,
   count INT NOT NULL,
   current_price FLOAT NOT NULL,
   isReserved BOOLEAN,
   image LONGBLOB,
   PRIMARY KEY (no,ownername),
   FOREIGN KEY (ownername) REFERENCES owners(username) 
);

CREATE TABLE reservations(
  time DATE,
  isDone BOOLEAN,
  rating TINYINT,
  price FLOAT NOT NULL,
  ownername varchar(255) NOT NULL,
  customername varchar(255) NOT NULL,
  room_no INT NOT NULL,
  FOREIGN KEY (customername) REFERENCES customers(username),
  FOREIGN KEY (room_no,ownername) REFERENCES rooms(no,ownername)
);



CREATE TABLE broker_notification(
    seen BOOLEAN,
    notificationDate DATE,
    ownername varchar(255) NOT NULL,
    FOREIGN KEY (ownername) REFERENCES owners(username)
);
