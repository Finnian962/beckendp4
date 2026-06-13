use Breezedemo;

drop procedure if exists Sp_UpdateUser;

Delimiter $$

create procedure Sp_UpdateUser
(
    IN p_Id INTEGER
    ,in p_name VARCHAR(50)
    ,in p_email VARCHAR(100)
    ,in p_rolename VARCHAR(50)    
)
BEGIN
    UPDATE Users as usrs
    set usrs.name = p_name,
    usrs.email = p_email,
    usrs.rolename = p_rolename
    where usrs.id = p_Id;
END$$

Delimiter ;