use Breezedemo;

drop procedure if exists Sp_GetAllUsers;

Delimiter $$

create procedure Sp_GetAllUsers
(
    IN _currentUserId INT
)
BEGIN
    SELECT 
    USRS.id, 
    USRS.name, 
    USRS.email, 
    USRS.rolename 
    FROM users as USRS
    WHERE USRS.id != p_Id;
    
END$$

Delimiter ;