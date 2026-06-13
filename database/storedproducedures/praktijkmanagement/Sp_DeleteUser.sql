USE breezedemo;
DROP PROCEDURE IF EXISTS sp_DeleteUser;
DELIMITER $$
CREATE PROCEDURE sp_DeleteUser(
    IN _d INT
)
BEGIN
    DELETE from Users
    where id = p_id;

    select ROW_COUNT() As affected;
END$$
DELIMITER ;