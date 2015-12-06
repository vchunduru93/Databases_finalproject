drop table Professor;
create table Professor (
  pid INTEGER AUTOINCREMENT,
  fname VARCHAR(15),
  lname VARCHAR(15)
);

drop table Department;
create table Department (
  dno INTEGER,
  dname VARCHAR(25)
);

drop table Department_affiliation;
create table Department_affiliation (
  pid INTEGER,
  dno INTEGER,
);

drop table Course;
create table Course (
  dno INTEGER,
  cno INTEGER,
  cname VARCHAR(40)
);

drop table Course_instance;
create table Course_instance (
  dno INTEGER,
  cno INTEGER,
  semester VARCHAR(1),
  year VARCHAR(4),
  pid INTEGER,
  rating FLOAT,
  summary TEXT
);
