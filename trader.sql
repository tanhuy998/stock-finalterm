-- ACCOUNT TABLE DEFINITION

CREATE TABLE ACCOUNT (
  ID INT NOT NULL,
  ACCOUNT_NAME CHAR(25) UNIQUE NOT NULL,
  PASSWORD CHAR(25) NOT NULL,
  REG_TIME DATE NOT NULL,
  
  CONSTRAINT ACCOUNT_PK PRIMARY KEY (ID)
);
  
CREATE SEQUENCE ACCOUNT_SEQUENCE;


-- ACCOUNT_INFOMATION DEFINITION

CREATE TABLE ACCOUNT_INFORMATION (
  ID INT,
  NAME NVARCHAR2(50) NOT NULL,
  BIRTHDAY DATE NOT NULL,
  ADDRESS NVARCHAR2 (80),
  
  ACCOUNT_ID INT UNIQUE NOT NULL,
  
  CONSTRAINT ACCOUNT_INFO_PK PRIMARY KEY (ID),
  CONSTRAINT INFO_FK_ACCOUNT FOREIGN KEY (ACCOUNT_ID) REFERENCES ACCOUNT(ID)
  
);

CREATE SEQUENCE ACCOUNT_INFO_SEQUENCE;


-- WALLET DEFINITION

CREATE TABLE ACCOUNT_WALLET (
  ID INT NOT NULL,
  AMOUNT REAL,
  SHARE_NUMBER INT,
  
  ACCOUNT_ID INT UNIQUE NOT NULL,
  
  CONSTRAINT WALLET_PK PRIMARY KEY (ID),
  CONSTRAINT WALLET_FK_ACCOUNT FOREIGN KEY (ACCOUNT_ID) REFERENCES ACCOUNT(ID)
);

CREATE SEQUENCE WALLET_SEQUENCE;


-- TRANSACTION_TYPE DEFINITION

CREATE TABLE TRANSACTION_TYPE (
  ID INT NOT NULL,
  TYPE_NAME CHAR(3) NOT NULL,
  
  CONSTRAINT TRAN_TYPE_PK PRIMARY KEY (ID)
);

CREATE SEQUENCE TRAN_TYPE_SEQUENCE;

-- TRANSACTION_MONEY DEFINITION

CREATE TABLE TRANSACTION_MONEY (
  ID INT NOT NULL,
  AMOUNT REAL NOT NULL,
  TRADE_TIME DATE NOT NULL,
  STATUS NUMBER(1) DEFAULT 0 NOT NULL,
  
  TRAN_TYPE_ID INT NOT NULL,
  ACCOUNT_ID INT NOT NULL,
  
  CONSTRAINT TRAN_MON_PK PRIMARY KEY (ID),
  CONSTRAINT TRAN_MON_FK_ACCOUNT FOREIGN KEY (ACCOUNT_ID) REFERENCES ACCOUNT(ID),
  CONSTRAINT TRAN_MON_FK_TRAN_TYPE FOREIGN KEY (TRAN_TYPE_ID) REFERENCES TRANSACTION_TYPE (ID)
);

CREATE SEQUENCE TRAN_MON_SEQUENCE;

-- TRANSACTION_SHARE 

CREATE TABLE TRANSACTION_SHARE (
  ID INT NOT NULL,
  AMOUNT FLOAT NOT NULL,
  TRADE_TIME DATE NOT NULL,
  STATUS NUMBER(1) DEFAULT 0 NOT NULL,
  TRAN_TYPE NUMBER(1) NOT NULL,
  LEVER INT DEFAULT 1,
  PRICE FLOAT NOT NULL,
  CLOSE_TIME DATE,
  CLOSE_PRICE FLOAT,
  
  ACCOUNT_ID INT NOT NULL,
  
  CONSTRAINT TRAN_SHA_PK PRIMARY KEY (ID),
  CONSTRAINT TRAN_SHA_FK_ACCOUNT FOREIGN KEY (ACCOUNT_ID) REFERENCES ACCOUNT(ID)
);

CREATE SEQUENCE TRAN_SHA_SEQUENCE;



