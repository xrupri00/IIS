drop table student;
drop table Term;
drop table exam;
drop table subject;
drop table student_term;
drop table lector_subject;
drop table student_subject;
drop table login_student;
drop table login_lector;
drop table lector;


CREATE table student(
  id INTEGER Primary key NOT NULL,
  name VARCHAR(50) NOT NULL,
  surname VARCHAR(50) NOT NULL,
  degrees VARCHAR (50)
);

CREATE table lector(
  id INTEGER Primary key NOT NULL,
  name VARCHAR(50) NOT NULL,
  surname VARCHAR(50) NOT NULL,
  degrees VARCHAR (50)
);

CREATE table term(
  id INTEGER Primary key NOT NULL AUTO_INCREMENT,
  holding_date DATE NOT NULL,
  capacity INTEGER NOT NULL,
  holding_place VARCHAR(50) NOT NULL,
  assign_begin DATE NOT NULL,
  assign_end DATE NOT NULL,
  id_exam INTEGER NOT NULL
);

CREATE table exam(
  id INTEGER Primary key NOT NULL AUTO_INCREMENT,
  min_points INTEGER NOT NULL,
  max_points INTEGER NOT NULL,
  type VARCHAR(25) NOT NULL,
  id_subject INTEGER NOT NULL
);

CREATE table subject(
  id INTEGER Primary key NOT NULL AUTO_INCREMENT,
  acronym VARCHAR(5) NOT NULL,
  type VARCHAR(5) NOT NULL,
  id_garant INTEGER NOT NULL
);

CREATE table student_subject(
  id_student INTEGER NOT NULL, 
  id_subject INTEGER NOT NULL,
  assign_date DATE NOT NULL,
  earned_points INTEGER
);

CREATE table student_term(
  id_student INTEGER NOT NULL, 
  id_term INTEGER NOT NULL,
  assign_date DATE NOT NULL,
  eval_date DATE,
  earned_points INTEGER,
  id_lector INTEGER
);

CREATE table lector_subject(
  id_lector INTEGER NOT NULL, 
  id_subject INTEGER NOT NULL
);

CREATE table login_student(
  id INTEGER Primary key NOT NULL AUTO_INCREMENT,
  login VARCHAR(50) NOT NULL,
  passwd VARCHAR(50) NOT NULL
);

CREATE table login_lector(
  id INTEGER Primary key NOT NULL AUTO_INCREMENT,
  login VARCHAR(50) NOT NULL,
  passwd VARCHAR(50) NOT NULL
);

ALTER TABLE student_term ADD CONSTRAINT PK_student_term PRIMARY KEY (id_student, id_term);

ALTER TABLE lector_subject ADD CONSTRAINT PK_lector_subject PRIMARY KEY (id_lector, id_subject);

ALTER TABLE student_subject ADD CONSTRAINT PK_student_subject PRIMARY KEY (id_student, id_subject);

ALTER TABLE subject ADD CONSTRAINT FK_Garant FOREIGN KEY (id_garant) REFERENCES lector(id) ON DELETE CASCADE;
ALTER TABLE student_term ADD CONSTRAINT FK_evaled FOREIGN KEY (id_lector) REFERENCES lector(id) ON DELETE CASCADE;
ALTER TABLE term ADD CONSTRAINT FK_exam FOREIGN KEY (id_exam) REFERENCES exam(id) ON DELETE CASCADE;
ALTER TABLE exam ADD CONSTRAINT FK_subject FOREIGN KEY (id_subject) REFERENCES subject(id) ON DELETE CASCADE;

COMMIT;
