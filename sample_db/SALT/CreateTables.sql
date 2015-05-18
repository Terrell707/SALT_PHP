CREATE TABLE employee (
  id INT(5) NOT NULL AUTO_INCREMENT,
  emp_id INT(5),
  first_name VARCHAR(20),
  middle_init VARCHAR(1),
  last_name VARCHAR(20),
  phone_number CHAR(10),
  email VARCHAR(40),
  street VARCHAR(45),
  city VARCHAR(15),
  state CHAR(10),
  zip CHAR(5),
  pay DECIMAL(8,2),
  active BOOLEAN,
  PRIMARY KEY (id, emp_id)
) Engine = InnoDB;

CREATE TABLE business (
  name VARCHAR(35),
  tin CHAR(11),
  soc CHAR(4),
  bpa_no CHAR(13),
  duns_no INT(9),
  contractor_id INT(5),
  CONSTRAINT contractor_fk FOREIGN KEY (contractor_id) REFERENCES employee (id)
) Engine = InnoDB;

CREATE TABLE user (
  username VARCHAR(15),
  password VARCHAR(62),
  emp INT(5),
  PRIMARY KEY (username),
  CONSTRAINT emp_fk FOREIGN KEY (emp) REFERENCES employee (id) ON UPDATE CASCADE ON DELETE CASCADE
) Engine = InnoDB;

CREATE TABLE site (
  office_code CHAR(3) NOT NULL,
  name VARCHAR(15),
  address VARCHAR(75),
  phone_number CHAR(10),
  email VARCHAR(40),
  can INT(7),
  pay DECIMAL(5,2),
  active BOOLEAN,
  PRIMARY KEY (office_code)
) Engine = InnoDB;

CREATE TABLE expert (
  expert_id INT(5) NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(20),
  last_name VARCHAR(20),
  role CHAR(3),
  active BOOLEAN,
  PRIMARY KEY (expert_id)
) Engine = InnoDB;

CREATE TABLE judge (
  judge_id INT(5) NOT NULL AUTO_INCREMENT,
  office CHAR(3) NOT NULL,
  first_name VARCHAR(20),
  last_name VARCHAR(20),
  active BOOLEAN,
  PRIMARY KEY (judge_id),
  CONSTRAINT office_pk FOREIGN KEY (office) REFERENCES site (office_code) ON UPDATE CASCADE ON DELETE CASCADE
) Engine = InnoDB;

CREATE TABLE clerk (
  clerk_id INT(5) NOT NULL AUTO_INCREMENT,
  helps_judge INT(5),
  first_name VARCHAR(20),
  last_name VARCHAR(20),
  email VARCHAR(40),
  PRIMARY KEY (clerk_id),
  CONSTRAINT helps_judge_pk FOREIGN KEY (helps_judge) REFERENCES judge (judge_id) ON UPDATE CASCADE ON DELETE CASCADE
) Engine = InnoDB;

CREATE TABLE schedule (
  emp_id INT(5) NOT NULL,
  office_code CHAR(3) NOT NULL,
  work_date DATE,
  CONSTRAINT emp_id_pk FOREIGN KEY (emp_id) REFERENCES employee (id),
  CONSTRAINT office_code_pk FOREIGN KEY (office_code) REFERENCES site (office_code) ON UPDATE CASCADE ON DELETE CASCADE
) Engine = InnoDB;

CREATE TABLE ticket (
  ticket_no INT(8) NOT NULL,
  order_date DATE,
  call_order_no CHAR(15),
  first_name VARCHAR(20),
  last_name VARCHAR(20),
  soc CHAR(4),
  hearing_date DATE,
  hearing_time TIME,
  status CHAR(4),
  emp_worked INT(5) NOT NULL,
  judge_presided INT(5) NOT NULL,
  at_site CHAR(3) NOT NULL,
  PRIMARY KEY (ticket_no),
  CONSTRAINT emp_worked_pk FOREIGN KEY (emp_worked) REFERENCES employee (id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT judge_presided_pk FOREIGN KEY (judge_presided) REFERENCES judge (judge_id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT at_site_pk FOREIGN KEY (at_site) REFERENCES site (office_code) ON UPDATE CASCADE ON DELETE CASCADE
) Engine = InnoDB;

CREATE TABLE witness (
  expert_id INT(5),
  ticket_no INT(8),
  CONSTRAINT expert_id_pk FOREIGN KEY (expert_id) REFERENCES expert (expert_id) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT ticket_no_pk FOREIGN KEY (ticket_no) REFERENCES ticket (ticket_no) ON UPDATE CASCADE ON DELETE CASCADE
) Engine = InnoDB;
