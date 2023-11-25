
--@block
INSERT INTO users (name,email) 
VALUES 
('Rafih Yahya','RafihYahya@gmail.com');
--

--@block

SELECT * FROM users

--
--@block

UPDATE users SET id = 1 WHERE id = 3;

--
--@block

DELETE FROM users WHERE id = 2;

--
--@block

DELETE FROM personal_access_tokens WHERE id = 1 ;
--

