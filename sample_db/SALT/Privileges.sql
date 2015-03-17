CREATE USER 'sao'@'localhost' IDENTIFIED BY 'saoave';
GRANT SELECT ON salt.* TO 'sao'@'localhost';
GRANT UPDATE ON salt.* TO 'sao'@'localhost';
GRANT INSERT ON salt.ticket TO 'sao'@'localhost';
GRANT INSERT ON salt.witness TO 'sao'@'localhost';
GRANT INSERT ON salt.expert TO 'sao'@'localhost';
