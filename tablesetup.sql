drop table IF EXISTS Professor;
create table Professor (
  pid INTEGER AUTO_INCREMENT PRIMARY KEY,
  fname VARCHAR(15) NOT NULL,
  lname VARCHAR(15) NOT NULL,
  UNIQUE (fname, lname)
);

drop table IF EXISTS Department;
create table Department (
  dno INTEGER NOT NULL PRIMARY KEY,
  dname VARCHAR(50) NOT NULL
);

drop table IF EXISTS Department_affiliation;
create table Department_affiliation (
  pid INTEGER NOT NULL,
  dno INTEGER NOT NULL,
  FOREIGN KEY (pid)
    REFERENCES Professor(pid),
  FOREIGN KEY (dno)
    REFERENCES Department(dno)
);

drop table IF EXISTS Course;
create table Course (
  dno INTEGER NOT NULL,
  cno INTEGER NOT NULL PRIMARY KEY,
  cname VARCHAR(40) NOT NULL,
  FOREIGN KEY (dno)
    REFERENCES Department(dno),
  UNIQUE (dno, cno)
);

drop table IF EXISTS Course_instance;
create table Course_instance (
  dno INTEGER NOT NULL,
  cno INTEGER NOT NULL,
  semester VARCHAR(1) NOT NULL,
  year VARCHAR(4) NOT NULL,
  pid INTEGER NOT NULL,
  rating FLOAT NOT NULL,
  summary TEXT NOT NULL,
  FOREIGN KEY (dno)
    REFERENCES Department(dno),
  FOREIGN KEY (cno)
    REFERENCES Course(cno),
  FOREIGN KEY (pid)
    REFERENCES Professor(pid)
);
