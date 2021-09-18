    /*
 ********                                                                                               *************
        *************************************************  tables  **************************************************
 ********                                                                                               *************
    */

CREATE TABLE user
(
    user_id             int         NOT NULL primary key AUTO_INCREMENT comment 'primary key',
    user_fullname       VARCHAR(50) NOT NULL COMMENT 'user first name and last name',
    user_address        VARCHAR(50) COMMENT 'user  house location ',
    user_ville          VARCHAR(50) NOT NULL COMMENT 'user  city',
    user_gender         CHAR(1) COMMENT 'male|female  city',
    user_dateOfBirth    DATE        NOT NULL COMMENT 'user date of birth',
    user_phoneNumber    VARCHAR(15) COMMENT 'user phone number  in case of emergency',
    user_email          VARCHAR(50) NOT NULL COMMENT 'user email in case of responses',
    user_password       VARCHAR(50) NOT NULL COMMENT 'user security saved session',
    user_photo          VARCHAR(50) COMMENT 'user photo ',
    user_role           VARCHAR(50) COMMENT 'user role in comany ',
    user_compteEtat     VARCHAR(50) NOT NULL COMMENT 'user compte etat is active or not',
    user_secretQuestion VARCHAR(50) COMMENT 'use to change password in case user forget it',
    user_Response       VARCHAR(50) COMMENT 'use to change password in case user forget it',
    user_RequestCount   INT         NULL comment 'use to calculate how an user request have '
        CONSTRAINT `user_userGender` CHECK ((user_gender IN ('M', 'F', 'f', 'm')))
) default charset utf8 comment '';
CREATE TABLE request
(
    request_id       int         NOT NULL primary key AUTO_INCREMENT comment 'primary key',
    request_date     DATE        NOT NULL comment 'request date',
    request_pretext  VARCHAR(50) NOT NULL comment 'request content,message ... ',
    request_response VARCHAR(50) comment 'request response',
    request_status   VARCHAR(50) comment 'request status',
    request_type     VARCHAR(50) NOT NULL comment 'request type',
    user_id          int         NOT NULL comment 'foreign key from user table',
    CONSTRAINT `request_statue_constraint` CHECK ((request_etat IN ('approve', 'reject', , 'postpone', 'pending'))),
    CONSTRAINT `request_UserforeignKey` FOREIGN KEY (user_id) REFERENCES user (user_id)
) default charset utf8 comment '';



    /*
 ********                                                                                               *************
        *************************************************  views  **************************************************
 ********                                                                                               *************
    */

-- table : requests
/**
  * view 1
  * get count of requests each month in current year
 */
CREATE or REPLACE VIEW viewRequestByMonthCurYear
as
SELECT m.name, COUNT(request.request_id)
FROM months m
         LEFT JOIN request on MONTHNAME(request.request_date) = m.name
    and YEAR(request_date) = YEAR(CURDATE())
GROUP BY FIELD(m.name, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',
               'November', 'December')
;



/**
  * view 2
  * get last four requests with , each request with all info (user and request)
 */
CREATE VIEW viewGetLastFourRequests
as
SELECT u.user_id,
       u.user_fullname,
       u.user_photo,
       (
           SELECT COUNT(request_id)
           from users uu,
                request rr
           where uu.user_id = rr.user_id
             and rr.user_id = u.user_id
       ) as 'count',
       r.request_date
from request r,
     users u
where r.user_id = u.user_id
GROUP BY u.user_fullname
ORDER by request_date DESC
LIMIT 4;



/**
  * view 3
  *  get count requests in each type
 */
-- get count requests in each type
CREATE  OR REPLACE view  view_GetCountRequestsByType
as
select rr.role_name as 'type', count(r.request_id)  as 'count' ,CAST((count(r.request_id) * 100/ (select count(*) from request)) as DECIMAL) as 'percentage'
from request r
         RIGHT JOIN  request_types rr on rr.role_name = r.request_type
group by  rr.role_name;

-- table : users

/**
  * view 1
  * get count users by there role
 */

    CREATE OR REPLACE VIEW view_GetUsersRoleCountByUser
as

    SELECT r.role_name as 'role', COUNT(u.user_id) as 'count' , convert(count(u.user_id) * 100 / sum(count(u.user_id))over() , integer ) as 'percentage'
    FROM users u
             RIGHT JOIN user_roles r on r.role_name = u.user_role
    GROUP BY r.role_name;




    /**
      * view 2
      * get last four user sign up with
     */
    CREATE OR REPLACE VIEW view_GetLastFourUser
as
    SELECT u.user_fullname , u.user_dateOfBirth ,user_photo , user_gender
    FROM user u
    group by  u.user_fullname , u.user_dateOfBirth ,u.user_role , u.user_gender,created_at
    order by  u.created_at DESC  LIMIT 4;















    /*
 ********                                                                                               *************
    *************************************************  stored procedure  **************************************************
 ********                                                                                               *************
    */



-- table requests
/**
  *  proc 2
  * get count of requests each month in year pass as parameter
 */
DELIMITER //
CREATE PROCEDURE prcoRequestByMonth(IN customDate date)
BEGIN
    SELECT m.name, COUNT(request.request_id)
    FROM months m
             LEFT JOIN request on MONTHNAME(request.request_date) = m.name
        and YEAR(request_date) = YEAR(customDate)
    GROUP BY FIELD(m.name, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                   'October', 'November', 'December');
END //
DELIMITER ;

/**
  *  proc 2
  * get count of requests each month in year by gender
 */
DELIMITER //
CREATE PROCEDURE getRequestsByGender(IN customDate date)
BEGIN
    SELECT m.name as 'month', COUNT(u.user_id) as 'count'
    FROM request r
             right JOIN months m on MONTHNAME(r.request_date) = m.name
             left JOIN users u on u.user_id = r.user_id
        and u.user_gender = usersGander
    GROUP BY m.name;
END //
DELIMITER ;


-- table users


/**
  *  proc 1
  * GET COUNT OF USERS EVERY MONTH
 */

DELIMITER //
CREATE PROCEDURE procUserCountByMonth(IN customDate YEAR)
BEGIN
    SELECT m.name as 'month', COUNT(u.user_id) as 'count'
    FROM users u
             RIGHT JOIN months m on m.name = MONTHNAME(u.created_at)
        AND YEAR(created_at) = customDate
    GROUP BY FIELD(m.name, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                   'October', 'November', 'December');
END //
DELIMITER ;


/**
  *  proc 2
  * GET COUNT OF USERS EVERY MONTH by gender
 */

DELIMITER //
CREATE PROCEDURE proc_UserCountByGender(IN gender CHAR(1))
BEGIN

    SELECT m.name as 'month', COUNT(u.user_id) as 'count'
    FROM users u
             RIGHT JOIN months m on m.name = MONTHNAME(u.created_at)
        AND u.user_gender = gender
    GROUP BY FIELD(m.name, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                   'October', 'November', 'December');
END //
DELIMITER ;






/**
  *  proc 2
  *Percentage of your requests per month
 */




DELIMITER //
CREATE or replace PROCEDURE proc_UserRequestsPercentage(IN id INT , IN year year)
    BEGIN
    select months.name , count(request.user_id), convert( COALESCE(count(request.request_id) * 100 / (select count(*) from request where monthname(request_date)=months.name),0),integer )
    from  request
              RIGHT JOIN  months on months.name = monthname(request_date)
        and  request.user_id = id
        and year(request.request_date) = year
    GROUP BY FIELD(months.name, 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
        'October', 'November', 'December');
    END //
DELIMITER ;